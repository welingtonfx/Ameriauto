<?php
namespace Anuncio\Model\Table;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;
use Zend\Db\Sql\Sql;

class VeiculoFabricanteTable extends AbstractTableGateway implements ServiceLocatorAwareInterface
{	
	protected $serviceLocator;
		
	public function __construct()
	{		
		$this->table = 'veiculoFabricante';
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
	
	public function getFabricantesByIdTipo($id)
	{	
		$sql = new Sql($this->serviceLocator->get('database'));
		$select = $sql->select()
					  ->columns(array('idFabricante', 'nomeFabricante'))
					  ->from(array('a' => $this->table))
					  ->join(array('b' => 'veiculoTipoFabricante'), 'a.idFabricante = b.idFabricante', array())
					  ->where(array('b.idTipo = '. $id));
					  
		$statement = $sql->prepareStatementForSqlObject($select);
		$result = $statement->execute();
			
		return $result;
	}
	
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
	{
		$this->serviceLocator = $serviceLocator;
	}
	
	public function getServiceLocator()
	{
		return $serviceLocator;
	}
}