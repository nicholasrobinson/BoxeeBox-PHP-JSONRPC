#!/usr/bin/php
<?php

# Include BoxeeBoxPHPJSONRPC class
require_once('BoxeeBoxPHPJSONRPC.class.php');

# Connect to BoxeeBox
$bb = new BoxeeBoxPHPJSONRPC('boxeebox');

# Issue API Query
echo $bb->JSONRPC('Version', 'Version');

?>