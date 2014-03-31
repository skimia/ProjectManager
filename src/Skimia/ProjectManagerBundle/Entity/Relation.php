<?php

namespace Skimia\ProjectManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
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
     * @var string
     * @ORM\Column(type="string", name="type", length=255)
     */
    protected $type;

    /**
     * @var string
     * @ORM\Column(type="string", name="main_field", length=255)
     */
    protected $mainField;

    /**
     * @var string
     * @ORM\Column(type="string", name="linked_field", length=255, nullable=true)
     */
    protected $linkedField;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", name="bidirectionnal")
     */
    protected $bidirectionnal;

    /**
     * @var string
     * @ORM\Column(type="string", name="join_column", length=255, nullable=true)
     */
    protected $joinColumn;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", name="is_nullable")
     */
    protected $nullable;

    /**
     * @var Entity
     * @ORM\ManyToOne(targetEntity="Entity", inversedBy="mainRelations")
     * @ORM\JoinColumn(name="main_entity_id", referencedColumnName="id")
     */
    protected $mainEntity;

    /**
     * @var Entity
     * @ORM\ManyToOne(targetEntity="Entity", inversedBy="inversedRelations")
     * @ORM\JoinColumn(name="linked_entity_id", referencedColumnName="id")
     */
    protected $linkedEntity;

    /**
     * Constructor
     */
    public function __construct() {
        $this->nullable = false;
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
     * Set mainField
     * @param string $mainField
     * @return Relation
     */
    public function setMainField($mainField) {
        $this->mainField = $mainField;
        
        return $this;
    }

    /**
     * Get mainField
     * @return string
     */
    public function getMainField() {
        
        return $this->mainField;
    }

    /**
     * Set linkedField
     * @param string $linkedField
     * @return Relation
     */
    public function setLinkedField($linkedField) {
        $this->linkedField = $linkedField;
        
        return $this;
    }

    /**
     * Get linkedField
     * @return string
     */
    public function getLinkedField() {
        
        return $this->linkedField;
    }

    /**
     * Set bidirectionnal
     * @param boolean $bidirectionnal
     * @return Relation
     */
    public function setBidirectionnal($bidirectionnal) {
        $this->bidirectionnal = $bidirectionnal;
        
        return $this;
    }

    /**
     * Get bidirectionnal
     * @return boolean
     */
    public function getBidirectionnal() {
        
        return $this->bidirectionnal;
    }

    /**
     * Set joinColumn
     * @param string $joinColumn
     * @return Relation
     */
    public function setJoinColumn($joinColumn) {
        $this->joinColumn = $joinColumn;
        
        return $this;
    }

    /**
     * Get joinColumn
     * @return string
     */
    public function getJoinColumn() {
        
        return $this->joinColumn;
    }

    /**
     * Set nullable
     * @param boolean $nullable
     * @return Relation
     */
    public function setNullable($nullable) {
        $this->nullable = $nullable;
        
        return $this;
    }

    /**
     * Get nullable
     * @return boolean
     */
    public function getNullable() {
        
        return $this->nullable;
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
     * Set linkedEntity
     * @param Entity $entity
     * @return Relation
     */
    public function setLinkedEntity(Entity $entity) {
        $this->linkedEntity = $entity;
        
        if (!$entity->getInversedRelations()->contains($this)) {
            $entity->addInversedRelation($this);
        }
        
        return $this;
    }

    /**
     * Get linkedEntity
     * @return Entity
     */
    public function getLinkedEntity() {
        
        return $this->linkedEntity;
    }
}