<?php

namespace Skimia\ProjectManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EntityType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name')
            ->add('description')
            ->add('tableName')
            ->add('repository','entity', array(
                'class' => 'SkimiaProjectManagerBundle:Repository',
                'property' => 'name',
            ))
            ->add('bundle','entity', array(
                    'class' => 'SkimiaProjectManagerBundle:Bundle',
                    'property' => 'name',
                    'attr'=> array(
                        'class'=>'hide'
                        )
            ))
            ->add('form','entity', array(
                    'class' => 'SkimiaProjectManagerBundle:Form',
                    'property' => 'name',
            ))
            ->add('functions','multiselect', array(
                    'class' => 'SkimiaProjectManagerBundle:SimpleFunction',
                    'property' => 'name',
                    'label'=> 'Functions'
            ))
            ->add('lifecycleCallbacks','multiselect', array(
                    'class' => 'SkimiaProjectManagerBundle:LifecycleCallback',
                    'property' => 'name',
                    'label'=> 'Callbacks'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skimia\ProjectManagerBundle\Entity\Entity',
            'csrf_protection' => false
        ));
    }

    public function getName() {
        return '';
    }

}
