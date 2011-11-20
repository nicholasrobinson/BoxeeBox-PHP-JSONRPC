<?php
/*
 *	File:			BasePlayerClass.class.php
 *	Description:	Generate json encoded strings for BasePlayerClass methods
 *	Author:			Nicholas Robinson 11/19/2011
 */

# Includes
if (!defined('ROOT'))
{
	define('ROOT', dirname(dirname(__FILE__)));
}
require_once(ROOT . '/Services/BaseClass.class.php');

/** 
* Generate json encoded strings for BasePlayerClass methods
*/
abstract class BasePlayerClass extends BaseClass
{
	
	/** 
	* Gets the state of the audio player
	*
	* @return
	* playing		 (boolean)		 True if audio is currently playing;  
	* paused		 (boolean)		 True if audio is currently paused; 
	* stream		 (string)		 The URL or file name of stream; 
	* label			 (string)		 The name of the stream; 
	* seekable		 (string)		 True if it is possible to seek within this stream; 
	* can-play-next  (string)		 True if it is possible to skip to a next file; 
	* can-play-prev  (string)		 True if it is possible to skip to a previous file; 
	*/
	public function State()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Pauses or unpauses playback, returns new state
	*
	* @return
	* playing		 boolean	 True if audio is currently playing; 
	* paused		 boolean	 True if audio is currently paused; 
	*/
	public function PlayPause()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Stops playback
	*
	* @return string
	*/
	public function Stop()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Skips to the previous item in the playlist
	*
	* @return string
	*/
	public function SkipPrevious()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Skips backward in the current track by a big amount
	*
	* @return string
	*/
	public function BigSkipBackward()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Skips forward in the current track by a big amount
	*
	* @return string
	*/
	public function BigSkipForward()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Skips backward in the current track by a small amount
	*
	* @return string
	*/
	public function SmallSkipBackward()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Skips forward in the current track by a small amount
	*
	* @return string
	*/
	public function SmallSkipForward()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Gets the state of the audio player, including time information
	*
	* @return
	* time		 object		 Position in current track (hours, minutes, seconds, milliseconds); 
	* total		 object		 Duration of current track (hours, minutes, seconds, milliseconds); 
	* playing	 boolean	 True if audio is currently playing; 
	* paused	 boolean	 True if audio is currently paused; 
	*/
	public function GetTime()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Gets a percentage, of what is not obviously documented, presumably Position/Duration*100
	*
	* @return 
	* number	 Percentage
	*/
	public function GetPercentage()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Seek to a position in the track defined by position in seconds
	*
	* @param	value	Position to seek to
	*
	* @return
	*/
	public function SeekTime($value)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		$this->params = new stdClass();
		$this->params->value = $value;
		return self::stringify($this);
	}
	
	/** 
	* Seek to a position in the track defined by a percentage (of total duration)
	*
	* @param	value	Position to seek to
	*
	* @return
	*/
	public function SeekPercentage($value)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		$this->params = new stdClass();
		$this->params->value = $value;
		return self::stringify($this);
	}

}

?>