<?php

namespace Labs\BackBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;



class AboutType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichImageType::class,array(
                'label' => false,
                'required' => false,
                'allow_delete' => true
            ))
            ->add('title',TextType::class,array('label' => false, 'attr'  => array('class' => 'form-control')))
            ->add('subtitle',TextType::class,array('label' => false, 'attr'  => array('class' => 'form-control')))
            ->add('titleWhy',TextType::class,array('label' => false, 'attr'  => array('class' => 'form-control')))
            ->add('titleMission',TextType::class,array('label' => false, 'attr'  => array('class' => 'form-control')))
            ->add('titleDo',TextType::class,array('label' => false, 'attr'  => array('class' => 'form-control')))
            ->add('contentWhy', CKEditorType::class, array(
                'label' => false
            ))
            ->add('contentMission', CKEditorType::class, array(
                'label' => false
            ))
            ->add('contentDo', CKEditorType::class, array(
                'label' => false
            ))
            ->add('video',TextType::class,array('label' => false, 'attr'  => array('class' => 'form-control')))
            ->add('contentVideo', CKEditorType::class, array(
                'label' => false
            ))
            ->add('titleVideo',TextType::class,array('label' => false, 'attr'  => array('class' => 'form-control')))
            ->add('bannerImage', EntityType::class, array(
                 'class' => 'LabsBackBundle:BannerImage',
                 'choice_label' => 'name',
                'query_builder' => function(EntityRepository $repository) {
                    // This will return a query builder selecting all universities
                    return $repository->createQueryBuilder('u');
                }
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Labs\BackBundle\Entity\About'
        ));
    }
}
