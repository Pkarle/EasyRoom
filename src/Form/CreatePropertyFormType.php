<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreatePropertyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('maxNumberPersons')
            ->add('postalCode')
            ->add('region')
            ->add('country')
            ->add('typeProperty', ChoiceType::class, [
                'choices' => [
                    'Full property' => 'fullProperty',
                    'One room' => 'oneRoom',
                ],
            ])
            //->add('pictures')
            ->add('surface')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
}
