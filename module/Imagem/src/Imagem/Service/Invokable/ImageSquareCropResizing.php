<?php
namespace Imagem\Service\Invokable;

use Imagem\Service\AbstractImageResizing;

class ImageSquareCropResizing extends AbstractImageResizing
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
	 * Defines the size of resized image (both width and height will have the same size in pixels)
	 * 
	 * @var int
	 */
	public $cropSize;
	
	/**
	 * Base side should be "width" or "height"
	 * This is automatically calculated and it is required to make the crop in the center of the image
	 * 
	 * @var string
	 */
	protected $baseSize;
	
	/**
	 * Image file created to receive resized image
	 * 
	 * @var resource
	 */
	public $newImage;
	
	/**
	 * Set options to resizing image
	 * 
	 * For square crop resizing, "crop_size" is required (both width and height will have the same size)
	 * Check abstract class for more required and optional parameters for $options array
	 * 
	 * @param array $options
	 */
	public function setOptions(array $options)
	{
		$this->baseSize = ($this->sourceImageWidth > $this->sourceImageHeight) ? self::HEIGHT_AS_BASE : self::WIDTH_AS_BASE;
		$this->cropSize = isset($options['crop_size']) ? $options['crop_size']: new Exception(sprintf('%s method expects squareSize key in options argument'), __METHOD__);
		
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
		$this->newImage = $this->createNewImageFile($this->cropSize, $this->cropSize);
		
		$coordinates = $this->getCropCoordinates($this->sourceImageWidth, $this->sourceImageHeight);
		$sizes = $this->getCropSizes($this->sourceImageWidth, $this->sourceImageHeight);
					
		$this->executeResize($this->newImage, $this->sourceImage, 0, 0, $coordinates['x'], $coordinates['y'], $this->cropSize, $this->cropSize, $sizes['width'], $sizes['height']);
		
		$saveImage = $this->save($this->newImage);
		
		$this->destroy($this->newImage);
		$this->destroy($this->sourceImage);
		
		return $saveImage;
	}

	/**
	 * Calculates the coordinates in order to make the crop in the center of the image
	 * 
	 * @param int $sourceImageWidth
	 * @param int $sourceImageHeight
	 * 
	 * @return array
	 */
	private function getCropCoordinates($sourceImageWidth, $sourceImageHeight)
	{
		if($this->baseSize == self::WIDTH_AS_BASE)
		{
			$y = ($sourceImageHeight - $sourceImageWidth) > 0 ? ceil(($sourceImageHeight - $sourceImageWidth)) / 2 : 0;
			$x = 0;
		}
		elseif($this->baseSize == self::HEIGHT_AS_BASE)
		{
			$y = 0;
			$x = ($sourceImageWidth - $sourceImageHeight) > 0 ? ceil(($sourceImageWidth - $sourceImageHeight)) / 2 : 0;
		}

		return array('x' => $x, 'y' => $y);
	}
	
	/**
	 * Returns the crop size of the image - the lower number between width and height - in order to crop the image in a square format
	 * 
	 * @param int $sourceImageWidth
	 * @param int $sourceImageHeight
	 * 
	 * @return array
	 */
	private function getCropSizes($sourceImageWidth, $sourceImageHeight)
	{
		$width = $height = min($sourceImageWidth, $sourceImageHeight);
		return array('width' => $width, 'height' => $height);
	}
}