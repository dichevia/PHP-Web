<?php

namespace TopCarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand')
            ->add('model')
            ->add('body')
            ->add('year')
            ->add('fuel')
            ->add('power')
            ->add('topSpeed')
            ->add('acceleration')
            ->add('image', FileType::class,
                [
                    'mapped'=>false,
                    'required' =>false,
                    'constraints' =>[
                        new \Symfony\Component\Validator\Constraints\File([
                            'maxSize'=>'1024k',
                            'mimeTypes'=>'image/*',
                            'mimeTypesMessage' => 'Please upload a valid image file'
                        ])
                    ]
                ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TopCarBundle\Entity\Car'
        ));
    }

}
