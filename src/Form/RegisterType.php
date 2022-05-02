<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', Texttype::class, [
                'label' => 'Votre Prénom',
                'constraints'=> new Length(20, 3),
                'attr' => [
                    'placeholder' => 'Merci de saisir votre prenom '
                ]
            ])
            ->add('nom', Texttype::class, [
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

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux mot de passe ne sont pas identique',
                'label' => 'Confirmer votre mot de passe',
                'required' => true,
                'first_options' => ['label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de saisir votre mot de passe '
                    ]
                ],
                'second_options' => ['label' => 'Confirmer Mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmer votre mot de passe '
                    ]
                ],

            ])
            ->add('submit', SubmitType::class,[
                'label' => "S'inscrire"

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
