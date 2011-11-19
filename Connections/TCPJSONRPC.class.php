<?php
/*
 *	File:			TCPJSONRPC.class.php
 *	Description:	Handle JSONRPC communication via a TCP Socket
 *	Author:			Nicholas Robinson 11/19/2011
 */

# Constants
define('JSONRPC_PORT', '9090');
define('READ_LENGTH', 2048);

/** 
* Handle JSONRPC communication via a TCP Socket
*/
class TCPJSONRPC
{
	# Properties
	private $socket;
	private $serverAddress;
	private $serverPort = JSONRPC_PORT;
	
	/** 
	* Create TCP Socket
	*
	* @param  $serverAddress	BoxeeBox Server Address
	*
	* @return null
	*/
	public function __construct()
	{
		# Initialise TCP socket
		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		# Verify successful socket creation creation
		if ($this->socket === false) 
		{
			throw new Exception('socket_create() failed: reason: ' . socket_strerror(socket_last_error()));
		}
	}
	
	/** 
	* Destroy TCP Socket
	*
	* @return null
	*/
	public function __destruct()
	{
		# Close socket
		socket_close($this->socket);
	}
	
	/** 
	* Connect TCP Socket
	*
	* @param  $serverAddress	BoxeeBox Server Address
	*
	* @return null
	*/
	public function connect($serverAddress)
	{
		# Initialise properties
		$this->serverAddress = $serverAddress;
		# Connect to server
		$response = socket_connect($this->socket, $this->serverAddress, $this->serverPort);
		# Verify connection
		if ($response === false) 
		{
			throw new Exception('socket_connect() failed: reason: ($response) ' . socket_strerror(socket_last_error($this->socket)));
		} 
	}
	
	
	/** 
	* Send Data over TCP Socket
	*
	* @param  $data			Data to send
	*
	* @return string
	*/
	public function send($data)
	{
		# Write data to socket
		$success = socket_write($this->socket, $data, strlen($data));
		# Verify success
		if ($success === false)
		{
			throw new Exception('socket_write() failed: reason: ($success) ' . socket_strerror(socket_last_error($this->socket)));
		}
		# Read response from socket
		$response = socket_read($this->socket, READ_LENGTH, PHP_NORMAL_READ);
		# Verify success
		if ($response === false)
		{
			throw new Exception('socket_write() failed: reason: ($response) ' . socket_strerror(socket_last_error($this->socket)));
		}
		# Return trimmed response (removes trailing newline)
		return trim($response);
	}
	
}

?>