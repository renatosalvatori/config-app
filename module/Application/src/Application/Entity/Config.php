<?php

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
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
}