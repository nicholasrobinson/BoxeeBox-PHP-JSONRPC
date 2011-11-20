<?php
/*
 *	File:			System.class.php
 *	Description:	Generate json encoded strings for System methods
 *	Author:			Nicholas Robinson 11/19/2011
 */

# Includes
if (!defined('ROOT'))
{
	define('ROOT', dirname(dirname(__FILE__)));
}
require_once(ROOT . '/Services/BaseClass.class.php');

/** 
* Generate json encoded strings for System methods
*/
class System extends BaseClass
{
	
	/** 
	* Shuts down the system
	*
	* @return string
	*/
	public function Shutdown()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Suspends the system
	*
	* @return string
	*/
	public function Suspend()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Hibernates the system
	*
	* @return string
	*/
	public function Hibernate()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Reboots the system
	*
	* @return string
	*/
	public function Reboot()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}
	
	/** 
	* Get info labels about the system
	*
	* @param	labels		 array	 of string	 <field name>s to return information for
	*
	* @return
	* array		 of object field name boolean value of that field
	*/
	public function GetInfoLabels($labels)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		$this->params = new stdClass();
		$this->params->labels = $labels;
		return self::stringify($this);
	}
	
	/** 
	* Get info booleans about the system 
	* Available field names: system.canshutdown system.canpowerdown system.cansuspend system.canhibernate system.canreboot
	* Example parameters:
	* { "booleans": [ "system.canshutdown", "system.cansuspend" ] }
	* Example result: 
	* [ { 'system.canshutdown' : true }, { 'system.cansuspend' : true }]
	*
	* @param	 booleans	 array	 of string	 field names to return information for
	*
	* @return
	* array		 of object field name boolean value of that field
	*/
	public function GetInfoBooleans($booleans)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		$this->params = new stdClass();
		$this->params->booleans = $booleans;
		return self::stringify($this);
	}

}

?>