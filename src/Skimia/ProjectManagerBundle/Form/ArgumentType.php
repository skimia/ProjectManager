<?php

namespace Skimia\ProjectManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Skimia\AngularBundle\Form\EventListener\ResourceFormSubscriber;

class ArgumentType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
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
            ->add('default')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'spm_argument';
    }
}
