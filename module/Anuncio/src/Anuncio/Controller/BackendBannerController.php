<?php
namespace Anuncio\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;

class BackendBannerController extends AbstractActionController
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
	
    public function bannerListarAction()
    {
        return array();
    }

    public function bannerInserirAction()
    {
    	$form = $this->getServiceLocator()->get('banner-form');
    	$form->registerElements();

    	$form->get('submit')->setAttributes(array('value' => 'Inserir'));
    	$tituloPainel = "Inserir Banner";    
    	
    	$request = $this->getRequest();
    	
    	if($request->isPost())
    	{
    		$data = array_merge_recursive(
    			$request->getPost()->toArray(),
    			$request->getFiles()->toArray()
    		);
    		
	    	// Clona o form limpo e com atributos associados para ser usado em caso de sucesso na inserção
	    	$formLimpo = clone $form;
	    	
	    	$form->setData($data);
	    	
	    	if($form->isValid())
	    	{
	    		$bannerTable = $this->getServiceLocator()->get('banner-table');
	    		
	    		$dadosValidados = $form->getData(\Zend\Form\FormInterface::VALUES_AS_ARRAY);
	    		
	    		$insert = $bannerTable->insert($dadosValidados);
	    		
				if($insert)
				{
					$this->flashMessenger()->addSuccessMessage('O Banner foi inserido com sucesso.');
					
					$form = $formLimpo;
				}
				else
				{
					$this->flashMessenger()->addErrorMessage('Houve um erro na inserção do Banner no banco de dados.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
        						   		 'tituloPainel' => $tituloPainel));
        $viewModel->setTemplate('anuncio/backend-banner/form-banner');
 		
        return $viewModel;
    }

    public function bannerEditarAction()
    {
        return array();
    }
    
    public function bannerApagarAction()
    {
        return array();
    }
    
    public function bannerTipoListarAction()
    {
        return array();
    }

    public function bannerTipoInserirAction()
    {
    	$form = $this->getServiceLocator()->get('banner-tipo-form');
    	$form->registerElements();

    	$form->get('submit')->setAttributes(array('value' => 'Inserir'));
    	$tituloPainel = "Inserir Tipo de Banner";    
    	
    	$request = $this->getRequest();
    	
    	if($request->isPost())
    	{
    		$data = $request->getPost();
    		
	    	// Clona o form limpo e com atributos associados para ser usado em caso de sucesso na inserção
	    	$formLimpo = clone $form;
	    	
	    	$form->setData($data);
	    	
	    	if($form->isValid())
	    	{
	    		$dadosValidados = $form->getData(\Zend\Form\FormInterface::VALUES_AS_ARRAY);
	    		
	    		$bannerTipoTable = $this->getServiceLocator()->get('banner-tipo-table');
	    		
	    		$insert = $bannerTipoTable->insert($dadosValidados);
	    		
				if($insert)
				{
					$this->flashMessenger()->addSuccessMessage('O Tipo de Banner foi inserido com sucesso.');
					
					$form = $formLimpo;
				}
				else
				{
					$this->flashMessenger()->addErrorMessage('Houve um erro na inserção do Tipo de Banner no banco de dados.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('anuncio/backend-banner/form-banner-tipo');
 		
        return $viewModel;
    }

    public function bannerTipoEditarAction()
    {
        return array();
    }
    
    public function bannerTipoApagarAction()
    {
        return array();
    }
}
