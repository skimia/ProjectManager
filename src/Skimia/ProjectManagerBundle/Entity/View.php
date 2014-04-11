<?php
 
namespace Skimia\ProjectManagerBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
 
/**
 *
 * @ORM\Entity
 * @ORM\Table(name="views")
 */
class View {
 
    public static $__type = "View";
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
     * @ORM\Column(type="text", name="code", nullable=true)
     */
    protected $code;
 
    /**
     * @var Action
     * @ORM\OneToOne(targetEntity="Action", mappedBy="view")
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
     * @return View
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
     * Set code
     * @param text $code
     * @return View
     */
    public function setCode($code) {
        $this->code = $code;
         
        return $this;
    }
 
    /**
     * Get code
     * @return text
     */
    public function getCode() {
         
        return $this->code;
    }
 
    /**
     * Set action
     * @param Action $action
     * @return View
     */
    public function setAction(Action $action) {
        $this->action = $action;
         
        if ($action->getView() != $this) {
            $action->setView($this);
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