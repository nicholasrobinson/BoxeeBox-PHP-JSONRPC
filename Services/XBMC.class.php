<?php
/*
 *	File:			XBMC.class.php
 *	Description:	Generate json encoded strings for XBMC methods
 *	Author:			Nicholas Robinson 11/19/2011
 */

# Includes
if (!defined('ROOT'))
{
	define('ROOT', dirname(dirname(__FILE__)));
}
require_once(ROOT . '/Services/BaseClass.class.php');

/** 
* Generate json encoded strings for XBMC methods
*/
class XBMC extends BaseClass
{
	
	/** 
	* Gets the current volume
	*
	* @return 
	* number    volume
	*/
	public function GetVolume()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Sets the current volume as an int percent
	*
	* @param	value	number volume to set to
	*
	* @return string
	*/
	public function SetVolume($value)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		$this->params = new stdClass();
		$this->params->value = $value;
		return self::stringify($this);
	}
	
	/** 
	* Toggle volume mute on/off, returns same as XBMC.GetVolume
	*
	* @return 
	* number	 volume
	*/
	public function ToggleMute()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Starts playback of a file / URL
	*
	* @param	file			string File name or URL to play
	* @param	contenttype		string Content type (i.e. video/mp4 or text/html) (optional)
	*
	* @return string
	*/
	public function Play()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Starts slideshow
	*
	* @param		directory		string		directory to show pictures from
	* random		boolean			True if show in random order (optional, default is True)
	* recursive		boolean			True if include pictures from subdirectories  (optional, default is True)
	*
	* @return string
	*/
	public function StartSlideshow()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Exits XBMC
	*
	* @return string
	*/
	public function Quit($booleans)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}

}

?>