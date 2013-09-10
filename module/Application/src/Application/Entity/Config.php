<?php
/**
 * @todo: add a base entity class which handles validation via annotations
 * and includes toArray function. Also needs to get/set using __get and __set
 * magic methods. Potentially add a fromArray method?
 */
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
    
    /**
     * A collection of input filters to validate the fields before setting
     * and before persisting the entity
     * @var Zend\InputFilter\InputFilter 
     */
    private $inputFilter;
    
    // getters/setters
    /**
     * Simply gets any value from this object and returns it
     * @param string $property The name of the property to return
     * @return mixed 
     */
    public function __get($property){
      return $this->{$property};
    }
    
    /**
     * Sets an object property subject to validation checks. If successful it
     * will return this object to allow for a 'fluent' interface. If the field is
     * invalid in some way it will throw an Exception
     * @param string $property
     * @param mixed $value
     * @return \Application\Entity\Config
     * @throws \Exception 
     */
    public function __set($property, $value){
      //Do not allow undefined properties to be set
      if(!property_exists($this,$property)){
        throw new \Exception('Property '.$property.' does not exist.');
      }
      
      //Retrieve the input filter for this entity
      $inputFilter = $this->getInputFilter();
      $inputs = $inputFilter->getInputs();
      
      //If the field we are trying to set is included in the list of inputs
      if(array_key_exists($property, $inputs)){
        //Get a reference to the relevant input and set the value
        $input = $inputs[$property];
        $input->setValue($value);
        
        //If it is a valid value then set the property and return $this.
        //Otherwise, throw an exception.
        if($input->isValid()){
          $this->{$property} = $value;
          return $this;
        }else{
          $error = implode(',',$input->getMessages());
          throw new \Exception($error);
        }
      }
    }
    
    /**
     * Returns the properties of this object as an array for ease of use. Will
     * return only properties with the ORM\Column annotation as this way we know
     * for sure that it is a column with data associated, and won't pick up any
     * other properties. 
     * @return array 
     */
    public function toArray(){
      //Create an annotation reader so we can read annotations
      $reader = new \Doctrine\Common\Annotations\AnnotationReader();
      
      //Create a reflection class and retrieve the properties
      $reflClass = new \ReflectionClass($this);
      $properties = $reflClass->getProperties();
      
      //Create an array in which to store the data
      $array = array();
      
      //Loop through each property. Get the annotations for each property
      //and add to the array to return, ONLY if it contains an ORM\Column
      //annotation.
      foreach($properties as $property){
        $annotations = $reader->getPropertyAnnotations($property);
        foreach($annotations as $annotation){
          if($annotation instanceof \Doctrine\ORM\Mapping\Column){
            $array[$property->name] = $this->{$property->name};
          }
        }
      }
      
      //Finally, return the data array to the user
      return $array;
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
        
        
        $minLengthUserName = new Input('minLengthUserName');
        $minLengthUserName->getValidatorChain()
                          ->addValidator(new Validator\GreaterThan(2))
                          ->addValidator(new IntValidator\Int());
        
        $minLengthUserPassword = new Input('minLengthUserPassword');
        $minLengthUserPassword->getValidatorChain()
                              ->addValidator(new Validator\GreaterThan(3))
                              ->addValidator(new IntValidator\Int());
        
        $daysPasswordReuse = new Input('daysPasswordReuse');
        $daysPasswordReuse->getValidatorChain()
                          ->addValidator(new Validator\GreaterThan(0))
                          ->addValidator(new IntValidator\Int());
        
        $passwordLettersAndNumbers = new Input('passwordLettersAndNumbers');
        $passwordLettersAndNumbers->getValidatorChain()
                                  ->addValidator(new Validator\InArray(array('haystack' => array(true, false))));
        
        $passwordUpperLower = new Input('passwordUpperLower');
        $passwordUpperLower->getValidatorChain()
                           ->addValidator(new IntValidator\Int());
        
        $maxFailedLogins = new Input('maxFailedLogins');
        $maxFailedLogins->getValidatorChain()
                        ->addValidator(new Validator\GreaterThan(0))
                        ->addValidator(new IntValidator\Int());
        
        $passwordValidity = new Input('passwordValidity');
        $passwordValidity->getValidatorChain()
                         ->addValidator(new Validator\GreaterThan(1))
                         ->addValidator(new IntValidator\Int());
        
        $passwordExpiryDays = new Input('passwordExpiryDays');
        $passwordExpiryDays->getValidatorChain()
                           ->addValidator(new Validator\GreaterThan(1))
                           ->addValidator(new IntValidator\Int());
        
        $timeout = new Input('timeout');
        $timeout->getValidatorChain()
                ->addValidator(new Validator\GreaterThan(0))
                ->addValidator(new IntValidator\Int());
        
        $inputFilter = new InputFilter();
        $inputFilter->add($minLengthUserId)
                    ->add($minLengthUserName)
                    ->add($minLengthUserPassword)
                    ->add($daysPasswordReuse)
                    ->add($passwordLettersAndNumbers)
                    ->add($passwordUpperLower)
                    ->add($maxFailedLogins)
                    ->add($passwordValidity)
                    ->add($passwordExpiryDays)
                    ->add($timeout);
        
        $this->inputFilter = $inputFilter;
      }
      
      return $this->inputFilter;
    }
}