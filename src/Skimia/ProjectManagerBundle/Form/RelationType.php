<?php

namespace Skimia\ProjectManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Skimia\ProjectManagerBundle\Entity\EntityPMRepository;

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
                ->add('mainEntity', 'entity', array(
                    'class' => 'SkimiaProjectManagerBundle:Entity',
                    'property' => 'name',
                ))
                ->add('linkedEntity', 'entity', array(
                    'class' => 'SkimiaProjectManagerBundle:Entity',
                    'property' => 'name'
                ))
                ->add('mainField', 'text', array(
                    'required' => false
                ))
                ->add('linkedField', 'text', array(
                    'required' => false
                ))
                ->add('bidirectionnal', 'checkbox', array(
                    'required' => false
                ))
                ->add('joinColumn', null, array(
                    'required' => false
                ))
                ->add('joinTable', null, array(
                    'required' => false
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
