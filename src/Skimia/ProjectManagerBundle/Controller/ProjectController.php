<?php

namespace Skimia\ProjectManagerBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;

use Skimia\ProjectManagerBundle\Form\ProjectType;
use Skimia\ProjectManagerBundle\Entity\Project;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Util\Codes;

use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
/**
 * Description of Project
 *
 * @author Kessler
 */
class ProjectController extends FOSRestController implements ClassResourceInterface {


    
    /**
     * Collection get action
     * @var Request $request
     * @return array
     * @Secure(roles="ROLE_USER")
     * @Rest\View()
     */
    public function cgetAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('SkimiaProjectManagerBundle:Project')->findAll();
        return $entities;
    }

    /**
     * Get action
     * @var integer $id Id of the entity
     * @return array
     * @Secure(roles="ROLE_USER")
     * @Rest\View()
     */
    public function getAction($id) {
        $entity = $this->getEntity($id);

        return $entity;
    }

    /**
     * @Secure(roles="ROLE_USER")
     */
    public function cpostAction(Request $request) {
        $entity = new Project();
        $form = $this->createForm(new ProjectType(), $entity);
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //Security don des droits d'access au main_user
            $aclProvider = $this->get('security.acl.provider');
            $objectIdentity = ObjectIdentity::fromDomainObject($entity);
            try {
                $acl = $aclProvider->findAcl($objectIdentity);
            } catch (AclNotFoundException $e) {
                $acl = $aclProvider->createAcl($objectIdentity);
            }

            $securityContext = $this->get('security.context');
            $securityIdentity = new RoleSecurityIdentity($entity->getGroup()->getRoles()[0]);

            $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
            $aclProvider->updateAcl($acl);
            return $entity;
        }

        return array(
            'form' => $form,
        );
    }

    /**
     * @Secure(roles="ROLE_USER")
     */
    public function postAction(Request $request, $id) {
        $entity = $this->getEntity($id);
        $securityContext = $this->get('security.context');

        // check for edit access
        if (false === $securityContext->isGranted('EDIT', $entity))
        {
            throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException();
        }

        $form = $this->createForm(new ProjectType(), $entity);
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
     * @Secure(roles="ROLE_USER")
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

        $entity = $em->getRepository('SkimiaProjectManagerBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity');
        }
        if(!$entity->canDisplay($this->getUser())){
            throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException();
        }

        return $entity;
    }

}
