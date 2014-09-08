<?php
namespace Usuario\Model\Table;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;

class CidadeTable extends AbstractTableGateway
{
	public function __construct()
	{
		$this->table = 'cidade';
			$this->featureSet = new Feature\FeatureSet();
			$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
			$this->initialize();
	}
	
	public function insert($set)
	{
		unset($set['submit']);
		
		return parent::insert($set);
	}
}