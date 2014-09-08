<?php
namespace Anuncio\Form;

use Zend\Form\Form;
use Anuncio\Form\Filter\VeiculoCombustivelFilter;
use Anuncio\Model\Entity\VeiculoCombustivelEntity;
use Zend\StdLib\Hydrator\ObjectProperty;

class VeiculoCombustivelForm extends Form
{		
	/**
	 * Configura propriedades do formulário e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('veiculo-combustivel-form');

		$this->setAttributes(array('class' => 'form-backend form-horizontal', 
								   'method' => 'post',
								   'character_set' => 'UTF-8',
								   ))
			 ->setInputFilter(new  VeiculoCombustivelFilter());
			
		$this->setHydrator(new ObjectProperty)
			 ->setObject(new  VeiculoCombustivelEntity);
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields)
	 */
	public function registerElements()
	{		
		// Campo Nome do Combustível
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'nomeCombustivel',
				  'attributes' => array(
				  					   'id' => 'nomeCombustivel',
									   'placeholder' => 'nome do combustível',
									   'class' => 'form-control',
									   'maxlength' => 20,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Combustível',
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