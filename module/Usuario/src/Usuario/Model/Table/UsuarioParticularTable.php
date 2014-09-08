<?php
namespace Usuario\Model\Table;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;

class UsuarioParticularTable extends AbstractTableGateway
{
	public function __construct()
	{
		$this->table = 'usuarioParticular';
			$this->featureSet = new Feature\FeatureSet();
			$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
			$this->initialize();
	}
}