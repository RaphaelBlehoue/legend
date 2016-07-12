<?php

namespace Labs\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BestType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('content', TextareaType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('imageFile', VichImageType::class,array(
                'label' => false,
                'required' => false,
                'allow_delete' => true
            ))
            ->add('genre', ChoiceType::class, array(
                    'label' => false,
                    'choices' => array(
                        'BEST MAN' => true,
                        'BEST WOMEN' => false,
                    ))
            )
            ->add('top', ChoiceType::class, array(
                'label' => false,
                'choices' => array(
                    'OUI' => true,
                    'NON' => false,
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Labs\BackBundle\Entity\Best'
        ));
    }
}
