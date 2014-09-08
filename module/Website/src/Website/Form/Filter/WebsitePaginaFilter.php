<?php
namespace Website\Form\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class WebsitePaginaFilter extends InputFilter
{

	/**
	 * Configura os Filtros/Validações a serem executadas no formulário
	 */
	public function __construct()
	{	
		$factory = new InputFactory();

		// Adiciona o campo Cor Hexadecimal ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'tituloPagina',
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
												  		 'max' => 45,
												  		 'messages' => array(
												  		 					\Zend\Validator\StringLength::TOO_SHORT	=> 'O campo Título da Página deve ter no mínimo %min% caracteres.',
																  		    \Zend\Validator\StringLength::TOO_LONG 	=> 'O campo Título da Página deve ter no máximo %max% caracteres.',
												  			 			    ),
									  				     ),
									  ),
				 					  ),
				 )
		));
		
		// Adiciona o campo Conteúdo ao InputFilter			
		$this->add($factory->createInput(
			array(
				 'name' => 'conteudo',
				 'required' => false,
				 'filters' => array(
				 				   array('name' => 'StringTrim'),
				 				   array('name' => 'StripTags'),
				 				   ),
				 'validators' => array(
				 				 array(
				 				 	  'name' => 'StringLength',
				 				 	  'options' => array(
				 				 	  					'encoding' => 'UTF-8',
				 				 	  					'max' => 16700000,
				 				 	  					'messages' => array(
				 				 	  									   \Zend\Validator\StringLength::TOO_LONG => 'O campo Conteúdo não pode ter mais de 16,7 milhões de caracteres.',
				 				 	  									   )
				 				 	  					)
				 				 	  ),
				 					  ),
				 )
		));
	
	// Adiciona o campo Pagina Habilitada ao InputFilter
	$this->add($factory->createInput(
		array(
			 'name' => 'paginaHabilitada', 
			 'required' => false)
			 )
			 );
	
	 // Adiciona o campo de segurança CSRF ao InputFilter
	 /*$this->add($factory->createInput(
	 	array(
	 		 'name' => 'security',
	 		 'required' => true,
	 		 )
	 )); */
	}
}