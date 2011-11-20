<?php
/*
 *  File:			complex.php
 *  Description:	Complex SDK web example
 *  Author:			Nicholas Robinson 11/19/2011
 */
 
# Include BoxeeBoxPHPJSONRPC class
require_once('../BoxeeBoxPHPJSONRPC.class.php');

# Connect to BoxeeBox
$bb = new BoxeeBoxPHPJSONRPC('boxeebox');

# Handle connection restoration
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'restore')
{
	$deviceid			= isset($_REQUEST['deviceid']) ? $_REQUEST['deviceid'] : '';
	$response			= $bb->Device('Connect', $deviceid);
	$responseObject		= json_decode($response);
}
# Handle pairing confirmation
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'pair')
{
	$deviceid			= isset($_REQUEST['deviceid']) ? $_REQUEST['deviceid'] : '';
	$code				= isset($_REQUEST['code']) ? $_REQUEST['code'] : '';
	$response			= $bb->Device('PairResponse', $deviceid, $code);
	$responseObject		= json_decode($response);
}
# Handle inital registration
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'register')
{
	$deviceid			= isset($_REQUEST['deviceid']) ? $_REQUEST['deviceid'] : '';
	$applicationid		= isset($_REQUEST['applicationid']) ? $_REQUEST['applicationid'] : '';
	$label				= isset($_REQUEST['label']) ? $_REQUEST['label'] : '';
	$icon				= isset($_REQUEST['icon']) ? $_REQUEST['icon'] : '';
	$type				= isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
	$response			= $bb->Device('Connect', $deviceid, $applicationid, $label, $icon, $type);
	$responseObject		= json_decode($response);
}

# If not connected
if (!isset($_REQUEST['deviceid']) || isset($responseObject) && is_object($responseObject) && isset($responseObject->error))
{
?>
<html>
	<body>
		<h1>You are Not Connected</h2>
		<p><strong>1. Pair a New Device</strong></p>
		<form method="POST" action="complex.php?action=register">
			<input type="text" name="deviceid" />deviceid<br />
			<input type="text" name="applicationid" />applicationid<br />
			<input type="text" name="label" />label<br />
			<input type="text" name="icon" />icon<br />
			<select name="type">
				<option>Select Type</option>
				<option>tablet</option>
				<option>phone</option>
				<option>remote</option>
				<option>other</option>
			</select>
			<br />
			<input type="submit" />
		</form>
		<p>or</p>
		<p><strong>2. Complete a New Device Pairing</strong></p>
		<form method="POST" action="complex.php?action=pair">
			<input type="text" name="deviceid" value="<?php echo (isset($_REQUEST['deviceid']) && isset($_REQUEST['action']) && $_REQUEST['action'] == 'register') ? $_REQUEST['deviceid'] : ''; ?>" />deviceid<br />
			<input type="text" name="code" />type<br />
			<input type="submit" />
		</form>
		<p>or</p>
		<p><strong>3. Use a Paired Device</strong></p>
		<form method="POST" action="complex.php?action=restore">
			<input type="text" name="deviceid" value="<?php echo (isset($_REQUEST['deviceid']) && isset($_REQUEST['action']) && $_REQUEST['action'] == 'pair') ? $_REQUEST['deviceid'] : ''; ?>" />deviceid<br />
			<input type="submit" />
		</form>
<?php
}
# If connected, issue Input.NavigationState Query
else
{
?>
		<h1>You are Connected</h2>
		<p>Choose Action:</p>
		<form method="POST" action="complex.php?action=restore">
			<input type="submit" name="method" value="NavigationState" />
			<input type="submit" name="method" value="Home" />
			<input type="submit" name="method" value="Back" />
			<input type="submit" name="method" value="MouseClick" /><br />
			<input type="submit" name="method" value="Up" />
			<input type="submit" name="method" value="Down" />
			<input type="submit" name="method" value="Left" />
			<input type="submit" name="method" value="Right" />
			<input type="submit" name="method" value="Unpair" />
			<input type="hidden" name="deviceid" value="<?php echo $_REQUEST['deviceid']; ?>" />
		</form>
<?php
	# Handle NavigationState method
	if (!isset($_REQUEST['method']) || $_REQUEST['method'] == 'NavigationState')
	{
		$response			= $bb->Input('NavigationState');
		$responseObject		= json_decode($response);
?>
		<p>Input.NavigationState:</p>
		<p>Keys Enabled: <?php echo $responseObject->result->state->{'keys-enabled'}; ?></p>
		<p>Mouse Enabled: <?php echo $responseObject->result->state->{'mouse-enabled'}; ?></p>
<?php
	}
	# Handle Home method
	elseif (!isset($_REQUEST['method']) || $_REQUEST['method'] == 'Home')
	{
		$response			= $bb->Input('Home');
	}
	# Handle Back method
	elseif (!isset($_REQUEST['method']) || $_REQUEST['method'] == 'Back')
	{
		$response			= $bb->Input('Back');
	}
	# Handle Back method
	elseif (!isset($_REQUEST['method']) || $_REQUEST['method'] == 'MouseClick')
	{
		$response			= $bb->Input('MouseClick');
	}
	# Handle Back method
	elseif (!isset($_REQUEST['method']) || $_REQUEST['method'] == 'Up')
	{
		$response			= $bb->Input('Up');
	}
	# Handle Back method
	elseif (!isset($_REQUEST['method']) || $_REQUEST['method'] == 'Down')
	{
		$response			= $bb->Input('DOwn');
	}
	# Handle Back method
	elseif (!isset($_REQUEST['method']) || $_REQUEST['method'] == 'Left')
	{
		$response			= $bb->Input('Left');
	}
	# Handle Back method
	elseif (!isset($_REQUEST['method']) || $_REQUEST['method'] == 'Right')
	{
		$response			= $bb->Input('Right');
	}
	# Handle Unpair method
	elseif (!isset($_REQUEST['method']) || $_REQUEST['method'] == 'Unpair')
	{
		$response			= $bb->Device('Unpair', $_REQUEST['deviceid']);
	}
}

# If an API call was attempted
if (isset($response))
{
?>
		<h1>Received Data</h1>
		<p><?php echo $response; ?></p>
<?php
}
?>
	</body>
</html>