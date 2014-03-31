<?php

namespace Skimia\ProjectManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="entities")
 */
class Entity {

    public static $__type = "Entity";
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="name", length=255)
     */
    protected $name;

    /**
     * @var text
     * @ORM\Column(type="text", name="description", nullable=true)
     */
    protected $description;

    /**
     * @var string
     * @ORM\Column(type="string", name="table_name", length=255, nullable=true)
     */
    protected $tableName;

    /**
     * @var Bundle
     * @ORM\ManyToOne(targetEntity="Bundle", inversedBy="entities")
     * @ORM\JoinColumn(name="bundle_id", referencedColumnName="id")
     */
    protected $bundle;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Field", mappedBy="entity",cascade={"persist", "remove"})
     */
    protected $fields;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Relation", mappedBy="mainEntity",cascade={"persist", "remove"},cascade={"persist", "remove"})
     */
    protected $mainRelations;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Relation", mappedBy="linkedEntity")
     */
    protected $inversedRelations;
    public function __construct() {
        $this->fields = new ArrayCollection();
        $this->mainRelations = new ArrayCollection();
        $this->inversedRelations = new ArrayCollection();
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
     * @return Entity
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
     * @return Entity
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
     * Set tableName
     * @param string $tableName
     * @return Entity
     */
    public function setTableName($tableName) {
        $this->tableName = $tableName;
        
        return $this;
    }

    /**
     * Get tableName
     * @return string
     */
    public function getTableName() {
        
        return $this->tableName;
    }

    /**
     * Set bundle
     * @param Bundle $bundle
     * @return Entity
     */
    public function setBundle(Bundle $bundle) {
        $this->bundle = $bundle;
        
        if (!$bundle->getEntities()->contains($this)) {
            $bundle->addEntity($this);
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
     * Add field
     * @param Field $field
     * @return Entity
     */
    public function addField(Field $field) {
        $this->fields[] = $field;
        
        if ($field->getEntity() != $this) {
            $field->setEntity($this);
        }
        
        return $this;
    }

    /**
     * Remove field
     * @param Field $field
     * @return Entity
     */
    public function removeField(Field $field) {
        $this->fields->removeElement($field);
        
        return $this;
    }

    /**
     * Get fields
     * @return ArrayCollection
     */
    public function getFields() {
        
        return $this->fields;
    }

    /**
     * Add mainRelation
     * @param Relation $relation
     * @return Entity
     */
    public function addMainRelation(Relation $relation) {
        $this->mainRelations[] = $relation;
        
        if ($relation->getMainEntity() != $this) {
            $relation->setMainEntity($this);
        }
        
        return $this;
    }

    /**
     * Remove mainRelation
     * @param Relation $relation
     * @return Entity
     */
    public function removeMainRelation(Relation $relation) {
        $this->mainRelations->removeElement($relation);
        
        return $this;
    }

    /**
     * Get mainRelations
     * @return ArrayCollection
     */
    public function getMainRelations() {
        
        return $this->mainRelations;
    }

    /**
     * Add inversedRelation
     * @param Relation $relation
     * @return Entity
     */
    public function addInversedRelation(Relation $relation) {
        $this->inversedRelations[] = $relation;
        
        if ($relation->getLinkedEntity() != $this) {
            $relation->setLinkedEntity($this);
        }
        
        return $this;
    }

    /**
     * Remove inversedRelation
     * @param Relation $relation
     * @return Entity
     */
    public function removeInversedRelation(Relation $relation) {
        $this->inversedRelations->removeElement($relation);
        
        return $this;
    }

    /**
     * Get inversedRelations
     * @return ArrayCollection
     */
    public function getInversedRelations() {
        
        return $this->inversedRelations;
    }
}