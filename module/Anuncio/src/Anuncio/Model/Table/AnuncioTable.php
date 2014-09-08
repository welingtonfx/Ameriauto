<?php
namespace Anuncio\Model\Table;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;
use Zend\Db\Sql\Sql;

class AnuncioTable extends AbstractTableGateway implements ServiceLocatorAwareInterface
{
	/**
	 * @var ServiceLocatorInterface
	 */
	protected $serviceLocator;
	
	/**
	 * Define e tabela e o adapter do banco de dados
	 */
	public function __construct()
	{
		$this->table = 'anuncio';
			$this->featureSet = new Feature\FeatureSet();
			$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
			$this->initialize();
	}
	
	/**
	 * Substituí o método insert para remover os campos desnecessários na inserção
	 */
	public function insert($set)
	{
		unset($set['submit']);
		unset($set['csrf']);
		unset($set['deleteFoto1']);
		unset($set['deleteFoto2']);
		unset($set['deleteFoto3']);
		unset($set['deleteFoto4']);
		unset($set['deleteFoto5']);
		unset($set['deleteFoto6']);
		unset($set['deleteFoto7']);
		unset($set['deleteFoto8']);
		unset($set['deleteFoto9']);
		unset($set['deleteFoto10']);
		
		$set['idUsuario'] = 1; // @todo remover linha após ACL implementada.
		
		return parent::insert($set);
	}
	
	/**
	 * Remove os campos desnecessários e atualiza um registro no banco de dados
	 * 
	 * @todo Usar update() em vez de updateWith()
	 */
	public function updateAnuncioWith($set, $where = null)
	{
		unset($set['submit']);
		unset($set['csrf']);
		unset($set['deleteFoto1']);
		unset($set['deleteFoto2']);
		unset($set['deleteFoto3']);
		unset($set['deleteFoto4']);
		unset($set['deleteFoto5']);
		unset($set['deleteFoto6']);
		unset($set['deleteFoto7']);
		unset($set['deleteFoto8']);
		unset($set['deleteFoto9']);
		unset($set['deleteFoto10']);
		
		$set['idUsuario'] = 1; // @todo remover linha após ACL implementada.		
		
		$sql = new Sql($this->serviceLocator->get('database'));
		$update = $sql->update()
					  ->table($this->table)
					  ->set($set)
					  ->where($where);
		
		return parent::updateWith($update);
	}
	
	/**
	 * Obtem a lista de anúncios de um determinado usuário
	 * 
	 * @var int $idUsuario
	 */
	public function getAnunciosListByIdUsuario($idUsuario)
	{
		$sql = new Sql($this->serviceLocator->get('database'));
		$select = $sql->select()
					  ->columns(array('idAnuncio', 'descricaoBreve', 'placa', 'ano', 'valor', 'caminhoFoto1'))
					  ->from(array('a' => $this->table))
					  ->join(array('b' => 'veiculoFabricante'), 'a.idFabricante = b.idFabricante', array('nomeFabricante'))
					  ->join(array('c' => 'veiculo'), 'a.idVeiculo = c.idVeiculo', array('nomeVeiculo'))
					  ->where(array('a.idUsuario = '. $idUsuario))
					  ->order('a.dataModificacao DESC');
			
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