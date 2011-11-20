<?php
/*
 *  File:			browser.php
 *  Description:	BoxeeBox JSONRPC API Browser
 *  Author:			Nicholas Robinson 11/19/2011
 */

/************************************************
*					EXECUTION					*
************************************************/

# Process browser queries
if (isset($_REQUEST['hostname']) && isset($_REQUEST['service']) && isset($_REQUEST['method']))
{
	# Initialise payload array
	$payload = array();

	# Initialise repsonse array
	$response = array();
	$response['success'] = false;

	# Normalize hostname
	if (isset($_REQUEST['hostname']))
		$payload['hostname']		= $_REQUEST['hostname'];
	# Normalize deviceid
	if (isset($_REQUEST['deviceid']))
		$payload['deviceid']		= $_REQUEST['deviceid'];
	else
		$payload['deviceid']		= '';
	# Normalize service
	if (isset($_REQUEST['service']))
		$payload['service']		= $_REQUEST['service'];
	# Normalize method
	if (isset($_REQUEST['method']))
		$payload['method']		= $_REQUEST['method'];
		
	# If JSON Encoded parameters are detected
	if (isset($_REQUEST['parameters']) && $_REQUEST['parameters'] != 'null' && $_REQUEST['parameters'] != '')
	{
		$payload['parameters'] = json_decode($_REQUEST['parameters'], true);
		# Throw exception if invalid JSON
		if ($payload['parameters'] === null)
			throw new Exception('Invalid JSON');
		# Normalize parameters
		if (!is_array($payload['parameters']))
			$payload['parameters'] = array($payload['parameters']);
	}
	# Otherwise set parameters to null
	else
		$payload['parameters'] = array();

	# If a payload is present
	if (!empty($payload))
	{
		# Validate Payload
		if (!isset($payload['service']))
			$response['error'] = 'SERVICE_MISSING';
		elseif (!isset($payload['method']))
			$response['error'] = 'METHOD_MISSING';
		elseif (!isset($payload['parameters']))
			$response['error'] = 'PARAMETERS_MISSING';
		else
		{
			# Include BoxeeBoxPHPJSONRPC class
			require_once('../BoxeeBoxPHPJSONRPC.class.php');
			# Attempt to execute
			try 
			{
				# Connect to BoxeeBox
				$bb = new BoxeeBoxPHPJSONRPC($payload['hostname']);
				# Restore pre-existing sessions
				if ($payload['deviceid'] != 'null')
				{
					$bb->Device('Connect', $payload['deviceid']);
				}
				# Issue JSONRPC.Ping Query
				array_unshift($payload['parameters'], $payload['method']);
				$output = call_user_func_array(array($bb, $payload['service']), $payload['parameters']);
			}
			# Catch exceptions
			catch (Exception $error)
			{
				$output = 'CONNECTION ERROR';
			}
		}
	}
	# Otherwise indicate error
	else
	{
		$response['error'] = 'PAYLOAD_MISSING';
	}

	# Return output
	die($output);
}

/************************************************
*					BROWSER 					*
************************************************/

# Initialise variables
$services = array();
$method_blacklist = array('__construct');

# Fetch list of PHP class filenames in the services directory
$services_filenames = glob('../Services/*.class.php');
# Iterate through class filenames
foreach ($services_filenames as $services_filename)
{
	# Declare class
	require_once($services_filename);
	# Extract class name from filename
	$class_name = str_replace('.class.php', '', str_replace('../Services/', '', $services_filename));
	# Ignore Base Class
	if (strpos($class_name, 'Base') === false)
	{
		# Create reflection class
		$reflection_class = new ReflectionClass($class_name);
		# Extract Doc comments
		$class_description = trim(str_replace("\0", '', str_replace("\t", '', str_replace("\r", '', str_replace("\n", '', str_replace('*', '', str_replace('*/', '', str_replace('/*', '', $reflection_class->getDocComment()))))))));
		# Add class to services array
		$services[$class_name] = array();
		$services[$class_name]['methods'] = array();
		$services[$class_name]['description'] = $class_description;
		# Get methods
		$reflection_methods = $reflection_class->getMethods(ReflectionMethod::IS_PUBLIC);
		# Iterate through reflection methods
		foreach ($reflection_methods as $reflection_method)
		{
			# If method is not blacklisted
			if (!in_array($reflection_method->getName(), $method_blacklist))
			{
				# Extract Doc comments
				$method_comments = str_replace('*', '', str_replace('*/', '', str_replace('/*', '', $reflection_method->getDocComment())));
				$method_comments_array_1 = explode('@return', $method_comments);
				$method_comments_array_2 = explode('@param', $method_comments_array_1[0]);
				$method_description = trim(str_replace("\0", '', str_replace("\t", '', str_replace("\r", '', str_replace("\n", '', $method_comments_array_2[0])))));
				$method_return_description = trim(str_replace("\0", '', str_replace("\t", '', str_replace("\r", '', str_replace("\n", '', $method_comments_array_1[1])))));
				# Add method to services array
				$services[$class_name]['methods'][$reflection_method->getName()] = array();
				$services[$class_name]['methods'][$reflection_method->getName()]['parameters'] = array();
				$services[$class_name]['methods'][$reflection_method->getName()]['description'] = $method_description;
				$services[$class_name]['methods'][$reflection_method->getName()]['return_description'] = $method_return_description;
				# Get parameters
				$reflection_parameters = $reflection_method->getParameters();
				# Iterate through reflection parameters
				foreach ($reflection_parameters as $index => $reflection_parameter)
				{
					# Extract Doc comments
					$parameters_comments = trim(str_replace("\0", '', str_replace("\t", '', str_replace("\r", '', str_replace("\n", '', str_replace('$' . $reflection_parameter->getName(), '', $method_comments_array_2[(isset($method_comments_array_2[$index + 1]) ? $index + 1 : $index)]))))));
					# Add parameter to services array
					$services[$class_name]['methods'][$reflection_method->getName()]['parameters'][$reflection_parameter->getName()] = array();
					$services[$class_name]['methods'][$reflection_method->getName()]['parameters'][$reflection_parameter->getName()]['description'] = $parameters_comments;
				}
			}
		}
	}
}
?>

