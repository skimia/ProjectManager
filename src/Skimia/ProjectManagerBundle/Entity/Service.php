<?php
 
namespace Skimia\ProjectManagerBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
 
/**
 *
 * @ORM\Entity
 * @ORM\Table(name="services")
 */
class Service {
 
    public static $__type = "Service";
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    /**
     *
     * @var string
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
     *
     * @var array
     * @ORM\Column(type="array", name="fields", nullable=true)
     */
    protected $fields;
 
    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Action", inversedBy="services")
     */
    protected $actions;
 
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="SimpleFunction", mappedBy="service")
     */
    protected $functions;
 
    /**
     * Constructor
     */
    public function __construct() {
        $this->actions = new ArrayCollection();
        $this->functions = new ArrayCollection();
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
     * @return Service
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
     * @return Service
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
     * Set fields
     * @param array $fields
     * @return Service
     */
    public function setFields(array $fields) {
        $this->fields = $fields;
         
        return $this;
    }
 
    /**
     * Get fields
     * @return array
     */
    public function getFields() {
         
        return $this->fields;
    }
 
    /**
     * Add action
     * @param Action $action
     * @return Service
     */
    public function addAction(Action $action) {
        $this->actions[] = $action;
         
        if ($action->getServices()->contains($this)) {
            $action->addService($this);
        }
         
        return $this;
    }
 
    /**
     * Remove action
     * @param Action $action
     * @return Service
     */
    public function removeAction(Action $action) {
        $this->actions->removeElement($action);
         
        if ($action->getServices()->contains($this)) {
            $action->removeService($this);
        }
         
        return $this;
    }
 
    /**
     * Get actions
     * @return ArrayCollection
     */
    public function getActions() {
         
        return $this->actions;
    }
 
    /**
     * Add function
     * @param SimpleFunction $simpleFunction
     * @return Service
     */
    public function addFunction(SimpleFunction $simpleFunction) {
        $this->functions[] = $simpleFunction;
         
        if ($simpleFunction->getService() != $this) {
            $simpleFunction->setService($this);
        }
         
        return $this;
    }
 
    /**
     * Remove function
     * @param SimpleFunction $simpleFunction
     * @return Service
     */
    public function removeFunction(SimpleFunction $simpleFunction) {
        $this->functions->removeElement($simpleFunction);
         
        if ($simpleFunction->getService() != $this) {
            $simpleFunction->setService($this);
        }
         
        return $this;
    }
 
    /**
     * Get functions
     * @return ArrayCollection
     */
    public function getFunctions() {
         
        return $this->functions;
    }
}