<?php
/*
 *	File:			JSONRPC.class.php
 *	Description:	Generate json encoded strings for JSONRPC methods
 *	Author:			Nicholas Robinson 11/19/2011
 */

# Includes
if (!defined('ROOT'))
{
	define('ROOT', dirname(dirname(__FILE__)));
}
require_once(ROOT . '/Services/BaseClass.class.php');

/** 
* Generate json encoded strings for JSONRPC methods
*/
class JSONRPC extends BaseClass
{	
	/** 
	* Returns a list of all available method calls
	*
	* @return string
	*/
	public function Introspect()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Returns the version of this API (not JSONRPC version). 
	* An even number refers to a stable version while odd number is development.
	*
	* @return string
	*/
	public function Version()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Returns a list of client permissions
	*
	* @return string
	*/
	public function Permission()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Returns pong!
	*
	* @return string
	*/
	public function Ping()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
}

?>