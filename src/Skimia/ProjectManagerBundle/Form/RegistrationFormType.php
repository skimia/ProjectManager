<?php

namespace Skimia\ProjectManagerBundle\Form;

 
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

 
class RegistrationFormType extends BaseType
{
	private $class;

    public function __construct($class)
    {
    	parent::__construct($class);
        $this->class = $class;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
        ->add('key','hidden',array('mapped'=>false))
        ;
    }
 
 	public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'csrf_protection' => false
        ));
    }

    public function getName()
    {
        return 'spm_registration';
    }
}