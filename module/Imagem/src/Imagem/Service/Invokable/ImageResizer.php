<?php
namespace Imagem\Service\Invokable;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Imagem\Service\Invokable\ImageProportionalResizing;
use Imagem\Service\Invokable\ImageFixedResizing;
use Imagem\Service\Invokable\ImageSquareCropResizing;

class ImageResizer implements ServiceLocatorAwareInterface
{
	protected $serviceLocator;
	protected $resizeFormat = "Proportional";
	
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
	{
		$this->serviceLocator = $serviceLocator;
	}
	
	public function getServiceLocator()
	{
		return $this->serviceLocator;
	}
	
	public function resize(array $resizeConfig)
	{
		$this->resizeFormat = $resizeConfig['format'];
		$resizeImage = $resizeConfig['image'];
		$resizeOptions = $resizeConfig['options'];
		
		$resizeClass = $this->getResizeClass();
		
		$resizeClass->setImage($resizeImage);
		$resizeClass->setOptions($resizeOptions);
		
		return $resizeClass->resize();
	}
	
	protected function getResizeClass()
	{
		switch($this->resizeFormat)
		{
			case "Fixed":
			case __NAMESPACE__."\ImageFixedResizing":
				return $this->serviceLocator->get('image-fixed-resizing');
				break;
			case "Proportional":
			case __NAMESPACE__."\ImageProportionalResizing":
				return $this->serviceLocator->get('image-proportional-resizing');
				break;
			case "SquareCrop":
			case __NAMESPACE__."\ImageSquareCropResizing":
				return $this->serviceLocator->get('image-square-crop-resizing');
				break;
		}
	}
}