<?php
namespace Anuncio\Form;

use Zend\Form\Form;
use Anuncio\Form\Filter\VeiculoTipoFilter;
use Anuncio\Model\Entity\VeiculoTipoEntity;
use Zend\StdLib\Hydrator\ObjectProperty;

class VeiculoTipoForm extends Form
{		
	/**
	 * Configura propriedades do formulário e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('veiculo-tipo-form');

		$this->setAttributes(array('class' => 'form-backend form-horizontal', 
								   'method' => 'post',
								   'character_set' => 'UTF-8',
								   ))
			 ->setInputFilter(new  VeiculoTipoFilter());
			
		$this->setHydrator(new ObjectProperty)
			 ->setObject(new  VeiculoTipoEntity);
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields)
	 */
	public function registerElements()
	{		
		// Campo Nome de Fabricante
		$this->add(array(
				  'type' => 'Zend\Form\Element\Text',
				  'name' => 'nomeTipo',
				  'attributes' => array(
				  					   'id' => 'nomeTipo',
									   'placeholder' => 'nome do tipo de veículo',
									   'class' => 'form-control',
									   'maxlength' => 30,
				  					   ),
				  'options'    => array(
				  					   'label' => 'Tipo de Veículo',
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