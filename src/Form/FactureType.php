<?php

namespace App\Form;

use App\Entity\Facture;
use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType ;
use Symfony\Component\Form\Extension\Core\Type\LignesType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datedefacture',DateTimeType::class)
            ->add('montant',IntegerType::class)
            ->add('payee',CheckboxType::class , [
                'label'    => 'payee',
                'required' => false,
            ])
            ->add('client',EntityType::class , [
                'class' => Client::class ,
                'choice_label' => 'id' ,
                'label' => 'Client'
               
            ])
            ->add('Ajouter',SubmitType::class)
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
