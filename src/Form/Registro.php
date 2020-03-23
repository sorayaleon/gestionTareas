<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class Registro extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('nombre', TextType::class, array(
            'label' => 'Nombre'
        ))
        ->add('apellidos', TextType::class, array(
            'label' => 'Apellidos'
        ))
        ->add('email', EmailType::class, array(
            'label' => 'Email'
        ))
        ->add('password', PasswordType::class, array(
            'label' => 'Password'
        ))
        ->add('submit', SubmitType::class, array(
            'label' => 'Registrarme'
        ))
        ;
    }
}