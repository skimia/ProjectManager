<?php

namespace Skimia\ProjectManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ControllerType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name')
            ->add('description')
            ->add('bundle','entity', array(
                    'class' => 'SkimiaProjectManagerBundle:Bundle',
                    'property' => 'name',
            ))
            ->add('functions','entity', array(
                    'class' => 'SkimiaProjectManagerBundle:SimpleFunction',
                    'property' => 'name',
            ))
            ->add('routes','entity', array(
                    'class' => 'SkimiaProjectManagerBundle:Route',
                    'property' => 'name',
            ))
            ->add('actions','entity', array(
                    'class' => 'SkimiaProjectManagerBundle:Action',
                    'property' => 'name',
            ))
                
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skimia\ProjectManagerBundle\Entity\Controller',
            'csrf_protection' => false
        ));
    }

    public function getName() {
        return '';
    }

}
