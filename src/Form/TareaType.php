<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TareaType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('titulo', TextType::class, array(
            'label' => 'Titulo'
        ))
        ->add('contenido', TextareaType::class, array(
            'label' => 'Contenido'
        ))
        ->add('prioridad', ChoiceType::class, array(
            'label' => 'Prioridad',
            'choices' => array(
                'Alta' => 'Alta',
                'Media' => 'Media',
                'Baja' => 'Baja'
            )
        ))
        ->add('horas', TextType::class, array(
            'label' => 'Horas presupuestadas'
        ))
        ->add('submit', SubmitType::class, array(
            'label' => 'Guardar'
        ))
        ;
    }
}