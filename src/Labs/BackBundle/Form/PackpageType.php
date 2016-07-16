<?php

namespace Labs\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class PackpageType extends AbstractType
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
            ->add('title', TextType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('subTitle', TextType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('content', CKEditorType::class, array(
                'label' => false
            ))
            ->add('imageFile', VichImageType::class,array(
                'label' => false,
                'required' => false,
                'allow_delete' => true
            ))
            ->add('allpackTitle', TextType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('allpackSubtitle', TextType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control')
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Labs\BackBundle\Entity\Packpage'
        ));
    }
}
