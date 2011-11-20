<?php
/*
 *	File:			Device.class.php
 *	Description:	Generate json encoded strings for Device methods
 *	Author:			Nicholas Robinson 11/19/2011
 */

# Includes
if (!defined('ROOT'))
{
	define('ROOT', dirname(dirname(__FILE__)));
}
require_once(ROOT . '/Services/BaseClass.class.php');

/** 
* Generate json encoded strings for Device methods
*/
class Device extends BaseClass
{
	
	/** 
	* Initiates a pairing request by sending a challenge to Boxee. 
	* Boxee displays a dialog box with a PIN that the user should type on the device and send to Boxee with 
	* Device.PairResponse
	*
	* @param	deviceid		string     identifier for the device (h/w address, MAC address, serial number, etc)
	* @param	applicationid	string     identifier for the caller application
	* @param	label			string     name of the caller application (displayed in the Boxee user interface)
	* @param	icon			string     URL for the called application thumbnail (displayed in the Boxee user interface)
	* @param	type			string     One of the following values: "tablet", "phone", "remote", "other
	*
	* @return string
	*/
	public function PairChallenge($deviceid, $applicationid, $label, $icon, $type)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		$this->params = new stdClass();
		$this->params->deviceid = $deviceid;
		$this->params->applicationid = $applicationid;
		$this->params->label = $label;
		$this->params->icon = $icon;
		$this->params->type = $type;
		return self::stringify($this);
	}
	
	/** 
	* In response to Device.PairChallenge, Boxee displays a dialog box with a PIN that the user should type on the 
	* device and send to Boxee using this method.
	*
	* @param	deviceid		string		identifier for the device (h/w address, MAC address, serial number, etc)
	* @param	code			string		code entered by the user on the client device
	*
	* @return string
	*/
	public function PairResponse($deviceid, $code)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		$this->params = new stdClass();
		$this->params->deviceid = $deviceid;
		$this->params->code = $code;
		return self::stringify($this);
	}
	
	/** 
	* Unpair a paired device.
	*
	* @param	deviceid		string		identifier for the device (h/w address, MAC address, serial number, etc)
	*
	* @return string
	*/
	public function Unpair($deviceid)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		$this->params = new stdClass();
		$this->params->deviceid = $deviceid;
		return self::stringify($this);
	}
	
	/** 
	* The client should call this method when (after pairing once) to authenticate itself with Boxee. 
	* If the device is paired, the client can continue and make additional calls to Boxee.
	*
	* @param	deviceid		string		identifier for the device (h/w address, MAC address, serial number, etc)
	*
	* @return string
	*/
	public function Connect($deviceid)
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		$this->params = new stdClass();
		$this->params->deviceid = $deviceid;
		return self::stringify($this);
	}

}

?>