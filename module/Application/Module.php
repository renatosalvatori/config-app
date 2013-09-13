<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    /**
     * Added by HP to allow dependency injection into controllers 
     */
    public function getControllerConfig(){
        return array(
            'factories' => array(
                'Application\Controller\Config' => function(\Zend\Mvc\Controller\ControllerManager $cm){
                  //Get a handle on the service locator
                  $sm = $cm->getServiceLocator();

                  //Feed the configuration controller the doctrine entity manager
                  $em = $sm->get('Doctrine\ORM\EntityManager');
                  $controller = new \Application\Controller\ConfigController($em);

                  //Return 
                  return $controller;
                },
            ),
        );
    }
}
