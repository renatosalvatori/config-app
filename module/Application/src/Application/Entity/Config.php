<?php

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator;
use Zend\I18n\Validator as IntValidator;

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
     * Get the minimum length of the user ID
     * @return int 
     */
    public function getMinLengthUserId(){
        return $this->minLengthUserId;
    }
    
    /**
     * Set the minmum length of the user ID
     * @param int $minLengthUserId
     * @return \Application\Entity\Config This object
     */
    public function setMinLengthUserId($minLengthUserId){
        $this->minLengthUserId = $minLengthUserId;
        return $this;
    }
    
    /**
     * Get the minimum length of the user name
     * @return int 
     */
    public function getminLengthUserName(){
      return $this->getminLengthUserName;
    }
    
    /**
     * Set the minimum length of the user name
     * @param int $minLengthUserName
     * @return \Application\Entity\Config 
     */
    public function setMinLengthUserName($minLengthUserName){
      $this->minLengthUserName = $minLengthUserName;
      return $this;
    }
    
    /**
     * Get the minimum length of the user password
     * @return int 
     */
    public function getMinLengthUserPassword(){
      return $this->minLengthUserPassword;
    }
    
    /**
     * Set the minimum length of the user password
     * @param int $minLengthUserPassword
     * @return \Application\Entity\Config 
     */
    public function setMinLengthUserPassword($minLengthUserPassword){
      $this->minLengthUserPassword = $minLengthUserPassword;
      return $this;
    }
    
    /**
     * Get the number of days before passwords can be reused
     * @return int 
     */
    public function getDaysPasswordReuse(){
      return $this->daysPasswordReuse;
    }
    
    /**
     * Set the number of days before passwords can be reused
     * @param int $daysPasswordReuse
     * @return \Application\Entity\Config 
     */
    public function setDaysPasswordReuse($daysPasswordReuse){
      $this->daysPasswordReuse = $daysPasswordReuse;
      return $this;
    }
    
    /**
     * Get whether the passwords must contain letters and numbers
     * @return boolean 
     */
    public function getPasswordLettersAndNumbers(){
      return $this->passwordLettersAndNumbers;
    }
    
    /**
     * Set whether passwords must contain letters and numbers
     * @param int $passwordLettersAndNumbers
     * @return \Application\Entity\Config 
     */
    public function setPasswordLettersAndNumbers($passwordLettersAndNumbers){
      $this->passwordLettersAndNumbers = $passwordLettersAndNumbers;
      return $this;
    }
    
    /**
     * Get whether password must contain upper and lower case characters
     * @return type 
     */
    public function getPasswordUpperLower(){
      return $this->passwordUpperLower;
    }
    
    /**
     * Set whether password must contain upper and lower case characters
     * @param type $passwordUpperLower
     * @return \Application\Entity\Config 
     */
    public function setPasswordUpperLower($passwordUpperLower){
      $this->passwordUpperLower = $passwordUpperLower;
      return $this;
    }
    
    /**
     * Get the number of failed logins before user is locked out
     * @return int 
     */
    public function getMaxFailedLogins(){
      return $this->maxFailedLogins;
    }
    
    /**
     * Set the number of failed logins before user is locked out
     * @param int $maxFailedLogins
     * @return \Application\Entity\Config 
     */
    public function setMaxFailedLogins($maxFailedLogins){
      $this->maxFailedLogins = $maxFailedLogins;
      return $this;
    }
    
    /**
     * Get the password validity period in days
     * @return int 
     */
    public function getPasswordValidity(){
      return $this->passwordValidity;
    }
    
    /**
     * Set the password validity in days
     * @param int $passwordValidity
     * @return \Application\Entity\Config 
     */
    public function setPasswordValidity($passwordValidity){
      $this->passwordValidity = $passwordValidity;
      return $this;
    }
    
    /**
     * Get the number of days prior to expiry that the user starts getting
     * warning messages
     * @return int 
     */
    public function getPasswordExpiryDays(){
      return $this->passwordExpiryDays;
    }
    
    /**
     * Get the number of days prior to expiry that the user starts getting
     * warning messages
     * @param int $passwordExpiryDays
     * @return \Application\Entity\Config 
     */
    public function setPasswordExpiryDays($passwordExpiryDays){
      $this->passwordExpiryDays = $passwordExpiryDays;
      return $this;
    }
    
    /**
     * Get the timeout period of the application
     * @return int 
     */
    public function getTimeout(){
      return $this->timeout;
    }
    
    /**
     * Get the timeout period of the application
     * @param int $timeout
     * @return \Application\Entity\Config 
     */
    public function setTimeout($timeout){
      $this->timeout = $timeout;
      return $this;
    }
    
    /**
     * Returns the properties of this object as an array for ease of use
     * @return array 
     */
    public function toArray(){
      return get_object_vars($this);
    }
    
    /**
     * Before persisting this entity run some validation 
     * @ORM\PrePersist 
     * @ORM\PreUpdate
     */
    public function validate(){
      $inputFilter = $this->getInputFilter();
      $inputFilter->setData($this->toArray());
      if(!$inputFilter->isValid()){
        $errors = '';
        foreach($inputFilter->getInvalidInput() as $error){
          $errors.= $error->getName().' is not valid: '.implode(',',$error->getMessages());
        }
        throw new \Exception($errors);
      }
    }
    
    /**
     * Get the input filters for all fields
     * @return Zend\InputFilter\InputFilter 
     */
    public function getInputFilter(){
      if(!isset($this->inputFilter)){
        $minLengthUserId = new Input('minLengthUserId');
        $minLengthUserId->getValidatorChain()
                        ->addValidator(new Validator\GreaterThan(1))
                        ->addValidator(new IntValidator\Int());
        
        $inputFilter = new InputFilter();
        $inputFilter->add($minLengthUserId);
        
        $this->inputFilter = $inputFilter;
      }
      
      return $this->inputFilter;
    }
}