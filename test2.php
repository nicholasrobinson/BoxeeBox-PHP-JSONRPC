#!/usr/bin/php
<?php

# Includes
require_once('Methods/MethodsJSONRPC.class.php');
require_once('Connections/BoxeeBoxJSONRPC.class.php');

# Create JSON RPC Methods Object
$JSONRPC = new MethodsJSONRPC();

var_dump($JSONRPC->Ping());

$bb = new BoxeeBoxJSONRPC();
$bb->connect(gethostbyname('boxeebox'));
var_dump($bb->send($JSONRPC->Ping()));


?>