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
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    public function getJson(){
        return array(
            'name' => $this->getUsername(),
            'email' =>$this->getEmail(),
            'roles' => $this->getRoles()
        );
    }
}