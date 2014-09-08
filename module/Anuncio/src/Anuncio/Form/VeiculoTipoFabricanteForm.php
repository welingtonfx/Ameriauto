<?php
namespace Anuncio\Form;

use Zend\Form\Form;
use Anuncio\Form\Filter\VeiculoTipoFabricanteFilter;
use Anuncio\Model\Entity\VeiculoTipoFabricanteEntity;
use Zend\StdLib\Hydrator\ObjectProperty;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class VeiculoTipoFabricanteForm extends Form implements ServiceLocatorAwareInterface
{		
	/**
	 * Recebe o Service Locator
	 */
	protected $serviceLocator;
	
	/**
	 * @var array Guarda os Tipos de Veículo (usados como options em um select field do formulário)
	 */
	protected $veiculoTipoOptions = array();
	
	/**
	 * @var array Guarda os Fabricantes (usados como options em um select field do formulário)
	 */
	protected $veiculoFabricanteOptions = array();
	
	/**
	 * Configura propriedades do formulário e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('veiculo-tipo-fabricante-form');

		$this->setAttributes(array('class' => 'form-backend form-horizontal', 
								   'method' => 'post', 
								   'character_set' => 'UTF-8',
								   ))
			 ->setInputFilter(new VeiculoTipoFabricanteFilter());
			
		$this->setHydrator(new ObjectProperty)
			 ->setObject(new VeiculoTipoFabricanteEntity);
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields) e carrega os campos Select
	 */
	public function registerElements()
	{
		$this->loadVeiculoTipoOptions();
		$this->loadVeiculoFabricanteOptions();
				
		// Campo Tipo de Veículo
		$this->add(array(
				  'type' => 'Zend\Form\Element\Select',
				  'name' => 'idTipo',
				  'attributes' => array(
				  					   'id' => 'idTipo',
				  					   'class' => 'form-control',
				  					   ),
				  'options'	   => array(
				  					   //'disable_inarray_validator' => true,
				  					   'empty_option' => 'Selecione o Tipo de Veículo',
				  					   'label' => 'Tipo de Veículo',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   'value_options' => $this->veiculoTipoOptions,
				  					   )
		));
	
		// Campo Fabricante de Veículo
		$this->add(array(
				  'type' => 'Zend\Form\Element\Select',
				  'name' => 'idFabricante',
				  'attributes' => array(
				  					   'id' => 'idFabricante',
				  					   'class' => 'form-control',
				  					   ),
				  'options'	   => array(
				  					   //'disable_inarray_validator' => true,
				  					   'empty_option' => 'Selecione o Fabricante',
				  					   'label' => 'Fabricante',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   'value_options' => $this->veiculoFabricanteOptions,
				  					   )
		));		

		
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
	 * Obtem a lista de Fabricantes de Veículo
	 */
	public function loadVeiculoFabricanteOptions()
	{
		$veiculoFabricante = $this->serviceLocator->get('veiculo-fabricante-table');
		$fabricantes = $veiculoFabricante->select();
		
		foreach ($fabricantes as $fabricante)
		{
			$this->veiculoFabricanteOptions[$fabricante['idFabricante']] = $fabricante['nomeFabricante'];
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