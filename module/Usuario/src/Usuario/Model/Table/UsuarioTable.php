<?php
namespace Usuario\Model\Table;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;

class UsuarioTable extends AbstractTableGateway
{
	public function __construct()
	{
		$this->table = 'usuario';
			$this->featureSet = new Feature\FeatureSet();
			$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
			$this->initialize();
	}
}