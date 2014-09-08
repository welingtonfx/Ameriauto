<?php
namespace Imagem\Service\Invokable;

use Imagem\Service\AbstractImageResizing;

class ImageFixedResizing extends AbstractImageResizing
{
	/**
	 * Resized image width
	 * 
	 * @var int
	 */
	public $newWidth;
	
	/**
	 * Resized image height
	 * 
	 * @var int
	 */
	public $newHeight;
	
	/**
	 * Image file created to receive resized image
	 * 
	 * @var resource
	 */
	public $newImage;
	
	/**
	 * Set options to resizing image
	 * 
	 * For fixed resizing, "width" and "height" options are required
	 * Check abstract class for more required and optional parameters for $options array
	 * 
	 * @param array $options
	 */
	public function setOptions(array $options)
	{
		$this->newWidth =  isset($options['width']) ? $options['width'] : new Exception(sprintf('%s method expects a width key in options argument'), __METHOD__);
		$this->newHeight = isset($options['height']) ? $options['height']: new Exception(sprintf('%s method expects height key in options argument'), __METHOD__);;
		
		parent::setOptions($options);
	}
	
	/**
	 * Perform all actions for resizing the image
	 * Returns a boolean telling whether image was successfully saved
	 * 
	 * @return bool
	 */
	public function resize()
	{
		$this->newImage = $this->createNewImageFile($this->newWidth, $this->newHeight);
	
		$this->executeResize($this->newImage, $this->sourceImage, 0, 0, 0, 0, $this->newWidth, $this->newHeight, $this->sourceImageWidth, $this->sourceImageHeight);
		
		$saveImage = $this->save($this->newImage);
		
		$this->destroy($this->newImage);
		$this->destroy($this->sourceImage);
		
		return $saveImage;
	}
}