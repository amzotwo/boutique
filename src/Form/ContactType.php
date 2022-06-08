<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', Texttype::class, [
                'label' => 'Votre Prénom',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre prenom '
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => 'Votre Nom',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre nom '
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre Email',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre email '
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Votre Message',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre Message '
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn btn-info btn-block '
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
