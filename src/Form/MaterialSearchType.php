<?php

namespace App\Form;

use App\Entity\Type;
use App\Search\SearchMaterial;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterialSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('q',TextType::class,[
                "required"=>false,
                "label"=>false,
                "empty_data"=>'',
                "attr"=> [
                    "placeholder"=> "Recherche",
                    'class' => 'mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm rounded-md'
                ]
            ])
            ->add('pvNumber',TextType::class,[
                "required"=>false,
                "label"=>false,
                "empty_data"=>'',
                'attr' => [
                    "placeholder"=> "Numéro de PV",
                    'class' => 'mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm rounded-md'],
            ])
            ->add('imeiNumber',TextType::class,[
                "label"=>false,
                "required"=>false,
                "empty_data"=>'',
                'attr' => [
                    "placeholder"=> "Numéro de IMEI",
                    'class' => 'mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm rounded-md'],
            ])
            ->add('marque',TextType::class,[
                "label"=>false,
                "required"=>false,
                "empty_data"=>'',
                'attr' => [
                    "placeholder"=> "Marque",
                    'class' => 'mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm rounded-md'],
            ])
            ->add('type',EntityType::class,[
                "required"=>false,
                'expanded' => true,
                'multiple' => true,
                'class'=> Type::class,
                'attr' => ['class' => 'mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-sky-500 focus:border-indigo-500 sm:text-sm rounded-md']
            ])
            ->add('state',ChoiceType::class,[
                "required"=>false,
                'expanded' => true,
                'multiple' => true,
                'label' => 'Etat',
                'choices'=>[
                    'Affecté' => 'READY',
                    'En stock' => 'STOCK',
                    'À détruire' => 'BEINGDESTROY',
                    'Détruit' => 'DESTROY',

                ],
                'attr' => ['class' => 'mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-sky-500 focus:border-indigo-500 sm:text-sm rounded-md']
            ])
            ->add('status',ChoiceType::class,[
                "required"=>false,
                'expanded' => true,
                'multiple' => true,
                'choices'=>[
                    'Débloqué' => 'UNLOCK',
                    'Bloqué' => 'TOBLOCK',
                    'inutilisable' => 'UNUSABLE',

                ],
                'attr' => ['class' => 'mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-sky-500 focus:border-indigo-500 sm:text-sm rounded-md']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchMaterial::class,
            "method"=>'get',
            'csrf_protection'=>false
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
