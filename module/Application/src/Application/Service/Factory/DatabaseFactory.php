<?php
namespace Application\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\Adapter\Adapter as DbAdapter;

class DatabaseFactory implements FactoryInterface
{
	/**
	 * Método requerido pela FactoryInterface
	 * Cria e retorna um Adapter para conexão com banco de dados.
	 * 
	 * @param ServiceLocatorInterface $serviceLocator ServiceManager é automaticamente injetado pelo ZF2
	 * 
	 * @return DbAdapter
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$config = $serviceLocator->get('config');
		$adapter = new DbAdapter($config['db']);
		
		return $adapter;
	}
}