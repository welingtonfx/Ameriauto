<?php
namespace Anuncio\Form\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class EmailFilter extends InputFilter
{
	/**
	 * Configura os Filtros/Validações a serem executadas no formulário
	 */
	public function __construct()
	{	
		$factory = new InputFactory();

		// Adiciona o campo Nome do Remetente ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'nomeRemetente',
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
												  		 'max' => 50,
												  		 'messages' => array(
												  		 					\Zend\Validator\StringLength::TOO_SHORT	=> 'O seu nome deve ter no mínimo %min% caracteres.',
																  		    \Zend\Validator\StringLength::TOO_LONG 	=> 'O seu nome deve ter no máximo %max% caracteres.',
												  			 			    ),
									  				     ),
									  ),
				 					  ),
				 )
		));
		
		// Adiciona o campo Email do Remetente ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'emailRemetente',
				 'required' => true,
				 'filters' => array(
				 				   array('name' => 'StringTrim'),
				 				   array('name' => 'StripTags'),
				 				   ),
				 'validators' => array(
								 array('name' => 'EmailAddress',
									   'options' => array(
												  		 'messages' => array(
												  		 					\Zend\Validator\EmailAddress::INVALID			=> 'O e-mail inserido é inválido. Use o formato nome@email.com.br',
																  		    \Zend\Validator\EmailAddress::INVALID_FORMAT 	=> 'O e-mail inserido não é um endereço válido. Use o formato nome@email.com.br',
																  		    \Zend\Validator\EmailAddress::INVALID_HOSTNAME 	=> '%hostname% não é um hostname válido para este endereço.',
																  		    \Zend\Validator\EmailAddress::LENGTH_EXCEEDED   => 'O e-mail inserido excede o tamanho máximo de caracteres permitidos.',
												  			 			    ),
									  				     ),
									  ),
				 					  ),
				 )
		));
	
		// Adiciona o campo Mensagem ao InputFilter			
		$this->add($factory->createInput(
			array(
				 'name' => 'mensagem',
				 'required' => true,
				 'filters' => array(
				 				   array('name' => 'StringTrim'),
				 				   array('name' => 'StripTags'),
				 				   ),
				 'validators' => array(
				 				 array(
				 				 	  'name' => 'StringLength',
				 				 	  'options' => array(
				 				 	  					'encoding' => 'UTF-8',
				 				 	  					'max' => 500,
				 				 	  					'messages' => array(
				 				 	  									   \Zend\Validator\StringLength::TOO_LONG => 'O campo Mensagem não pode ter mais de %max% caracteres.',
				 				 	  									   )
				 				 	  					)
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