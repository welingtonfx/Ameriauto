<?php
namespace Anuncio\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;

class BackendVeiculoController extends AbstractActionController
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
	
    public function veiculoListarAction()
    {
        return array();
    }

    public function veiculoInserirAction()
    {
    	$form = $this->getServiceLocator()->get('veiculo-form');
    	$form->registerElements();

    	$form->get('submit')->setAttributes(array('value' => 'Inserir veículo »'));
    	$tituloPainel = "Inserir Veículo";    
    	
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
	    		
	    		$veiculoTable = $this->getServiceLocator()->get('veiculo-table');
	    		
	    		$insert = $veiculoTable->insert($dadosValidados);
	    		
				if($insert)
				{
					$this->flashMessenger()->addSuccessMessage('O veículo foi inserida com sucesso.');
					
					$form = $formLimpo;
				}
				else
				{
					$this->flashMessenger()->addErrorMessage('Houve um erro na inserção do veículo no banco de dados.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('anuncio/backend-veiculo/form-veiculo');
 		
        return $viewModel;
    }

    public function veiculoEditarAction()
    {	
    	$form = $this->getServiceLocator()->get('veiculo-form');
    	$form->registerElements();
    	
    	$form->get('submit')->setAttributes(array('value' => 'Alterar veículo »'));
    	$tituloPainel = "Alterar Veículo";
    	
    	$idVeiculo = $this->params()->fromRoute('id', false);
    	$response = $this->getResponse();
    	
    	if(false == $idVeiculo)
    	{
    		$response->setStatusCode(404);
    		return;
    	}
    	
		$veiculoTable = $this->getServiceLocator()->get('veiculo-table');
    	$veiculoResult = $veiculoTable->select(array('idVeiculo' => $idVeiculo));	
    	$veiculo = $veiculoResult->current();

    	if(false == $veiculo)
    	{
    		$response->setStatusCode(404);
    		return;
    	}
    	
   		$form->bind($veiculo);
   		
    	$request = $this->getRequest(); 
    	  		
    	if($request->isPost())
    	{
    		$data = $request->getPost();
	    	
	    	$form->setData($data);
	    	
	    	if($form->isValid())
	    	{
	    		$dadosValidados = $form->getData(\Zend\Form\FormInterface::VALUES_AS_ARRAY);
	    		
	    		$veiculoTable = $this->getServiceLocator()->get('veiculo-table');
	    		
	    		$update = $veiculoTable->update($dadosValidados, array('idVeiculo' => $idVeiculo));
	    		
				if($update)
				{
					$this->flashMessenger()->addSuccessMessage('O veículo foi alterado com sucesso.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('anuncio/backend-veiculo/form-veiculo');
 		
        return $viewModel;   		
    }
    
    public function veiculoApagarAction()
    {
        return array();
    }
    
    public function veiculoTipoListarAction()
    {
        return array();
    }

    public function veiculoTipoInserirAction()
    {
    	$form = $this->getServiceLocator()->get('veiculo-tipo-form');
    	$form->registerElements();

    	$form->get('submit')->setAttributes(array('value' => 'Inserir tipo de veículo »'));
    	$tituloPainel = "Inserir Tipo de Veículo";    
    	
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
	    		
	    		$veiculoTipoTable = $this->getServiceLocator()->get('veiculo-tipo-table');
	    		
	    		$insert = $veiculoTipoTable->insert($dadosValidados);
	    		
				if($insert)
				{
					$this->flashMessenger()->addSuccessMessage('O tipo de veículo foi inserido com sucesso.');
					
					$form = $formLimpo;
				}
				else
				{
					$this->flashMessenger()->addErrorMessage('Houve um erro na inserção do tipo de veículo no banco de dados.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('anuncio/backend-veiculo/form-veiculo-tipo');
 		
        return $viewModel;
    }

    public function veiculoTipoEditarAction()
    {
    	$form = $this->getServiceLocator()->get('veiculo-tipo-form');
    	$form->registerElements();
    	
    	$form->get('submit')->setAttributes(array('value' => 'Alterar tipo de veículo »'));
    	$tituloPainel = "Alterar Tipo de Veículo";
    	
    	$idTipoVeiculo = $this->params()->fromRoute('id', false);
    	$response = $this->getResponse();
    	
    	if(false == $idTipoVeiculo)
    	{
    		$response->setStatusCode(404);
    		return;
    	}
    	
		$tipoVeiculoTable = $this->getServiceLocator()->get('veiculo-tipo-table');
    	$tipoVeiculoResult = $tipoVeiculoTable->select(array('idTipo' => $idTipoVeiculo));	
    	$tipo = $tipoVeiculoResult->current();

    	if(false == $tipo)
    	{
    		$response->setStatusCode(404);
    		return;
    	}
    	
   		$form->bind($tipo);
   		
    	$request = $this->getRequest(); 
    	  		
    	if($request->isPost())
    	{
    		$data = $request->getPost();
	    	
	    	$form->setData($data);
	    	
	    	if($form->isValid())
	    	{
	    		$dadosValidados = $form->getData(\Zend\Form\FormInterface::VALUES_AS_ARRAY);
	    		
	    		$update = $tipoVeiculoTable->update($dadosValidados, array('idTipo' => $idTipoVeiculo));
	    		
				if($update)
				{
					$this->flashMessenger()->addSuccessMessage('O tipo de veículo foi alterado com sucesso.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('anuncio/backend-veiculo/form-veiculo-tipo');
 		
        return $viewModel; 
    }
    
    public function veiculoTipoApagarAction()
    {
        return array();
    }
    
    public function veiculoCombustivelListarAction()
    {
        return array();
    }

    public function veiculoCombustivelInserirAction()
    {
    	$form = $this->getServiceLocator()->get('veiculo-combustivel-form');
    	$form->registerElements();

    	$form->get('submit')->setAttributes(array('value' => 'Inserir combustível »'));
    	$tituloPainel = "Inserir Combustível de Veículo";    
    	
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
	    		
	    		$veiculoCombustivelTable = $this->getServiceLocator()->get('veiculo-combustivel-table');
	    		
	    		$insert = $veiculoCombustivelTable->insert($dadosValidados);
	    		
				if($insert)
				{
					$this->flashMessenger()->addSuccessMessage('O combustível foi inserido com sucesso.');
					
					$form = $formLimpo;
				}
				else
				{
					$this->flashMessenger()->addErrorMessage('Houve um erro na inserção do combustível no banco de dados.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('anuncio/backend-veiculo/form-veiculo-combustivel');
 		
        return $viewModel;
    }

    public function veiculoCombustivelEditarAction()
    {
    	$form = $this->getServiceLocator()->get('veiculo-combustivel-form');
    	$form->registerElements();
    	
    	$form->get('submit')->setAttributes(array('value' => 'Alterar combustível »'));
    	$tituloPainel = "Alterar Combustível";
    	
    	$idCombustivel = $this->params()->fromRoute('id', false);
    	$response = $this->getResponse();
    	
    	if(false == $idCombustivel)
    	{
    		$response->setStatusCode(404);
    		return;
    	}
    	
		$combustivelTable = $this->getServiceLocator()->get('veiculo-combustivel-table');
    	$combustivelResult = $combustivelTable->select(array('idCombustivel' => $idCombustivel));	
    	$combustivel = $combustivelResult->current();

    	if(false == $combustivel)
    	{
    		$response->setStatusCode(404);
    		return;
    	}
    	
   		$form->bind($combustivel);
   		
    	$request = $this->getRequest(); 
    	  		
    	if($request->isPost())
    	{
    		$data = $request->getPost();
	    	
	    	$form->setData($data);
	    	
	    	if($form->isValid())
	    	{
	    		$dadosValidados = $form->getData(\Zend\Form\FormInterface::VALUES_AS_ARRAY);
	    		
	    		$update = $combustivelTable->update($dadosValidados, array('idCombustivel' => $idCombustivel));
	    		
				if($update)
				{
					$this->flashMessenger()->addSuccessMessage('O combustível foi alterado com sucesso.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('anuncio/backend-veiculo/form-veiculo-combustivel');
 		
        return $viewModel; 
    }
    
    public function veiculoCombustivelApagarAction()
    {
        return array();
    }
    
    public function veiculoCorListarAction()
    {
        return array();
    }
    
    public function veiculoCorInserirAction()
    {
    	$form = $this->getServiceLocator()->get('veiculo-cor-form');
    	$form->registerElements();

    	$form->get('submit')->setAttributes(array('value' => 'Inserir cor »'));
    	$tituloPainel = "Inserir Cor de Veículo";    
    	
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
	    		
	    		$veiculoCorTable = $this->getServiceLocator()->get('veiculo-cor-table');
	    		
	    		$insert = $veiculoCorTable->insert($dadosValidados);
	    		
				if($insert)
				{
					$this->flashMessenger()->addSuccessMessage('A cor foi inserida com sucesso.');
					
					$form = $formLimpo;
				}
				else
				{
					$this->flashMessenger()->addErrorMessage('Houve um erro na inserção da cor no banco de dados.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('anuncio/backend-veiculo/form-veiculo-cor');
 		
        return $viewModel;
    }

    public function veiculoCorEditarAction()
    {
    	$form = $this->getServiceLocator()->get('veiculo-cor-form');
    	$form->registerElements();
    	
    	$form->get('submit')->setAttributes(array('value' => 'Alterar cor »'));
    	$tituloPainel = "Alterar Cor";
    	
    	$idCor = $this->params()->fromRoute('id', false);
    	$response = $this->getResponse();
    	
    	if(false == $idCor)
    	{
    		$response->setStatusCode(404);
    		return;
    	}
    	
		$corTable = $this->getServiceLocator()->get('veiculo-cor-table');
    	$corResult = $corTable->select(array('idCor' => $idCor));	
    	$cor = $corResult->current();

    	if(false == $cor)
    	{
    		$response->setStatusCode(404);
    		return;
    	}
    	
   		$form->bind($cor);
   		
    	$request = $this->getRequest(); 
    	  		
    	if($request->isPost())
    	{
    		$data = $request->getPost();
	    	
	    	$form->setData($data);
	    	
	    	if($form->isValid())
	    	{
	    		$dadosValidados = $form->getData(\Zend\Form\FormInterface::VALUES_AS_ARRAY);
	    		
	    		$update = $corTable->update($dadosValidados, array('idCor' => $idCor));
	    		
				if($update)
				{
					$this->flashMessenger()->addSuccessMessage('A cor foi alterada com sucesso.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('anuncio/backend-veiculo/form-veiculo-cor');
 		
        return $viewModel; 
    }

    public function veiculoCorApagarAction()
    {
        return array();
    }
    
    public function veiculoFabricanteListarAction()
    {
        return array();
    }

    public function veiculoFabricanteInserirAction()
    {
    	$form = $this->getServiceLocator()->get('veiculo-fabricante-form');
    	$form->registerElements();

    	$form->get('submit')->setAttributes(array('value' => 'Inserir fabricante »'));
    	$tituloPainel = "Inserir Fabricante de Veículo";    
    	
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
	    		
	    		$veiculoFabricanteTable = $this->getServiceLocator()->get('veiculo-fabricante-table');
	    		
	    		$insert = $veiculoFabricanteTable->insert($dadosValidados);
	    		
				if($insert)
				{
					$this->flashMessenger()->addSuccessMessage('O fabricante foi inserido com sucesso.');
					
					$form = $formLimpo;
				}
				else
				{
					$this->flashMessenger()->addErrorMessage('Houve um erro na inserção do fabricante no banco de dados.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('anuncio/backend-veiculo/form-veiculo-fabricante');
 		
        return $viewModel;
    }

    public function veiculoFabricanteEditarAction()
    {
    	$form = $this->getServiceLocator()->get('veiculo-fabricante-form');
    	$form->registerElements();
    	
    	$form->get('submit')->setAttributes(array('value' => 'Alterar fabricante »'));
    	$tituloPainel = "Alterar Fabricante";
    	
    	$idFabricante = $this->params()->fromRoute('id', false);
    	$response = $this->getResponse();
    	
    	if(false == $idFabricante)
    	{
    		$response->setStatusCode(404);
    		return;
    	}
    	
		$fabricanteTable = $this->getServiceLocator()->get('veiculo-fabricante-table');
    	$fabricanteResult = $fabricanteTable->select(array('idFabricante' => $idFabricante));	
    	$fabricante = $fabricanteResult->current();

    	if(false == $fabricante)
    	{
    		$response->setStatusCode(404);
    		return;
    	}
    	
   		$form->bind($fabricante);
   		
    	$request = $this->getRequest(); 
    	  		
    	if($request->isPost())
    	{
    		$data = $request->getPost();
	    	
	    	$form->setData($data);
	    	
	    	if($form->isValid())
	    	{
	    		$dadosValidados = $form->getData(\Zend\Form\FormInterface::VALUES_AS_ARRAY);
	    		
	    		$update = $fabricanteTable->update($dadosValidados, array('idFabricante' => $idFabricante));
	    		
				if($update)
				{
					$this->flashMessenger()->addSuccessMessage('O fabricante foi alterado com sucesso.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('anuncio/backend-veiculo/form-veiculo-fabricante');
 		
        return $viewModel; 
    }
    
    public function veiculoFabricanteApagarAction()
    {
        return array();
    }
    
    public function veiculoTipoFabricanteListarAction()
    {
        return array();
    }

    public function veiculoTipoFabricanteInserirAction()
    {
    	$form = $this->getServiceLocator()->get('veiculo-tipo-fabricante-form');
    	$form->registerElements();

    	$form->get('submit')->setAttributes(array('value' => 'Associar tipo com fabricante »'));
    	$tituloPainel = "Associar Tipo e Fabricante de Veículo";    
    	
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
	    		
	    		$veiculoTipoFabricanteTable = $this->getServiceLocator()->get('veiculo-tipo-fabricante-table');
	    		
	    		$insert = $veiculoTipoFabricanteTable->insert($dadosValidados);
	    		
				if($insert)
				{
					$this->flashMessenger()->addSuccessMessage('O tipo-fabricante foi inserido com sucesso.');
					
					$form = $formLimpo;
				}
				else
				{
					$this->flashMessenger()->addErrorMessage('Houve um erro na inserção do tipo-fabricante no banco de dados.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('anuncio/backend-veiculo/form-veiculo-tipo-fabricante');
 		
        return $viewModel;
    }

    public function veiculoTipoFabricanteEditarAction()
    {
    	$form = $this->getServiceLocator()->get('veiculo-tipo-fabricante-form');
    	$form->registerElements();
    	
    	$form->get('submit')->setAttributes(array('value' => 'Alterar associação tipo-fabricante »'));
    	$tituloPainel = "Alterar associação de Tipo e Fabricante de Veículo";
    	
    	$idTipoFabricante = $this->params()->fromRoute('id', false);
    	$response = $this->getResponse();
    	
    	if(false == $idTipoFabricante)
    	{
    		$response->setStatusCode(404);
    		return;
    	}
    	
		$tipoFabricanteTable = $this->getServiceLocator()->get('veiculo-tipo-fabricante-table');
    	$tipoFabricanteResult = $tipoFabricanteTable->select(array('idTipoFabricante' => $idTipoFabricante));	
    	$tipoFabricante = $tipoFabricanteResult->current();

    	if(false == $tipoFabricante)
    	{
    		$response->setStatusCode(404);
    		return;
    	}
    	
   		$form->bind($tipoFabricante);
   		
    	$request = $this->getRequest(); 
    	  		
    	if($request->isPost())
    	{
    		$data = $request->getPost();
	    	
	    	$form->setData($data);
	    	
	    	if($form->isValid())
	    	{
	    		$dadosValidados = $form->getData(\Zend\Form\FormInterface::VALUES_AS_ARRAY);
	    		
	    		$update = $tipoFabricanteTable->update($dadosValidados, array('idTipoFabricante' => $idTipoFabricante));
	    		
				if($update)
				{
					$this->flashMessenger()->addSuccessMessage('A associação tipo-fabricante foi alterada com sucesso.');
				}
	    	}
	    	else
	    	{
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
	    	}
    	}	
 		
 		$viewModel = new ViewModel(array('form' => $form,
 										 'tituloPainel' => $tituloPainel));
 		$viewModel->setTemplate('anuncio/backend-veiculo/form-veiculo-tipo-fabricante');
 		
        return $viewModel; 
    }
    
    public function veiculoTipoFabricanteApagarAction()
    {
        return array();
    }
}
