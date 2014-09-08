<?php
namespace Anuncio\Model\Table;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;

class BannerTable extends AbstractTableGateway
{
	public function __construct()
	{
		$this->table = 'banner';
			$this->featureSet = new Feature\FeatureSet();
			$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
			$this->initialize();
	}
	
	public function insert($set)
	{
		unset($set['submit']);
		$caminhoBanner = explode("\\", $set['caminhoBanner']['tmp_name']);
		$set['caminhoBanner'] = $caminhoBanner[count($caminhoBanner)-1];
		
		return parent::insert($set);
	}
}