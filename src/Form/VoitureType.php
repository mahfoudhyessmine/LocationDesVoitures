<?php

namespace App\Form;

use App\Entity\Voiture;
use App\Entity\Agence;
use App\Entity\Client;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType ;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('Marque',TextType::class)
            ->add('Couleur',TextType::class)
            ->add('Nbdeplace',IntegerType::class,array('attr'=> array('min'=>1)))
            ->add('Description',TextareaType::class)
            ->add('Matricule',TextType::class)
            ->add('Disponiibilite',TextType::class)
            ->add('Datemiseencirculation',DateTimeType::class)
            ->add('Carburent',TextType::class)
            ->add('idagence',EntityType::class,[
                'class'=>Agence::class,
                'choice_label'=>'id',
                'label'=>'agence'])
            ->add('client',EntityType::class,[
                'class'=>Client::class,
                'choice_label'=>'id',
                'label'=>'client'])
            ->add('ajouter',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
