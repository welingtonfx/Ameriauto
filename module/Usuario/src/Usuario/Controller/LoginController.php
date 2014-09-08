<?php
namespace Usuario\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;

class LoginController extends AbstractActionController
{
	/**
	 * Substitui o método onDispatch para definir um novo layout em comum a todas as actions deste controller
	 * 
	 * @see AbstractActionController:onDispatch()
	 */
    public function onDispatch(MvcEvent $e)
	{
		$response = parent::onDispatch($e);
		
		$this->layout()->setTemplate('layout/layout-back-end');
		
		return $response;
	}
	
    public function indexAction()
    {
    	$loginPage = 'LoginPage';
    	
    	$tld = $this->params()->fromRoute('tld', 'indefinido');
    	$subdomain = $this->params()->fromRoute('subdomain', 'indefinido');
    	
    	$viewModel = new ViewModel(array('tld' => $tld, 'subdomain' => $subdomain));
    	$viewModel->setTemplate('usuario/login/index');
        return $viewModel;
    }
}
