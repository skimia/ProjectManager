<?php
 
namespace Skimia\ProjectManagerBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="lifecycle_callback")
 */
class LifecycleCallback {
 
    public static $__type = "LifecycleCallback";
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    /**
     *
     * @Assert\NotBlank()
     * @Assert\Length(min = "3",max = "255")
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
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"preRemove","postRemove","prePersist","postPersist","preUpdate","postUpdate","postLoad","loadClassMetadata","onFlush"}, message = "Choisissez un type valide.")
     * @var string
     * @ORM\Column(type="string", name="type", length=20)
     */
    protected $type;
 
    /**
     *
     * @var text
     * @ORM\Column(type="text", name="code", nullable=true)
     */
    protected $code;
 
    /**
     * @var Entity
     * @ORM\ManyToOne(targetEntity="Entity", inversedBy="lifecycleCallbacks")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id")
     */
    protected $entity;
 
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
     * @return LifecycleCallback
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
     * @return LifecycleCallback
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
     * Set type
     * @param string $type
     * @return LifecycleCallback
     */
    public function setType($type) {
        $this->type = $type;
         
        return $this;
    }
 
    /**
     * Get type
     * @return string
     */
    public function getType() {
         
        return $this->type;
    }
 
    /**
     * Set code
     * @param text $code
     * @return LifecycleCallback
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
     * Set entity
     * @param Entity $entity
     * @return LifecycleCallback
     */
    public function setEntity(Entity $entity) {
        $this->entity = $entity;
         
        if (!$entity->getLifecycleCallbacks()->contains($this)) {
            $entity->addLifecycleCallback($this);
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
}