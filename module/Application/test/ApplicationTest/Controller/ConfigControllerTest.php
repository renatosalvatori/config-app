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
        $this->controller = new ConfigController();
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
    
    public function testGetCannotBeAccessed(){
        $this->routeMatch->setParam('id','1');
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(405, $response->getStatusCode());
    }
}