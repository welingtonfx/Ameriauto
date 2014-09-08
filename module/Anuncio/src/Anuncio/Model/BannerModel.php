<?php
namespace Anuncio\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Model\UploadDirectoryStructureAwareInterface;

class BannerModel implements ServiceLocatorAwareInterface,
							 UploadDirectoryStructureAwareInterface
{
	/**
	 * @var ServiceLocatorInterface
	 */
	protected $serviceLocator;
	
	/**
	 * @var string Diretório base dos banners enviados por upload
	 */
	protected $bannerBaseDir;
	
	/**
	 * Remove um banner
	 * 
	 * @var string $bannerFile
	 */
	public function deleteBanner($bannerFile)
	{
		unlink($this->bannerBaseDir.'/'.$bannerFile);	
	}
	
    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;

    }

    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
        $this->serviceLocator;
    }
 
     /* (non-PHPdoc)
     * @see \Application\Model\UploadDirectoryStructureAwareInterface::setUploadDirectoryStructure()
     */	   
	public function setUploadDirectoryStructure($uploadDirectoryConfig)
	{
		$uploadRoot = $uploadDirectoryConfig['upload_root'];
		$bannerBase = $uploadDirectoryConfig['banner']['main-directory'];
		
		$this->bannerBaseDir = $uploadRoot.'/'.$bannerBase;
	}

    /* (non-PHPdoc)
     * @see \Application\Model\UploadDirectoryStructureAwareInterface::getUploadDirectoryStructure()
     */	
	public function getUploadDirectoryStructure()
	{
		return $this->uploadDir;
	}
}