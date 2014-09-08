<?php
namespace Usuario\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;

class BackendLocalidadeController extends AbstractActionController
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
	
    public function cidadeListarAction()
    {
        return array();
    }
    
    public function cidadeInserirAction()
    {
    	$form = $this->getServiceLocator()->get('cidade-form');
    	$form->registerElements();

    	$form->get('submit')->setAttributes(array('value' => 'Inserir cidade »'));
    	$tituloPainel = "Inserir Cidade";    
    	
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
	    		
	    		$cidadeTable = $this->getServiceLocator()->get('cidade-table');
	    		
	    		$insert = $cidadeTable->insert($dadosValidados);
	    		
				if($insert)
				{
					$this->flashMessenger()->addSuccessMessage('A cidade foi inserida com sucesso.');
					
					$form = $formLimpo;
				}
				else
				{
					$this->flashMessenger()->addErrorMessage('Houve um erro na inserção da cidade no banco de dados.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('usuario/backend-localidade/form-cidade');
 		
        return $viewModel;
    }
    
    public function cidadeEditarAction()
    {
        return array();
    }
    
    public function cidadeApagarAction()
    {
        return array();
    }
    
    public function estadoListarAction()
    {
        return array();
    }
    
    public function estadoInserirAction()
    {
    	$form = $this->getServiceLocator()->get('estado-form');
    	$form->registerElements();

    	$form->get('submit')->setAttributes(array('value' => 'Inserir estado »'));
    	$tituloPainel = "Inserir Estado";    
    	
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
	    		
	    		$estadoTable = $this->getServiceLocator()->get('estado-table');
	    		
	    		$insert = $estadoTable->insert($dadosValidados);
	    		
				if($insert)
				{
					$this->flashMessenger()->addSuccessMessage('O estado foi inserido com sucesso.');
					
					$form = $formLimpo;
				}
				else
				{
					$this->flashMessenger()->addErrorMessage('Houve um erro na inserção do estado no banco de dados.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('usuario/backend-localidade/form-estado');
 		
        return $viewModel;
    }
    
    public function estadoEditarAction()
    {
        return array();
    }
    
    public function estadoApagarAction()
    {
        return array();
    }
    
    public function regiaoListarAction()
    {

    }
    
    public function regiaoInserirAction()
    {
    	$form = $this->getServiceLocator()->get('regiao-form');
    	$form->registerElements();

    	$form->get('submit')->setAttributes(array('value' => 'Inserir região »'));
    	$tituloPainel = "Inserir Região";    
    	
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
	    		
	    		$regiaoTable = $this->getServiceLocator()->get('regiao-table');
	    		
	    		$insert = $regiaoTable->insert($dadosValidados);
	    		
				if($insert)
				{
					$this->flashMessenger()->addSuccessMessage('A região foi inserida com sucesso.');
					
					$form = $formLimpo;
				}
				else
				{
					$this->flashMessenger()->addErrorMessage('Houve um erro na inserção da região no banco de dados.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('usuario/backend-localidade/form-regiao');
 		
        return $viewModel;
    }
    
    public function regiaoEditarAction()
    {
        return array();
    }
    
    public function regiaoApagarAction()
    {
        return array();
    } 
}
