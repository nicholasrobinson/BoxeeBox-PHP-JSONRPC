#!/usr/bin/php
<?php

# Includes
require_once('Methods/MethodsJSONRPC.class.php');

# Create JSON RPC Methods Object
$JSONRPC = new MethodsJSONRPC();

var_dump($JSONRPC->Ping());

?>