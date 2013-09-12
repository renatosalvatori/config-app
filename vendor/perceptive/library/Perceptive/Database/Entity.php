<?php
/**
 * Base entity class containing some functionality that will be used by all
 * entities 
 */

namespace Perceptive\Database;

use Zend\Validator\ValidatorChain;

class Entity{
  
    //An array of validators for various fields in this entity
    protected $validators;
  
    public function __construct(){
      $this->validators = $this->getValidators();
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
     * Updates all of the values in this entity from an array. If any property
     * does not exist a ReflectionException will be thrown.
     * @param array $data
     * @return \Perceptive\Database\Entity 
     */
    public function fromArray($data){
      //Create an annotation reader so we can read annotations
      $reader = new \Doctrine\Common\Annotations\AnnotationReader();
      
      //Create a reflection class and retrieve the properties
      $reflClass = new \ReflectionClass($this);
      
      //Loop through each element in the supplied array
      foreach($data as $key=>$value){
          //Attempt to get at the property - if the property doesn't exist an
          //exception will be thrown here.
          $property = $reflClass->getProperty($key);
          
          //Access the property's annotations
          $annotations = $reader->getPropertyAnnotations($property);
          
          //Loop through all annotations to see if this is actually a valid column
          //to update.
          $isColumn = false;
          foreach($annotations as $annotation){
            if($annotation instanceof \Doctrine\ORM\Mapping\Column){
              $isColumn = true;
            }
          }
          
          //If it is a column then update it using it's setter function. Otherwise,
          //throw an exception.
          if($isColumn===true){
            $func = 'set'.ucfirst($property->getName());
            $this->$func($data[$property->getName()]);
          }else{
            throw new \Exception('You cannot update the value of a non-column using fromArray.');
          }
      }
      
      //return this object to facilitate a 'fluent' interface.
      return $this;
    }
    
    /**
     * Validates a field against an array of validators. Returns true if the value is
     * valid or an error string if not.
     * @param string $fieldName The name of the field to validate. This is only used when constructing the error string
     * @param mixed $value
     * @param array $validators
     * @return boolean|string 
     */
    protected function setField($fieldName, $value, $validators){
      //Create a validator chain
      $validatorChain = new ValidatorChain();
      
      //Try to retrieve the validators for this field
      if(array_key_exists($fieldName, $this->validators)){
        $validators = $this->validators[$fieldName];
      }else{
        $validators = array();
      }
      
      //Add all validators to the chain
      foreach($validators as $validator){
        $validatorChain->attach($validator);
      }
      
      //Check if the value is valid according to the validators. Return true if so,
      //or an error string if not.
      if($validatorChain->isValid($value)){
        $this->{$fieldName} = $value;
        return $this;
      }else{
        $err = 'The '.$fieldName.' field was not valid: '.implode(',',$validatorChain->getMessages());
        throw new \Exception($err);
      }
    }
}