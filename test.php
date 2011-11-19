#!/usr/bin/php
<?php

# Define parameters
$serverAddress = gethostbyname('boxeebox');
$serverPort = 9090;

# Initialise TCP socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

# Verify successful socket creation creation
if ($socket === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
} else {
    echo "OK.\n";
}

# Connect to server
$server = socket_connect($socket, $serverAddress, $serverPort);

# Verify connection
if ($result === false) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
} else {
    echo "OK.\n";
}

# Compose base JSONRPC object
$baseObject = new stdClass();
$baseObject->jsonrpc = "2.0";
$baseObject->id = 1;

# Compose introspect object {"jsonrpc": "2.0", "method": "JSONRPC.Introspect", "id": 1}
$introspectObject = clone $baseObject;
$introspectObject->method = "JSONRPC.Introspect";

# Compose outbound data string
$in = json_encode($introspectObject);

# Initialise output buffer
$out = '';

# Write outband data string to socket
echo "in: $in \n";
socket_write($socket, $in, strlen($in));

# Get Response
echo "out: $in \n";
while ($out = socket_read($socket, 2048)) {
    echo $out;
}

# Close socket
socket_close($socket);

?>