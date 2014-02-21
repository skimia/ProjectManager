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
class FieldController extends FOSRestController implements ClassResourceInterface {


    
    /**
     * Collection get action
     * @var Request $request
     * @return array
     *
     * @Rest\View()
     */
    public function cgetAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('SkimiaProjectManagerBundle:Field')->findAll();
        return $entities;
    }

    /**
     * Get action
     * @var integer $id Id of the entity
     * @return array
     *
     * @Rest\View()
     */
    public function getAction($id) {
        $entity = $this->getEntity($id);

        return $entity;
    }

    public function cpostAction(Request $request) {
        $entity = new Field();
        $form = $this->createForm(new FieldType(), $entity);
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $entity;
        }

        return array(
            'form' => $form,
        );
    }

    public function postAction(Request $request, $id) {
        $entity = $this->getEntity($id);
        $form = $this->createForm(new FieldType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->view(null, Codes::HTTP_NO_CONTENT);
        }

        return array(
            'form' => $form,
        );
    }

    public function deleteAction($id) {
        $entity = $this->getEntity($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        return $this->view(null, Codes::HTTP_NO_CONTENT);
    }

    /**
     * Get entity instance
     * @var integer $id Id of the entity
     * @return Organisation
     */
    protected function getEntity($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkimiaProjectManagerBundle:Field')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find announcement entity');
        }

        return $entity;
    }

}
