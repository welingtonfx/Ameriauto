<?php
namespace Usuario\Form;

use Zend\Form\Fieldset;
use Zend\StdLib\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilterProviderInterface;
use Usuario\Model\Entity\UsuarioParticularEntity;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UsuarioParticularFieldset extends Fieldset implements InputFilterProviderInterface
															ServiceLocatorAwareInterface
{		
	/**
	 * @var array Guarda as Cidades (usados como options em um select field do formulário)
	 */
	protected $cidadeOptions = array();
	
	/**
	 * Configura propriedades do fieldset e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('usuario-particular-fieldset');
			
		$this->setHydrator(new ClassMethods)
			 ->setObject(new UsuarioParticularEntity);
			 
		$this->registerElements();
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields) e carrega os campos Select
	 */
	public function registerElements()
	{
		$this->loadCidadeOptions();
		
		// Campo (ID) Usuario
		$this->add(array(
				  'type' => 'Usuario\Form\UsuarioFieldset',
				  'name' => 'usuario',
				  'attributes' => array(
				  					   'id' => 'usuario',
									   'class' => 'form-control',
				  					   ),
				  'options'    => array(
				  					   'label' => 'E-mail',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Nome
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'nome',
				  'attributes' => array(
				  					   'id' => 'nome',
									   'placeholder' => 'seu nome',
									   'class' => 'form-control',
									   'maxlength' => 60,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Nome',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Endereço
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'endereco',
				  'attributes' => array(
				  					   'id' => 'endereco',
									   'placeholder' => 'seu endereço',
									   'class' => 'form-control',
									   'maxlength' => 80,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Endereço',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Bairro
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'bairro',
				  'attributes' => array(
				  					   'id' => 'bairro',
									   'placeholder' => 'bairro',
									   'class' => 'form-control',
									   'maxlength' => 35,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Bairro',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Cidade
		$this->add(array(
				  'type' => 'Zend\Form\Element\Select',
				  'name' => 'cidade',
				  'attributes' => array(
				  					   'id' => 'cidade',
				  					   'class' => 'form-control',
				  					   ),
				  'options'	   => array(
				  					   //'disable_inarray_validator' => true,
				  					   'empty_option' => 'Selecione sua cidade',
				  					   'label' => 'Sua cidade',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   'value_options' => $this->cidadeOptions,
				  					   )
		));
		
		// Campo Complemento
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'complemento',
				  'attributes' => array(
				  					   'id' => 'complemento',
									   'placeholder' => 'complemento',
									   'class' => 'form-control',
									   'maxlength' => 50,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Complemento',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo CPF
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'cpf',
				  'attributes' => array(
				  					   'id' => 'cpf',
									   'placeholder' => 'cpf',
									   'class' => 'form-control',
									   'maxlength' => 14,
				  					   ),
				  'options'    => array(
				  					   'label' => 'CNPJ',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo DDD Celular
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'dddCelular',
				  'attributes' => array(
				  					   'id' => 'dddCelular',
									   'class' => 'form-control',
									   'placeholder' => 'DDD',
									   'maxlength' => 2,
				  					   ),
				  'options'    => array(
				  					   'label' => 'DDD Celular',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Celular
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'celular',
				  'attributes' => array(
				  					   'id' => 'celular',
									   'class' => 'form-control',
									   'placeholder' => 'celular',
									   'maxlength' => 10,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Celular',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo DDD Telefone
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'dddTelefone',
				  'attributes' => array(
				  					   'id' => 'dddTelefone',
									   'class' => 'form-control',
									   'placeholder' => 'DDD',
									   'maxlength' => 2,
				  					   ),
				  'options'    => array(
				  					   'label' => 'DDD Telefone',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Telefone
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'telefone',
				  'attributes' => array(
				  					   'id' => 'telefone',
									   'class' => 'form-control',
									   'placeholder' => 'Telefone',
									   'maxlength' => 10,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Telefone',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
	}
	
	public function getInputFilterSpecification()
	{
		return array();
	}
	
	/**
	 * Obtem a lista de Cidades
	 */
	public function loadCidadeOptions()
	{
		$cidadeTable = $this->serviceLocator->get('cidade-table');
		$cidades = $cidadeTable->select();
		
		foreach ($cidades as $cidade)
		{
			$this->cidadeOptions[$cidade['idCidade']] = $cidade['nomeCidade'];
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