<?php
namespace Application\Service\Invokable;

class FileManager
{
	/**
	 * Remove files and directories recursively
	 * 
	 * @var string $target
	 */
	public function deleteRecursively($target)
	{
	    if(is_dir($target))
	    {
	    	// GLOB_MARK adds a slash to returned directories
	        $files = glob($target . '*', GLOB_MARK);
	        
	        foreach($files as $file)
	        {
	            $this->deleteRecursively($file);      
	        }
	      	
	      	// Avoid error by trying to remove parent dir twice
	      	if(file_exists($target))
	      	{
	      		rmdir($target);	
	      	}
	    } 
	    elseif(is_file($target)) 
	    {
	        unlink($target);
	    }
	}
}