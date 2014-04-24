<?php

namespace Skimia\ProjectManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Skimia\ProjectManagerBundle\Entity\EntityPMRepository;
use Skimia\AngularBundle\Form\EventListener\ResourceFormSubscriber;

class RelationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('type', 'choice', array(
                    'choices' => array(
                        'OneToOne' => 'One To One',
                        'ManyToOne' => 'Many To One',
                        'ManyToMany' => 'Many To Many'
                    ),
                ))
                ->add('mainEntity', 'singleselect', array(
                    'class' => 'SkimiaProjectManagerBundle:Entity',
                    'property' => 'name',
                ))
                ->add('inversedEntity', 'singleselect', array(
                    'class' => 'SkimiaProjectManagerBundle:Entity',
                    'property' => 'name'
                ))
                
                ->add('options_mainfield', 'text', array(
                    'property_path' => 'options[mainfield]'
                ))
                ->add('options_inversedfield', 'text', array(
                    'property_path' => 'options[inversedfield]'
                ))
                ->add('options_bidirectionnal', 'checkbox', array(
                    'required' => false,
                    'property_path' => 'options[bidirectionnal]'
                ))
                ->add('options_joincolumn', 'text', array(
                    'required' => false,
                    'property_path' => 'options[joincolumn]'
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skimia\ProjectManagerBundle\Entity\Relation',
            'csrf_protection' => false
        ));
    }

    public function getName() {
        return '';
    }

}
