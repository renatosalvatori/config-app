<?php
/**
 * A restful controller that retrieves and updates configuration information
 */
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Json;

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
    public function update(){
      echo "going to update";
    }
}
