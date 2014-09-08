<?php
namespace Usuario\Form;

use Zend\Form\Form;
use Usuario\Form\Filter\RegiaoFilter;
use Usuario\Model\Entity\RegiaoEntity;
use Zend\StdLib\Hydrator\ObjectProperty;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RegiaoForm extends Form  implements ServiceLocatorAwareInterface
{		
	/**
	 * Recebe o Service Locator
	 */
	protected $serviceLocator;
	
	/**
	 * @var array Guarda as Regiões (usados como options em um select field do formulário)
	 */
	protected $estadoOptions = array();
	
	/**
	 * Configura propriedades do formulário e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('regiao-form');

		$this->setAttributes(array('class' => 'form-backend form-horizontal', 
								   'method' => 'post', 
								   'character_set' => 'UTF-8',
								   ))
			 ->setInputFilter(new RegiaoFilter());
			
		$this->setHydrator(new ObjectProperty)
			 ->setObject(new RegiaoEntity);
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields) e carrega os campos Select
	 */
	public function registerElements()
	{
		$this->loadEstadoOptions();
				
		// Campo Estado
		$this->add(array(
				  'type' => 'Zend\Form\Element\Select',
				  'name' => 'idEstado',
				  'attributes' => array(
				  					   'id' => 'idEstado',
				  					   'class' => 'form-control',
				  					   ),
				  'options'	   => array(
				  					   //'disable_inarray_validator' => true,
				  					   'empty_option' => 'Selecione o Estado',
				  					   'label' => 'Estado',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   'value_options' => $this->estadoOptions,
				  					   )
		));
		
		// Campo Região
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'nomeRegiao',
				  'attributes' => array(
				  					   'id' => 'nomeRegiao',
									   'placeholder' => 'nome da região',
									   'class' => 'form-control',
									   'maxlength' => 45,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Região',
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
	 * Obtem a lista de Estados
	 */
	public function loadEstadoOptions()
	{
		$estadoTable = $this->serviceLocator->get('estado-table');
		$estados = $estadoTable->select();
		
		foreach ($estados as $estado)
		{
			$this->estadoOptions[$estado['idEstado']] = $estado['nomeEstado'];
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