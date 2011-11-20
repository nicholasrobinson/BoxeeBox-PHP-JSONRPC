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
	* @param	text		 string		 string text to set
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
	* @param		 msg			 string		 message to display in the notification dialog
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
	
}

?>