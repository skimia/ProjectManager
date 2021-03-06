<?php

namespace Skimia\ProjectManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Announcement
 *
 * @ORM\Table(name="announcements")
 * @ORM\Entity(repositoryClass="Skimia\ProjectManagerBundle\Entity\AnnouncementRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Announcement {

    public static $__type = "Announcement";
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
     * @Assert\NotBlank()
     * @Assert\Length(min = "10",max = "255")
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min = "20")
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="posted", type="datetime")
     */
    private $posted;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @MaxDepth(1)
     */
    protected $user;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Announcement
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Announcement
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set posted
     *
     * @param \DateTime $posted
     * @return Announcement
     */
    public function setPosted($posted) {
        $this->posted = $posted;

        return $this;
    }

    /**
     * Get posted
     *
     * @return \DateTime 
     */
    public function getPosted() {
        return $this->posted;
    }

    /**
     * Set bundle
     *
     * @param \Skimia\ProjectManagerBundle\Entity\User $user
     * @return Entity
     */
    public function setUser(\Skimia\ProjectManagerBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get bundle
     *
     * @return \Skimia\ProjectManagerBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /** 
     * @ORM\PrePersist 
     */
    public function onPrePersist() {
        //using Doctrine DateTime here
        $this->posted = new \DateTime('now');
    }

}