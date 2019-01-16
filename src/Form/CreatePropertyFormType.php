<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CreatePropertyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('maxNumberPersons', IntegerType::class)
            ->add('postalCode')
            ->add('region', TextType::class)
            ->add('country', TextType::class)
            ->add('typeProperty', ChoiceType::class, [
                'choices' => [
                    'Appartement' => 'appartement',
                    'House' => 'house',
                ],
            ])
            ->add('whole', CheckboxType::class, [
                'label' => 'Are you willing to rent your full property ?'
            ])
            ->add('pictures', FileType::class, [
                'multiple' => true
            ])
            ->add('surface', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
}
