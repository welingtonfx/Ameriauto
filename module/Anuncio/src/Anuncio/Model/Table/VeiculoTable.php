<?php
namespace Anuncio\Model\Table;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;
use Zend\Db\Sql\Sql;

class VeiculoTable extends AbstractTableGateway implements ServiceLocatorAwareInterface
{
	protected $serviceLocator;

	public function __construct()
	{
		$this->table = 'veiculo';
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
	
	public function getVeiculosByIdFabricante($idTipo, $idFabricante)
	{	
		$sql = new Sql($this->serviceLocator->get('database'));
		$select = $sql->select()
					  ->columns(array('idVeiculo', 'nomeVeiculo'))
					  ->from(array('a' => $this->table))
					  ->join(array('b' => 'veiculoTipoFabricante'), 'a.idTipoFabricante = b.idTipoFabricante', array())
					  ->where(array('b.idFabricante = '. $idFabricante . ' AND b.idTipo = '. $idTipo));
					  
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