<?php

namespace Skimia\ProjectManagerBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;

use Skimia\ProjectManagerBundle\Form\FieldType;
use Skimia\ProjectManagerBundle\Entity\Field;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Util\Codes;

/**
 * Description of Field
 *
 * @author Kessler
 */
class FieldController extends SPMRestController {

	protected function getRepository(){

        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('SkimiaProjectManagerBundle:Field');
    }

    protected function getNewFormInstance(){

        return new FieldType();
    }

}