<html>
	<head>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
		<script type="text/javascript">
			// Copy services to javascript
			<?php
				echo 'var services = new Array();' . PHP_EOL;
				foreach ($services as $service_name => $service_content)
				{
					echo '			services[\'' . $service_name . '\'] = new Array();' . PHP_EOL;
					echo '			services[\'' . $service_name . '\'][\'methods\'] = new Array();' . PHP_EOL;
					echo '			services[\'' . $service_name . '\'][\'description\'] = \'' . htmlspecialchars($service_content['description'], ENT_QUOTES) . '\';' . PHP_EOL;
					foreach ($service_content['methods'] as $method_name => $method_content)
					{
						echo '			services[\'' . $service_name . '\'][\'methods\'][\'' . $method_name . '\'] = new Array();' . PHP_EOL;
						echo '			services[\'' . $service_name . '\'][\'methods\'][\'' . $method_name . '\'][\'parameters\'] = new Array();' . PHP_EOL;
						echo '			services[\'' . $service_name . '\'][\'methods\'][\'' . $method_name . '\'][\'description\'] =  \'' . htmlspecialchars($method_content['description'], ENT_QUOTES) . '\';' . PHP_EOL;
						echo '			services[\'' . $service_name . '\'][\'methods\'][\'' . $method_name . '\'][\'return_description\'] =  \'' . htmlspecialchars($method_content['return_description'], ENT_QUOTES) . '\';' . PHP_EOL;
						foreach ($method_content['parameters'] as $parameter_name => $parameter_content)
						{
							echo '			services[\'' . $service_name . '\'][\'methods\'][\'' . $method_name . '\'][\'parameters\'][\'' . $parameter_name . '\'] = new Array();' . PHP_EOL;
							echo '			services[\'' . $service_name . '\'][\'methods\'][\'' . $method_name . '\'][\'parameters\'][\'' . $parameter_name . '\'][\'description\'] =  \'' . htmlspecialchars($parameter_content['description'], ENT_QUOTES) . '\';' . PHP_EOL;
						}
					}
				}
			?>
			// Ready Behaviour
			$(document).ready(function()
			{
				// Populate Service Drop-down
				$("#service").html('');
				$('<option>Select Service</option>').appendTo("#service");
				for (var service in services)
				{
					$('<option>' + service + '</option>').appendTo("#service");
				}
				
				// Hide dependent inputs
				$(".method").hide();
				$(".parameters").hide();
				$(".execute").hide();
				
				// Create service select change handler
				$("#service").live('change', function(event)
				{
					// Hide execute
					$(".execute").hide();
					// Hide arguments
					$(".parameters").hide();
					$("#parameters").html('');
					// Hide prototype
					$("#prototype").html('');
					// Populate Service Drop-down
					$("#method").html('');
					$('<option>Select Method</option>').appendTo("#method");
					var service = $("#service").val();
					if (service == "Select Service")
					{
						$(".method").hide();
						return false;
					}
					for (var method in services[service]['methods'])
					{
						$('<option>' + method + '</option>').appendTo("#method");
					}
					$(".method").show();
				});
				
				// Create method select change handler
				$("#method").live('change', function(event)
				{
					// Hide prototype
					$("#prototype").html('');
					// Populate Service Drop-down
					$("#parameters").html('This method takes no parameters...');
					$("#descriptions").html('');
					var service = $("#service").val();
					var method = $("#method").val();
					if (method == "Select Method")
					{
						$(".parameters").hide();
						$(".execute").hide();
						return false;
					}
					if (typeof services[service]['methods'][method]['description'] != "undefined")
						$('<em>' + services[service]['methods'][method]['description'] + '</em><br />').appendTo("#prototype");
					$('<strong>' + service + '::' + method + '(' + '</strong>').appendTo("#prototype");
					$("#parameters").html('');
					if (!$.isEmptyObject(services[service]['methods'][method]['parameters']))
					{
						for (var parameter in services[service]['methods'][method]['parameters'])
						{
							// Prep-populate Device service's deviceid parameter for convenience
							if (service == 'Device' && parameter == 'deviceid' && typeof window.deviceid != 'undefined')
							{
								$('<input type="text" class="parameter" name="' + parameter + '" value="' + window.deviceid + '" /> <em>' + parameter + '</em><br />').appendTo("#parameters");
							}
							else
							{
								$('<input type="text" class="parameter" name="' + parameter + '" /> <em>' + parameter + '</em><br />').appendTo("#parameters");
							}
							$('<strong>$' + parameter + ', ' + '</strong>').appendTo("#prototype");
							$('<em>' + services[service]['methods'][method]['parameters'][parameter]['description'] + '</em><br />').appendTo("#descriptions");
						}
						$("#prototype").html($("#prototype").html().substr(0, $("#prototype").html().length - 11));
					}
					else
						$('<em>This method takes no parameters</em>').appendTo("#parameters");
					$('<strong>);</strong><br />').appendTo("#prototype");
					$('<em>returns ' + services[service]['methods'][method]['return_description'] + '</em>').appendTo("#prototype"); 
					$(".execute").show();
					$(".parameters").show();
				});
				
				// Create execute click handler
				$("#execute").live('click', function(event)
				{
					execute();
				});
				
				// Create form submit handler
				$("#ui").live('submit', function(event)
				{
					execute();
					return false;
				});
				
				// Create clearQuery click handler
				$("#clearQuery").live('click', function(event)
				{
					$("#method").change();
				});
				
				// Create clearResults click handler
				$("#clearResults").live('click', function(event)
				{
					$("#results").html('');
				});
				
				// Create hostname keypress handler
				$('.hostname').live('keypress', function (e) {
					var code = (e.keyCode ? e.keyCode : e.which);
					if (code == 13) 
						return false;
				});

				// Create parameter keypress handler
				$('.parameter').live('keypress', function (e) {
					var code = (e.keyCode ? e.keyCode : e.which);
					if (code == 13) 
						$('#execute').click();
				});
			});
			
			function execute()
			{
				// Extract Form Values
				var hostname = $("#hostname").val();
				var service = $("#service").val();
				var method = $("#method").val();
				var parameters = new Array();
				var parameterList = new Array();
				var parameterValue = '';
				// Extract form parameter values
				for (var parameter in services[service]['methods'][method]['parameters'])
				{
					// Ensure Device.PairResponse code is treated as a string
					if (service == 'Device' && method == 'PairResponse' && parameter == 'code')
					{
						parameterValue = '"' + $("[name=" + parameter + "]").val() + '"';
					}
					else
					{
						parameterValue = $("[name=" + parameter + "]").val();
					}
					parameterList.push('"' + parameter + '": ');
					parameters.push(parameterValue);
					// Retain Connect deviceid for future use
					if (service == 'Device' && method == 'Connect' && parameter == 'deviceid')
					{
						window.deviceid = parameterValue;
					}
				}
				// Create JSON encoded parameters payload
				var jsonPayload = '[';
				// Encode each parameter dependent on type
				for (var i in parameters)
				{
					var parameter = parameters[i];
					// If parameter encapsulated by double quotes or is an Object or numeric
					if (	(parameter[0] == '"' && parameter[parameter.length - 1] == '"')
						||	(parameter[0] == '{') || (parameter[0] == '[')
						||	((parameter - 0) == parameter && parameter.length > 0)	)
					{
						parameterList[i] += parameter;
						jsonPayload = jsonPayload + parameter + ((i < parameters.length - 1) ? ',' : '');
					}
					// Otherwise treat as a string
					else
					{
						parameterList[i] += '"' + parameter + '"';
						jsonPayload = jsonPayload + '"' + parameter + '"' + ((i < parameters.length - 1) ? ',' : '');
					}
				}
				jsonPayload = jsonPayload + ']'; 
				// Output Query
				var query = '{"jsonrpc": "2.0", "method": "' + service + '.' + method + '", "params": {' + parameterList + '}, "id": 1}';
				$('<p>Sent:<br /><span class="query">' + query + '</p><hr class="results" />').prependTo("#results");
				// POST to API with JSON encoded query object
				$.ajax({
					type: 'POST',
					url: '',
					data:	{
							'hostname' : hostname,
							'service' : service,
							'method' : method,
							'parameters' : jsonPayload,
							'deviceid' : (typeof window.deviceid != 'undefined' ? window.deviceid : '')
							},
					success: 
						function(result) 
						{
							// Output result
							$('<p>Received:<br /><span class="' + (result.match(/error/i) ? 'error' : 'result') + '">' + jsonReadable(result) + '</p>').prependTo("#results");
						},
					dataType: 'text'
				});
			}
			
			// Format json_encoded string for human consumption
			function jsonReadable(json)
			{
				// Initialise helper parameters
				tabcount = 1; 
				result = ''; 
				inquote = false; 
				ignorenext = false; 
				
				// Define tab and newline characters
				tab = "&nbsp;&nbsp;&nbsp;&nbsp;"; 
				newline = "<br/>"; 
				
				// Iterate through json string
				for(var i = 0; i < json.length; i = i + 1) 
				{
					// Extract current character
					char = json[i]; 
					// Handle escaped strings
					if (ignorenext)
					{ 
						result = result + char; 
						ignorenext = false; 
					}
					// Otherwise 
					else
					{
						// Handle specific cases
						switch(char)
						{ 
							 case '[': 
								tabcount = tabcount + 1;
								result = result + newline + new Array(tabcount - 1).join(tab) + char + newline + new Array(tabcount).join(tab); 
								break; 
							case '{': 
								tabcount = tabcount + 1;
								result = result + (i > 0 ? newline : '') + new Array(tabcount - 1).join(tab) + char + newline + new Array(tabcount).join(tab); 
								break; 
							case '}': 
								tabcount = tabcount - 1; 
								result = $.trim(result) + newline + new Array(tabcount).join(tab) + char; 
								break; 
							case ']': 
								tabcount = tabcount - 1; 
								result = $.trim(result) + newline + new Array(tabcount).join(tab) + char; 
								break; 
							case ',': 
								result = result + char + newline + new Array(tabcount).join(tab); 
								break; 
							case '"': 
								inquote = !inquote; 
								result = result + char; 
								break; 
							case '\\': 
								if (inquote) ignorenext = true; 
								result = result + char; 
								break;
							default: 
								result = result + char; 
						} 
					} 
				} 
				// Return
				return result; 
			} 
		</script>
		<style type="text/css">
		<!--
			strong {
				font-size:20px;
			}
			hr {
				border:1px solid;
			}
			table {
				border:none;
				border-spacing:0px;
				margin:0px;
				padding:0px;
			}
			td {
				margin:0px;
				padding:0px
			}
			th {
				text-align:right;
				vertical-align:top;
				padding-right:5px;
			}
			.query {
				color:#00f;
			}
			.result {
				color:#0c8;
			}
			.error {
				color:#f00;
			}
			hr.results {
				border:1px dashed;
			}
			.service {
				height:32px;
				vertical-align: top;
			}
			.method {
				height:28px;
				vertical-align: top;
			}
			.hostname {
				width:300px;
				height:29px;
				line-height:30px;
				border: #ccc 1px solid;
				background: #eee;
			}
			.parameter {
				width:300px;
				height:29px;
				line-height:30px;
				border: #ccc 1px solid;
				background: #eee;
			}
			#prototype {
				vertical-align:middle;
			}
			#descriptions {
				vertical-align:top;
				line-height:30px;
			}
		-->
		</style>
	</head>
	<body>
		<h2>API Call:</h2>
		<form name="ui" id="ui">
			<table>
				<tr>
					<th width="100">Hostname: </th>
					<td width="500"><input name="hostname" class="hostname" id="hostname" value="boxeebox" /></td>
					<td rowspan="3" id="prototype"></td>
				</tr>
				<tr class="service">
					<th width="100">Service: </th>
					<td width="500"><select name="service" class="parameter" id="service"></select></td>
				</tr>
				<tr class="method">
					<th>Method: </th>
					<td><select name="method" class="parameter" id="method"></select></td>
				</tr>
				<tr class="parameters">
					<th>Parameters: </th>
					<td><div id="parameters"></div></td>
					<td id="descriptions"></td>
				</tr>
				<tr class="execute">
					<th>&nbsp;</th>
					<td><input type="button" name="execute" id="execute" value="Execute" /><input type="button" name="reset" id="clearQuery" value="Reset" /></td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</form>
		<hr />
		<h2>Results:</h2>
		<input type="button" name="clear" id="clearResults" value="Clear" />
		<div id="results"></div>
	</body>
</html>