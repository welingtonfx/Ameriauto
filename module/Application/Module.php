<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        /**  Adapter Global para o banco de dados */
        $services = $e->getApplication()->getServiceManager();
        $dbAdapter = $services->get('database');
        
        \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($dbAdapter);
        
        // $eventManager->attach(MvcEvent::EVENT_RENDER, array($this, 'routeMatch'), 100);
    }
    
    public function routeMatch(MvcEvent $event)
    {
		$routeMatch = $event->getRouteMatch();
		$routeName = $routeMatch->getMatchedRouteName();
		
		if($routeName == "login/default")
		{
			$viewModel = $event->getViewModel();
			
			$viewModel->setTemplate('layout/layout-teste');
		}
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
}
