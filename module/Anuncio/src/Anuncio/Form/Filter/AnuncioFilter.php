<?php
namespace Anuncio\Form\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Anuncio\Form\AnuncioOpcionais;

class AnuncioFilter extends InputFilter
{
	/**
	* @var array Guarda os nomes dos campos opcionais
	*/
	protected $opcionais = array();

	/**
	 * Configura os Filtros/Validações a serem executadas no formulário
	 */
	public function __construct()
	{	
		$factory = new InputFactory();
		
		// Obtem o array de equipamentos opcionais dos veículos
		$anuncioOpcionais = new AnuncioOpcionais();
		$this->opcionais = $anuncioOpcionais->getOpcionais();

		// Adiciona o campo Tipo de Veículo ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'idTipoVeiculo',
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
								 	   					 					\Zend\Validator\NotEmpty::IS_EMPTY => 'É necessário selecionar um Fabricante.',
								 	   					 					),
								 	   					 ),
								 	  ),
								 	  ),
				 )
		));
		

		// Adiciona o campo Veículo ao InputFilter	
		$this->add($factory->createInput(
			array(
				 'name' => 'idVeiculo',
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
				 			     	  									   \Zend\Validator\NotEmpty::IS_EMPTY => 'É necessário selecionar um Veículo.',
				 			     	  									   ),
				 			     	  					),
				 			     	  ),
				 					  ),
				 )
		));


		// Adiciona o campo Combustível ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'idCombustivel',
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
				 				 	  									   \Zend\Validator\NotEmpty::IS_EMPTY => 'É necessário selecionar um Combustível.',
				 				 	  									   ),
				 				 	  					),
				 				 	  ),	  
				 					  ),
				 )
		));
		
		// Adiciona o campo Cor ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'idCor',
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
				 				 	  									   \Zend\Validator\NotEmpty::IS_EMPTY => 'É necessário selecionar uma Cor.',
				 				 	  									   ),
				 				 	  					),
				 				 	  ),	  
				 					  ),
				 )
		));
		
		// Adiciona o campo Descrição Breve ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'descricaoBreve',
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
									  									   \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo Descrição Breve não pode estar vazio.',
									  									   ),
									  					),
									 ),
								array('name' => 'StringLength',
									  'options' => array(
												  		'encoding' => 'UTF-8',
												  		'max' => 45,
												  		'messages' => array(
																  		   \Zend\Validator\StringLength::TOO_LONG 	=> 'O campo Descrição Breve deve ter no máximo 45 caracteres.',
												  						   ),
									  				    ),
									 ),
									 ),
				 )
		));
		
		 // Adiciona o campo Ano ao InputFilter
		 $this->add($factory->createInput(
		 	array(
		 		 'name' => 'ano',
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
		 		 					  	   					 					\Zend\Validator\NotEmpty::IS_EMPTY => 'O campo ano deve ser preenchido com 4 dígitos. Ex: 2008.',
		 		 					  	   					 					),
		 		 					  	   					 ),
		 		 					  	   ),
		 		 					  array(
		 		 					  	   'name' => 'Between',
		 		 					  	   'break_chain_on_failure' => true,
		 		 					  	   'options' => array(
															 'min' => 1940, 
															 'max' => 2016,
															 'messages' => array(
															 					\Zend\Validator\Between::NOT_BETWEEN => 'O ano deve ser um número entre 1940 e 2016.',
															 					),
															 ),
		 		 					  	   ),
			 		 				  array(
			 		 					   'name' => 'Regex',
			 		 					   'options' => array(
			 		 					 					  'pattern' => '/^[0-9]{4}$/',
			 		 					 					  'messages' => array(
			 		 					 									     \Zend\Validator\Regex::NOT_MATCH => 'Use apenas números para escrever o ano.',
			 		 					 									     ),
			 		 					 				     ),
			 		 					   ),	  
		 		 					  ),
		 		 )
		 ));
		 
		// Adiciona o campo Placa ao InputFilter
		$this->add($factory->createInput(
			array(
				 'name' => 'placa',
				 'required' => true,
				 'filters' => array(
				 				   array('name' => 'StringTrim'),
				 				   array('name' => 'StripTags'),
				 				   array('name' => 'StringToUpper'),
				 				   ),
				 'validators' => array(
				 					 array(
				 					 	  'name' => 'NotEmpty',
				 					 	  'break_chain_on_failure' => true,
				 					 	  'options' => array(
				 					 	  					'messages' => array(
				 					 	  									   \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo Placa deve ser preenchido.'
				 					 	  									   ),
				 					 	  					),
				 					 	  ),
				 					 array(
				 					 	  'name' => 'Regex',
				 					 	  'break_chain_on_failure' => true,
				 					 	  'options' => array(
				 					 	  					'pattern' => '/^[A-Z]{3}\-[0-9]{4}$/',
				 					 	  					'messages' => array(
				 					 	  									   \Zend\Validator\Regex::NOT_MATCH => 'O campo placa deve ser preenchido com o formato ABC-1234',
				 					 	  									   ),
				 					 	  					),
				 					 	  ),
				 					 )
				 ), 'placa'
		));
		 
		// Adiciona o campo Quilometragem ao InputFilter	
		$this->add($factory->createInput(
			array(
				 'name' => 'quilometragem',
				 'required' => 'true',
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
				 					  	   					 					\Zend\Validator\NotEmpty::IS_EMPTY => 'O campo Quilometragem deve ser preenchido. Use apenas números.'
				 					  	   					 					),
				 					  	   					 ),
				 					  	   ),
				 					  array(
				 					  	   'name' => 'Regex',
				 					  	   'break_chain_on_failure' => true,
				 					  	   'options' => array(
				 					  	   					 'pattern' => '/^[0-9]{1,6}$/',
				 					  	   					 'messages' => array(
				 					  	   					 					\Zend\Validator\Regex::NOT_MATCH => 'Use apenas números para escrever a Quilometragem (máximo 6 dígitos).',
				 					  	   					 					)
				 					  	   					 ),
				 					  	   ),
				 					  array(
				 					  	   'name' => 'Between',
				 					  	   'options' => array(
				 					  	   					 'min' => 0,
				 					  	   					 'max' => 350000,
				 					  	   					 'messages' => array(
				 					  	   					 				    \Zend\Validator\Between::NOT_BETWEEN => 'O campo Quilometragem deve conter um número entre 0 e 350000.'
				 					  	   					 					)
				 					  	   					 )
				 					  	   ),
				 					  ),
				 )
		));
		
		// Adiciona o campo Valor (preço) ao InputFilter	
		$this->add($factory->createInput(
			array(
				 'name' => 'valor',
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
				 					  	   					 					\Zend\Validator\NotEmpty::IS_EMPTY => 'O campo Valor deve ser preenchido. Use apenas números.',
				 					  	   					 					),
				 					  	   					 ),
				 					  	   ),
				 					  array(
				 					  		'name' => 'Regex',
				 					  		'break_chain_on_failure' => true,
				 					  		'options' => array(
				 					  						  'pattern' => '/^[0-9]{1,7}$/',
				 					  						  'messages' => array(
				 					  						  					 \Zend\Validator\Regex::NOT_MATCH => 'Use apenas números para preencher o Valor (máximo 7 dígitos).',
				 					  						  					 ),
				 					  						  )
				 					  ),
				 					  array(
				 					  	   'name' => 'Between',
				 					  	   'options' => array(
				 					  	   					 'min' => 0,
				 					  	   					 'max' => 9999999,
				 					  	   					 'messages' => array(
				 					  	   					 					\Zend\Validator\Between::NOT_BETWEEN => 'O campo Valor deve conter um número de 0 a 9999999',
				 					  	   					 					)
				 					  	   					 )
				 					  	   ),
				 					  )
				 )
		));

		// Adiciona o campo Descrição Adicional ao InputFilter			
		$this->add($factory->createInput(
			array(
				 'name' => 'descricaoAdicional',
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
				 				 	  					'max' => 400,
				 				 	  					'messages' => array(
				 				 	  									   \Zend\Validator\StringLength::TOO_LONG => 'O campo Descrição Adicional não pode ter mais de 400 caracteres.',
				 				 	  									   )
				 				 	  					)
				 				 	  ),
				 					  ),
				 )
		));
		
		// Adiciona todos os campos opcionais (checkboxes) ao InputFilter
		foreach($this->opcionais as $opcionalNome => $descricao)
		{
			$this->add($factory->createInput(
				array(
					 'name' => $opcionalNome, 
					 'required' => false)
					 )
					 );
		}
		
		// Adiciona os campos de Fotos  ao Input Filter
		for($i = 1; $i <= 10; $i++)
		{
			$this->add($factory->createInput(
				array(
					 'type' => 'Zend\InputFilter\FileInput',
					 'name' => 'caminhoFoto'.$i,
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
		}

		// Adiciona os campos deleteFoto ao Input Filter
		for($i = 1; $i <= 10; $i++)
		{
			$this->add($factory->createInput(
				array(
					 'name' => 'deleteFoto'.$i,
					 'required' => false,
					 )
			));
		}
	
	 // Adiciona o campo de segurança CSRF ao InputFilter
	 /*$this->add($factory->createInput(
	 	array(
	 		 'name' => 'security',
	 		 'required' => true,
	 		 )
	 )); */
	}
}