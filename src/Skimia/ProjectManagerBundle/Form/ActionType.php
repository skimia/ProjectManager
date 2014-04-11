<?php

namespace Skimia\ProjectManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name')
            ->add('description')
            ->add('args','collection',array(
                'type'=>'spm_argument'
                ))
            ->add('controller','entity', array(
                    'class' => 'SkimiaProjectManagerBundle:Controller',
                    'property' => 'name',
            ))
            ->add('view','entity', array(
                    'class' => 'SkimiaProjectManagerBundle:View',
                    'property' => 'name',
            ))
            ->add('route','entity', array(
                    'class' => 'SkimiaProjectManagerBundle:Route',
                    'property' => 'name',
            ))
            ->add('services','entity', array(
                    'class' => 'SkimiaProjectManagerBundle:Service',
                    'property' => 'name',
            ))
                
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skimia\ProjectManagerBundle\Entity\Action',
            'csrf_protection' => false
        ));
    }

    public function getName() {
        return '';
    }

}
