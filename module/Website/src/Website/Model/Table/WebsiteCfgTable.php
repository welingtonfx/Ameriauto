<?php
namespace Website\Model\Table;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;

class WebsiteCfgTable extends AbstractTableGateway
{
	public function __construct()
	{
		$this->table = 'websiteCfg';
			$this->featureSet = new Feature\FeatureSet();
			$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
			$this->initialize();
	}
}