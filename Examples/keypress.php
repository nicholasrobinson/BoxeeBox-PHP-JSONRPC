<?php
/*
 *  File:			keypress.php
 *  Description:	jQuery KeyPress Example
 *  Author:			Nicholas Robinson 11/19/2011
 */
 
# Include BoxeeBoxPHPJSONRPC class
require_once('../BoxeeBoxPHPJSONRPC.class.php');

# Handle specified action
if (isset($_REQUEST['action']) && isset($_REQUEST['hostname']) && isset($_REQUEST['deviceid']))
{
	# Catch Exceptions
	try
	{
		# Connect to BoxeeBox
		$bb = new BoxeeBoxPHPJSONRPC($_REQUEST['hostname']);
		$bb->Device('Connect', $_REQUEST['deviceid']);
		# Extract action
		$action = $_REQUEST['action'];
		# Extract url (if set)
		$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';
		# Call appropriate API method
		switch($action)
		{
			case 'Home':
				$bb->Input('Home');
				break;
			case 'MouseClick':
				$bb->Input('MouseClick');
				break;
			case 'Back':
				$bb->Input('Back');
				break;
			case 'Up':
				$bb->Input('Up');
				break;
			case 'Down':
				$bb->Input('Down');
				break;
			case 'Left':
				$bb->Input('Left');
				break;
			case 'Right':
				$bb->Input('Right');
				break;
			case 'Play':
				$bb->XBMC('Play', $value, '');
				break;
			case 'TextFieldSet':
				$bb->GUI('TextFieldSet', $value);
				break;
			default:
				break;
		}
		# Output action
		echo $action;
	}
	catch (Exception $e)
	{
	}
	# Stop rendering
	die();
}

?>
<html>
	<head>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
		<script type="text/javascript">
			// Ready Behaviour
			$(document).ready(function()
			{
				// Create Play click handler
				$("#play").live('click', function(event)
				{
					// POST action to this script
					$.ajax({
						type: 'POST',
						url: '',
						data:	{
								'hostname' : $('#hostname').val(),
								'deviceid' : $('#deviceid').val(),
								'action' : 'Play',
								'value' : $("#url").val()
								},
						success: 
							function(result) 
							{
								// Output result
								console.log(result);
							},
						dataType: 'text'
					});
				});
				// Create TextFieldSet click handler
				$("#textfieldset").live('click', function(event)
				{
					// POST action to this script
					$.ajax({
						type: 'POST',
						url: '',
						data:	{
								'hostname' : $('#hostname').val(),
								'deviceid' : $('#deviceid').val(),
								'action' : 'TextFieldSet',
								'value' : $("#text").val()
								},
						success: 
							function(result) 
							{
								// Output result
								console.log(result);
							},
						dataType: 'text'
					});
				});
			});
			
			// Handle key-presses
			$(window).keydown(function(e)
			{
				var action = '';
				switch ( e.keyCode ) {
					case 192:
						action = 'Home';
						break;
					case 13:
						action = 'MouseClick';
						break;
					case 27:
						action = 'Back';
						break;
					case 38:
						action = 'Up';
						break;
					case 40:
						action = 'Down';
						break; 
					case 37:
						action = 'Left';
						break; 
					case 39:
						action = 'Right';
						break; 
					default:
						return;
						break;
				}
				// POST action to this script
				$.ajax({
					type: 'POST',
					url: '',
					data:	{
							'hostname' : $('#hostname').val(),
							'deviceid' : $('#deviceid').val(),
							'action' : action
							},
					success: 
						function(result) 
						{
							// Output result
							console.log(result);
						},
					dataType: 'text'
				});
			});
		</script>
	</head>
	<body>
		<h2>Use your Keyboard to Control your BoxeeBox</h2>
		<hr />
		<p>Ensure you pair your device first using <a href="complex.php">this</a>.
		<p>hostname: <input id="hostname" value="boxeebox" /></p>
		<p>deviceid: <input id="deviceid" value="" /></p>
		<hr />
		<p>url to play: <input id="url" value="" /><button type="button" id="play">Play</button></p>
		<p>set textfield: <input id="text" value="" /><button type="button" id="textfieldset">TextFieldSet</button></p>
		<hr />
		<p>&lt;up&gt; = Up</p>
		<p>&lt;down&gt; = Down</p>
		<p>&lt;left&gt; = Left</p>
		<p>&lt;right&gt; = Right</p>
		<p>&lt;enter&gt; = MouseClick</p>
		<p>&lt;escape&gt; = Back</p>
		<p>&lt;~&gt; = Home</p>
	</body>
</html>