<?php

namespace Skimia\ProjectManagerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entity
 *
 * @ORM\Table(name="field_types")
 * @ORM\Entity(repositoryClass="Skimia\ProjectManagerBundle\Entity\FieldTypeRepository")
 */
class FieldType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="db_type", type="string", length=255)
     */
    private $dbType;

    /**
     * @ORM\OneToMany(targetEntity="Field", mappedBy="fieldType")
     */
    protected $fields;

	public function __construct()
    {
        $this->fields = new ArrayCollection();
    }
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Entity
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Entity
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dbType
     *
     * @param string $dbType
     * @return FieldType
     */
    public function setDbType($dbType)
    {
        $this->dbType = $dbType;
    
        return $this;
    }

    /**
     * Get dbType
     *
     * @return string 
     */
    public function getDbType()
    {
        return $this->dbType;
    }

    /**
     * Add fields
     *
     * @param \Skimia\ProjectManagerBundle\Entity\Field $fields
     * @return Entity
     */
    public function addField(\Skimia\ProjectManagerBundle\Entity\Field $fields)
    {
        $this->fields[] = $fields;
    
        return $this;
    }

    /**
     * Remove fields
     *
     * @param \Skimia\ProjectManagerBundle\Entity\Field $fields
     */
    public function removeField(\Skimia\ProjectManagerBundle\Entity\Field $fields)
    {
        $this->fields->removeElement($fields);
    }

    /**
     * Get fields
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFields()
    {
        return $this->fields;
    }
}