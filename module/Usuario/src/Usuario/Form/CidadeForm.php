<?php
namespace Usuario\Form;

use Zend\Form\Form;
use Usuario\Form\Filter\CidadeFilter;
use Usuario\Model\Entity\CidadeEntity;
use Zend\StdLib\Hydrator\ObjectProperty;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CidadeForm extends Form implements ServiceLocatorAwareInterface
{		
	/**
	 * Recebe o Service Locator
	 */
	protected $serviceLocator;
	
	/**
	 * @var array Guarda as Regiões (usados como options em um select field do formulário)
	 */
	protected $regiaoOptions = array();
	
	/**
	 * Configura propriedades do formulário e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('cidade-form');

		$this->setAttributes(array('class' => 'form-backend form-horizontal', 
								   'method' => 'post', 
								   'character_set' => 'UTF-8',
								   ))
			 ->setInputFilter(new CidadeFilter());
			
		$this->setHydrator(new ObjectProperty)
			 ->setObject(new CidadeEntity);
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields) e carrega os campos Select
	 */
	public function registerElements()
	{
		$this->loadRegiaoOptions();
				
		// Campo Região
		$this->add(array(
				  'type' => 'Zend\Form\Element\Select',
				  'name' => 'idRegiao',
				  'attributes' => array(
				  					   'id' => 'idRegiao',
				  					   'class' => 'form-control',
				  					   ),
				  'options'	   => array(
				  					   'disable_inarray_validator' => true,
				  					   'empty_option' => 'Selecione a Região',
				  					   'label' => 'Região',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   'value_options' => $this->regiaoOptions,
				  					   )
		));
		
		// Campo Cidade
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'nomeCidade',
				  'attributes' => array(
				  					   'id' => 'nomeCidade',
									   'placeholder' => 'nome da cidade',
									   'class' => 'form-control',
									   'maxlength' => 40,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Cidade',
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
	 * Obtem a lista de Regiões
	 */
	public function loadRegiaoOptions()
	{
		$regiaoTable = $this->serviceLocator->get('regiao-table');
		$regioes = $regiaoTable->select();
		
		foreach ($regioes as $regiao)
		{
			$this->regiaoOptions[$regiao['idRegiao']] = $regiao['nomeRegiao'];
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