#!/usr/bin/php
<?php

# Parse command line arguments
$args = getopt('h:s:m:');
if (!isset($args['h']) || !isset($args['s']) || !isset($args['m']))
{
	echo "Usage: ./commandline.php -h <hostname> -s <service> -m <method> \n";
	echo "Example: ./commandline.php -h boxeebox -s JSONRPC -m Ping\n";
	exit(1);
}
$hostname = $args['h'];
$service = $args['s'];
$method = $args['m'];

# Include BoxeeBoxPHPJSONRPC class
require_once('../BoxeeBoxPHPJSONRPC.class.php');

# Connect to BoxeeBox
$bb = new BoxeeBoxPHPJSONRPC($hostname);

# Issue JSONRPC.Ping Query
echo "JSONRPC.Ping:\n";
echo $bb->$service($method) . "\n";

?>