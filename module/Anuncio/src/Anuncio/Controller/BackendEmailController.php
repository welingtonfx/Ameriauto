<?php
namespace Anuncio\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;

class BackendEmailController extends AbstractActionController
{
	/**
	 * Substitui o m�todo onDispatch para definir um novo layout em comum a todas as actions deste controller
	 * 
	 * @see AbstractActionController:onDispatch()
	 */
	 public function onDispatch(MvcEvent $e)
	 {
	 	$response = parent::onDispatch($e);
	 	
	 	$this->layout()->setTemplate('layout/layout-back-end');
	 	
	 	return $response;
	 }
	
    public function listarAction()
    {
        return array();
    }

    public function inserirAction()
    {
        return array();
    }

    public function editarAction()
    {
        return array();
    }
    
    public function apagarAction()
    {
        return array();
    }
}
