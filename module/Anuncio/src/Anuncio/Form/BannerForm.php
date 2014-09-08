<?php
namespace Anuncio\Form;

use Zend\Form\Form;
use Anuncio\Form\Filter\BannerFilter;
use Anuncio\Model\Entity\BannerEntity;
use Zend\StdLib\Hydrator\ObjectProperty;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BannerForm extends Form implements ServiceLocatorAwareInterface
{		
	/**
	 * Recebe o Service Locator
	 */
	protected $serviceLocator;
	
	/**
	 * @var array Guarda os Tipos de Banner (usados como options em um select field do formulário)
	 */
	protected $bannerTipoOptions = array();
	
	/**
	 * @var array Guarda as Concessionárias (usados como options em um select field do formulário)
	 */
	protected $concessionariaOptions = array();
	
	/**
	 * Configura propriedades do formulário e o associa ao Hydrator e à Entidade
	 */
	public function __construct()
	{
		parent::__construct('banner-form');

		$this->setAttributes(array('class' => 'form-backend form-horizontal', 
								   'method' => 'post', 
								   'enctype' => 'multipart/form-data',
								   'character_set' => 'UTF-8',
								   ))
			 ->setInputFilter(new BannerFilter());
			
		$this->setHydrator(new ObjectProperty)
			 ->setObject(new BannerEntity);
	}	
	
	/**
	 * Registra e configura os elementos do formulário (form fields) e carrega os campos Select
	 */
	public function registerElements()
	{
		$this->loadBannerTipoOptions();
		$this->loadConcessionariaOptions();
				
		// Campo Tipo de Banner
		$this->add(array(
				  'type' => 'Zend\Form\Element\Select',
				  'name' => 'idBannerTipo',
				  'attributes' => array(
				  					   'id' => 'idBannerTipo',
				  					   'class' => 'form-control',
				  					   ),
				  'options'	   => array(
				  					   //'disable_inarray_validator' => true,
				  					   'empty_option' => 'Selecione o Tipo de Banner',
				  					   'label' => 'Tipo de Banner',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   'value_options' => $this->bannerTipoOptions,
				  					   )
		));

		// Campo Usuario Concessionaria
		$this->add(array(
				  'type' => 'Zend\Form\Element\Select',
				  'name' => 'idUsuarioConcessionaria',
				  'attributes' => array(
				  					   'id' => 'idUsuarioConcessionaria',
				  					   'class' => 'form-control',
				  					   ),
				  'options'	   => array(
				  					   //'disable_inarray_validator' => true,
				  					   'empty_option' => 'Selecione a Concessionária',
				  					   'label' => 'Concessionária',
				  					   'label_attributes' => array('class' => 'col-md-2 control-label'),
				  					   'value_options' => $this->concessionariaOptions,
				  					   )
		));
		
		// Campo Banner
		$this->add(array(
				  'type' => 'Zend\Form\Element\File',
				  'name' => 'caminhoBanner',
				  'attributes' => array(
				  					   'id' => 'caminhoBanner',
									   'class' => 'form-control',
				  					   ),
				  'options'    => array(
				  					   'label' => 'Banner',
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
	
	/**
	 * Obtem a lista de Tipos de Banner
	 */
	public function loadBannerTipoOptions()
	{
		$bannerTipo = $this->serviceLocator->get('banner-tipo-table');
		$tipos = $bannerTipo->select();
		
		foreach ($tipos as $tipo)
		{
			$this->bannerTipoOptions[$tipo['idBannerTipo']] = $tipo['nomeTipo'];
		}
	}
	
	/**
	 * Obtem a lista de Concessionárias
	 */
	public function loadConcessionariaOptions()
	{
		$usuarioConcessionariaTable = $this->serviceLocator->get('usuario-concessionaria-table');
		$concessionarias = $usuarioConcessionariaTable->getCidadeConcessionariaList();
		
		foreach ($concessionarias as $concessionaria)
		{
			$this->concessionariaOptions[$concessionaria['idUsuarioConcessionaria']] = $concessionaria['nomeCidade'] . ' - ' . $concessionaria['nomeConcessionaria'];
		}
	}
	
    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     */
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
	{
		$this->serviceLocator = $serviceLocator;
	}
	
    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
	public function getServiceLocator()
	{
		return $this->serviceLocator;
	}
}