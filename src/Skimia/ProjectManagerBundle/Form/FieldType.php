<?php

namespace Skimia\ProjectManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FieldType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('description')
                ->add('dbName')
                 ->add('entity','entity', array(
                    'class' => 'SkimiaProjectManagerBundle:Entity',
                    'property' => 'name',
                    'attr'=> array(
                        'class'=>'hide'
                        )
                ))
                ->add('type', 'choice', array(
                    'choices' => array(
                        'integer' => 'Integer',
                        'smallint' => 'SmallInt',
                        'bigint' => 'BigInt',
                        'string' => 'String',
                        'text' => 'Text',
                        'decimal' => 'Decimal',
                        'boolean' => 'Boolean',
                        'datetime' => 'DateTime',
                        'date' => 'Date',
                        'time' => 'Time',
                        'array' => 'Array',
                        'object' => 'Object',
                        'float' => 'Float',
                    ),
                ))
                ->add('options_nullable', 'checkbox', array(
                    'required' => false,
                    'property_path' => 'options["nullable"]'
                ))
                ->add('options_unique', 'checkbox', array(
                    'required' => false,
                    'property_path' => 'options["unique"]'
                ))
                ->add('options_length', 'integer', array(
                    'required' => false,  
                    'property_path' => 'options["length"]'
                ))
                ->add('options_precision', 'integer', array(
                    'required' => false,    
                    'property_path' => 'options["precision"]'                
                ))
                ->add('options_scale', 'integer', array(
                    'required' => false, 
                    'property_path' => 'options["scale"]'                   
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skimia\ProjectManagerBundle\Entity\Field',
            'csrf_protection' => false
        ));
    }

    public function getName() {
        return '';
    }

}
