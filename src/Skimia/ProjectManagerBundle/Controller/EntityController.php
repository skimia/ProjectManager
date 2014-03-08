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
class EntityController extends FOSRestController implements ClassResourceInterface {


    
    /**
     * Collection get action
     * @var Request $request
     * @return array
     *
     * @Rest\View()
     */
    public function cgetAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('SkimiaProjectManagerBundle:Entity')->findAll();
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
        $entity = new Entity();
        $bundle = $this->container->get('doctrine')->getRepository('SkimiaProjectManagerBundle:Bundle')->find(intval($request->request->get('bundle')));      
        $request->request->remove('bundle');
        
        $form = $this->createForm(new EntityType(), $entity);
        $form->bind($request);
        $entity->setBundle($bundle); 
        
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
        $form = $this->createForm(new EntityType(), $entity);
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

        $entity = $em->getRepository('SkimiaProjectManagerBundle:Entity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find announcement entity');
        }

        return $entity;
    }

}

