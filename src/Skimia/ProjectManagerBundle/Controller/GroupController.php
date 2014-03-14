<?php

namespace Skimia\ProjectManagerBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;

use Skimia\ProjectManagerBundle\Form\GroupType;
use Skimia\ProjectManagerBundle\Entity\Group;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Util\Codes;

use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
/**
 * Description of Group
 *
 * @author Kessler
 */
class GroupController extends FOSRestController implements ClassResourceInterface {


    
    /**
     * Collection get action
     * @var Request $request
     * @return array
     * @Secure(roles="ROLE_USER")
     * 
     * @Rest\View()
     */
    public function cgetAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('SkimiaProjectManagerBundle:Group')->findByUser($this->getUser());
        return $entities;
    }

    /**
     * @Secure(roles="ROLE_USER")
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
     * @Secure(roles="ROLE_USER")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return type
     */
    public function cpostAction(Request $request) {
        $entity = new Group();
        $form = $this->createForm(new GroupType(), $entity);
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setMainUser($this->getUser());
            $entity->addRole('ROLE_GROUP_'.md5($entity->getName().microtime()));
            $em->persist($entity);
            $em->flush();
            //Security don des droits d'access au main_user
            $aclProvider = $this->get('security.acl.provider');
            $objectIdentity = ObjectIdentity::fromDomainObject($entity);
            $acl = $aclProvider->createAcl($objectIdentity);

            $securityContext = $this->get('security.context');
            $securityIdentity = UserSecurityIdentity::fromAccount($this->getUser());

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
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param type $id
     * @return type
     */
    public function postAction(Request $request, $id) {
        $entity = $this->getEntity($id);
        if($entity->getMainUser()!= $this->getUser())
            throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException();
        $form = $this->createForm(new GroupType(), $entity);
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

        $entity = $em->getRepository('SkimiaProjectManagerBundle:Group')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Group Entity');
        }
        if(!$entity->canDisplay($this->getUser())){
            throw $this->createNotFoundException('Unable to find Group');
        }
        return $entity;
    }

}


