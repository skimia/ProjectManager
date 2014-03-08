<?php

namespace Skimia\ProjectManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Skimia\AngularBundle\Form\EventListener\ResourceFormSubscriber;

class FieldType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'Nom'
            ))
            ->add('type')
            ->add('dbName', 'text', array(
                'label' => 'Nom du champ (BDD)'
            ))
            ->add('options')
            ->add('entity', 'hidden', array(
                'data_class' => 'Skimia\ProjectManagerBundle\Entity\Entity'
            ))
        ;
        $builder->addEventSubscriber(new ResourceFormSubscriber());
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skimia\ProjectManagerBundle\Entity\Field',
            'csrf_protection'   => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}
