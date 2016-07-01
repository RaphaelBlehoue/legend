<?php

namespace Labs\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DossierType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weddingMen', TextType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('weddingWomen', TextType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('content', TextareaType::class, array(
                'label' => false,
                'attr'  => array(
                    'class' => 'form-control'
                )
            ))
            ->add('ceremonyDate',DateType::class, array(
                'label'  => false,
                'widget' => 'choice',
                'input'  => 'datetime',
                'format' => 'dd-MMMM-yyyy',
                'years'  => range(date('Y') + 10, date('Y') - 30, -1)
            ))
            ->add('colors',  TextareaType::class, array(
                'label' => false,
                'attr'  => array(
                    'class' => 'form-control'
                )
            ))
            ->add('video',  TextareaType::class, array(
                'label' => false,
                'attr'  => array(
                    'class' => 'form-control'
                )
            ))
            ->add('online', ChoiceType::class, array(
                'label' => false,
                'choices' => array(
                    'OUI' => true,
                    'NON' => false,
                ))
            )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Labs\BackBundle\Entity\Dossier'
        ));
    }
}
