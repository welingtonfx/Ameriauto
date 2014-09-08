<?php
namespace Imagem\Service\Invokable;

use Imagem\Service\AbstractImageResizing;

class ImageProportionalResizing extends AbstractImageResizing
{
	/**
	 * Defines the width as base for image resizing
	 */
	const WIDTH_AS_BASE  = "width";
	
	/**
	 * Defines the height as base for image resizing
	 */	
	const HEIGHT_AS_BASE = "height";
	
	/**
	 * Defines the size of the base side of resized image
	 * 
	 * @var int
	 */
	public $maxSize;
	
	/**
	 * Base side should be "width" or "height"
	 * If width then the width of resized image will have the size defined on "max_size" option and height will be resized proportionally
	 * If height then the height of resized image will have the size defined on "max_size" option and width will be resized proportionally
	 * 
	 * @var string
	 */
	public $baseSize;

	/**
	 * Image file created to receive resized image
	 * 
	 * @var resource
	 */
	public $newImage;
	
	/**
	 * Set options to resizing image
	 * 
	 * For proportional resizing, "max_size" and "base_size" are required
	 * Check abstract class for more required and optional parameters for $options array
	 * 
	 * @param array $options
	 */
	public function setOptions(array $options)
	{
		$this->maxSize = isset($options['max_size'])? $options['max_size'] : new Exception(sprintf('%s method expects maxSize key in options argument'), __METHOD__);
		$this->baseSize = isset($options['base_size']) ? $options['base_size'] : new Exception(sprintf('%s method expects baseSize key in options argument'), __METHOD__);
		
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
		$proportionalSize = $this->getProportionalSize();
		$this->newImage = $this->createNewImageFile($proportionalSize['width'], $proportionalSize['height']);
		
		$this->executeResize($this->newImage, $this->sourceImage, 0, 0, 0, 0, $proportionalSize['width'], $proportionalSize['height'], $this->sourceImageWidth, $this->sourceImageHeight);
		
		$saveImage = $this->save($this->newImage);
		
		$this->destroy($this->newImage);
		$this->destroy($this->sourceImage);
		
		return $saveImage;
	}
	
	/**
	 * Calculates the new image size considering the proportions of source image
	 * 
	 * @return array
	 */
	private function getProportionalSize()
	{
		// Calculate the scaling we need to do to fit the image inside our frame
		if($this->baseSize == self::WIDTH_AS_BASE)
		{
			$scale = $this->maxSize / $this->sourceImageWidth;
		}
		elseif($this->baseSize == self::HEIGHT_AS_BASE)
		{
			$scale = $this->maxSize / $this->sourceImageHeight;
		}
		else
		{ 
			throw new Exception('Invalid Base Size defined.');
		}
		
		// Get the new dimensions
		$width  = ceil($scale*$this->sourceImageWidth);
		$height = ceil($scale*$this->sourceImageHeight);
		
		return array('width' => $width, 'height' => $height);
	}
}