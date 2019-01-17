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
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CreatePropertyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('description', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('maxNumberPersons', IntegerType::class, ['attr' => ['class' => 'form-control']])
            ->add('postalCode', null, ['attr' => ['class' => 'form-control']])
            ->add('region', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('country', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('typeProperty', ChoiceType::class, [
                'choices' => [
                    'Appartement' => 'appartement',
                    'House' => 'house',
                ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('whole', CheckboxType::class, [
                'label' => 'Are you willing to rent your full property ?',
                'attr' => ['class' => 'form-check-input'],
                'required' => false
            ])
            ->add('pictures', FileType::class, [
                'multiple' => true,
            ])
            ->add('surface', TextType::class, ['attr' => ['class' => 'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
}
