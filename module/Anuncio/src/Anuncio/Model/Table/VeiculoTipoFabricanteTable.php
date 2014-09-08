<?php
namespace Anuncio\Model\Table;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;
use Zend\Db\Sql\Sql;

class VeiculoTipoFabricanteTable extends AbstractTableGateway implements ServiceLocatorAwareInterface
{
	/**
	 * @var ServiceLocatorInterface
	 */
	protected $serviceLocator;
	
	public function __construct()
	{
		$this->table = 'veiculoTipoFabricante';
			$this->featureSet = new Feature\FeatureSet();
			$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
			$this->initialize();
	}
	
	public function insert($set)
	{
		unset($set['submit']);
		
		return parent::insert($set);
	}
	
	public function update($set, $where = null)
	{
		unset($set['submit']);
		
		return parent::update($set, $where);
	}

	/**
	 * Obtem a lista de Tipos de Veículos e Fabricantes
	 */	
	public function getTipoFabricanteList()
	{
		$sql = new Sql($this->serviceLocator->get('database'));
		$select = $sql->select()
					  ->columns(array('idTipoFabricante'))
					  ->from(array('a' => $this->table))
					  ->join(array('b' => 'veiculoTipo'), 'a.idTipo = b.idTipo', 'nomeTipo')
					  ->join(array('c' => 'veiculoFabricante'), 'a.idFabricante = c.idFabricante', 'nomeFabricante')
					  ->order('b.nomeTipo ASC')
					  ->order('c.nomeFabricante ASC');
					  
		$statement = $sql->prepareStatementForSqlObject($select);
		$result = $statement->execute();
		
		return $result;
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
		return $serviceLocator;
	}
}