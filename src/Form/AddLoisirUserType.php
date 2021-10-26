<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\Loisir;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddLoisirUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', EntityType::class, [
                'choice_label' => 'nom',
                'class' => Loisir::class,
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('activities', EntityType::class, [
                'choice_label' => 'activities',
                'class' => Activity::class,
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Loisir::class,
        ]);
    }
}
