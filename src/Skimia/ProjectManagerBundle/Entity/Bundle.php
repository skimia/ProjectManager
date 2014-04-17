<?php
 
namespace Skimia\ProjectManagerBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Bundle Symfony2
 * @ORM\Entity
 * @ORM\Table(name="bundles")
 */
class Bundle {
 
    public static $__type = "Bundle";
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    /**
     * Nom du bundle
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min = "3",max = "255")
     * @ORM\Column(type="string", name="name", length=255)
     */
    protected $name;
 
    /**
     * Description du bundle
     * @var text
     * @Assert\NotBlank()
     * @Assert\Length(min = "20")
     * @ORM\Column(type="text", name="description")
     */
    protected $description;
 
    /**
     * Namespace du bundle
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min = "3",max = "255")
     * @ORM\Column(type="string", name="namespace", length=255)
     */
    protected $namespace;
 
    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Project", inversedBy="bundles")
     */
    protected $projects;
 
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Entity", mappedBy="bundle",cascade={"remove"})
     */
    protected $entities;
 
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Form", mappedBy="bundle",cascade={"remove"})
     */
    protected $forms;
 
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Controller", mappedBy="bundle",cascade={"remove"})
     */
    protected $controllers;
 
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Route", mappedBy="bundle",cascade={"remove"})
     */
    protected $routes;
 
    /**
     * Constructor
     */
    public function __construct() {
        $this->projects = new ArrayCollection();
        $this->entities = new ArrayCollection();
        $this->forms = new ArrayCollection();
        $this->controllers = new ArrayCollection();
        $this->routes = new ArrayCollection();
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
     * @return Bundle
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
     * @return Bundle
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
     * Set namespace
     * @param string $namespace
     * @return Bundle
     */
    public function setNamespace($namespace) {
        $this->
        namespace = $namespace;
 
         
        return $this;
    }
 
    /**
     * Get namespace
     * @return string
     */
    public function getNamespace() {
         
        return $this->
        namespace;
 
    }
 
    /**
     * Add project
     * @param Project $project
     * @return Bundle
     */
    public function addProject(Project $project) {
        $this->projects[] = $project;
         
        if ($project->getBundles()->contains($this)) {
            $project->addBundle($this);
        }
         
        return $this;
    }
 
    /**
     * Remove project
     * @param Project $project
     * @return Bundle
     */
    public function removeProject(Project $project) {
        $this->projects->removeElement($project);
         
        if ($project->getBundles()->contains($this)) {
            $project->removeBundle($this);
        }
         
        return $this;
    }
 
    /**
     * Get projects
     * @return ArrayCollection
     */
    public function getProjects() {
         
        return $this->projects;
    }
 
    /**
     * Add entity
     * @param Entity $entity
     * @return Bundle
     */
    public function addEntity(Entity $entity) {
        $this->entities[] = $entity;
         
        if ($entity->getBundle() != $this) {
            $entity->setBundle($this);
        }
         
        return $this;
    }
 
    /**
     * Remove entity
     * @param Entity $entity
     * @return Bundle
     */
    public function removeEntity(Entity $entity) {
        $this->entities->removeElement($entity);
         
        if ($entity->getBundle() != $this) {
            $entity->setBundle($this);
        }
         
        return $this;
    }
 
    /**
     * Get entity
     * @return ArrayCollection
     */
    public function getEntities() {
         
        return $this->entities;
    }
 
    /**
     * Add form
     * @param Form $form
     * @return Bundle
     */
    public function addForm(Form $form) {
        $this->forms[] = $form;
         
        if ($form->getBundle() != $this) {
            $form->setBundle($this);
        }
         
        return $this;
    }
 
    /**
     * Remove form
     * @param Form $form
     * @return Bundle
     */
    public function removeForm(Form $form) {
        $this->forms->removeElement($form);
         
        if ($form->getBundle() != $this) {
            $form->setBundle($this);
        }
         
        return $this;
    }
 
    /**
     * Get forms
     * @return ArrayCollection
     */
    public function getForms() {
         
        return $this->forms;
    }
 
    /**
     * Add controller
     * @param Controller $controller
     * @return Bundle
     */
    public function addController(Controller $controller) {
        $this->controllers[] = $controller;
         
        if ($controller->getBundle() != $this) {
            $controller->setBundle($this);
        }
         
        return $this;
    }
 
    /**
     * Remove controller
     * @param Controller $controller
     * @return Bundle
     */
    public function removeController(Controller $controller) {
        $this->controllers->removeElement($controller);
         
        if ($controller->getBundle() != $this) {
            $controller->setBundle($this);
        }
         
        return $this;
    }
 
    /**
     * Get controllers
     * @return ArrayCollection
     */
    public function getControllers() {
         
        return $this->controllers;
    }
 
    /**
     * Add route
     * @param Route $route
     * @return Bundle
     */
    public function addRoute(Route $route) {
        $this->routes[] = $route;
         
        if ($route->getBundle() != $this) {
            $route->setBundle($this);
        }
         
        return $this;
    }
 
    /**
     * Remove route
     * @param Route $route
     * @return Bundle
     */
    public function removeRoute(Route $route) {
        $this->routes->removeElement($route);
         
        if ($route->getBundle() != $this) {
            $route->setBundle($this);
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
}