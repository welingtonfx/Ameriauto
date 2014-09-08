<?php
namespace Website\Form;

use Zend\Form\Form;
use Website\Form\Filter\WebsitePaginaFilter;
use Website\Model\Entity\WebsitePaginaEntity;
use Zend\StdLib\Hydrator\ObjectProperty;

class WebsitePaginaForm extends Form
{		
	/**
	 * Configura propriedades do formulário e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('website-cfg-form');

		$this->setAttributes(array('class' => 'form-backend form-horizontal', 
								   'method' => 'post', 
								   'character_set' => 'UTF-8',
								   ))
			 ->setInputFilter(new WebsiteCfgFilter());
			
		$this->setHydrator(new ObjectProperty)
			 ->setObject(new WebsiteCfgEntity);
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields) e carrega os campos Select
	 */
	public function registerElements()
	{					
		// Campo Título da Página
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'tituloPagina',
				  'attributes' => array(
				  					   'id' => 'tituloPagina',
									   'placeholder' => 'exemplos: Nossa Missão / Sobre a Empresa / História da Concessionária / Onde nos encontrar',
									   'class' => 'form-control',
									   'maxlength' => 50,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Título da Página',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Conteúdo da Página
		$this->add(array(
				  'type' => 'Zend\Form\Element\Textarea',
				  'name' => 'conteudo',
				  'attributes' => array(
				  					   'id' => 'conteudo',
									   'placeholder' => '',
									   'class' => 'form-control',
									   'maxlength' => 16700000,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Conteúdo da Página',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Página Habilitada?
		$this->add(array(
				  'type' => 'Zend\Form\Element\Checkbox',
				  'name' => 'paginaHabilitada',
				  'options'    => array(
				  					   'label' => 'Ativar Página?',
				  					   'checked_value' => true,
				  					   'unchecked_value' => false,
				  					   'use_hidden_element' => false,
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