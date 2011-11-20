<?php
/*
 *	File:			PicturePlayer.class.php
 *	Description:	Generate json encoded strings for PicturePlayer methods
 *	Author:			Nicholas Robinson 11/19/2011
 */

# Includes
if (!defined('ROOT'))
{
	define('ROOT', dirname(dirname(__FILE__)));
}
require_once(ROOT . '/Services/BaseClass.class.php');

/** 
* Generate json encoded strings for PicturePlayer methods
*/
class PicturePlayer extends BaseClass
{
	
	/** 
	* Pauses or unpauses slideshow.
	*
	* @return
	* playing		 boolean	  True if audio is currently playing; 
	* paused		 boolean	  True if audio is currently paused; 
	*/
	public function PlayPause()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Stops playback.
	*
	* @return string
	*/
	public function Stop()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Skips to the previous item in the slideshow.
	*
	* @return string
	*/
	public function SkipPrevious()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Skips to the next item in the slideshow.
	*
	* @return string
	*/
	public function SkipNext()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* In a zoomed view, pans the viewport to the left.
	*
	* @return string
	*/
	public function MoveLeft()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* In a zoomed view, pans the viewport to the right.
	*
	* @return string
	*/
	public function MoveRight()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* In a zoomed view, pans the viewport downwards.
	*
	* @return string
	*/
	public function MoveDown()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* In a zoomed view, pans the viewport upwards.
	*
	* @return string
	*/
	public function MoveUp()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Zooms the viewport out.
	*
	* @return 
	* number	 Percentage
	*/
	public function ZoomOut()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Zooms the viewport in.
	*
	* @param	value	 Position to seek to
	*
	* @return string
	*/
	public function ZoomIn()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Zoom to a defined level
	*
	* @param	number      Zoom level to seek to, as a whole number between 1-10
	*
	* @return string
	*/
	public function Zoom($number)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		$this->params = new stdClass();
		$this->params->number = $number;
		return self::stringify($this);
	}
	
	/** 
	* Rotate the current picture (clockwise or anticlockwise?)
	*
	* @return string
	*/
	public function Rotate()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}

}

?>