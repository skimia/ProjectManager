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
use JMS\SecurityExtraBundle\Annotation\SatisfiesParentSecurityPolicy;


class BetakeyController extends SPMRestController {

    /***************\
         CONFIG
    \***************/
    protected $_LIST = false;
    protected $_CREATE = false;
    protected $_EDIT = false;
    protected $_DELETE = false;

    /***************\
         UTILITY
    \***************/

    protected function getRepository(){

        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('SkimiaProjectManagerBundle:BetaKey');
    }

    protected function getNewFormInstance(){

        return null;
    }

}
