<?php
 
namespace Skimia\ProjectManagerBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Form Symfony2
 * @ORM\Entity
 * @ORM\Table(name="forms")
 */
class Form {
 
    public static $__type = "Form";
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    /**
     * Nom du formulaire
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
     *
     * @var array
     * @ORM\Column(type="array", name="code", nullable=true)
     */
    protected $code;
 
    /**
     * @var Entity
     * @ORM\OneToOne(targetEntity="Entity", inversedBy="form")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id", nullable=true)
     */
    protected $entity;
 
    /**
     * @var Bundle
     * @ORM\ManyToOne(targetEntity="Bundle", inversedBy="forms")
     * @ORM\JoinColumn(name="bundle_id", referencedColumnName="id")
     */
    protected $bundle;
 
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
     * @return Form
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
     * @return Form
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
     * Set code
     * @param array $code
     * @return Form
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
     * @return Form
     */
    public function setEntity(Entity $entity) {
        $this->entity = $entity;
         
        if ($entity->getForm() != $this) {
            $entity->setForm($this);
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
     * Set bundle
     * @param Bundle $bundle
     * @return Form
     */
    public function setBundle(Bundle $bundle) {
        $this->bundle = $bundle;
         
        if (!$bundle->getForms()->contains($this)) {
            $bundle->addForm($this);
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
}