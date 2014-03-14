<?php

namespace Skimia\ProjectManagerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bundle
 *
 * @ORM\Table(name="bundles")
 * @ORM\Entity(repositoryClass="Skimia\ProjectManagerBundle\Entity\BundleRepository")
 */
class Bundle
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
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="bundles", cascade={"persist"})
     */
    protected $projects;


    /**
     * @ORM\OneToMany(targetEntity="Entity", mappedBy="bundle",cascade={"persist", "remove"})
     */
    protected $entities;

	public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->entities = new ArrayCollection();        
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
     * @return Bundle
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
     * @return Bundle
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
     * Add projects
     *
     * @param \Skimia\ProjectManagerBundle\Entity\Project $projects
     * @return Bundle
     */
    public function addProject(\Skimia\ProjectManagerBundle\Entity\Project $project)
    {
        $this->projects[] = $project;
    
        return $this;
    }

    /**
     * Remove projects
     *
     * @param \Skimia\ProjectManagerBundle\Entity\Project $projects
     */
    public function removeProject(\Skimia\ProjectManagerBundle\Entity\Project $projects)
    {
        $this->projects->removeElement($projects);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProjects()
    {
        return $this->projects;
    }
    

    /**
     * Add entities
     *
     * @param \Skimia\ProjectManagerBundle\Entity\Entity $entities
     * @return Bundle
     */
    public function addEntity(\Skimia\ProjectManagerBundle\Entity\Entity $entity)
    {
        $this->entities[] = $entity;
    
        return $this;
    }

    /**
     * Remove entities
     *
     * @param \Skimia\ProjectManagerBundle\Entity\Entity $entities
     */
    public function removeEntity(\Skimia\ProjectManagerBundle\Entity\Entity $entities)
    {
        $this->entities->removeElement($entities);
    }

    /**
     * Get entities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * Add entities
     *
     * @param \Skimia\ProjectManagerBundle\Entity\Entity $entities
     * @return Bundle
     */
    public function addEntitie(\Skimia\ProjectManagerBundle\Entity\Entity $entities)
    {
        $this->entities[] = $entities;
    
        return $this;
    }

    /**
     * Remove entities
     *
     * @param \Skimia\ProjectManagerBundle\Entity\Entity $entities
     */
    public function removeEntitie(\Skimia\ProjectManagerBundle\Entity\Entity $entities)
    {
        $this->entities->removeElement($entities);
    }
}