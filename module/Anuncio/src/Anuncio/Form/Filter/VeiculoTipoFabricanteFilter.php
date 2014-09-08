<?php
namespace Anuncio\Form\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class VeiculoTipoFabricanteFilter extends InputFilter
{

	/**
	 * Configura os Filtros/Validações a serem executadas no formulário
	 */
	public function __construct()
	{	
		$factory = new InputFactory();

		// Adiciona o campo Tipo de Veículo ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'idTipo',
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
				 					  										\Zend\Validator\NotEmpty::IS_EMPTY => 'É necessário selecionar um Tipo de Veículo.'
				 					  									   ),
				 					  					),
				 					  ),
				 					  ),
				 )
		));
		
		// Adiciona o campo Fabricante ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'idFabricante',
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
				 					  										\Zend\Validator\NotEmpty::IS_EMPTY => 'É necessário selecionar um Fabricante.'
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