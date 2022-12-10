<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Type;
use App\Entity\Weapons;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeaponsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Nom de l\'arme',])
            ->add('UnlockAt', IntegerType::class,
            [ 'label' => 'Nombre d\'armes nécessaires' ])
            ->add('InsightDrop', IntegerType::class,
                [ 'label' => 'Nombre d\'armes obtenue' ])
            ->add('Level', IntegerType::class,
                [ 'label' => 'Niveau de l\'arme craftée' ])
            ->add('Type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'name'])
            ->add('Crafted', CheckboxType::class,  [
                'label' => 'Est-elle craftée ?',
                'required' => false,
                ])
            ->add('LocationDrop', EntityType::class, [
                'label' => 'Où l\'obtenir',
                'class' => Location::class,
                'choice_label' => 'name',
            ])
            ->add('Sauvegarder', SubmitType::class, [
                'attr' => ['label' => 'Sauver', 'class' => 'w-100 btn-dark btn'],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Weapons::class,
        ]);
    }
}
