<?php
/**
 * A restful controller that retrieves and updates configuration information
 * @todo Create a class called ConfigController that does the real work and returns instances
 * of Entity\Config. Create a class called ConfigRestController which accesses this controller
 * and returns it in JSON format - might make it easier to test.
 */
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ConfigController extends AbstractRestfulController
{
    /**
     * Retrieves the configuration from the database 
     */
    public function getList(){
      //locate the doctrine entity manager
      $em = $this->getServiceLocator()
                 ->get('Doctrine\ORM\EntityManager');
      
      //there should only ever be one row in the configuration table, so I use findAll
      $config = $em->getRepository("\Application\Entity\Config")->findAll();
      
      //return a JsonModel to the user. I use my toArray function to convert the doctrine
      //entity into an array - the JsonModel can't handle a doctrine entity itself.
      return new JsonModel(array(
        'data' => $config[0]->toArray(),
      ));
    }
    
    /**
     * Updates the configuration
     */
    public function replaceList($data){
      //locate the doctrine entity manager
      $em = $this->getServiceLocator()
                 ->get('Doctrine\ORM\EntityManager');
      
      //there should only ever be one row in the configuration table, so I use findAll
      $config = $em->getRepository("\Application\Entity\Config")->findAll();
      
      //loop through each submitted field
      foreach($data as $column=>$value){
        //work out the name of the setter function for each field
        $func = "set".ucfirst($column);
        $config[0]->$func($value);
      }
      
      //save the entity to the database
      $em->persist($config[0]);
      $em->flush();
      
      //return a JsonModel to the user. I use my toArray function to convert the doctrine
      //entity into an array - the JsonModel can't handle a doctrine entity itself.
      return new JsonModel(array(
        'data' => $config[0]->toArray(),
      )); 
    }
}
