<?php
namespace Website\Form;

use Zend\Form\Form;
use Website\Form\Filter\WebsiteCfgFilter;
use Website\Model\Entity\WebsiteCfgEntity;
use Zend\StdLib\Hydrator\ObjectProperty;

class WebsiteCfgForm extends Form
{		
	/**
	 * Configura propriedades do formulário e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('website-cfg-form');

		$this->setAttributes(array('class' => 'form-backend form-horizontal', 
								   'method' => 'post', 
								   'enctype' => 'multipart/form-data',
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
		// Campo Foto Topo Site
		$this->add(array(
				  'type' => 'Zend\Form\Element\File',
				  'name' => 'fotoTopoSite',
				  'attributes' => array(
				  					   'id' => 'fotoTopoSite',
									   'class' => 'form-control',
				  					   ),
				  'options'    => array(
				  					   'label' => 'Logotipo (tamanho grande)',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Campo Hexadecimal
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'corHexadecimal',
				  'attributes' => array(
				  					   'id' => 'corHexadecimal',
									   'placeholder' => 'cor hexadecimal',
									   'class' => 'form-control',
									   'maxlength' => 6,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Cor Hexadecimal',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   ),
		));
		
		// Website Habilitado?
		$this->add(array(
				  'type' => 'Zend\Form\Element\Checkbox',
				  'name' => 'websiteHabilitado',
				  'options'    => array(
				  					   'label' => 'Ativar Website?',
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