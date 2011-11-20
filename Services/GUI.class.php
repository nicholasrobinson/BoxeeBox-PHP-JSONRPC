<?php
/*
 *	File:			GUI.class.php
 *	Description:	Generate json encoded strings for GUI methods
 *	Author:			Nicholas Robinson 11/19/2011
 */

# Includes
if (!defined('ROOT'))
{
	define('ROOT', dirname(dirname(__FILE__)));
}
require_once(ROOT . '/Services/BaseClass.class.php');

/** 
* Generate json encoded strings for GUI methods
*/
class GUI extends BaseClass
{
	
	/** 
	* If a text field / edit control is currently focused in the Boxee user interface, set it's value. 
	* It allows to use a "remote" keyboard to enter text.
	*
	* @param	text		string		string text to set
	*
	* @return string
	*/
	public function TextFieldSet($text)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		$this->params = new stdClass();
		$this->params->text = $text;
		return self::stringify($this);
	}
	
	/** 
	* Returns the state of the on-screen virtual keyboard or it a text field / edit control is currently 
	* focused in the Boxee user interface.
	*
	* @return
	* displayed		 boolean	 True if the on-screen virtual keyboard or it a text field / edit control is currently focused in the Boxee user interface
	* text			 string		 Value that's currently in the text field (if "displayed" is True)
	* password		 boolean	 True if the text field is a password field
	*/
	public function KeyboardState()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Show notification dialog for 5 seconds.
	*
	* @param		msg			string		message to display in the notification dialog
	*
	* @return string
	*/
	public function NotificationShow($msg)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		$this->params = new stdClass();
		$this->params->msg = $msg;
		return self::stringify($this);
	}
	
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