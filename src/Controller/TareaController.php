<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Tarea;
use App\Entity\User;
use App\Form\TareaType;

class TareaController extends AbstractController
{
    public function index()
    {
        
        //Prueba de entidades y relaciones
        $em = $this->getDoctrine()->getManager();
        
        
        $repositorioTarea = $this->getDoctrine()->getRepository(Tarea::class);
        $tareas = $repositorioTarea->findBy([], ['id' => 'DESC']);
        
        /*
        foreach ($tareas as $tarea){
            echo $tarea->getUser()->getEmail(). " -> " . $tarea->getTitulo(). "<br/>";
        }
        
        $repositorioUsuario = $this->getDoctrine()->getRepository(User::class);
        $users = $repositorioUsuario->findAll();
        
        foreach ($users as $user){
            echo "<h1>{$user->getNombre()} {$user->getApellidos()}</h1>";
            
            foreach ($user->getTareas() as $tarea){
                echo $tarea->getTitulo(). "<br/>";
            }
        }
        * 
         */
        return $this->render('tarea/index.html.twig', [
            'tareas' => $tareas,
        ]);
    }
    
    public function detalle(Tarea $tarea){
        if(!$tarea){
            return $this->redirectToRoute('tareas');
        }
        
        return $this->render('tarea/detalle.html.twig', [
            'tarea' => $tarea
        ]);
    }
    
    public function crear(Request $request, UserInterface $user){
        $tarea = new Tarea();
        $form = $this->createForm(TareaType::class, $tarea);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $tarea->setCreatedAt(new \DateTime('now'));
            $tarea->setUser($user);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($tarea);
            $em->flush();
            
            return $this->redirect(
                    $this->generateUrl('detalleTarea', ['id' => $tarea->getId()]));
            }
        return $this->render('tarea/crear.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    public function misTareas(UserInterface $user){
        $tareas = $user->getTareas();
        return $this->render('tarea/misTareas.html.twig', [
            'tareas' => $tareas
        ]);
    }
    public function editar(Request $request, UserInterface $user, Tarea $tarea){
        if(!$user || $user->getId() != $tarea->getUser()->getId()){
            return $this->redirectToRoute('tareas');
        }
        $form = $this->createForm(TareaType::class, $tarea);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($tarea);
            $em->flush();
            
            return $this->redirect(
                    $this->generateUrl('detalleTarea', ['id' => $tarea->getId()]));
        }
        return $this->render('tarea/crear.html.twig', [
            'edit' => true,
            'form' => $form->createView()
        ]);
    }
    
    public function eliminar(UserInterface $user, Tarea $tarea){
        if(!$user || $user->getId() != $tarea->getUser()->getId()){
            return $this->redirectToRoute('tareas');
        }
        
        if(!$tarea){
            return $this->redirectToRoute('tareas');
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($tarea);
        $em->flush();
        
        return $this->redirectToRoute('tareas');
    }
}