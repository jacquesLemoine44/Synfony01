<?php

namespace App\Form;

use App\Entity\Eleves;
use App\Entity\Classes;
use App\Entity\Professeurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class ElevesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEleve')->add('nomEleve', TextType::class, ['label' => 'Elève : '])
            ->add('prenomEleve')->add('prenomEleve', TextType::class, ['label' => 'Prénom : '])

            // ->add('dateNaissance')
            // ou           
             ->add('dateNaissance')->add('dateNaissance', BirthdayType::class, ['placeholder' => 'Sélectionner : ',])

            // ->add('classes')
            ->add('classes', EntityType::class, [
                'class' => Classes::class,
                'choice_label' => 'nomClasse',
                ]);            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eleves::class,
        ]);
    }
}
