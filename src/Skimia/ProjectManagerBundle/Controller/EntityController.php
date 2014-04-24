<?php

namespace Skimia\ProjectManagerBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;

use Skimia\ProjectManagerBundle\Form\EntityType;
use Skimia\ProjectManagerBundle\Entity\Entity;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Util\Codes;

/**
 * Description of Entity
 *
 * @author Kessler
 */
class EntityController extends SPMRestController {

	protected function getRepository(){

        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('SkimiaProjectManagerBundle:Entity');
    }

    protected function getNewFormInstance(){

        return new EntityType();
    }

}

