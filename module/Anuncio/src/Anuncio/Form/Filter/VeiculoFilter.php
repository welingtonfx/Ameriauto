<?php
namespace Anuncio\Form\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class VeiculoFilter extends InputFilter
{

	/**
	 * Configura os Filtros/Validações a serem executadas no formulário
	 */
	public function __construct()
	{	
		$factory = new InputFactory();

		// Adiciona o campo Tipo-Fabricante ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'idTipoFabricante',
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
				 					  										\Zend\Validator\NotEmpty::IS_EMPTY => 'É necessário selecionar um Tipo de Veículo e Fabricante.'
				 					  									   ),
				 					  					),
				 					  ),
				 					  ),
				 )
		));

		// Adiciona o campo Nome do Veículo ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'nomeVeiculo',
				 'required' => true,
				 'filters' => array(
				 				   array('name' => 'StringTrim'),
				 				   array('name' => 'StripTags'),
				 				   ),
				 'validators' => array(
								 array('name' => 'StringLength',
									   'options' => array(
												  		 'encoding' => 'UTF-8',
												  		 'min' => 2,
												  		 'max' => 30,
												  		 'messages' => array(
												  		 					\Zend\Validator\StringLength::TOO_SHORT	=> 'O campo Nome do Veículo deve ter no mínimo %min% caracteres.',
																  		    \Zend\Validator\StringLength::TOO_LONG 	=> 'O campo Nome do Veículo deve ter no máximo %max% caracteres.',
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