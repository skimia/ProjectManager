<?php

namespace Skimia\ProjectManagerBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Skimia\ProjectManagerBundle\Form\AnnouncementType;
use Skimia\ProjectManagerBundle\Entity\Announcement;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Util\Codes;

use JMS\SecurityExtraBundle\Annotation\Secure;


class AnnouncementController extends SPMRestController {

    /***************\
         CONFIG
    \***************/
    protected $_CREATE_ROLE = "ROLE_ADMIN";
    protected $_EDIT_ROLE = "ROLE_ADMIN";
    protected $_DELETE_ROLE = "ROLE_ADMIN";

    /***************\
         UTILITY
    \***************/

    protected function getRepository(){

        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('SkimiaProjectManagerBundle:Announcement');
    }

    protected function getNewFormInstance(){

        return new AnnouncementType();
    }


    /***************\
      REST ACTIONS
    \***************/

    /**
     * @Rest\View(serializerEnableMaxDepthChecks=true)
     */
    public function cgetAction(Request $request){

        return parent::cgetAction($request);
    }


    /**
     * @Rest\View(serializerEnableMaxDepthChecks=true)
     */
    public function getAction($id) {

        return parent::getAction($id);
    }

    public function cpostAction(Request $request) {

        $modifyEntity = function($entity,$form){
            $entity->setUser($this->getUser());
        };
        
        return parent::cpostActionMethod($request, array(), $modifyEntity);

    }

    public function postAction(Request $request, $id) {

        $modifyEntity = function($entity,$form){
            $entity->setUser($this->getUser());
        };
        
        return parent::postActionMethod($request, $id, array(), $modifyEntity);

    }


}
