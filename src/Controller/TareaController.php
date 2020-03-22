<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tarea;
use App\Entity\User;

class TareaController extends AbstractController
{
    public function index()
    {
        
        //Prueba de entidades y relaciones
        $em = $this->getDoctrine()->getManager();
        
        /*
        $repositorioTarea = $this->getDoctrine()->getRepository(Tarea::class);
        $tareas = $repositorioTarea->findAll();
        
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
            'controller_name' => 'TareaController',
        ]);
    }
}
