<?php

namespace Labs\BackBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventsType extends AbstractType
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
            ->add('client', TextType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('video', TextType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('content', CKEditorType::class, array(
                'label' => false
            ))
            ->add('dateEvent',DateType::class, array(
                'label'  => false,
                'widget' => 'choice',
                'input'  => 'datetime',
                'format' => 'dd-MMMM-yyyy',
                'years'  => range(date('Y') + 10, date('Y') - 30, -1)
            ))
            ->add('category',EntityType::class, array(
                'label' => false,
                'class' => 'LabsBackBundle:Category',
                'choice_label' => 'name'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Labs\BackBundle\Entity\Events'
        ));
    }
}
