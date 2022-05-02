<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangepasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Mon adresse email',
                'disabled' => true
            ])
            ->add('old_password', PasswordType::class, [
                'label' => 'Mon ancien mot de passe',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre mot de passe actuel'
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Les deux mot de passe ne sont pas identique',
                'label' => 'Confirmer votre mot de passe',
                'required' => true,
                'first_options' => ['label' => 'Mon nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de saisir votre mot de passe '
                    ]
                ],
                'second_options' => ['label' => 'Confirmer votre nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmer votre mot de passe '
                    ]
                ],

            ])
            ->add('prenom', TextType::class, [
                'label' => 'Mon Prenom',
                'disabled' => true
            ])
            ->add('nom', TextType::class, [
                'label' => 'Mon nom',
                'disabled' => true
            ])
            ->add('submit', SubmitType::class,[
                'label' => "Mettre à jour"

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
