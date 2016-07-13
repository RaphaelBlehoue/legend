<?php

namespace Labs\BackBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;
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
            ->add('name', TextType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('weddingMen', TextType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('weddingWomen', TextType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('content', CKEditorType::class, array(
                'label' => false
            ))
            ->add('ceremonyDate',DateType::class, array(
                'label'  => false,
                'widget' => 'choice',
                'input'  => 'datetime',
                'format' => 'dd-MMMM-yyyy',
                'years'  => range(date('Y') + 10, date('Y') - 30, -1)
            ))
            ->add('video',TextType::class, array(
                'label' => false,
                'attr'  => array(
                    'class' => 'form-control'
                )
            ))
            ->add('video_prewedding',TextType::class, array(
                'label' => false,
                'attr'  => array(
                    'class' => 'form-control'
                )
            ))
            ->add('package',EntityType::class, array(
                'label' => false,
                'class' => 'LabsBackBundle:Packages',
                'choice_label' => 'name'
            ))
            ->add('profileWomenFile', VichImageType::class,array(
                'label' => false,
                'required' => false,
                'allow_delete' => true
            ))
            ->add('profileMenFile', VichImageType::class,array(
                'label' => false,
                'required' => false,
                'allow_delete' => true
            ))
            ->add('content_wedding_men', CKEditorType::class, array(
                'label' => false
            ))
            ->add('content_wedding_women', CKEditorType::class, array(
                'label' => false
            ))
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
