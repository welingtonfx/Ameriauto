<?php
namespace Anuncio\Form;

use Zend\Form\Form;
use Anuncio\Form\Filter\VeiculoCorFilter;
use Anuncio\Model\Entity\VeiculoCorEntity;
use Zend\StdLib\Hydrator\ObjectProperty;

class VeiculoCorForm extends Form
{		
	/**
	 * Configura propriedades do formulário e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('veiculo-cor-form');

		$this->setAttributes(array('class' => 'form-backend form-horizontal', 
								   'method' => 'post',
								   'character_set' => 'UTF-8',
								   ))
			 ->setInputFilter(new  VeiculoCorFilter());
			
		$this->setHydrator(new ObjectProperty)
			 ->setObject(new  VeiculoCorEntity);
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields)
	 */
	public function registerElements()
	{		
		// Campo Nome da Cor
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'nomeCor',
				  'attributes' => array(
				  					   'id' => 'nomeCor',
									   'placeholder' => 'nome da cor',
									   'class' => 'form-control',
									   'maxlength' => 20,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Cor',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
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