<?php

namespace App\Form;

use App\Entity\Classes;
use App\Entity\Professeurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClassesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomClasse')->add('NomClasse', TextType::class, ['label' => 'Classe : '])

            // ->add('professeurs')

            ->add('professeurs', EntityType::class, [
                'class' => Professeurs::class,
                'choice_label' => 'nomProfesseur',
                ]);
             
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classes::class,
        ]);
    }
}
