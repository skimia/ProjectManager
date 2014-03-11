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
                ->add('nullable', 'checkbox', array(
                    'required' => false,
                ))
                ->add('unique', 'checkbox', array(
                    'required' => false,
                ))
                ->add('length', 'integer', array(
                    'required' => false,  
                ))
                ->add('precision', 'integer', array(
                    'required' => false,                    
                ))
                ->add('scale', 'integer', array(
                    'required' => false,                    
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
