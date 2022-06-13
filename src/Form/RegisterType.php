<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Firstname', TextType::class, [
                'label'=>'Prénom',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre prénom'
                ]
                ])
            ->add('Lastname', TextType::class,[
                'label'=>'Nom',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre Nom'
                ]
            ])
            ->add('Email', EmailType::class,[
                'label'=>'Adresse Email',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre Adresse Email'
                ]   
            ])
            ->add('Password',PasswordType::class,[
                'label'=>'Mot de passe',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre Mot de passe'
                ]
            ])
            ->add('submit', SubmitType::class,[
                'label'=>"s'inscrire"  
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
