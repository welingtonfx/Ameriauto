<?php
namespace Usuario\Form;

use Zend\Form\Fieldset;
use Zend\StdLib\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilterProviderInterface;
use Usuario\Model\Entity\UsuarioConcessionariaEntity;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UsuarioConcessionariaFieldset extends Fieldset implements InputFilterProviderInterface
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
		parent::__construct('usuario-concessionaria-fieldset');
			
		$this->setHydrator(new ClassMethods)
			 ->setObject(new UsuarioConcessinariaEntity);
			 
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
		
		// Campo Nome Concessionária
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'nomeConcessionaria',
				  'attributes' => array(
				  					   'id' => 'nomeConcessionaria',
									   'placeholder' => 'nome do estabelecimento',
									   'class' => 'form-control',
									   'maxlength' => 60,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Nome da Concessionária',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Nome Responsável
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'nomeResponsavel',
				  'attributes' => array(
				  					   'id' => 'nomeResponsavel',
									   'placeholder' => 'nome do responsável',
									   'class' => 'form-control',
									   'maxlength' => 60,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Nome do Responsável',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Endereço
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'endereco',
				  'attributes' => array(
				  					   'id' => 'endereco',
									   'placeholder' => 'endereço',
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
		
		// Campo CNPJ
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'cnpj',
				  'attributes' => array(
				  					   'id' => 'cnpj',
									   'placeholder' => 'cnpj',
									   'class' => 'form-control',
									   'maxlength' => 14,
				  					   ),
				  'options'    => array(
				  					   'label' => 'CNPJ',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo DDD Telefone 1
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'dddTelefone1',
				  'attributes' => array(
				  					   'id' => 'dddTelefone1',
									   'class' => 'form-control',
									   'placeholder' => 'DDD',
									   'maxlength' => 2,
				  					   ),
				  'options'    => array(
				  					   'label' => 'DDD Telefone 1',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Telefone 1
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'telefone1',
				  'attributes' => array(
				  					   'id' => 'telefone1',
									   'class' => 'form-control',
									   'placeholder' => 'Telefone',
									   'maxlength' => 10,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Telefone 1',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo DDD Telefone 2
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'dddTelefone2',
				  'attributes' => array(
				  					   'id' => 'dddTelefone2',
									   'class' => 'form-control',
									   'placeholder' => 'DDD',
									   'maxlength' => 2,
				  					   ),
				  'options'    => array(
				  					   'label' => 'DDD Telefone 2',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Telefone 2
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'telefone2',
				  'attributes' => array(
				  					   'id' => 'telefone2',
									   'class' => 'form-control',
									   'placeholder' => 'Telefone',
									   'maxlength' => 10,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Telefone 2',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Foto Fachada
		$this->add(array(
				  'type' => 'Zend\Form\Element\File',
				  'name' => 'fotoFachada',
				  'attributes' => array(
				  					   'id' => 'fotoFachada',
									   'class' => 'form-control',
				  					   ),
				  'options'    => array(
				  					   'label' => 'fotoFachada',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Foto Logotipo
		$this->add(array(
				  'type' => 'Zend\Form\Element\File',
				  'name' => 'fotoLogotipo',
				  'attributes' => array(
				  					   'id' => 'fotoLogotipo',
									   'class' => 'form-control',
				  					   ),
				  'options'    => array(
				  					   'label' => 'fotoLogotipo',
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