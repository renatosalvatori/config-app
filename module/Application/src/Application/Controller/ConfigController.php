<?php
/**
 * A restful controller that retrieves and updates configuration information
 */
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ConfigController extends AbstractRestfulController
{
    /**
     * The doctrine EntityManager for use with database operations
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;
    
    /**
     * Constructor function manages dependencies
     * @param \Doctrine\ORM\EntityManager $em 
     */
    public function __construct(\Doctrine\ORM\EntityManager $em){
      $this->em = $em;
    }
  
    /**
     * Retrieves the configuration from the database 
     */
    public function getList(){
      //locate the doctrine entity manager
      $em = $this->em;
      
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
      $em = $this->em;
      
      //there should only ever be one row in the configuration table, so I use findAll
      $config = $em->getRepository("\Application\Entity\Config")->findAll();
      
      //use the entity's fromArray function to update the data
      $config[0]->fromArray($data);
      
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
