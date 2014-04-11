<?php
 
namespace Skimia\ProjectManagerBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
 
/**
 *
 * @ORM\Entity
 * @ORM\Table(name="routes")
 */
class Route {
 
    public static $__type = "Route";
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
     * @var string
     * @ORM\Column(type="string", name="pattern", length=255)
     */
    protected $pattern;
 
    /**
     *
     * @var array
     * @ORM\Column(type="array", name="defaults")
     */
    protected $defaults;
 
    /**
     *
     * @var array
     * @ORM\Column(type="array", name="requirements", nullable=true)
     */
    protected $requirements;
 
    /**
     * @var Controller
     * @ORM\ManyToOne(targetEntity="Controller", inversedBy="routes")
     * @ORM\JoinColumn(name="controller_id", referencedColumnName="id")
     */
    protected $controller;
 
    /**
     * @var Bundle
     * @ORM\ManyToOne(targetEntity="Bundle", inversedBy="routes")
     * @ORM\JoinColumn(name="bundle_id", referencedColumnName="id")
     */
    protected $bundle;
 
    /**
     * @var Action
     * @ORM\OneToOne(targetEntity="Action", inversedBy="route")
     * @ORM\JoinColumn(name="action_id", referencedColumnName="id")
     */
    protected $action;
 
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
     * @return Route
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
     * Set pattern
     * @param string $pattern
     * @return Route
     */
    public function setPattern($pattern) {
        $this->pattern = $pattern;
         
        return $this;
    }
 
    /**
     * Get pattern
     * @return string
     */
    public function getPattern() {
         
        return $this->pattern;
    }
 
    /**
     * Set defaults
     * @param array $defaults
     * @return Route
     */
    public function setDefaults(array $defaults) {
        $this->defaults = $defaults;
         
        return $this;
    }
 
    /**
     * Get defaults
     * @return array
     */
    public function getDefaults() {
         
        return $this->defaults;
    }
 
    /**
     * Set requirements
     * @param array $requirements
     * @return Route
     */
    public function setRequirements(array $requirements) {
        $this->requirements = $requirements;
         
        return $this;
    }
 
    /**
     * Get requirements
     * @return array
     */
    public function getRequirements() {
         
        return $this->requirements;
    }
 
    /**
     * Set controller
     * @param Controller $controller
     * @return Route
     */
    public function setController(Controller $controller) {
        $this->controller = $controller;
         
        if (!$controller->getRoutes()->contains($this)) {
            $controller->addRoute($this);
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
     * Set bundle
     * @param Bundle $bundle
     * @return Route
     */
    public function setBundle(Bundle $bundle) {
        $this->bundle = $bundle;
         
        if (!$bundle->getRoutes()->contains($this)) {
            $bundle->addRoute($this);
        }
         
        return $this;
    }
 
    /**
     * Get bundle
     * @return Bundle
     */
    public function getBundle() {
         
        return $this->bundle;
    }
 
    /**
     * Set action
     * @param Action $action
     * @return Route
     */
    public function setAction(Action $action) {
        $this->action = $action;
         
        if ($action->getRoute() != $this) {
            $action->setRoute($this);
        }
         
        return $this;
    }
 
    /**
     * Get action
     * @return Action
     */
    public function getAction() {
         
        return $this->action;
    }
}