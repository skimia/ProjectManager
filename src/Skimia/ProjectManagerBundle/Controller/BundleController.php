<?php

namespace Skimia\ProjectManagerBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;

use Skimia\ProjectManagerBundle\Form\BundleType;
use Skimia\ProjectManagerBundle\Entity\Bundle;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Util\Codes;

/**
 * Description of Bundle
 *
 * @author Kessler
 */
class BundleController extends SPMRestController {

    /***************\
         UTILITY
    \***************/

    protected function getRepository(){

        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('SkimiaProjectManagerBundle:Bundle');
    }

    protected function getNewFormInstance(){

        return new BundleType();
    }
    
}
