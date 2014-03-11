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


class AnnouncementController extends FOSRestController implements ClassResourceInterface {

    /**
     * Collection get action
     * @var Request $request
     * @return array
     *
     * @Rest\View()
     */
    public function cgetAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('SkimiaProjectManagerBundle:Announcement')->findAll();
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

    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     */
    public function cpostAction(Request $request) {
        $entity = new Announcement();
        $entity->setUser($this->getUser());
        $form = $this->createForm(new AnnouncementType(), $entity);
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

    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     */
    public function postAction(Request $request, $id) {
        $entity = $this->getEntity($id);
        var_dump($entity);
        $form = $this->createForm(new AnnouncementType(), $entity);
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

    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     */
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

        $entity = $em->getRepository('SkimiaProjectManagerBundle:Announcement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find announcement entity');
        }

        return $entity;
    }

}
