<?php
/*
 *	File:			BaseClass.class.php
 *	Description:	Abstract Base Class for Methods Classes
 *	Author:			Nicholas Robinson 11/19/2011
 */

# Constants
define('JSONRPC_VERSION', '2.0');
define('MESSAGE_ID', 1);

/** 
* Abstract Base Class for Methods Classes
*/
abstract class BaseClass
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