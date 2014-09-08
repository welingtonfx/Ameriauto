<?php
namespace Usuario\Form\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class EstadoFilter extends InputFilter
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
				 'name' => 'nomeEstado',
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
				 					  										\Zend\Validator\NotEmpty::IS_EMPTY => 'O campo Estado deve ser preenchido.'
				 					  									   ),
				 					  					),
				 					  ),
				 				 array('name' => 'StringLength',
									   'options' => array(
												  		 'encoding' => 'UTF-8',
														 'min' => 4,
												  		 'max' => 20,
												  		 'messages' => array(
												  		 					\Zend\Validator\StringLength::TOO_SHORT	=> 'O campo Estado deve ter no mínimo %min% caracteres.',
																  		    \Zend\Validator\StringLength::TOO_LONG 	=> 'O campo Estado deve ter no máximo %max% caracteres.',
												  			 			    ),
									  				     ),
									  ),
				 					  ),
				 )
		));
		
		// Adiciona o campo Sigla ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'sigla',
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
				 					  										\Zend\Validator\NotEmpty::IS_EMPTY => 'O campo Sigla deve ser preenchido.'
				 					  									   ),
				 					  					),
				 					  ),
								 array('name' => 'StringLength',
									   'options' => array(
												  		 'encoding' => 'UTF-8',
														 'min' => 2,
												  		 'max' => 2,
												  		 'messages' => array(
												  		 					\Zend\Validator\StringLength::TOO_SHORT	=> 'O campo Estado deve ter exatos %min% caracteres.',
																  		    \Zend\Validator\StringLength::TOO_LONG 	=> 'O campo Estado deve ter exatos %max% caracteres.',
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