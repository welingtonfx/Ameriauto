<?php
namespace Anuncio\Form;

use Zend\Form\Form;
use Anuncio\Form\Filter\EmailFilter;
use Anuncio\Model\Entity\EmailEntity;
use Zend\StdLib\Hydrator\ObjectProperty;

class BannerTipoForm extends Form
{		
	/**
	 * Configura propriedades do formulário e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('email-form');

		$this->setAttributes(array('class' => 'form-backend form-horizontal', 
								   'method' => 'post', 
								   'character_set' => 'UTF-8',
								   ))
			 ->setInputFilter(new EmailFilter());
			
		$this->setHydrator(new ObjectProperty)
			 ->setObject(new EmailEntity);
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields)
	 */
	public function registerElements()
	{		
		// Campo Nome do Remetente
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'nomeRemetente',
				  'attributes' => array(
				  					   'id' => 'nomeRemetente',
									   'placeholder' => 'seu nome',
									   // 'class' => 'form-control', @todo verificar se esta classe css será usada ou outras
									   'maxlength' => 50,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Nome',
				  					   // 'label_attributes' => array('class' => 'col-md-2 control-label'), @todo verificar se esta classe css será usada ou outras
				  					   ),
		));
		
		// Campo Email do Remetente
		$this->add(array(
				  'type' => 'Zend\Form\Element\Email',
				  'name' => 'emailRemetente',
				  'attributes' => array(
				  					   'id' => 'emailRemetente',
									   'placeholder' => 'seu e-mail',
									   // 'class' => 'form-control', @todo verificar se esta classe css será usada ou outras
									   'maxlength' => 80,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Nome',
				  					   // 'label_attributes' => array('class' => 'col-md-2 control-label'), @todo verificar se esta classe css será usada ou outras
				  					   ),
		));
		
		// Campo Mensagem
		$this->add(array(
				  'type' => 'Zend\Form\Element\Textarea',
				  'name' => 'mensagem',
				  'attributes' => array(
				  					   'id' => 'mensagem',
									   'placeholder' => 'sua mensagem',
									   // 'class' => 'form-control',
									   'maxlength' => 500,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Mensagem',
				  					   // 'label_attributes' => array('class' => 'col-md-2 control-label'),
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