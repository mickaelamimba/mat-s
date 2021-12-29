<?php

namespace App\Form;

use App\Entity\Ready;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReadyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nigend',NumberType::class,[
                'label' => 'Nigend',
            ])
            ->add('userName',TextType::class,[
                'label' => "Nom d'utilisateur",
            ])
            ->add('materiel',CollectionType::class,[
                'entry_type'=>MaterialType::class,
                'by_reference' => false,
                'allow_add' => false,
                'allow_delete' => false,
                'attr'=> [ 'readonly' => true ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ready::class,
        ]);
    }
}
