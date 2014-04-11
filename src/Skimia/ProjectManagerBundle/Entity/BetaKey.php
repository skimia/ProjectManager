<?php
 
namespace Skimia\ProjectManagerBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
 
/**
 *
 * @ORM\Entity
 * @ORM\Table(name="beta_keys")
 */
class BetaKey {
 
    public static $__type = "BetaKey";
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    /**
     *
     * @var string
     * @ORM\Column(type="string", name="key", length=64)
     */
    protected $key;
 
    /**
     *
     * @var integer
     * @ORM\Column(type="integer", name="usages")
     */
    protected $usages;
 
    /**
     * Constructor
     */
    public function __construct() {
    }
 
    /**
     * Get id
     * @return integer
     */
    public function getId() {
         
        return $this->id;
    }
 
    /**
     * Set key
     * @param string $key
     * @return BetaKey
     */
    public function setKey($key) {
        $this->key = $key;
         
        return $this;
    }
 
    /**
     * Get key
     * @return string
     */
    public function getKey() {
         
        return $this->key;
    }
 
    /**
     * Set usages
     * @param text $usages
     * @return BetaKey
     */
    public function setUsages($usages) {
        $this->usages = $usages;
         
        return $this;
    }
 
    /**
     * Get usages
     * @return integer
     */
    public function getUsages() {
         
        return $this->usages;
    }

}