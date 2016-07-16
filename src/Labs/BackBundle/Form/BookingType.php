<?php

namespace Labs\BackBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;


class BookingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => false,
                'attr' => [
                    'class' => 'sm-form-control'
                ]
            ))
            ->add('lieu', TextType::class, array(
                'label' => false,
                'attr' => [
                    'class' => 'sm-form-control'
                ]
            ))
            ->add('name', TextType::class, array(
                'label' => false,
                'attr' => [
                    'class' => 'sm-form-control'
                ]
            ))
            ->add('date_res',DateType::class, array(
                'widget' => 'single_text',
                'html5'  => false,
                'label'  => false,
                'attr' => ['class' => 'js-datepicker sm-form-control']
            ))
            ->add('packages',EntityType::class, array(
                'label' => false,
                'class' => 'LabsBackBundle:Packages',
                'choice_label' => 'name',
                'attr' => ['class' => 'sm-form-control']
            ))
            ->add('phone', PhoneNumberType::class, [
                'label' => false,
                'widget' => PhoneNumberType::WIDGET_SINGLE_TEXT,
                'country_choices' => ['CI'],
                'preferred_country_choices' => ['CI'],
                'attr' => ['class' => 'sm-form-control']
            ])
            ->add('mobile', PhoneNumberType::class, [
                'label' => false,
                'widget' => PhoneNumberType::WIDGET_SINGLE_TEXT,
                'country_choices' => ['CI'],
                'preferred_country_choices' => ['CI'],
                'attr' => ['class' => 'sm-form-control'],
            ])
            ->add('content', TextareaType::class,[
                'label' => false,
                'attr'  => ['class' => 'sm-form-control']
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Labs\BackBundle\Entity\Booking'
        ));
    }
}
