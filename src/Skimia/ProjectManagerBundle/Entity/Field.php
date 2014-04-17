<?php
 
namespace Skimia\ProjectManagerBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Champ d'entité Symfony2
 * @ORM\Entity
 * @ORM\Table(name="fields")
 */
class Field {
 
    public static $__type = "Field";
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    /**
     * Nom du champ
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min = "3",max = "255")
     * @ORM\Column(type="string", name="name", length=255)
     */
    protected $name;
 
    /**
     * Description du champ
     * @var text
     * @ORM\Column(type="text", name="description", nullable=true)
     */
    protected $description;
 
    /**
     * Nom du champ en bdd
     * @var string
     * @ORM\Column(type="string", name="db_name", length=255, nullable=true)
     */
    protected $dbName;
 
    /**
     * Type de champ
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min = "3",max = "255")
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
     * @ORM\ManyToOne(targetEntity="Entity", inversedBy="fields")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id")
     */
    protected $entity;
 
    /**
     * Constructor
     */
    public function __construct() {
        $this->options = array();
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
     * Set description
     * @param text $description
     * @return Field
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
     * Set options
     * @param array $options
     * @return Field
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
     * @return Field
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
     * @return Field
     */
    public function setEntity(Entity $entity) {
        $this->entity = $entity;
         
        if (!$entity->getFields()->contains($this)) {
            $entity->addField($this);
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