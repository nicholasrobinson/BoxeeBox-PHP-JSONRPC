<?php
/*
 *  File:			simple.php
 *  Description:	Simple SDK web/command line example
 *  Author:			Nicholas Robinson 11/19/2011
 */
 
# Include BoxeeBoxPHPJSONRPC class
require_once('../BoxeeBoxPHPJSONRPC.class.php');

# Connect to BoxeeBox
$bb = new BoxeeBoxPHPJSONRPC('boxeebox');

# Issue JSONRPC.Ping Query
echo "JSONRPC.Ping:\n";
echo $bb->JSONRPC('Ping') . "\n\n";

?>