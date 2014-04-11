<?php
 
namespace Skimia\ProjectManagerBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
 
/**
 *
 * @ORM\Entity
 * @ORM\Table(name="controllers")
 */
class Controller {
 
    public static $__type = "Controller";
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
     * @var Bundle
     * @ORM\ManyToOne(targetEntity="Bundle", inversedBy="controllers")
     * @ORM\JoinColumn(name="bundle_id", referencedColumnName="id")
     */
    protected $bundle;
 
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="SimpleFunction", mappedBy="controller")
     */
    protected $functions;
 
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Route", mappedBy="controller")
     */
    protected $routes;
 
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Action", mappedBy="controller")
     */
    protected $actions;
 
    /**
     * Constructor
     */
    public function __construct() {
        $this->functions = new ArrayCollection();
        $this->routes = new ArrayCollection();
        $this->actions = new ArrayCollection();
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
     * @return Controller
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
     * @return Controller
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
     * Set bundle
     * @param Bundle $bundle
     * @return Controller
     */
    public function setBundle(Bundle $bundle) {
        $this->bundle = $bundle;
         
        if (!$bundle->getControllers()->contains($this)) {
            $bundle->addController($this);
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
     * Add function
     * @param SimpleFunction $simpleFunction
     * @return Controller
     */
    public function addFunction(SimpleFunction $simpleFunction) {
        $this->functions[] = $simpleFunction;
         
        if ($simpleFunction->getController() != $this) {
            $simpleFunction->setController($this);
        }
         
        return $this;
    }
 
    /**
     * Remove function
     * @param SimpleFunction $simpleFunction
     * @return Controller
     */
    public function removeFunction(SimpleFunction $simpleFunction) {
        $this->functions->removeElement($simpleFunction);
         
        if ($simpleFunction->getController() != $this) {
            $simpleFunction->setController($this);
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
 
    /**
     * Add route
     * @param Route $route
     * @return Controller
     */
    public function addRoute(Route $route) {
        $this->routes[] = $route;
         
        if ($route->getController() != $this) {
            $route->setController($this);
        }
         
        return $this;
    }
 
    /**
     * Remove route
     * @param Route $route
     * @return Controller
     */
    public function removeRoute(Route $route) {
        $this->routes->removeElement($route);
         
        if ($route->getController() != $this) {
            $route->setController($this);
        }
         
        return $this;
    }
 
    /**
     * Get routes
     * @return ArrayCollection
     */
    public function getRoutes() {
         
        return $this->routes;
    }
 
    /**
     * Add action
     * @param Action $action
     * @return Controller
     */
    public function addAction(Action $action) {
        $this->actions[] = $action;
         
        if ($action->getController() != $this) {
            $action->setController($this);
        }
         
        return $this;
    }
 
    /**
     * Remove action
     * @param Action $action
     * @return Controller
     */
    public function removeAction(Action $action) {
        $this->actions->removeElement($action);
         
        if ($action->getController() != $this) {
            $action->setController($this);
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
}