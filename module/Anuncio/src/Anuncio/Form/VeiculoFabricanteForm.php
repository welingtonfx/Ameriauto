<?php
namespace Anuncio\Form;

use Zend\Form\Form;
use Anuncio\Form\Filter\VeiculoFabricanteFilter;
use Anuncio\Model\Entity\VeiculoFabricanteEntity;
use Zend\StdLib\Hydrator\ObjectProperty;

class VeiculoFabricanteForm extends Form
{		
	/**
	 * Configura propriedades do formulário e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('veiculo-fabricante-form');

		$this->setAttributes(array('class' => 'form-backend form-horizontal', 
								   'method' => 'post',
								   'character_set' => 'UTF-8',
								   ))
			 ->setInputFilter(new  VeiculoFabricanteFilter());
			
		$this->setHydrator(new ObjectProperty)
			 ->setObject(new  VeiculoFabricanteEntity);
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields)
	 */
	public function registerElements()
	{		
		// Campo Nome de Fabricante
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'nomeFabricante',
				  'attributes' => array(
				  					   'id' => 'nomeFabricante',
									   'placeholder' => 'nome do fabricante',
									   'class' => 'form-control',
									   'maxlength' => 35,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Fabricante',
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