<?php

namespace Skimia\ProjectManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Skimia\ProjectManagerBundle\Entity\Entity;
use Skimia\ProjectManagerBundle\Entity\Field;

/**
 * @ORM\Entity
 * @ORM\Table(name="relations")
 */
class Relation {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string 
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @var Entity 
     * @ORM\ManyToOne(targetEntity="Entity", inversedBy="mainRelations")
     * @ORM\JoinColumn(name="id_main_entity", referencedColumnName="id")
     */
    private $mainEntity;

    /**
     * @var Entity 
     * @ORM\ManyToOne(targetEntity="Entity", inversedBy="inversedRelations")
     * @ORM\JoinColumn(name="id_linked_entity", referencedColumnName="id")
     */
    private $linkedEntity;

    /**
     * @var string 
     * @ORM\Column(type="string")
     */
    private $mainField;

    /**
     * @var string 
     * @ORM\Column(type="string")
     */
    private $linkedField;

    /**
     * @var boolean 
     * @ORM\Column(type="boolean")
     */
    private $bidirectionnal;

    /**
     * @var string 
     * @ORM\Column(type="string", nullable=true)
     */
    private $joinColumn;

    /**
     * @var string 
     * @ORM\Column(type="string", nullable=true)
     */
    private $joinTable;

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
     * Set mainEntity
     * @param Entity $mainEntity
     * @return Relation
     */
    public function setMainEntity(Entity $mainEntity) {
        $this->mainEntity = $mainEntity;
        if (!$mainEntity->getMainRelations()->contains($this))
            $mainEntity->addMainRelation($this);

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
     * @param Entity $linkedEntity
     * @return Relation
     */
    public function setLinkedEntity(Entity $linkedEntity) {
        $this->linkedEntity = $linkedEntity;
        if(!$linkedEntity->getInversedRelations()->contains($this))
            $linkedEntity->addInversedRelation ($this);
            
        return $this;
    }

    /**
     * Get linkedEntity
     * @return Entity
     */
    public function getLinkedEntity() {
        return $this->linkedEntity;
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
     * Set joinTable
     * @param string $joinTable
     * @return Relation
     */
    public function setJoinTable($joinTable) {
        $this->joinTable = $joinTable;

        return $this;
    }

    /**
     * Get joinTable
     * @return string
     */
    public function getJoinTable() {
        return $this->joinTable;
    }

}