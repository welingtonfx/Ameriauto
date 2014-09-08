<?php
namespace Application\Model;

interface UploadDirectoryStructureAwareInterface
{
	public function setUploadDirectoryStructure($uploadDirectoryConfig);

	public function getUploadDirectoryStructure();
}