<?php
/*
 *	File:			JSONRPC.class.php
 *	Description:	Generate json encoded strings for JSONRPC methods
 *	Author:			Nicholas Robinson 11/19/2011
 */

# Includes
require_once('Services/BaseClass.class.php');

/** 
* Generate json encoded strings for JSONRPC methods
*/
class JSONRPC extends BaseClass
{
	# Properties
	public $method;
	
	/** 
	* Generate string for JSONRPC.Introspect method
	*
	* @return string
	*/
	public function Introspect()
	{
		$this->method = "JSONRPC.Introspect";
		return self::stringify($this);
	}
	
	/** 
	* Generate string for JSONRPC.Version method
	*
	* @return string
	*/
	public function Version()
	{
		$this->method = "JSONRPC.Version";
		return self::stringify($this);
	}
	
	/** 
	* Generate string for JSONRPC.Ping method
	*
	* @return string
	*/
	public function Ping()
	{
		$this->method = "JSONRPC.Ping";
		return self::stringify($this);
	}
}

?>