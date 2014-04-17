<?php
 
namespace Skimia\ProjectManagerBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fonction PHP
 * @ORM\Entity
 * @ORM\Table(name="functions")
 */
class SimpleFunction {
 
    public static $__type = "SimpleFunction";
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    /**
     * Nom de la fonction
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min = "3",max = "255")
     * @ORM\Column(type="string", name="name", length=255)
     */
    protected $name;
 
    /**
     *
     * @var text
     * @ORM\Column(type="text", name="description", nullable=true)
     */
    protected $description;
 
    /**
     * Arguments de la fonction
     * @var array
     * @ORM\Column(type="array", name="args", nullable=true)
     */
    protected $args;
 
    /**
     *
     * @var array
     * @ORM\Column(type="array", name="code", nullable=true)
     */
    protected $code;
 
    /**
     * @var Entity
     * @ORM\ManyToOne(targetEntity="Entity", inversedBy="functions")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id", nullable=true)
     */
    protected $entity;
 
    /**
     * @var Repository
     * @ORM\ManyToOne(targetEntity="Repository", inversedBy="functions")
     * @ORM\JoinColumn(name="repository_id", referencedColumnName="id", nullable=true)
     */
    protected $repository;
 
    /**
     * @var Controller
     * @ORM\ManyToOne(targetEntity="Controller", inversedBy="functions")
     * @ORM\JoinColumn(name="controller_id", referencedColumnName="id", nullable=true)
     */
    protected $controller;
 
    /**
     * @var Service
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="functions")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id", nullable=true)
     */
    protected $service;
 
    /**
     * Constructor
     */
    public function __construct() {
    }
 
    /**
     * Get id
     * @return integer
     */
    public function getId() {
         
        return $this->id;
    }
 
    /**
     * Set name
     * @param string $name
     * @return Function
     */
    public function setName($name) {
        $this->name = $name;
         
        return $this;
    }
 
    /**
     * Get name
     * @return string
     */
    public function getName() {
         
        return $this->name;
    }
 
    /**
     * Set description
     * @param text $description
     * @return Function
     */
    public function setDescription($description) {
        $this->description = $description;
         
        return $this;
    }
 
    /**
     * Get description
     * @return text
     */
    public function getDescription() {
         
        return $this->description;
    }
 
    /**
     * Set args
     * @param array $args
     * @return Function
     */
    public function setArgs(array $args) {
        $this->args = $args;
         
        return $this;
    }
 
    /**
     * Get args
     * @return array
     */
    public function getArgs() {
         
        return $this->args;
    }
 
    /**
     * Set code
     * @param array $code
     * @return Function
     */
    public function setCode(array $code) {
        $this->code = $code;
         
        return $this;
    }
 
    /**
     * Get code
     * @return array
     */
    public function getCode() {
         
        return $this->code;
    }
 
    /**
     * Set entity
     * @param Entity $entity
     * @return Function
     */
    public function setEntity(Entity $entity) {
        $this->entity = $entity;
         
        if (!$entity->getFunctions()->contains($this)) {
            $entity->addFunction($this);
        }
         
        return $this;
    }
 
    /**
     * Get entity
     * @return Entity
     */
    public function getEntity() {
         
        return $this->entity;
    }
 
    /**
     * Set repository
     * @param Repository $repository
     * @return Function
     */
    public function setRepository(Repository $repository) {
        $this->repository = $repository;
         
        if (!$repository->getFunctions()->contains($this)) {
            $repository->addFunction($this);
        }
         
        return $this;
    }
 
    /**
     * Get repository
     * @return Repository
     */
    public function getRepository() {
         
        return $this->repository;
    }
 
    /**
     * Set controller
     * @param Controller $controller
     * @return Function
     */
    public function setController(Controller $controller) {
        $this->controller = $controller;
         
        if (!$controller->getFunctions()->contains($this)) {
            $controller->addFunction($this);
        }
         
        return $this;
    }
 
    /**
     * Get controller
     * @return Controller
     */
    public function getController() {
         
        return $this->controller;
    }
 
    /**
     * Set service
     * @param Service $service
     * @return Function
     */
    public function setService(Service $service) {
        $this->service = $service;
         
        if (!$service->getFunctions()->contains($this)) {
            $service->addFunction($this);
        }
         
        return $this;
    }
 
    /**
     * Get service
     * @return Service
     */
    public function getService() {
         
        return $this->service;
    }
}