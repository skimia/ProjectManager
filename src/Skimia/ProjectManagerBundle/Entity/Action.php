<?php
 
namespace Skimia\ProjectManagerBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
 
/**
 *
 * @ORM\Entity
 * @ORM\Table(name="actions")
 */
class Action {
 
    public static $__type = "Action";
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
     * @ORM\Column(type="array", name="args", nullable=true)
     */
    protected $args;
 
    /**
     *
     * @var array
     * @ORM\Column(type="array", name="options", nullable=true)
     */
    protected $options;
 
    /**
     *
     * @var array
     * @ORM\Column(type="array", name="code", nullable=true)
     */
    protected $code;
 
    /**
     * @var Controller
     * @ORM\ManyToOne(targetEntity="Controller", inversedBy="actions")
     * @ORM\JoinColumn(name="controller_id", referencedColumnName="id")
     */
    protected $controller;
 
    /**
     * @var View
     * @ORM\OneToOne(targetEntity="View", inversedBy="action")
     * @ORM\JoinColumn(name="view_id", referencedColumnName="id", nullable=true)
     */
    protected $view;
 
    /**
     * @var Route
     * @ORM\OneToOne(targetEntity="Route", mappedBy="action")
     */
    protected $route;
 
    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Service", mappedBy="actions")
     */
    protected $services;
 
    /**
     * Constructor
     */
    public function __construct() {
        $this->services = new ArrayCollection();
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
     * @return Action
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
     * @return Action
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
     * @return Action
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
     * Set options
     * @param array $options
     * @return Action
     */
    public function setOptions(array $options) {
        $this->options = $options;
         
        return $this;
    }
 
    /**
     * Get options
     * @return array
     */
    public function getOptions() {
         
        return $this->options;
    }
 
    /**
     * Set code
     * @param array $code
     * @return Action
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
     * Set controller
     * @param Controller $controller
     * @return Action
     */
    public function setController(Controller $controller) {
        $this->controller = $controller;
         
        if (!$controller->getActions()->contains($this)) {
            $controller->addAction($this);
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
     * Set view
     * @param View $view
     * @return Action
     */
    public function setView(View $view) {
        $this->view = $view;
         
        if ($view->getAction() != $this) {
            $view->setAction($this);
        }
         
        return $this;
    }
 
    /**
     * Get view
     * @return View
     */
    public function getView() {
         
        return $this->view;
    }
 
    /**
     * Set route
     * @param Route $route
     * @return Action
     */
    public function setRoute(Route $route) {
        $this->route = $route;
         
        if ($route->getAction() != $this) {
            $route->setAction($this);
        }
         
        return $this;
    }
 
    /**
     * Get route
     * @return Route
     */
    public function getRoute() {
         
        return $this->route;
    }
 
    /**
     * Add service
     * @param Service $service
     * @return Action
     */
    public function addService(Service $service) {
        $this->services[] = $service;
         
        if ($service->getActions()->contains($this)) {
            $service->addAction($this);
        }
         
        return $this;
    }
 
    /**
     * Remove service
     * @param Service $service
     * @return Action
     */
    public function removeService(Service $service) {
        $this->services->removeElement($service);
         
        if ($service->getActions()->contains($this)) {
            $service->removeAction($this);
        }
         
        return $this;
    }
 
    /**
     * Get services
     * @return ArrayCollection
     */
    public function getServices() {
         
        return $this->services;
    }
}