<?php

namespace Skimia\ProjectManagerBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;

use Skimia\ProjectManagerBundle\Form\RelationType;
use Skimia\ProjectManagerBundle\Entity\Relation;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Util\Codes;

/**
 * Description of Entity
 *
 * @author Kessler
 */
class RelationController extends SPMRestController {

	protected function getRepository(){

        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('SkimiaProjectManagerBundle:Relation');
    }

    protected function getNewFormInstance(){

        return new RelationType();
    }

}

