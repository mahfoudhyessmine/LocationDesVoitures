<?php

namespace App\Form;

use App\Entity\Contrat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Form\Type\EntityType ;
use App\Entity\Voiture;
use App\Entity\Client;


class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
        
        
            ->add('type',TextType::class)
            ->add('datededepart',DateType::class , [
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                ]
            ])
            ->add('datederouteur',DateType::class, 
            [
             'placeholder' => [ 'year' => 'Year', 'month' => 'Month', 'day' => 'Day', ],
                    
            ])
               
            ->add('voiture',EntityType::class,[
                'class'=>Voiture::class,
                'choice_label'=>'id',
                'label'=>'voiture'])

                ->add('client',EntityType::class,[
                    'class'=>Client::class,
                    'choice_label'=>'id',
                    'label'=>'Client'])

            ->add('Ajouter',SubmitType::class)

         
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}
