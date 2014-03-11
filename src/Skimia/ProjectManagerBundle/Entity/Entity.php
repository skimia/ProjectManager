<?php

namespace Skimia\ProjectManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Skimia\ProjectManagerBundle\Entity\Field;
use Skimia\ProjectManagerBundle\Entity\Relation;

/**
 * @ORM\Entity
 * @ORM\Table(name="entities")
 */
class Entity {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Bundle", inversedBy="entities", cascade={"persist"})
     * @ORM\JoinColumn(name="bundle_id", referencedColumnName="id")
     */
    protected $bundle;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="table_name", type="string", nullable=true)
     */
    private $tableName;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Field", mappedBy="entity")
     */
    private $fields;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Relation", mappedBy="mainEntity")
     */
    private $mainRelations;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Relation", mappedBy="linkedEntity")
     */
    private $inversedRelations;

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
     * Set description
     * @param string $description
     * @return Entity
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     * @return string 
     */
    public function getDescription() {
        return $this->description;
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
     * Set bundle
     *
     * @param \Skimia\ProjectManagerBundle\Entity\Bundle $bundle
     * @return Entity
     */
    public function setBundle(\Skimia\ProjectManagerBundle\Entity\Bundle $bundle = null)
    {
        $this->bundle = $bundle;
    
        return $this;
    }

    /**
     * Get bundle
     *
     * @return \Skimia\ProjectManagerBundle\Entity\Bundle 
     */
    public function getBundle()
    {
        return $this->bundle;
    }
    
    /**
     * Set tableName
     * @param string $table
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
     * Add field
     * @param Field $field
     * @return Entity
     */
    public function addField(Field $field) {
        $this->fields[] = $field;
        if($field->getEntity() != $this) $field->setEntity ($this);

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
     * @param Relation $mainRelation
     * @return Entity
     */
    public function addMainRelation(Relation $mainRelation) {
        $this->mainRelations[] = $mainRelation;
        if($mainRelation->getMainEntity() != $this) $mainRelation->setMainEntity($this);

        return $this;
    }

    /**
     * Remove mainRelation
     * @param Relation $mainRelation
     * @return Entity
     */
    public function removeMainRelation(Relation $mainRelation) {
        $this->mainRelations->removeElement($mainRelation);

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
     * @param Relation $inversedRelation
     * @return Entity
     */
    public function addInversedRelation(Relation $inversedRelation) {
        $this->inversedRelations[] = $inversedRelation;
        if($inversedRelation->getLinkedEntity() != $this) $inversedRelation->setLinkedEntity ($this);

        return $this;
    }

    /**
     * Remove inversedRelation
     * @param Relation $inversedRelation
     * @return Entity
     */
    public function removeInversedRelation(Relation $inversedRelation) {
        $this->inversedRelations->removeElement($inversedRelation);

        return $this;
    }

    /**
     * Get inversedRelation
     * @return ArrayCollection
     */
    public function getInversedRelations() {
        return $this->inversedRelations;
    }

}
