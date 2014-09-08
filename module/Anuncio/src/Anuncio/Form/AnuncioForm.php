<?php
namespace Anuncio\Form;

use Zend\Form\Form;
use Anuncio\Form\AnuncioOpcionais;
use Anuncio\Form\Filter\AnuncioFilter;
use Anuncio\Model\Entity\AnuncioEntity;
use Zend\StdLib\Hydrator\ObjectProperty;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AnuncioForm extends Form implements ServiceLocatorAwareInterface
{	
	/**
	* @var array Guarda os nomes dos campos de equipamentos opcionais
	*/
	protected $opcionais = array();
	
	/**
	 * Recebe o Service Locator
	 */
	protected $serviceLocator;
	
	/**
	 * @var array Guarda os Tipos de Veículo (usados como options em um select field do formulário)
	 */
	protected $veiculoTipoOptions = array();
	
	/**
	 * @var array Guarda os Combustíveis (usados como options em um select field do formulário)
	 */	
	protected $veiculoCombustivelOptions = array();
	
	/**
	 * @var array Guarda as Cores (usados como options em um select field do formulário)
	 */		
	protected $veiculoCorOptions = array();
	
	/**
	 * @var array Guarda os Fabricantes (usados como options em um select field do formulário)
	 */		
	protected $veiculoFabricanteOptions = array();
	
	/**
	 * @var array Guarda os Veículos (usados como options em um select field do formulário)
	 */		
	protected $veiculoOptions = array();
	
	/**
	 * Configura propriedades do formulário e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('anuncio-form');

		$this->setAttributes(array('class' => 'form-backend form-horizontal', 
								   'method' => 'post', 
								   'enctype' => 'multipart/form-data',
								   'character_set' => 'UTF-8',
								   ))
			 ->setInputFilter(new AnuncioFilter());
			
		$this->setHydrator(new ObjectProperty)
			 ->setObject(new AnuncioEntity);
		
		$anuncioOpcionais = new AnuncioOpcionais();
		$this->opcionais = $anuncioOpcionais->getOpcionais();
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields) e carrega os campos Select
	 */
	public function registerElements()
	{
		$this->loadVeiculoTipoOptions();
		$this->loadVeiculoCombustivelOptions();
		$this->loadVeiculoCorOptions();
				
		// Campo Tipo de Veículo
		$this->add(array(
				  'type' => 'Zend\Form\Element\Select',
				  'name' => 'idTipoVeiculo',
				  'attributes' => array(
				  					   'id' => 'idTipoVeiculo',
				  					   'class' => 'form-control',
				  					   ),
				  'options'	   => array(
				  					   'disable_inarray_validator' => true,
				  					   'empty_option' => 'Selecione o Tipo de Veículo',
				  					   'label' => 'Tipo de Veículo',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   'value_options' => $this->veiculoTipoOptions,
				  					   )
		));
		
		// Campo Fabricante
		$this->add(array(
				  'type' => 'Zend\Form\Element\Select',
				  'name' => 'idFabricante',
				  'attributes' => array(
				  					   'id' => 'idFabricante',
									   'class' => 'form-control',
				  					   ),
				  'options'    => array(
				  					   'disable_inarray_validator' => true,
				  					   'empty_option' => 'Selecione o Fabricante',
				  					   'label' => 'Fabricante',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
									   'value_options' => $this->veiculoFabricanteOptions,
				  					   ),
		));

		// Campo Veículo
		$this->add(array(
				  'type' => 'Zend\Form\Element\Select',
				  'name' => 'idVeiculo',
				  'attributes' => array(
				  					   'id' => 'idVeiculo',
									   'class' => 'form-control',
				  					   ),
				  'options'    => array(
				  					   'disable_inarray_validator' => true,
									   'empty_option' => 'Selecione o Veículo',
				  					   'label' => 'Veículo',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   	'value_options' => $this->veiculoOptions,
				  					   ),
		));
				  
		// Campo Combustível
		$this->add(array(
				  'type' => 'Zend\Form\Element\Select',
				  'name' => 'idCombustivel',
				  'attributes' => array(
				  					   'id' => 'idCombustivel',
									   'class' => 'form-control',
				  					   ),
				  'options'    => array(
				  					   'disable_inarray_validator' => true,
									   'empty_option' => 'Selecione o Combustível',
				  					   'label' => 'Combustível',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   'value_options' => $this->veiculoCombustivelOptions,
				  					   ),
		));
				  
		// Campo Cor
		$this->add(array(
				  'type' => 'Zend\Form\Element\Select',
				  'name' => 'idCor',
				  'attributes' => array(
				  					   'id' => 'idCor',
									   'class' => 'form-control',
				  					   ),
				  'options'    => array(
									   'empty_option' => 'Selecione o Cor',
				  					   'disable_inarray_validator' => true,
				  					   'label' => 'Cor',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   'value_options' => $this->veiculoCorOptions,
				  					   ),
		));
		
		// Campo Descrição Breve
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'descricaoBreve',
				  'attributes' => array(
				  					   'id' => 'descricaoBreve',
									   'placeholder' => 'exemplo: 1.6 16V 4P Completo',
									   'class' => 'form-control',
									   'maxlength' => 45,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Descrição breve',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));

		// Campo Ano
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'ano',
				  'attributes' => array(
				  					   'id' => 'ano',
									   'placeholder' => 'somente números - exemplo: 2006',
									   'class' => 'form-control',
									   'maxlength' => 4,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Ano',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Placa
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'placa',
				  'attributes' => array(
				  					   'id' => 'placa',
									   'placeholder' => 'exemplo: ABC-1234',
									   'class' => 'form-control',
									   'maxlength' => 8,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Placa',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
				  
		// Campo Quilometragem
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'quilometragem',
				  'attributes' => array(
				  					   'id' => 'quilometragem',
									   'placeholder' => 'somente números - exemplo: 12000',
									   'class' => 'form-control',
									   'maxlength' => 6,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Quilometragem',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));

		// Campo Valor
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'valor',
				  'attributes' => array(
				  					   'id' => 'valor',
									   'placeholder' => 'somente números - exemplo: 45000',
									   'class' => 'form-control',
									   'maxlength' => 7,									   
				  					   ),
				  'options'    => array(
				  					   'label' => 'Valor - R$',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
				  
		// Campos Opcionais (todos os checkboxes)
		foreach ($this->opcionais as $nome => $label)
		{
			$this->add(array(
					  'type' => 'Zend\Form\Element\Checkbox',
					  'name' => $nome,
					  'options'    => array(
					  					   'label' => $label,
					  					   'checked_value' => true,
					  					   'unchecked_value' => false,
					  					   'use_hidden_element' => false,
					  					   ),
			 ));
		}
		
		// Campos Descrição Adicional
		$this->add(array(
				  'type' => 'Zend\Form\Element\Textarea',
				  'name' => 'descricaoAdicional',
				  'attributes' => array(
				  					   'id' => 'descricaoAdicional',
									   'placeholder' => 'exemplo: Único dono, 7 lugares, quitado, etc',
									   'class' => 'form-control',
									   'maxlength' => 400,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Descrição Adicional',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campos Fotos (10 fotos)
		for($i = 1; $i <= 10; $i++)
		{
			$this->add(array(
					  'type' => 'Zend\Form\Element\File',
					  'name' => 'caminhoFoto'.$i,
					  'attributes' => array(
					  					   'id' => 'caminhoFoto'.$i,
										   'class' => 'form-control',
					  					   ),
					  'options'    => array(
					  					   'label' => 'Foto '.$i,
					  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
					  					   ),
			));
		}
				  
		// Campos Delete Foto (um para cada foto)
		for($i = 1; $i <= 10; $i++)
		{
			$this->add(array(
					  'type' => 'Zend\Form\Element\Checkbox',
					  'name' => 'deleteFoto'.$i,
					  'attributes' => array(
					  					   'id' => 'deleteFoto'.$i,
					  					   ),
					  'options'    => array(
					  					   'label' => 'Apagar foto',
					  					   'checked_value' => true,
					  					   'unchecked_value' => false,
					  					   'use_hidden_element' => false,
					  					   ),
	
			));
		}
		
		// Adiciona o botão submit
		$this->add(array(
					   'type' => 'Zend\Form\Element\Submit',
					   'name' => 'submit',
					   'attributes' => array(
											'class' => 'btn btn-primary',
											'type' => 'submit',
											),
		));

		// Adiciona o campo de validação de segurança	
		/*$this->add(array(
					    'type' => 'Zend\Form\Element\Csrf',
					    'name' => 'security'
		)); */
	}
	
	/**
	 * Obtem a lista de Tipos de Veículo
	 */
	public function loadVeiculoTipoOptions()
	{
		$veiculoTipo = $this->serviceLocator->get('veiculo-tipo-table');
		$tipos = $veiculoTipo->select();
		
		foreach ($tipos as $tipo)
		{
			$this->veiculoTipoOptions[$tipo['idTipo']] = $tipo['nomeTipo'];
		}
	}

	/**
	 * Obtem a lista de Combustíveis
	 */	
	public function loadVeiculoCombustivelOptions()
	{
		$veiculoCombustivel = $this->serviceLocator->get('veiculo-combustivel-table');
		$combustiveis = $veiculoCombustivel->select();
		
		foreach ($combustiveis as $combustivel)
		{
			$this->veiculoCombustivelOptions[$combustivel['idCombustivel']] = $combustivel['nomeCombustivel'];
		}
	}
	
	/**
	 * Obtem a lista de Cores
	 */
	public function loadVeiculoCorOptions()
	{
		$veiculoCor = $this->serviceLocator->get('veiculo-cor-table');
		$cores = $veiculoCor->select();
		
		foreach ($cores as $cor)
		{
			$this->veiculoCorOptions[$cor['idCor']] = $cor['nomeCor'];
		}	
	}
	
    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     */
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
	{
		$this->serviceLocator = $serviceLocator;
	}
	
    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
	public function getServiceLocator()
	{
		return $this->serviceLocator;
	}
}