<?php
namespace Anuncio\Model\Table;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;

class BannerTipoTable extends AbstractTableGateway
{
	public function __construct()
	{
		$this->table = 'bannerTipo';
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