<?php

namespace Labs\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresse', TextareaType::class, [
                'label' => false,
                'attr' => array('class' => 'form-control')
            ])
            ->add('phone', TextType::class, [
                'label' => false,
                'attr' => array('class' => 'form-control')
            ])
            ->add('faxe', TextType::class, [
                'label' => false,
                'attr' => array('class' => 'form-control')
            ])
            ->add('skype', TextType::class, [
                'label' => false,
                'attr' => array('class' => 'form-control')
            ])
            ->add('twitter', TextType::class, [
                'label' => false,
                'attr' => array('class' => 'form-control')
            ])
            ->add('facebook', TextType::class, [
                'label' => false,
                'attr' => array('class' => 'form-control')
            ])
            ->add('youtube', TextType::class, [
                'label' => false,
                'attr' => array('class' => 'form-control')
            ])
            ->add('vimeo', TextType::class, [
                'label' => false,
                'attr' => array('class' => 'form-control')
            ])
            ->add('email', TextType::class, [
                'label' => false,
                'attr' => array('class' => 'form-control')
            ])
            ->add('pinterest', TextType::class, [
                'label' => false,
                'attr' => array('class' => 'form-control')
            ])
            ->add('instagram', TextType::class, [
                'label' => false,
                'attr' => array('class' => 'form-control')
            ])
            ->add('google', TextType::class, [
                'label' => false,
                'attr' => array('class' => 'form-control')
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Labs\BackBundle\Entity\Contacts'
        ));
    }
}
