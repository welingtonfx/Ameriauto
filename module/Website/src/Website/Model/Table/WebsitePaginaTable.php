<?php
namespace Website\Model\Table;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;

class WebsitePaginaTable extends AbstractTableGateway
{
	public function __construct()
	{
		$this->table = 'websitePagina';
			$this->featureSet = new Feature\FeatureSet();
			$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
			$this->initialize();
	}
}