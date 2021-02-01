<?php

namespace App\Form;

use App\Entity\Heros;
use App\Entity\Mission;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ['label' => 'Nom de la mission', 'attr' => ['class' => 'form-control']])
            ->add('description', TextareaType::class, ['label' => 'Description', 'attr' => ['class' => 'form-control']])
            ->add('dateFin', DateType::class, [
                'html5'=>true,
                'widget' => 'single_text',
                'label' => 'Date de fin', 
                
                'attr' => ['class' => 'form-control']
            ])
            ->add('difficulte', NumberType::class, ['label' => 'Difficulté', 'attr' => ['class' => 'form-control']])
            ->add('etat', ChoiceType::class, ['label' => 'Etat de la mission', 'choices' => [
                'Disponible' => 0,
                'En cours' => 1,
                'Terminée' => 2
            ], 'attr' => ['class' => 'form-control']])
            ->add('heros', EntityType::class, ['attr' => ['class' => 'form-control'],'required'=>false, 'label' => 'Héros à affecter', 'class' => Heros::class, 'choice_label' => 'nom', 'multiple' => true]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
