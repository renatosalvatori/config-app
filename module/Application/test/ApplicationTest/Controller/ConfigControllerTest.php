<?php
namespace ApplicationTest\Controller;

use ApplicationTest\Bootstrap;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Application\Controller\ConfigController;//remember to change this to the controller name
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;

class ConfigControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    protected function setUp()
    {
        $serviceManager = Bootstrap::getServiceManager();
        
        //get a mock instance of EntityManager to inject into the controller
        $emMock = $this->getMockEm();
        $this->controller = new ConfigController($emMock);
        
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'Config'));//remember to change this to the controller name
        $this->event      = new MvcEvent();
        $config = $serviceManager->get('Config');
        $routerConfig = isset($config['router']) ? $config['router'] : array();
        $router = HttpRouter::factory($routerConfig);

        $this->event->setRouter($router);
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($serviceManager);
    }
    
    /**
     * Create a mock EntityManager so changes are not saved to the database
     * @todo make this function more extensible by copying the way they've done it here: https://gist.github.com/wowo/1331789
     */
    public function getMockEm(){
      //Create a mock repository
      $mockRepo = $this->getMock(
                    '\Application\Entity\Config',
                    array('findAll'),array(),'',false
                  );
      $mockRepo->expects($this->any())
               ->method('findAll')
               ->will($this->returnValue(array(new \Application\Entity\Config())));
      
      //Create a mock entity manager
      $emMock = $this->getMock(
                  '\Doctrine\ORM\EntityManager',
                  array('getRepository', 'persist', 'flush'), 
                  array(), '', false
                );
      $emMock->expects($this->any())
             ->method('getRepository')
             ->will($this->returnValue($mockRepo));
      $emMock->expects($this->any())
             ->method('persist')
             ->will($this->returnValue(null));
      $emMock->expects($this->any())
             ->method('flush')
             ->will($this->returnValue(null));
      
      //Return the mocked up entity manager
      return $emMock;
    }
    
    /**
     * Test that certain methods can be accessed 
     */
    public function testGetListCanBeAccessed(){
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        
        $this->assertEquals(200, $response->getStatusCode());
    }
    
    public function testReplaceListCanBeAccessed(){
        $this->request->setMethod('put');
        $this->request->getPost()->set('minLengthUserId','1');
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();        
        
        $this->assertEquals(200, $response->getStatusCode());
    }
    
    /**
     * Test that certain methods return the correct variable type 
     */
    public function testGetListReturnsJson(){
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        
        $this->assertInstanceOf('Zend\View\Model\JsonModel', $result);
    }
    
    public function testReplaceListReturnsJson(){
        $this->request->setMethod('put');
        $this->request->getPost()->set('minLengthUserId','1');
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        
        $this->assertInstanceOf('Zend\View\Model\JsonModel', $result);
    }
    
    /**
     * Test that certain methods cannot be accessed 
     */
    public function testGetCannotBeAccessed(){
        $this->routeMatch->setParam('id','1');
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(405, $response->getStatusCode());
    }
    
    public function testCreateCannotBeAccessed(){
        $this->request->setMethod('post');
        $this->routeMatch->setParam('id','1');
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(405, $response->getStatusCode());
    }
    
    public function testDeleteCannotBeAccessed(){
        $this->request->setMethod('delete');
        $this->routeMatch->setParam('id','1');
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(405, $response->getStatusCode());
    }
    
    public function testDeleteListCannotBeAccessed(){
        $this->request->setMethod('delete');
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(405, $response->getStatusCode());
    }
    
    public function testUpdateCannotBeAccessed(){
        $this->request->setMethod('put');
        $this->routeMatch->setParam('id','1');
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(405, $response->getStatusCode());
    }
}