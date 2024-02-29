<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username', TextType::class, [
            'required' => true,
            // 'help' => 'Le prénom de l auteur'
        ])
        ->add('firstname', TextType::class, [
            'required' => true,
            //'help' => "Le nom de famille de l auteur"
        ])
        ->add('lastname', TextType::class, [
            'required' => true,
            //'help' => "Le nom de famille de l auteur"
        ])
         ->add('email', EmailType::class, [
        //     'help' => "Le mail professionnel de l auteur auquel il peut être contacté"
         ])
    ;
        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

