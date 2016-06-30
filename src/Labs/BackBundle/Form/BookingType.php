<?php

namespace Labs\BackBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                    'class' => 'form-control'
                ]
            ))
            ->add('lieu', TextType::class, array(
                'label' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ))
            ->add('name', TextType::class, array(
                'label' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ))
            ->add('date_res',DateType::class, array(
                'label'  => false,
                'widget' => 'choice',
                'input'  => 'datetime',
                'format' => 'dd-MMMM-yyyy',
                'years'  => range(date('Y'), date('Y') - 30, -1)
            ))
            ->add('pack', EntityType::class, array(
                'class' => 'Labs\BackBundle\Entity\Packs',
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
            'data_class' => 'Labs\BackBundle\Entity\Booking'
        ));
    }
}
