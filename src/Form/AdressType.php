<?php

namespace App\Form;



use App\Entity\Adress;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label'=> 'Quel nom souhaitez-vous donner à votre adresse ?',
                'attr'=>[
                    'placeholder'=>'Nommez vore adresse'
                ]
            ])
            ->add('firstname',TextType::class,[
                'label'=> 'Votre Prénom',
                'attr'=>[
                    'placeholder'=>'Entrer votre prénom'
                ]
            ])
            ->add('lastname',TextType::class,[
                'label'=> 'Votre nom',
                'attr'=>[
                    'placeholder'=>'Entrer votre nom'
                ]
            ])
            ->add('company',TextType::class,[
                'label'=> 'Votre société',
                'attr'=>[
                    'placeholder'=>'(Facultatif) Entrer le nom de votre société'
                ]
            ])
            ->add('adress',TextType::class,[
                'label'=> 'Votre adresse',
                'attr'=>[
                    'placeholder'=>'255, Cité safco keur massar'
                ]
            ])
            ->add('postal',TextType::class,[
                'label'=> 'Votre code postal ?',
                'attr'=>[
                    'placeholder'=>'Entrer votre code postal'
                ]
            ])
            ->add('city',TextType::class,[
                'label'=> 'Votre Ville',
                'attr'=>[
                    'placeholder'=>'Entrer votre ville'
                ]
            ])
            ->add('conutry',CountryType::class,[
                'label'=> 'Pays',
                'attr'=>[
                    'placeholder'=>'Entrer votre pays'
                ]
            ])
            ->add('phone',TelType::class,[
                'label'=> 'Votre numéro de téléphone ',
                'attr'=>[
                    'placeholder'=>'77 734 82 89'
                ]
            ])
            ->add('submit', SubmitType::class,[
                'label'=> 'Valider',
                'attr'=>[
                    'class'=> 'btn btn-info btn-block mt-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adress::class,
        ]);
    }
}
 ?>
