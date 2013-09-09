<?php

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** 
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks
 */
class Config {
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer") 
     */
    protected $minLengthUserId;

    /** 
     * @ORM\Id
     * @ORM\Column(type="integer") 
     */
    protected $minLengthUserName;
    
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer") 
     */
    protected $minLengthUserPassword;
    
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer") 
     */
    protected $daysPasswordReuse;
    
    /** 
     * @ORM\Id
     * @ORM\Column(type="boolean") 
     */
    protected $passwordLettersAndNumbers;
    
    /** 
     * @ORM\Id
     * @ORM\Column(type="boolean") 
     */
    protected $passwordUpperLower;
    
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer") 
     */
    protected $maxFailedLogins;
    
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer") 
     */
    protected $passwordValidity;
    
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer") 
     */
    protected $passwordExpiryDays;

    /** 
     * @ORM\Id
     * @ORM\Column(type="integer") 
     */
    protected $timeout;
    
    // getters/setters
    /**
     * Set the minmum length of the user ID
     * @param int $minLengthUserId The minimum length of the user ID
     */
    public function setMinLengthUserId($minLengthUserId){
        $this->minLengthUserId = $minLengthUserId;
    }
    
    /**
     * Returns this object as a simple array 
     */
    public function toArray(){
      return get_object_vars($this);
    }
    
    /**
     * Before persisting this entity, check that the minimum
     * length of the user ID is not less than 1
     * @ORM\PrePersist 
     * @ORM\PreUpdate
     */
    public function assertMinLengthUserIdNotLessThan1(){
        if($this->minLengthUserId < 1){
            throw new \Exception('Minimum length of user ID cannot be less than 1.');
        }
    }
}