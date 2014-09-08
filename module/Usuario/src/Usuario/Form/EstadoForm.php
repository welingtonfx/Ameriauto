<?php
namespace Usuario\Form;

use Zend\Form\Form;
use Usuario\Form\Filter\EstadoFilter;
use Usuario\Model\Entity\EstadoEntity;
use Zend\StdLib\Hydrator\ObjectProperty;

class EstadoForm extends Form
{		
	/**
	 * Configura propriedades do formulário e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('estado-form');

		$this->setAttributes(array('class' => 'form-backend form-horizontal', 
								   'method' => 'post', 
								   'character_set' => 'UTF-8',
								   ))
			 ->setInputFilter(new EstadoFilter());
			
		$this->setHydrator(new ObjectProperty)
			 ->setObject(new EstadoEntity);
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields)
	 */
	public function registerElements()
	{	
		// Campo Estado
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'nomeEstado',
				  'attributes' => array(
				  					   'id' => 'nomeEstado',
									   'placeholder' => 'nome do estado',
									   'class' => 'form-control',
									   'maxlength' => 20,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Estado',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Sigla
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'sigla',
				  'attributes' => array(
				  					   'id' => 'sigla',
									   'placeholder' => 'sigla',
									   'class' => 'form-control',
									   'maxlength' => 2,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Sigla',
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
}