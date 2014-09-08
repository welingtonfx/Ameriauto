<?php
namespace Website\Form\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class WebsiteCfgFilter extends InputFilter
{

	/**
	 * Configura os Filtros/Validações a serem executadas no formulário
	 */
	public function __construct()
	{	
		$factory = new InputFactory();

		// Adiciona o campo Foto Topo ao InputFilter
		$this->add($factory->createInput(
			array(
				 'type' => 'Zend\InputFilter\FileInput',
				 'name' => 'fotoTopoSite',
				 'required' => false,
				 'validators' => array(
			 					 array(
									  'name' => 'FileUploadFile',
									  'break_chain_on_failure' => true,
									  'options' => array(
									 				    'messages' => array(
																           \Zend\Validator\File\UploadFile::INI_SIZE       => 'O tamanho do arquivo excede o definido no arquivo ini.',
																           \Zend\Validator\File\UploadFile::FORM_SIZE      => 'O tamanho do arquivo excede o definido no formulário.',
																           \Zend\Validator\File\UploadFile::PARTIAL        => 'O arquivo não foi completamente enviado. Envie novamente.',
																           \Zend\Validator\File\UploadFile::NO_FILE        => 'O arquivo não foi enviado.',
																           \Zend\Validator\File\UploadFile::NO_TMP_DIR     => 'Não foi encontrado um diretório temporário.',
																           \Zend\Validator\File\UploadFile::CANT_WRITE     => 'O arquivo não pôde ser escrito no servidor.',
																           \Zend\Validator\File\UploadFile::EXTENSION      => 'Uma extensão do PHP retornou um erro ao enviar o arquivo.',
																           \Zend\Validator\File\UploadFile::ATTACK         => 'O arquivo foi enviado de forma ilegal. Possível tentativa de ataque.',
																           \Zend\Validator\File\UploadFile::FILE_NOT_FOUND => 'Arquivo não encontrado.',
																           \Zend\Validator\File\UploadFile::UNKNOWN        => 'Erro desconhecido ao enviar o arquivo.',
									 				   					   ),
									 				    ),										  
									  ),
								 array(
								 	  'name' => 'FileSize',
								 	  'break_chain_on_failure' => true,
								 	  'options' => array(
								 	  					'max' => '8MB',
								 	  					'messages' => array(
								 	  									   \Zend\Validator\File\Size::TOO_BIG   => 'O tamanho máximo do arquivo deve ser %max%. O arquivo enviado possui %size%.',
								 	  									   \Zend\Validator\File\Size::NOT_FOUND => 'O arquivo não é legível ou não existe.',
								 	  									   ),
								 	  					),
								 	  ),
			 					 array(
									  'name' => 'FileIsImage',
									  'break_chain_on_failure' => true,
									  'options' => array(
									 				    'messages' => array(
									 				   					   \Zend\Validator\File\IsImage::FALSE_TYPE   => 'O arquivo enviado foi detectado como sendo %type%. Envie uma imagem no formato JPEG, PNG ou GIF.',
									 				   					   \Zend\Validator\File\IsImage::NOT_DETECTED => 'O sistema não conseguiu detectar o tipo de arquivo enviado. Envie uma imagem no formato JPEG, PNG ou GIF.',
									 				   					   \Zend\Validator\File\IsImage::NOT_READABLE => 'O sistema não conseguiu ler o arquivo. Envie uma imagem no formato JPEG, PNG ou GIF.'
									 				   					   ),
									 				    ),										  
									  ),
			 					 array(
									  'name' => 'FileExcludeMimeType',
									  'break_chain_on_failure' => true,
									  'type' => array('image/jpeg','image/png','image/gif'),
									  'options' => array(
									 				    'messages' => array(
									 				   					   \Zend\Validator\File\MimeType::FALSE_TYPE => 'O arquivo enviado foi detecado como sendo %type%. Envie uma imagem no formato JPEG, PNG ou GIF.',
									 				   					   ),
									 				    ),
								 	  ),
		 				  		 array(
		 				   		 'name' => 'FileImageSize',
								 'break_chain_on_failure' => true,
		 				   		 'options' => array(
		 				   						   'maxWidth' => 6000,
		 				   						   'maxHeight' => 6000,
		 				   						   'messages' => array(
									 				   				  \Zend\Validator\File\ImageSize::WIDTH_TOO_BIG  => 'A largura máxima permitida para esta imagem é de %maxwidth%px mas a imagem enviada possui %width%px.',
									 				   				  \Zend\Validator\File\ImageSize::HEIGHT_TOO_BIG => 'A altura máxima permitida para esta imagem é de %maxheight%px mas a imagem enviada possui %height%px.',
									 				   				  \Zend\Validator\File\ImageSize::NOT_DETECTED   => 'O tamanho da imagem não pôde ser detectado.',
									 				   				  ),
		 				   						   ),
		 				       		  ),
				 					  ),
				 'filters' => array(
							  array(
							  	   'name' => 'FileRenameUpload',
							  	   'options' => array(
							  	   					 'target' => './data/upload/',
							  	   					 'use_upload_name' => false,
							  	   					 'use_upload_extension' => true,
							  	   					 'overwrite' => false,
							  	   					 'randomize' => true,
							  	   					 ),
							  	   ),
				 				   ),
				 )
		));

		// Adiciona o campo Cor Hexadecimal ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'corHexadecimal',
				 'required' => true,
				 'filters' => array(
				 				   array('name' => 'StringTrim'),
				 				   array('name' => 'StripTags'),
				 				   ),
				 'validators' => array(
								 array('name' => 'StringLength',
									   'options' => array(
												  		 'encoding' => 'UTF-8',
												  		 'min' => 6,
												  		 'max' => 6,
												  		 'messages' => array(
												  		 					\Zend\Validator\StringLength::TOO_SHORT	=> 'O campo Cor Hexadecimal deve ter exatos %min% caracteres.',
																  		    \Zend\Validator\StringLength::TOO_LONG 	=> 'O campo Cor Hexadecimal deve ter exatos %max% caracteres.',
												  			 			    ),
									  				     ),
									  ),
				 					  ),
				 )
		));
	
		// Adiciona o campo Website Habilitado ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'websiteHabilitado', 
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