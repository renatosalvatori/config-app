<?php
/**
 * @todo: add a base entity class which handles validation via annotations
 * and includes toArray function. Also needs to get/set using __get and __set
 * magic methods. Potentially add a fromArray method?
 */
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Validator;
use Zend\I18n\Validator as I18nValidator;
use Perceptive\Database\Entity;


/** 
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Config extends Entity{
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
        //Use the setField function, which checks whether the field is valid,
        //to set the value.
        return $this->setField('minLengthUserId', $minLengthUserId);
    }

    /**
     * Get the minimum length of the user name
     * @return int 
     */
    public function getminLengthUserName(){
      return $this->minLengthUserName;
    }

    /**
     * Set the minimum length of the user name
     * @param int $minLengthUserName
     * @return \Application\Entity\Config 
     */
    public function setMinLengthUserName($minLengthUserName){
      //Use the setField function, which checks whether the field is valid,
      //to set the value.
      return $this->setField('minLengthUserName', $minLengthUserName);
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
      //Use the setField function, which checks whether the field is valid,
      //to set the value.
      return $this->setField('minLengthUserPassword', $minLengthUserPassword);
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
      //Use the setField function, which checks whether the field is valid,
      //to set the value.
      return $this->setField('daysPasswordReuse', $daysPasswordReuse);
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
      //Use the setField function, which checks whether the field is valid,
      //to set the value.
      return $this->setField('passwordLettersAndNumbers', $passwordLettersAndNumbers);
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
      //Use the setField function, which checks whether the field is valid,
      //to set the value.
      return $this->setField('passwordUpperLower', $passwordUpperLower);
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
      //Use the setField function, which checks whether the field is valid,
      //to set the value.
      return $this->setField('maxFailedLogins', $maxFailedLogins);
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
      //Use the setField function, which checks whether the field is valid,
      //to set the value.
      return $this->setField('passwordValidity', $passwordValidity);
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
      //Use the setField function, which checks whether the field is valid,
      //to set the value.
      return $this->setField('passwordExpiryDays', $passwordExpiryDays);
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
      //Use the setField function, which checks whether the field is valid,
      //to set the value.
      return $this->setField('timeout', $timeout);
    }
    
    /**
     * Returns a list of validators for each column. These validators are checked
     * in the class' setField method, which is inherited from the Perceptive\Database\Entity class
     * @return array
     */
    public function getValidators(){
      //If the validators array hasn't been initialised, initialise it
      if(!isset($this->validators)){
        $validators = array(
            'minLengthUserId' => array(
                new I18nValidator\Int(),
                new Validator\GreaterThan(1),
            ),
            'minLengthUserName' => array(
                new I18nValidator\Int(),
                new Validator\GreaterThan(2),
            ),
            'minLengthUserPassword' => array(
                new I18nValidator\Int(),
                new Validator\GreaterThan(3),
            ),
            'daysPasswordReuse' => array(
                new I18nValidator\Int(),
                new Validator\GreaterThan(-1),
            ),
            'passwordLettersAndNumbers' => array(
                new I18nValidator\Int(),
                new Validator\GreaterThan(-1),
                new Validator\LessThan(2),
            ),
            'passwordUpperLower' => array(
                new I18nValidator\Int(),
                new Validator\GreaterThan(-1),
                new Validator\LessThan(2),
            ),
            'maxFailedLogins' => array(
                new I18nValidator\Int(),
                new Validator\GreaterThan(0),
            ),
            'passwordValidity' => array(
                new I18nValidator\Int(),
                new Validator\GreaterThan(1),
            ),
            'passwordExpiryDays' => array(
                new I18nValidator\Int(),
                new Validator\GreaterThan(1),
            ),
            'timeout' => array(
                new I18nValidator\Int(),
                new Validator\GreaterThan(0),
            )
        );
        $this->validators = $validators;
      }
      
      //Return the list of validators
      return $this->validators;
    }
    
    /**
     * @todo: add a lifecyle event which validates before persisting the entity.
     * This way there is no chance of invalid values being saved to the database.
     * This should probably be implemented in the parent class so all entities know
     * to validate.
     */
}