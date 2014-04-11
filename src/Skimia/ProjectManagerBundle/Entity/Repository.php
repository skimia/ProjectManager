<?php
 
namespace Skimia\ProjectManagerBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
 
/**
 * Repository Symfony2
 * @ORM\Entity
 * @ORM\Table(name="repositories")
 */
class Repository {
 
    public static $__type = "Repository";
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    /**
     * Nom du repository
     * @var string
     * @ORM\Column(type="string", name="name", length=255)
     */
    protected $name;
 
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="SimpleFunction", mappedBy="repository")
     */
    protected $functions;
 
    /**
     * Constructor
     */
    public function __construct() {
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
     * @return Repository
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
     * Add function
     * @param SimpleFunction $simpleFunction
     * @return Repository
     */
    public function addFunction(SimpleFunction $simpleFunction) {
        $this->functions[] = $simpleFunction;
         
        if ($simpleFunction->getRepository() != $this) {
            $simpleFunction->setRepository($this);
        }
         
        return $this;
    }
 
    /**
     * Remove function
     * @param SimpleFunction $simpleFunction
     * @return Repository
     */
    public function removeFunction(SimpleFunction $simpleFunction) {
        $this->functions->removeElement($simpleFunction);
         
        if ($simpleFunction->getRepository() != $this) {
            $simpleFunction->setRepository($this);
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