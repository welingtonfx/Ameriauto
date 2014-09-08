<?php
namespace Usuario\Form;

use Zend\Form\Form;
use Usuario\Form\Filter\UsuarioFilter;

class UsuarioConcessionariaForm extends Form
{		
	/**
	 * Configura propriedades do formulário e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('usuario-concessionaria-form');

		$this->setAttributes(array('class' => 'form-backend form-horizontal', 
								   'method' => 'post', 
								   'character_set' => 'UTF-8',
								   ))
			 ->setInputFilter(new UsuarioFilter()); // @todo fazer filter
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields) e carrega os campos Select
	 */
	public function registerElements()
	{			
		
		// Adiciona o Fieldset Usuario Concessionaria
		$this->add(array(
				  'type' => 'Usuario\Form\UsuarioConcessionariaFieldset',
				  'name' => 'usuario-concessionaria',
				  'options'    => array(
				  					   'use_as_base_fieldset' => true,
				  					   ),
		));
		
		// Adiciona o Captcha
		$this->add(array(
				'type' => 'Zend\Form\Element\Captcha',
				'name' => 'captcha',
				'attributes' => array(),
				'options' => array(
					'label' => 'Digite o que está escrito na imagem',
					'captcha' => array(
						'class' => 'Image',
						'imgDir' => 'public/img/captcha',
						'suffix' => '.png',
						'imgUrl' => '/img/captcha/',
						'imgAlt' => 'Captcha',
						'font' => './data/font/thorne_shaded.ttf',
						'fsize' => 24,
						'width' => 350,
						'height' => 100,
						'expiration' => 600,
						'dotNoiseLevel' => 40,
						'lineNoiseLevel' => 3,
					),
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