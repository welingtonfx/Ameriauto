<?php
namespace Application\Service\Initializer;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Model\UploadDirectoryStructureAwareInterface;

class UploadDirectoryStructure implements InitializerInterface
{
    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\InitializerInterface::initialize()
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
    	if ($instance instanceof UploadDirectoryStructureAwareInterface)
    	{
    		$uploadDirectoryConfig = $serviceLocator->get('config')['upload_directory_structure'];
    		$instance->setUploadDirectoryStructure($uploadDirectoryConfig);
    	}
    }
}