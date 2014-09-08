<?php
namespace Usuario\Form\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class RegiaoFilter extends InputFilter
{

	/**
	 * Configura os Filtros/Validações a serem executadas no formulário
	 */
	public function __construct()
	{	
		$factory = new InputFactory();

		// Adiciona o campo Estado ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'idEstado',
				 'required' => true,
				 'filters' => array(
				 				   array('name' => 'StringTrim'),
				 				   array('name' => 'StripTags'),
				 				   ),
				 'validators' => array(
				 				 array(
				 					  'name' => 'NotEmpty',
				 					  'options' => array(
				 					  					'messages' => array(
				 					  										\Zend\Validator\NotEmpty::IS_EMPTY => 'É necessário selecionar um Estado.'
				 					  									   ),
				 					  					),
				 					  ),
				 					  ),
				 )
		));
		
		// Adiciona o campo Nome Região ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'nomeRegiao',
				 'required' => true,
				 'filters' => array(
				 				   array('name' => 'StringTrim'),
				 				   array('name' => 'StripTags'),
				 				   ),
				 'validators' => array(
				 				 array(
				 					  'name' => 'NotEmpty',
				 					  'break_chain_on_failure' => true,
				 					  'options' => array(
				 					  					'messages' => array(
				 					  										\Zend\Validator\NotEmpty::IS_EMPTY => 'O campo Região deve ser preenchido.'
				 					  									   ),
				 					  					),
				 					  ),
								 array('name' => 'StringLength',
									   'options' => array(
												  		 'encoding' => 'UTF-8',
														 'min' => 2,
												  		 'max' => 45,
												  		 'messages' => array(
												  		 					\Zend\Validator\StringLength::TOO_SHORT	=> 'O campo Região deve ter no mínimo %min% caracteres.',
																  		    \Zend\Validator\StringLength::TOO_LONG 	=> 'O campo Região deve ter no máximo %max% caracteres.',
												  			 			    ),
									  				     ),
									  ),
				 					  ),
				 )
		));
	
	 // Adiciona o campo de segurança CSRF ao InputFilter
	 /*$this->add($factory->createInput(
	 	array(
	 		 'name' => 'security',
	 		 'required' => true,
	 		 )
	 )); */
	}
}