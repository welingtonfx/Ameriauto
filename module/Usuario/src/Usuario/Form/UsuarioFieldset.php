<?php
namespace Usuario\Form;

use Zend\Form\Fieldset;
use Zend\StdLib\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilterProviderInterface;
use Usuario\Model\Entity\UsuarioEntity;
use Usuario\Form\Filter\UsuarioFilter;

class UsuarioFieldset extends Fieldset implements InputFilterProviderInterface
{		
	
	/**
	 * Configura propriedades do fieldst e o associa Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('usuario-fieldset');
			
		$this->setHydrator(new ClassMethods)
			 ->setObject(new UsuarioEntity);
			 
		$this->registerElements();
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields) e carrega os campos Select
	 */
	public function registerElements()
	{		
		// Campo Email
		$this->add(array(
				  'type' => 'Zend\Form\Element\EmailAddress',
				  'name' => 'email',
				  'attributes' => array(
				  					   'id' => 'email',
									   'placeholder' => 'seu e-mail',
									   'class' => 'form-control',
									   'maxlength' => 80,
				  					   ),
				  'options'    => array(
				  					   'label' => 'E-mail',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Senha
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'senha',
				  'attributes' => array(
				  					   'id' => 'senha',
									   'placeholder' => 'sua senha',
									   'class' => 'form-control',
									   'maxlength' => 15,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Senha',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Senha
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'senha_verificador',
				  'attributes' => array(
				  					   'id' => 'senha_verificador',
									   'placeholder' => 'digite sua senha novamente',
									   'class' => 'form-control',
									   'maxlength' => 15,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Repetir a senha',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
	}
	
	public function getInputFilterSpecification()
	{
		return array();
	}
}