<?php
/*
 *	File:			MethodsBaseClass.class.php
 *	Description:	Class definition for Methods Base Class
 *	Author:			Nicholas Robinson 11/19/2011
 */

# Constants
define('JSONRPC_VERSION', '2.0');
define('MESSAGE_ID', 1);

/** 
* Base class for BoxeeBox JSONRPC Remote Control Methods
*/
class MethodsBaseClass
{
	# Properties
	public $jsonrpc = JSONRPC_VERSION;
	public $id = MESSAGE_ID;
	
	/** 
	* Flatten object into JSON encoded string
	*
	* @param  $object	Object for stringification
	*
	* @return string
	*/
	protected function stringify($object)
	{
		return json_encode($object);
	}
}

?>