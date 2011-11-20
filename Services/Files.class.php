<?php
/*
 *	File:			Files.class.php
 *	Description:	Generate json encoded strings for Files methods
 *	Author:			Nicholas Robinson 11/19/2011
 */

# Includes
if (!defined('ROOT'))
{
	define('ROOT', dirname(dirname(__FILE__)));
}
require_once(ROOT . '/Services/BaseClass.class.php');

/** 
* Generate json encoded strings for Files methods
*/
class Files extends BaseClass
{
	
	/** 
	* Returns a list of available source directories (directories in root folder)
	* Many functions in this namespace allow filtering by type, valid types are the following:
	* video
	* music
	* pictures
	* files
	*
	* @param	 media		 string		 media type filter, see Files namespace documentation for details
	*
	* @return
	* shares	 array		 a list of file items in the directory
	* start		 number
	* total		 number
	* end		 number
	*/
	public function GetSources($media)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		$this->params = new stdClass();
		$this->params->media = $media;
		return self::stringify($this);
	}
	
	/** 
	* Returns a list of items in a directory, items can be filtered by type.
	* Many functions in this namespace allow filtering by type, valid types are the following:
	* video
	* music
	* pictures
	* files
	*
	* @param	directory		string		the directory to list, e.g. foo/bar
	* @param	media			string		media type filter, see Files namespace documentation for details
	*
	* @return
	* directories	 array		 sub-directories in this directory
	* files			 array		 files in this directory
	* limits		 array		 contains the following:
	* start			 number
	* total			 number
	* end			 number
	*/
	public function GetDirectory($directory, $media)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		$this->params = new stdClass();
		$this->params->directory = $directory;
		$this->params->media = $media;
		return self::stringify($this);
	}

}

?>