<?php
namespace Imagem\Service;

use Imagem\Service\ImageResizingInterface;

abstract class AbstractImageResizing implements ImageResizingInterface
{
	/**
	 * Default image quality
	 */
	CONST DEFAULT_IMAGE_QUALITY = 80;
	
	/**
	 * Resize source image if smaller than output image?
	 */
	CONST RESIZE_SMALLER_IMAGE = false;
	
	/**
	 * Path to save the output image
	 * 
	 * @var string
	 */
	public $savePath;
	
	/**
	 * Quality of the output image
	 * 
	 * @var int
	 */
	public $saveQuality = self::DEFAULT_IMAGE_QUALITY;
	
	/**
	 * Resize source image if smaller than output image?
	 * 
	 * @var bool
	 */
	public $resizeSmaller = self::RESIZE_SMALLER_IMAGE;
	
	/**
	 * Source image path
	 * 
	 * @var string
	 */
	public $sourceImagePath;
	
	/**
	 * Source image width
	 * 
	 * @var int
	 */	
	protected $sourceImageWidth;
	
	/**
	 * Source image height
	 * 
	 * @var int
	 */	
	protected $sourceImageHeight;
	
	/**
	 * Source image Mime Type
	 * 
	 * @var string
	 */	
	protected $sourceImageMimeType;
	
	/**
	 * File of the source Image
	 * 
	 * @var resource
	 */	
	protected $sourceImage;
	
	/**
	 * Whether source image is smaller than output
	 * 
	 * @var bool
	 */	
	protected $sourceImageIsSmaller;
	
	/**
	 * Create the source image on memory according to mime type
	 * 
	 * @return resource
	 */
	public function createSourceImage($originalImageType)
	{
		switch($originalImageType) {
			case 'image/jpeg':
				return imagecreatefromjpeg($this->sourceImagePath);
				break;
			case 'image/png':
				return imagecreatefrompng($this->sourceImagePath);
				break;
			case 'image/gif':
				return imagecreatefromgif($this->sourceImagePath);
				break;
			default:
				throw new Exception('Unsupported image type');
		}
	}
	
	/**
	 * Create the blank image file which will receive the resized
	 * 
	 * @param int $width Resized image width
	 * @param int $height Resized image height
	 * @return resource
	 */
	public function createNewImageFile($width, $height)
	{
		if($this->resizeSmaller == false && $this->isSourceImageSmaller($width, $height) == true)
		{
			$width = $this->sourceImageWidth;
			$height = $this->sourceImageHeight;
		}

			return imagecreateTrueColor($width, $height);
	}

	/**
	 * Check whether source image is smaller than output image
	 * 
	 * @param $width Resized image width
	 * @param $height Resized image height
	 * @return bool
	 */
	public function isSourceImageSmaller($width, $height)
	{
		if(($width > $this->sourceImageWidth) && ($height > $this->sourceImageHeight))
		{
			$this->sourceImageIsSmaller = true;
			return true;
		}
		else
		{
			$this->sourceImageIsSmaller = false;
			return false;
		}
	}
	
	/**
	 * Set options to resizing image
	 * 
	 * "save_path" is a required option (ex: ./mydir/myfile.jpg)
	 * "quality" must be an integer from 0 to 100
	 * "resize_smaller" if true will resize the image even if it is smaller than user defined sizes (making image bigger will result in quality loss)
	 * 
	 * Options like width, height must be defined in concrete classes
	 * 
	 * @param array $options
	 */
	public function setOptions(array $options)
	{
		if (!is_array($options))
		{
			throw new Exception\InvalidArgumentException(sprintf(
				'%s expects an array as argument; received a "%s"',
				__METHOD__, (is_object($options) ? get_class($options) : gettype($options))
			));
		}
		
		$this->savePath = isset($options['save_path']) ? $options['save_path'] : new Exception(sprintf('%s method expects savePath key in options argument'), __METHOD__);
		$this->saveQuality = isset($options['quality']) ? $options['quality'] : self::DEFAULT_IMAGE_QUALITY;
		$this->resizeSmaller = isset($options['resize_smaller']) ? $options['resize_smaller'] : self::RESIZE_SMALLER_IMAGE;
	}
	
	/**
	 * Set image path and get source image config in order to create file in memory
	 * 
	 * @param string #sourceImagePath
	 */
	public function setImage($sourceImagePath)
	{
		$this->sourceImagePath = $sourceImagePath;
		
		$imageInfo = getimagesize($sourceImagePath);
		$this->sourceImageWidth = $imageInfo[0]; // Largura da imagem
		$this->sourceImageHeight = $imageInfo[1]; // Altura da imagem
		
		$this->sourceImageMimeType = $imageInfo['mime'];
		
		$this->sourceImage = $this->createSourceImage($this->sourceImageMimeType);
	}
	
	/**
	 * Execute the resizing of the image
	 * 
	 * Do not resize image if it smaller than specified by the user
	 * 
	 * @param resource $destImage
	 * @param resource $srcImage
	 * @param int $destX
	 * @param int $destY
	 * @param int $srcX
	 * @param int $srcY
	 * @param int $destWidth
	 * @param int $destHeight
	 * @param int $sourceWidth
	 * @param int $sourceHeight
	 */
	protected function executeResize($destImage, $srcImage, $destX = 0, $destY = 0, $srcX, $srcY, $destWidth, $destHeight, $sourceWidth, $sourceHeight)
	{
		if($this->resizeSmaller == false && $this->sourceImageIsSmaller == true)
		{
			$destWidth = $this->sourceImageWidth;
			$destHeight = $this->sourceImageHeight;
			$srcX = $srcY = 0;
		}
		
		imagecopyresampled($destImage, $srcImage, $destX, $destY, $srcX, $srcY, $destWidth, $destHeight, $sourceWidth, $sourceHeight);
	}
	
	/**
	 * Save the resized image
	 * 
	 * @param resource $destImage
	 */
	protected function save($destImage)
	{
		ob_start();
		$saveImage = imagejpeg($destImage, $this->savePath, $this->saveQuality);
		$data = ob_get_clean();
		
		if($saveImage) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Clean the memory allocated for image
	 * 
	 * @param resource $image
	 */
	protected function destroy($image)
	{
		return imagedestroy($image);
	}
}