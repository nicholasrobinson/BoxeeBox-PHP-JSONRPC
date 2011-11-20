<?php
/*
 *	File:			BoxeeBoxPHPJSONRPC.class.php
 *	Description:	Communicate with BoxeeBox via JSONRPC API
 *	Author:			Nicholas Robinson 11/19/2011
 */

# Includes
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/Connections/TCPJSONRPC.class.php');
require_once(ROOT . '/Services/JSONRPC.class.php');

/** 
* Communicate with BoxeeBox via JSONRPC API
*/
class BoxeeBoxPHPJSONRPC
{
	# Properties
	private $connection;
	
	/** 
	* Create BoxeeBoxJSONRPC connection
	*
	* @param  $hostname		BoxeeBox Server Hostname or IP 
	*
	* @return null
	*/
	public function __construct($hostname)
	{
		# Fetch server address
		$serverAddress = gethostbyname($hostname);
		# Establish connection to server
		$this->connection = new TCPJSONRPC();
		$this->connection->connect($serverAddress);
	}
	
	/** 
	* Handle API Services
	*
	* @param  $service		JSONRPC API service 
	* @param  $parameters	JSONRPC API method and parameters array
	*
	* @return null
	*/
	public function __call($service, $parameters) 
	{
		# Validate parameters
		if (count($parameters) < 1)
		{
			throw new Exception('ERROR: No Service specified');
		}
		# Extract Method
		$method = array_shift($parameters);
		# Validate service
		if (!file_exists(ROOT . '/Services/' . $service . '.class.php'))
		{
			throw new Exception('ERROR: Invalid Service specified');
		}
		# Instanciate service object
		$serviceObject = new $service;
		# Validate method
		if (!method_exists($serviceObject, $method))
		{
			throw new Exception('ERROR: Invalid method specified');
		}
		# Fetch json encoded query
		$jsonQuery = call_user_func_array(array($serviceObject, $method), $parameters);
		# Validate api call
		if ($jsonQuery == false)
		{
			throw new Exception('ERROR: Invalid parameters specified');
		}
		# Send query to jsonrpc api
		$response = $this->connection->send($jsonQuery);
		# Return response
		return $response;
	}
	
}