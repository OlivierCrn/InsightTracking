<?php

namespace App\Form;

use App\Entity\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name')
            ->add('AmmoType', ChoiceType::class, [
            'choices' => [
                    'Classic' => 'Classic',
                    'Verte' => 'Verte',
                    'Violette' => 'Violette'
    ],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Type::class,
        ]);
    }
}
