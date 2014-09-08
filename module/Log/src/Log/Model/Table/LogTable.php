<?php
namespace Log\Model\Table;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;

class LogTable extends AbstractTableGateway
{
	public function __construct()
	{
		$this->table = 'log';
			$this->featureSet = new Feature\FeatureSet();
			$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
			$this->initialize();
	}
}