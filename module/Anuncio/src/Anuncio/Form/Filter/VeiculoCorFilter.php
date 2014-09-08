<?php
namespace Anuncio\Form\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class VeiculoCorFilter extends InputFilter
{

	/**
	 * Configura os Filtros/Validações a serem executadas no formulário
	 */
	public function __construct()
	{	
		$factory = new InputFactory();

		// Adiciona o campo Cor ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'nomeCor',
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
												  		 'max' => 20,
												  		 'messages' => array(
												  		 					\Zend\Validator\StringLength::TOO_SHORT	=> 'O campo Cor deve ter no mínimo %min% caracteres.',
																  		    \Zend\Validator\StringLength::TOO_LONG 	=> 'O campo Cor deve ter no máximo %max% caracteres.',
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