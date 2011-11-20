<?php

# Include BoxeeBoxPHPJSONRPC class
require_once('../BoxeeBoxPHPJSONRPC.class.php');

# Connect to BoxeeBox
$bb = new BoxeeBoxPHPJSONRPC('boxeebox');

# Issue JSONRPC.Ping Query
echo "JSONRPC.Ping:\n";
echo $bb->JSONRPC('Ping') . "\n\n";

?>