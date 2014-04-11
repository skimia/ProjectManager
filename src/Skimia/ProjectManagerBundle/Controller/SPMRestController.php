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
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

abstract class SPMRestController extends FOSRestController implements ClassResourceInterface {

    /***************\
         CONFIG
    \***************/
    protected $_LIST = true;
    protected $_GET = true;
    protected $_CREATE = true;
    protected $_EDIT = true;
    protected $_DELETE = true;

    protected $_LIST_ROLE = false;
    protected $_GET_ROLE = false;
    protected $_CREATE_ROLE = "ROLE_USER";
    protected $_EDIT_ROLE = "ROLE_USER";
    protected $_DELETE_ROLE = "ROLE_USER";


	abstract protected function getRepository();
	abstract protected function getNewFormInstance();


	protected function getNewEntityInstance(){
		$class = $this->getRepository()->getClassName();
		return new $class();
	}

	/**
     * Get entity instance
     * @var integer $id Id of the entity
     * @return Entity
     */
    protected function getEntity($id, \Closure $verify = null) {
        $entity = $this->getRepository()->find($id);

        if (!$entity) throw $this->createNotFoundException('Unable to find  this entity');

        if(isset($verify)) $verify($entity);

        return $entity;
    }

	/**
     * REST LIST ACTION
     * @var Request $request
     * @return array
     * @Rest\View()
     */
	public function cgetAction(Request $request) {
        if(!$this->_LIST) throw new MethodNotAllowedHttpException(array());

        if($this->_LIST_ROLE !== false && false === $this->get('security.context')->isGranted($this->_LIST_ROLE))
            throw new AccessDeniedException();

        return $this->getRepository()->findAll();
    }

    /**
     * REST GET ACTION
     * @var integer $id Id of the entity
     * @return array
     * @Rest\View()
     */
    public function getAction($id) {
        if(!$this->_GET) throw new MethodNotAllowedHttpException(array());

        if($this->_GET_ROLE !== false && false === $this->get('security.context')->isGranted($this->_GET_ROLE))
            throw new AccessDeniedException();

        return $this->getEntity($id);
    }


    /**
     *  @Rest\View()
     */
    public function cpostAction(Request $request){
        if(!$this->_CREATE) throw new MethodNotAllowedHttpException(array());

    	return $this->cpostActionMethod($request);
    }

    /**
    * REST CREATE ACTION
    * @var Request $request
    * @var array $options Unused
    * @var Closure $modifyEntity Callback before $form->bind(); (:Data not safe)
    * @var Closure $security CallBack before $em->flush() & return; (:Data safe)
    * 
    */
    protected function cpostActionMethod(Request $request,
    	$options = array(),
    	\Closure $modifyEntity = null,
    	\Closure $security = null) {

        if($this->_CREATE_ROLE !== false && false === $this->get('security.context')->isGranted($this->_CREATE_ROLE))
            throw new AccessDeniedException();

        $entity = $this->getNewEntityInstance();
        $form = $this->createForm($this->getNewFormInstance(), $entity);

        if(isset($modifyEntity)) $modifyEntity($entity,$form);
        
        $form->bind($request);

        if ($form->isValid()) {

            $errorList = $this->get('validator')->validate($entity);
            if (count($errorList) > 0) {
                return $errorList;
            }

            $em = $this->getDoctrine()->getManager();

            if(isset($security)) $security($entity,$form);

            $em->persist($entity);
            $em->flush();

            return $entity;
        }

        return array(
            'form' => $form,
        );
    }


    /**
     *  @Rest\View()
     */
    public function postAction(Request $request, $id){
        if(!$this->_EDIT) throw new MethodNotAllowedHttpException(array());

    	return $this->postActionMethod($request, $id);
    }

    /**
    * REST EDIT ACTION
    * @var Request $request
    * @var integer $id Id of the entity
    * @var array $options Unused
    * @var Closure $modifyEntity Callback before $form->bind(); (:Data not safe)
    * @var Closure $security CallBack before $em->flush() & return; (:Data safe)
    * 
    */
    protected function postActionMethod(Request $request, $id,
     	$options = array(),
    	\Closure $modifyEntity = null,
    	\Closure $security = null) {

        if($this->_EDIT_ROLE !== false && false === $this->get('security.context')->isGranted($this->_EDIT_ROLE))
            throw new AccessDeniedException();

        $entity = $this->getEntity($id);
        $form = $this->createForm($this->getNewFormInstance(), $entity);

        if(isset($modifyEntity)) $modifyEntity($entity,$form);

        $form->bind($request);

        if ($form->isValid()) {

            $errorList = $this->get('validator')->validate($entity);
            if (count($errorList) > 0) {
                return $errorList;
            }

            $em = $this->getDoctrine()->getManager();

            if(isset($security)) $security($entity,$form);

            $em->persist($entity);
            $em->flush();

            return $entity;
        }

        return array(
            'form' => $form,
        );
    }


    /**
     *  @Rest\View()
     */
    public function deleteAction($id){
        if(!$this->_DELETE) throw new MethodNotAllowedHttpException(array());

        if($this->_DELETE_ROLE !== false && false === $this->get('security.context')->isGranted($this->_DELETE_ROLE))
            throw new AccessDeniedException();

    	return $this->deleteActionMethod($id);
    }

    /**
    * REST DELETE ACTION
    * @var integer $id Id of the entity
    * @var array $options Unused
    * @var Closure $beforeRemove Callback before $em->remove($entity);
    * @var Closure $afterRemove CallBack after $em->remove($entity);
    * 
    */
    protected function deleteActionMethod($id,
    	$options = array(),
    	\Closure $beforeRemove = null,
    	\Closure $afterRemove = null) {

        $entity = $this->getEntity($id);

        if(isset($beforeRemove)) $beforeRemove($entity);

        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);

        if(isset($afterRemove)) $afterRemove($entity);

        $em->flush();

        return $this->view(null, Codes::HTTP_NO_CONTENT);
    }


}