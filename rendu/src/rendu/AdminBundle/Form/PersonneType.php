<?php

// src/rendu/AdminBundle/Form/PersonneType.php
namespace rendu\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('date_naissance')
            ->add('description')
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
        ;
    }
}