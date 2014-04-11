<?php
 
namespace Skimia\ProjectManagerBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
 
/**
 * Relation Symfony2
 * @ORM\Entity
 * @ORM\Table(name="relations")
 */
class Relation {
 
    public static $__type = "Relation";
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    /**
     * Type de relation
     * @var string
     * @ORM\Column(type="string", name="type", length=255)
     */
    protected $type;
 
    /**
     *
     * @var array
     * @ORM\Column(type="array", name="options")
     */
    protected $options;
 
    /**
     *
     * @var array
     * @ORM\Column(type="array", name="code", nullable=true)
     */
    protected $code;
 
    /**
     * @var Entity
     * @ORM\ManyToOne(targetEntity="Entity", inversedBy="mainRelations")
     * @ORM\JoinColumn(name="main_entity_id", referencedColumnName="id")
     */
    protected $mainEntity;
 
    /**
     * @var Entity
     * @ORM\ManyToOne(targetEntity="Entity", inversedBy="inversedRelations")
     * @ORM\JoinColumn(name="inversed_entity_id", referencedColumnName="id")
     */
    protected $inversedEntity;
 
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
     * Set type
     * @param string $type
     * @return Relation
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
     * Set options
     * @param array $options
     * @return Relation
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
     * @return Relation
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
     * Set mainEntity
     * @param Entity $entity
     * @return Relation
     */
    public function setMainEntity(Entity $entity) {
        $this->mainEntity = $entity;
         
        if (!$entity->getMainRelations()->contains($this)) {
            $entity->addMainRelation($this);
        }
         
        return $this;
    }
 
    /**
     * Get mainEntity
     * @return Entity
     */
    public function getMainEntity() {
         
        return $this->mainEntity;
    }
 
    /**
     * Set inversedEntity
     * @param Entity $entity
     * @return Relation
     */
    public function setInversedEntity(Entity $entity) {
        $this->inversedEntity = $entity;
         
        if (!$entity->getInversedRelations()->contains($this)) {
            $entity->addInversedRelation($this);
        }
         
        return $this;
    }
 
    /**
     * Get inversedEntity
     * @return Entity
     */
    public function getInversedEntity() {
         
        return $this->inversedEntity;
    }
}