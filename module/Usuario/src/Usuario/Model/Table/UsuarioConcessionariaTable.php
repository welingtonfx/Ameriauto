<?php
namespace Usuario\Model\Table;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\Sql\Sql;

class UsuarioConcessionariaTable extends AbstractTableGateway implements ServiceLocatorAwareInterface
{
	/**
	 * @var ServiceLocatorInterface
	 */
	protected $serviceLocator;
	
	public function __construct()
	{
		$this->table = 'usuarioConcessionaria';
			$this->featureSet = new Feature\FeatureSet();
			$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
			$this->initialize();
	}
	
	public function getCidadeConcessionariaList()
	{
		$sql = new Sql($this->serviceLocator->get('database'));
		$select = $sql->select()
					  ->columns(array('nomeConcessionaria', 'idUsuarioConcessionaria'))
					  ->from(array('a' => $this->table))
					  ->join(array('b' => 'cidade'), 'a.idCidade = b.idCidade', 'nomeCidade')
					  ->order('b.nomeCidade ASC');
					  
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
		return $this->serviceLocator;
	}
}