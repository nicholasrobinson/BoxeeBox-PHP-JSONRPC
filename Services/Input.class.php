<?php
/*
 *	File:			Input.class.php
 *	Description:	Generate json encoded strings for Input methods
 *	Author:			Nicholas Robinson 11/19/2011
 */

# Includes
if (!defined('ROOT'))
{
	define('ROOT', dirname(dirname(__FILE__)));
}
require_once(ROOT . '/Services/BaseClass.class.php');

/** 
* Generate json encoded strings for Input methods
*/
class Input extends BaseClass
{
	
	/** 
	* Returns the current navigation state, whether a mouse or keys navigation is enabled.
	*
	* @return
	* keys-enabled	 boolean	 True if the navigation keys are enabled (currently always True)
	* mouse-enabled	 boolean	 True if the mouse is  enabled
	*/
	public function NavigationState()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Sends a remote key up event
	*
	* @return string
	*/
	public function Up()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Sends a remote key down event
	*
	* @return string
	*/
	public function Down()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Sends a remote key left event
	*
	* @return string
	*/
	public function Left()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Sends a remote key right event
	*
	* @return string
	*/
	public function Right()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Sends a remote key back event
	*
	* @return string
	*/
	public function Back()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Return boxee to the home window
	*
	* @return string
	*/
	public function Home()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Sends a mouse movement event
	*
	* @param	deltax		number		Delta on the X axis
	* @param	deltay		number		Delta on the Y axis
	* @return string
	*
	*/
	public function MouseMovement($deltax, $deltay)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		$this->params = new stdClass();
		$this->params->deltax = $deltax;
		$this->params->deltay = $deltay;
		return self::stringify($this);
	}
	
	/** 
	* Sends a mouse click event
	*
	* @return string
	*/
	public function MouseClick()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}

}

?>