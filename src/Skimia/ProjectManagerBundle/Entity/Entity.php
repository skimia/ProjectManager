<?php
 
namespace Skimia\ProjectManagerBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
 
/**
 * Entité Symfony2
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
     * Nom de l'entité
     * @var string
     * @ORM\Column(type="string", name="name", length=255)
     */
    protected $name;
 
    /**
     * Description de l'entité
     * @var text
     * @ORM\Column(type="text", name="description", nullable=true)
     */
    protected $description;
 
    /**
     * Nom de la table liée à l'entité
     * @var string
     * @ORM\Column(type="string", name="table_name", length=255)
     */
    protected $tableName;
 
    /**
     * @var Repository
     * @ORM\OneToOne(targetEntity="Repository")
     * @ORM\JoinColumn(name="repository_id", referencedColumnName="id", nullable=true)
     */
    protected $repository;
 
    /**
     * @var Bundle
     * @ORM\ManyToOne(targetEntity="Bundle", inversedBy="entities")
     * @ORM\JoinColumn(name="bundle_id", referencedColumnName="id")
     */
    protected $bundle;
 
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Field", mappedBy="entity")
     */
    protected $fields;
 
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Relation", mappedBy="mainEntity")
     */
    protected $mainRelations;
 
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Relation", mappedBy="inversedEntity")
     */
    protected $inversedRelations;
 
    /**
     * @var Form
     * @ORM\OneToOne(targetEntity="Form", mappedBy="entity")
     */
    protected $form;
 
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="SimpleFunction", mappedBy="entity")
     */
    protected $functions;
 
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="LifecycleCallback", mappedBy="entity")
     */
    protected $lifecycleCallbacks;
 
    /**
     * Constructor
     */
    public function __construct() {
        $this->fields = new ArrayCollection();
        $this->mainRelations = new ArrayCollection();
        $this->inversedRelations = new ArrayCollection();
        $this->functions = new ArrayCollection();
        $this->lifecycleCallbacks = new ArrayCollection();
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
     * Set repository
     * @param Repository $repository
     * @return Entity
     */
    public function setRepository(Repository $repository) {
        $this->repository = $repository;
         
        return $this;
    }
 
    /**
     * Get repository
     * @return Repository
     */
    public function getRepository() {
         
        return $this->repository;
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
         
        if ($field->getEntity() != $this) {
            $field->setEntity($this);
        }
         
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
         
        if ($relation->getMainEntity() != $this) {
            $relation->setMainEntity($this);
        }
         
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
         
        if ($relation->getInversedEntity() != $this) {
            $relation->setInversedEntity($this);
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
         
        if ($relation->getInversedEntity() != $this) {
            $relation->setInversedEntity($this);
        }
         
        return $this;
    }
 
    /**
     * Get inversedRelations
     * @return ArrayCollection
     */
    public function getInversedRelations() {
         
        return $this->inversedRelations;
    }
 
    /**
     * Set form
     * @param Form $form
     * @return Entity
     */
    public function setForm(Form $form) {
        $this->form = $form;
         
        if ($form->getEntity() != $this) {
            $form->setEntity($this);
        }
         
        return $this;
    }
 
    /**
     * Get form
     * @return Form
     */
    public function getForm() {
         
        return $this->form;
    }
 
    /**
     * Add function
     * @param SimpleFunction $simpleFunction
     * @return Entity
     */
    public function addFunction(SimpleFunction $simpleFunction) {
        $this->functions[] = $simpleFunction;
         
        if ($simpleFunction->getEntity() != $this) {
            $simpleFunction->setEntity($this);
        }
         
        return $this;
    }
 
    /**
     * Remove function
     * @param SimpleFunction $simpleFunction
     * @return Entity
     */
    public function removeFunction(SimpleFunction $simpleFunction) {
        $this->functions->removeElement($simpleFunction);
         
        if ($simpleFunction->getEntity() != $this) {
            $simpleFunction->setEntity($this);
        }
         
        return $this;
    }
 
    /**
     * Get functions
     * @return ArrayCollection
     */
    public function getFunctions() {
         
        return $this->functions;
    }
 
    /**
     * Add lifecycleCallback
     * @param LifecycleCallback $lifecycleCallback
     * @return Entity
     */
    public function addLifecycleCallback(LifecycleCallback $lifecycleCallback) {
        $this->lifecycleCallbacks[] = $lifecycleCallback;
         
        if ($lifecycleCallback->getEntity() != $this) {
            $lifecycleCallback->setEntity($this);
        }
         
        return $this;
    }
 
    /**
     * Remove lifecycleCallback
     * @param LifecycleCallback $lifecycleCallback
     * @return Entity
     */
    public function removeLifecycleCallback(LifecycleCallback $lifecycleCallback) {
        $this->lifecycleCallbacks->removeElement($lifecycleCallback);
         
        if ($lifecycleCallback->getEntity() != $this) {
            $lifecycleCallback->setEntity($this);
        }
         
        return $this;
    }
 
    /**
     * Get lifecycleCallbacks
     * @return ArrayCollection
     */
    public function getLifecycleCallbacks() {
         
        return $this->lifecycleCallbacks;
    }
}