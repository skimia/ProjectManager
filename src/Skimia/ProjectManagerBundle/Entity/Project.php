<?php

namespace Skimia\ProjectManagerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="projects")
 * @ORM\Entity()
 */
class Project
{
    public static $__type = "Project";
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
     * @ORM\ManyToMany(targetEntity="Bundle", inversedBy="projects", cascade={"persist"})
     */
    protected $bundles;

    /**
     * @var Group
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="projects")
     * @ORM\JoinColumn(name="", referencedColumnName="id")
     */
    protected $group;

	public function __construct()
    {
        $this->bundles = new ArrayCollection();
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
     * @return Project
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
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = str_replace('[/code]', '</code>', str_replace('[code]', '<code>', htmlentities($description)));
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
     * Add bundles
     *
     * @param \Skimia\ProjectManagerBundle\Entity\Bundle $bundles
     * @return Project
     */
    public function addBundle(\Skimia\ProjectManagerBundle\Entity\Bundle $bundles)
    {
        $this->bundles[] = $bundles;
    
        return $this;
    }

    /**
     * Remove bundles
     *
     * @param \Skimia\ProjectManagerBundle\Entity\Bundle $bundles
     */
    public function removeBundle(\Skimia\ProjectManagerBundle\Entity\Bundle $bundles)
    {
        $this->bundles->removeElement($bundles);
    }

    /**
     * Get bundles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBundles()
    {
        return $this->bundles;
    }
    
    /**
     * Set group
     * @param Group $group
     * @return Project
     */
    public function setGroup(Group $group) {
        $this->group = $group;
        
        if (!$group->getProjects()->contains($this)) {
            $group->addProject($this);
        }
        
        return $this;
    }

    /**
     * Get group
     * @return Group
     */
    public function getGroup() {
        
        return $this->group;
    }

    public function canDisplay(\Skimia\ProjectManagerBundle\Entity\User $user = null){
        $grp = $this->getGroup();
        if(isset($grp)){
            return $grp->canDisplay($user);
        }
        else{
            return true;
        }
    }
    
}