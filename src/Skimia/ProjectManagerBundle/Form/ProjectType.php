<?php

namespace Skimia\ProjectManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Skimia\AngularBundle\Form\EventListener\ResourceFormSubscriber;

class ProjectType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('group','entity', array(
                    'class' => 'SkimiaProjectManagerBundle:Group',
                    'property' => 'name',
            ))
            ->add('bundles', 'multiselect', array(
                'label' => 'Bundles',
                'class' => 'SkimiaProjectManagerBundle:Bundle',
                'property' => 'name',
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skimia\ProjectManagerBundle\Entity\Project',
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
