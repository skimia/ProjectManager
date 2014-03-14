<?php

namespace Skimia\ProjectManagerBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Skimia\ProjectManagerBundle\Entity\GroupRepository")
 * @ORM\Table(name="groups")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;
     

     /**
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     * @ORM\JoinColumn(name="user_main_id", referencedColumnName="id")
     */
    protected $main_user;
    
    /**
     * @ORM\ManyToMany(targetEntity="Skimia\ProjectManagerBundle\Entity\User")
     * @ORM\JoinTable(name="users_groups",
     *      joinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    protected $users;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $public;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $openned;

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
     * Set public
     *
     * @param boolean $public
     * @return Group
     */
    public function setPublic($public)
    {
        $this->public = $public;
    
        return $this;
    }

    /**
     * Get public
     *
     * @return boolean 
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set openned
     *
     * @param boolean $openned
     * @return Group
     */
    public function setOpenned($openned)
    {
        $this->openned = $openned;
    
        return $this;
    }

    /**
     * Get openned
     *
     * @return boolean 
     */
    public function getOpenned()
    {
        return $this->openned;
    }

    /**
     * Set main_user
     *
     * @param \Skimia\ProjectManagerBundle\Entity\User $mainUser
     * @return Group
     */
    public function setMainUser(\Skimia\ProjectManagerBundle\Entity\User $mainUser = null)
    {
        $this->main_user = $mainUser;
        if(isset($mainUser))
            $this->addUser($mainUser);
    
        return $this;
    }

    /**
     * Get main_user
     *
     * @return \Skimia\ProjectManagerBundle\Entity\User 
     */
    public function getMainUser()
    {
        return $this->main_user;
    }
    
    public function canDisplay(\Skimia\ProjectManagerBundle\Entity\User $user = null){
        if($user->hasRole('ROLE_SUPER_ADMIN'))
            return true;
        if($user == $this->main_user)
            return true;
        if($this->getUsers()->contains($user))
            return true;
        if($this->openned || $this->public)
            return true;
        return false;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roles = array();
    }
    
    /**
     * Add users
     *
     * @param \Skimia\ProjectManagerBundle\Entity\User $users
     * @return Group
     */
    public function addUser(\Skimia\ProjectManagerBundle\Entity\User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \Skimia\ProjectManagerBundle\Entity\User $users
     */
    public function removeUser(\Skimia\ProjectManagerBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}