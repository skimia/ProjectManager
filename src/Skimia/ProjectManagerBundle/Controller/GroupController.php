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
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
/**
 * Description of Group
 *
 * @author Kessler
 */
class GroupController extends SPMRestController {

    /***************\
         UTILITY
    \***************/
    protected function getRepository(){

        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('SkimiaProjectManagerBundle:Group');
    }

    protected function getNewFormInstance(){

        return new GroupType();
    }

    public function cpostAction(Request $request) {

        $security = function($entity,$form){
            $entity->setMainUser($this->getUser());
            $entity->addRole('ROLE_GROUP_'.md5($entity->getName().microtime()));

            $em = $this->getDoctrine()->getManager();
            $users = $entity->getUsers();
            foreach($users as $user){
                $em->persist($user);
            }

            $aclProvider = $this->get('security.acl.provider');
            $objectIdentity = ObjectIdentity::fromDomainObject($entity);
            $acl = $aclProvider->createAcl($objectIdentity);

            $securityContext = $this->get('security.context');
            $securityIdentity = new RoleSecurityIdentity(current($entity->getRoles()));

            $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
            $aclProvider->updateAcl($acl);

        };
        
        return parent::cpostActionMethod($request, array(), null, $security);

    }

    public function postAction(Request $request, $id) {

        $security = function($entity,$form){
            $securityContext = $this->get('security.context');

            // check for edit access
            if (false === $securityContext->isGranted('EDIT', $entity))
            {
                throw new AccessDeniedException();
            }
        };
        
        return parent::postActionMethod($request, $id, array(), null, $security);

    }
    
    public function deleteAction($id) {

        $security = function($entity,$form){
            $securityContext = $this->get('security.context');

            // check for edit access
            if (false === $securityContext->isGranted('DELETE', $entity))
            {
                throw new AccessDeniedException();
            }
        };
        
        return parent::deleteActionMethod($id, array(), null, $security);

    }

}


