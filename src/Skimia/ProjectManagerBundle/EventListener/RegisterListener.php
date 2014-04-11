<?php

namespace Skimia\ProjectManagerBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegisterListener implements EventSubscriberInterface{

	public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_INITIALIZE => 'onRegistrationInitialize',
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
            FOSUserEvents::REGISTRATION_COMPLETED => 'onRegistrationCompleted'
        );
    }

    public function onRegistrationInitialize(UserEvent $event){
        global $kernel;

        $formFactory = $kernel->getContainer()->get('fos_user.registration.form.factory');

        $user = $event->getUser();
        $request = $event->getRequest();
        
        $form = $formFactory->createForm();
        $form->setData($user);

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if (!$form->isValid()) {
                die(json_encode(array('form'=>$form)));
            }
        }else{
            die(json_encode(array('form'=>$form)));
        }
    }

    public function onRegistrationSuccess(FormEvent $event){
        global $kernel;
        $em = $kernel->getContainer()->get('doctrine')->getManager();
        $entity = $em->getRepository('SkimiaProjectManagerBundle:BetaKey')->findOneByKey($event->getRequest()->request->get('fos_user_registration_form')['key']);
        if(!$entity){
            throw new \Exception('key Undefined');
            //die(json_encode('));
        }
        if($entity->getUsages()<=0){
            throw new \Exception('key Invalide');
        }
        $entity->setUsages($entity->getUsages() -1);
        $em->persist($entity);
        //$em->flush();
        //die();
    }

    public function onRegistrationCompleted(FilterUserResponseEvent $event){
        die(json_encode($event->getUser()->getJson()));

    }
}