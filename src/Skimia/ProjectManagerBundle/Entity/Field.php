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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="db_name", type="string", length=255)
     */
    private $dbName;

    /**
     * @var array
     *
     * @ORM\Column(name="options", type="array")
     */
    private $options;

    /**
     * @ORM\ManyToOne(targetEntity="Entity", inversedBy="fields")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id")
     */
    protected $entity;

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
     * @return Field
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
     * Set type
     *
     * @param string $type
     * @return Field
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set dbName
     *
     * @param string $dbName
     * @return Field
     */
    public function setDbName($dbName)
    {
        $this->dbName = $dbName;
    
        return $this;
    }

    /**
     * Get dbName
     *
     * @return string 
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * Set options
     *
     * @param array $options
     * @return Field
     */
    public function setOptions($options)
    {
        $this->options = $options;
    
        return $this;
    }

    /**
     * Get options
     *
     * @return array 
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set entity
     *
     * @param \Skimia\ProjectManagerBundle\Entity\Entity $entity
     * @return Field
     */
    public function setEntity(\Skimia\ProjectManagerBundle\Entity\Entity $entity = null)
    {
        $this->entity = $entity;
    
        return $this;
    }

    /**
     * Get entity
     *
     * @return \Skimia\ProjectManagerBundle\Entity\Entity 
     */
    public function getEntity()
    {
        return $this->entity;
    }
}