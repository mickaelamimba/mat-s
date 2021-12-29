<?php

namespace App\Form;


use App\Entity\Material;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imeiNumber',TextType::class, [
                'label' => 'Numéro IMEI',
                ])
            ->add('marque',TextType::class, [
                'label' => 'Marque',
            ])
            ->add('observation',TextareaType::class, [
                'label' => 'Observation',

            ])
            ->add('status',ChoiceType::class,[
                'expanded' => false,
                'multiple' => false,
                'choices'=>[
                    'Débloqué' => 'UNLOCK',
                    'Bloqué' => 'TOBLOCK',
                    'inutilisable' => 'UNUSABLE',

                ],
                'label' => 'Statut',

            ])
            ->add('type',EntityType::class,[
                "class"=>Type::class,
                ]

            )


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Material::class,
        ]);
    }
}
