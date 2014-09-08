<?php
namespace Anuncio\Form;

use Zend\Form\Form;
use Anuncio\Form\Filter\VeiculoFilter;
use Anuncio\Model\Entity\VeiculoEntity;
use Zend\StdLib\Hydrator\ObjectProperty;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class VeiculoForm extends Form implements ServiceLocatorAwareInterface
{		
	/**
	 * Recebe o Service Locator
	 */
	protected $serviceLocator;
	
	/**
	 * @var array Guarda os Tipo-Fabricante de Veículo (usados como options em um select field do formulário)
	 */
	protected $veiculoTipoFabricanteOptions = array();
	
	/**
	 * Configura propriedades do formulário e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('veiculo-form');

		$this->setAttributes(array('class' => 'form-backend form-horizontal', 
								   'method' => 'post', 
								   'character_set' => 'UTF-8',
								   ))
			 ->setInputFilter(new VeiculoFilter());
			
		$this->setHydrator(new ObjectProperty)
			 ->setObject(new VeiculoEntity);
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields) e carrega os campos Select
	 */
	public function registerElements()
	{
		$this->loadTipoFabricanteOptions();
				
		// Campo Tipo-Fabricante
		$this->add(array(
				  'type' => 'Zend\Form\Element\Select',
				  'name' => 'idTipoFabricante',
				  'attributes' => array(
				  					   'id' => 'idTipoFabricante',
				  					   'class' => 'form-control',
				  					   ),
				  'options'	   => array(
				  					   //'disable_inarray_validator' => true,
				  					   'empty_option' => 'Selecione o Tipo de Veículo e o Fabricante',
				  					   'label' => 'Tipo de Veículo e Fabricante',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   'value_options' => $this->veiculoTipoFabricanteOptions,
				  					   )
		));
		
		// Campo Nome do Veículo
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'nomeVeiculo',
				  'attributes' => array(
				  					   'id' => 'nomeVeiculo',
									   'placeholder' => 'nome do veículo',
									   'class' => 'form-control',
									   'maxlength' => 30,
									   ),
				  'options'    => array(
				  					   'label' => 'Nome do Veículo',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
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
	 * Obtem a lista de Tipos de Veículo e Fabricantes
	 */
	public function loadTipoFabricanteOptions()
	{
		$veiculoTipoFabricante = $this->serviceLocator->get('veiculo-tipo-fabricante-table');
		$tiposFabricantes = $veiculoTipoFabricante->getTipoFabricanteList();
		
		foreach ($tiposFabricantes as $tipoFabricante)
		{
			$this->veiculoTipoFabricanteOptions[$tipoFabricante['idTipoFabricante']] = strtoupper($tipoFabricante['nomeTipo']) ." - ". $tipoFabricante['nomeFabricante'];
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