<?php

namespace Skimia\ProjectManagerBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    public static $__type = "User";
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="users", cascade={"persist"})
     * @ORM\JoinTable(name="users_groups")
     **/
    protected $groups;
    
    public function __construct()
    {
        parent::__construct();

        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }
    public function getJson(){
        return array(
            'id' => $this->getId(),
            'name' => $this->getUsername(),
            'email' =>$this->getEmail(),
            'roles' => $this->getRoles()
        );
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
     * Add groups
     *
     * @param \Skimia\ProjectManagerBundle\Entity\Group $groups
     * @return User
     */
    public function addGroup(\FOS\UserBundle\Model\GroupInterface $groups)
    {
        $this->groups[] = $groups;
    
        return $this;
    }

    /**
     * Remove groups
     *
     * @param \Skimia\ProjectManagerBundle\Entity\Group $groups
     */
    public function removeGroup(\FOS\UserBundle\Model\GroupInterface $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }
}