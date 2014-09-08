<?php
namespace Imagem\Service;

interface ImageResizingInterface
{
	/**
	 * Set options for image resizing
	 * 
	 * @param array $options
	 */
	public function setOptions(array $options);
	
	/**
	 * Set source image path and get the info to create the image on memory
	 * 
	 * @param string $sourceImagePath
	 */
	public function setImage($sourceImagePath);
	
	/**
	 * Create the source image on memory
	 * 
	 * @param string $originalImageType Receives the image mime type
	 */
	public function createSourceImage($originalImageType);
	
	/**
	 * Create the blank file which will receive the resized image
	 * 
	 * @param int $width
	 * @param int $height
	 */
	public function createNewImageFile($width, $height); 
}