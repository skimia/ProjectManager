<?php

namespace Skimia\ProjectManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Field
 *
 * @ORM\Table(name="fields")
 * @ORM\Entity(repositoryClass="Skimia\ProjectManagerBundle\Entity\FieldRepository")
 */
class Field
{
    public static $__type = "Field";
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var Entity
     * @ORM\ManyToOne(targetEntity="Entity", inversedBy="fields")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id")
     */
    private $entity;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="db_name", type="string", nullable=true)
     */
    private $dbName;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @var boolean
     * @ORM\Column(name="is_nullable",type="boolean")
     */
    private $nullable;  
        
    /**
     * @var string
     * @ORM\Column(name="is_unique", type="boolean")
     */
    private $unique;
    
    /**
     * @var integer
     * @ORM\Column(name="string_length", type="integer", nullable=true)
     */
    private $length;
    
    /**
     * @var integer
     * @ORM\Column(name="decimal_precision", type="integer", nullable=true)
     */
    private $precision;
    
    /**
     * @var integer
     * @ORM\Column(name="decimal_scale", type="integer", nullable=true)
     */
    private $scale;

    public function __construct() {
        $this->nullable = false;
        $this->unique = false;
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
     * @return Field
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
     * @return Field
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
     * Set entity
     * @param Entity $entity
     * @return Field
     */
    public function setEntity(Entity $entity) {
        $this->entity = $entity;
        if(!$entity->getFields()->contains($this))
            $entity->addField ($this);

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
     * Set type
     * @param string $type
     * @return Field
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
     * Set isNullable
     * @param boolean $nullable
     * @return Field
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
     * Set dbName
     * @param string $dbName
     * @return Field
     */
    public function setDbName($dbName) {
        $this->dbName = $dbName;

        return $this;
    }

    /**
     * Get dbName
     * @return string
     */
    public function getDbName() {
        return $this->dbName;
    }
    
    /**
     * Set unique
     * @param boolean $unique
     * @return Field
     */
    public function setUnique($unique) {
        $this->unique = $unique;

        return $this;
    }

    /**
     * Get unique
     * @return boolean
     */
    public function getUnique() {
        return $this->unique;
    }
    
    /**
     * Set length
     * @param integer $length
     * @return Field
     */
    public function setLength($length) {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     * @return integer
     */
    public function getLength() {
        return $this->length;
    }
    
    /**
     * Set precision
     * @param integer $precision
     * @return Field
     */
    public function setPrecision($precision) {
        $this->precision = $precision;

        return $this;
    }

    /**
     * Get precision
     * @return integer
     */
    public function getPrecision() {
        return $this->precision;
    }
    
    /**
     * Set scale
     * @param integer $scale
     * @return Field
     */
    public function setScale($scale) {
        $this->scale = $scale;

        return $this;
    }

    /**
     * Get scale
     * @return integer
     */
    public function getScale() {
        return $this->scale;
    }  
}