<?php
namespace Anuncio\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;
use Anuncio\Model\AnuncioTable;
use Anuncio\Model\AnuncioModel;
use Anuncio\Model\Entity\AnuncioEntity;
use Zend\Db\TableGateway\Feature;

class BackendAnuncioController extends AbstractActionController
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
	
	/**
	 * Página da listagem de anúncios
	 */
    public function listarAction()
    {
    	$tituloPainel = "Meus anúncios publicados";
    	$anunciosTable = $this->getServiceLocator()->get('anuncio-table');
    	
    	$anuncios = $anunciosTable->getAnunciosListByIdUsuario(1); // @todo Alterar após ACL
    	
        return new ViewModel(array('anuncios' => $anuncios,
        						   'tituloPainel' => $tituloPainel,
        						   'uploadDirectoryStructure' => $this->getUploadDirectoryStructure()));
    }

	/**
	 * Página de inserção de anúncio
	 */
    public function inserirAction()
    {
    	$form = $this->getServiceLocator()->get('anuncio-form');
    	$form->registerElements();
    	
    	$form->get('submit')->setAttributes(array('value' => 'Publicar anúncio »'));
    	$tituloPainel = "Adicionar Novo Anúncio";
    	
    	$request = $this->getRequest();
    	
    	if($request->isPost())
    	{
    		$data = array_merge_recursive(
    			$request->getPost()->toArray(),
    			$request->getFiles()->toArray()
    		);
    		
	    	// Clona o form limpo e com atributos associados para ser usado em caso de sucesso na inserção */
	    	$formLimpo = clone $form;
			
			$form->setData($data);

			if($form->isValid()) // Filtra e Valida os dados do Post. Apenas Valida os Files.
			{
				$dadosValidados = $form->getData(\Zend\Form\FormInterface::VALUES_AS_ARRAY); // Filtra of Files
				
				$anuncioModel = $this->getServiceLocator()->get('anuncio-model');
				
				$anuncioModel->setData($dadosValidados);
				$anuncioModel->createDirectoryStructure();
				$anuncioModel->resizeImages();
				
				$dadosValidados = $anuncioModel->getData();
				
				$anuncioTable = $this->getServiceLocator()->get('anuncio-table');
	
				$insert = $anuncioTable->insert($dadosValidados);
				
				if($insert)
				{
					$this->flashMessenger()->addSuccessMessage('O anúncio foi publicado com sucesso.');
					
					$form = $formLimpo;
				}
				else
				{
					$this->flashMessenger()->addErrorMessage('Houve um erro na inserção do anúncio no banco de dados.');
				}
			}
			else
			{
				$filter = $form->getInputFilter();
				$idTipoVeiculo = $filter->getValue('idTipoVeiculo');
				$idFabricante = $filter->getValue('idFabricante');
				
				if($idTipoVeiculo)
				{
					$form->get('idFabricante')->setValueOptions($this->getFabricanteOptions($idTipoVeiculo));
				}
				
				if($idFabricante)
				{
					$form->get('idVeiculo')->setValueOptions($this->getVeiculoOptions($idTipoVeiculo, $idFabricante));
				}
				
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram corretamente preenchidos. Verifique abaixo.');
			}
    	}
        
        return new ViewModel(array('form' => $form,
        						   'tituloPainel' => $tituloPainel));
    }

	/**
	 * Página de edição de anúncio
	 */
    public function editarAction()
    {
    	$form = $this->getServiceLocator()->get('anuncio-form');
    	$form->registerElements();
    	
    	$form->get('submit')->setAttributes(array('value' => 'Alterar anúncio »'));
    	$tituloPainel = "Alterar Anúncio";
    	
    	$idAnuncio = $this->params()->fromRoute('id', false);
    	$response = $this->getResponse();
    	
    	if(false == $idAnuncio)
    	{
    		$response->setStatusCode(404);
    		return;
    	}
    	
		$anuncioTable = $this->getServiceLocator()->get('anuncio-table');
    	$anuncioResult = $anuncioTable->select(array('idAnuncio' => $idAnuncio));	
    	$anuncio = $anuncioResult->current();

    	if(false == $anuncio)
    	{
    		$response->setStatusCode(404);
    		return;
    	}

    	if($anuncio['idTipoVeiculo'])
    	{
    		$idTipoVeiculo = $anuncio['idTipoVeiculo'];
	    	
	    	if($anuncio['idFabricante'])
	    	{
	    		$idFabricante = $anuncio['idFabricante'];
	    		$form->get('idFabricante')->setValueOptions($this->getFabricanteOptions($idTipoVeiculo));
	    		
	    		if($anuncio['idVeiculo'])
	    		{
		    		$form->get('idVeiculo')->setValueOptions($this->getVeiculoOptions($idTipoVeiculo, $idFabricante));
		    	}
	    	}
    	}

    	$form->bind($anuncio);

    	$fotos = array('caminhoFoto1' => $anuncio['caminhoFoto1'],
    				   'caminhoFoto2' => $anuncio['caminhoFoto2'],
    				   'caminhoFoto3' => $anuncio['caminhoFoto3'],
    				   'caminhoFoto4' => $anuncio['caminhoFoto4'],
    				   'caminhoFoto5' => $anuncio['caminhoFoto5'],
    				   'caminhoFoto6' => $anuncio['caminhoFoto6'],
    				   'caminhoFoto7' => $anuncio['caminhoFoto7'],
    				   'caminhoFoto8' => $anuncio['caminhoFoto8'],
    				   'caminhoFoto9' => $anuncio['caminhoFoto9'],
    				   'caminhoFoto10' => $anuncio['caminhoFoto10']
    				  );
    				  
    	$request = $this->getRequest();

    	if($request->isPost())
    	{
    		$data = array_merge_recursive(
    			$request->getPost()->toArray(),
    			$request->getFiles()->toArray()
    		);
    		
	    	$form->setData($data);
	    	
	    	$modifiedForm = clone $form;
	    	
			if($form->isValid()) // Filtra e Valida os dados do Post. Apenas Valida os Files.
			{
				$dadosValidados = $form->getData(\Zend\Form\FormInterface::VALUES_AS_ARRAY); // Filtra of Files
				
				$anuncioModel = $this->getServiceLocator()->get('anuncio-model');
				
				$anuncioModel->setData($dadosValidados);
				$anuncioModel->setCurrentFotos($fotos);
				$anuncioModel->editFotos();
				
				$anuncioModel->createDirectoryStructure();
				$anuncioModel->resizeImages();
				
				$dadosValidados = $anuncioModel->getData();
	
				$anuncioTable = $this->getServiceLocator()->get('anuncio-table');
				$update = $anuncioTable->updateAnuncioWith($dadosValidados, array('idAnuncio' => $idAnuncio));
				
				if($update)
				{
					$this->flashMessenger()->addSuccessMessage('O anúncio foi alterado com sucesso.');
					
					$this->redirect()->toRoute('login/anuncios');
				}
				else
				{
					$this->flashMessenger()->addErrorMessage('Houve um erro na alteração do anúncio no banco de dados.');

					$form = $modifiedForm;
				}
			}
			else
			{
				$filter = $form->getInputFilter();
				$idTipoVeiculo = $filter->getValue('idTipoVeiculo');
				$idFabricante = $filter->getValue('idFabricante');
				
				if($idTipoVeiculo)
				{
					$form->get('idFabricante')->setValueOptions($this->getFabricanteOptions($idTipoVeiculo));
				}
				
				if($idFabricante)
				{
					$form->get('idVeiculo')->setValueOptions($this->getVeiculoOptions($idTipoVeiculo, $idFabricante));
				}
				
				$this->flashMessenger()->addErrorMessage('Um ou mais campos obrigatórios não foram preenchidos. Verifique abaixo.');
				
			}
    	}
    	
        return new ViewModel(array('form' => $form,
        						   'tituloPainel' => $tituloPainel,
        						   'fotos' => $fotos,
        						   'placa' => $anuncio['placa'],
        						   'uploadDirectoryStructure' => $this->getUploadDirectoryStructure()));
    }
    
	/**
	 * Página de remoção de anúncio
	 */
    public function apagarAction()
    {
    	$idAnuncio = $this->params()->fromRoute('id', false);
    	$response = $this->getResponse();
    	
    	if(false == $idAnuncio)
    	{
    		$response->setStatusCode(404);
    		return;
    	}
    	
    	$anuncioTable = $this->getServiceLocator()->get('anuncio-table');
    	$anuncioResult = $anuncioTable->select(array('idAnuncio' => $idAnuncio));	
    	$anuncio = $anuncioResult->current();
    	
    	if(false == $anuncio)
    	{
    		$response->setStatusCode(404);
    		return;
    	}
    	
    	$anuncioModel = $this->getServiceLocator()->get('anuncio-model');
    	$anuncioModel->setData((array) $anuncio);
    	$anuncioModel->deleteFotos();
    	
    	$deleteAnuncio = $anuncioTable->delete(array('idAnuncio' => $idAnuncio));
    	
    	if($deleteAnuncio) 
    	{
    		$this->flashMessenger()->addSuccessMessage('O anúncio foi excluído.');
    	}
    	else
    	{
    		$this->flashMessenger()->addErrorMessage('O anúncio não pôde ser excluído');	
    	}
    	
    	return $this->redirect()->toRoute('login/anuncios');
    }
    
	/**
	 * (AJAX) - Retorna os Fabricantes de Veículos via chamada AJAX
	 */
    public function ajaxFabricanteOptionsAction()
    {
    	$request = $this->getRequest();
    	$response = $this->getResponse();
    	
    	if ($request->isXmlHttpRequest())
    	{
    		$idTipo = $this->params()->fromQuery('idTipo');

	     	$fabricantes = $this->getFabricanteOptions($idTipo);
	    	
	    	return $response->setContent(\Zend\Json\Json::encode($fabricantes));
    	}
    	
    	return $this->redirect()->toRoute('home');
    }
    
	/**
	 * (AJAX) - Retorna os Veículos via chamada AJAX
	 */
    public function ajaxVeiculoOptionsAction()
    {
    	$request = $this->getRequest();
    	$response = $this->getResponse();
    	
    	if($request->isXmlHttpRequest())
    	{
    		$idTipo = $this->params()->fromQuery('idTipo');
	     	$idFabricante = $this->params()->fromQuery('idFabricante');
	    	
	    	$veiculos = $this->getVeiculoOptions($idTipo, $idFabricante);
    	
    		return $response->setContent(\Zend\Json\Json::encode($veiculos));	    		
    	}
    	
    	return $this->redirect()->toRoute('home');
    }
    
	/**
	 * Retorna os Fabricantes de Veículos de acordo com o Tipo de Veículo
	 */
    protected function getFabricanteOptions($idTipo)
    {
		$veiculosFabricantesTable = $this->getServiceLocator()->get('veiculo-fabricante-table');	
		$resultFabricantes = $veiculosFabricantesTable->getFabricantesByIdTipo($idTipo);
		
    	$fabricantes = array();
    	
    	foreach($resultFabricantes as $fabricante)
    	{
			$fabricantes[$fabricante['idFabricante']] = $fabricante['nomeFabricante'];
    	}
    	
    	return $fabricantes;
    }
    
	/**
	 * Obtem os Veículos de acordo com um Tipo de Veículo e Fabricante
	 */
    protected function getVeiculoOptions($idTipo, $idFabricante)
    {	
		$veiculosTable = $this->getServiceLocator()->get('veiculo-table');
		
		$resultVeiculos = $veiculosTable->getVeiculosByIdFabricante($idTipo, $idFabricante);
		
	    $veiculos = array();   		
	    	
    	foreach($resultVeiculos as $veiculo)
    	{
    		$veiculos[$veiculo['idVeiculo']] = $veiculo['nomeVeiculo'];
    	}
    	
    	return $veiculos;
    }
    
    /**
     * Retorna a estrutura de diretórios onde são feitos os uploads
     */
    protected function getUploadDirectoryStructure()
    {
    	$config = $this->getServiceLocator()->get('config');
    	return $config['upload_directory_structure'];
    }
}
