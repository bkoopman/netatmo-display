<!DOCTYPE html>
<?php
	//ini_set('display_errors', 1);
	//ini_set('display_startup_errors', 1);
	//error_reporting(E_ALL);

	$clientId = "10101010acb39bc818e57892";
	$clientSecret = "1010101010ababababababab";
	$refreshToken = "ababababab|2727272727";
	
	// Haarlem
	$lat = 52.3765;  // North
	$long = 4.6486;  // East
	date_default_timezone_set("GMT");
	$timeofday = dayOrNight($lat, $long);
		
	require_once("Netatmo/autoload.php");
	use Netatmo\Clients\NAWSApiClient;
	use Netatmo\Exceptions\NAClientException;

	$config = array (
		"client_id" => $clientId, 
		"client_secret" => $clientSecret, 
		"scope" => "read_station"
	);
	$client = new NAWSApiClient($config);
	
	$value = array (
		"refresh_token" => $refreshToken
	);
	$client->setTokensFromStore($value);
	
	try
	{
		$tokens = $client->getAccessToken();
		$refresh_token = $tokens["refresh_token"];
		$access_token = $tokens["access_token"];
		//echo "refresh_token=".$refresh_token." <br>";		
	}
	catch(Netatmo\Exceptions\NAClientException $ex)
	{
		echo "An error occured while trying to retrieve your tokens <br>".$ex;
	}
	
	// load data and use first available device
	$data = $client->getData(NULL, TRUE);
	$device = $data["devices"][0];
	$indoor = $device["dashboard_data"];
	$outdoor = $device["modules"][0]["dashboard_data"];
	$rain = $device["modules"][1]["dashboard_data"];
	
	//include "inc/icon.php";
	include "inc/yahoo.php";
	
	$css = "css/custom-medium.css";
	if (isset($_GET["bw"]))
	{
		$css = "css/custom-small-bw.css";
	}
	if (isset($_GET["s"]))
	{
		$css = "css/custom-small.css";
	}
	
	function dayOrNight($lat, $long)
	{
		$sunrise = date_sunrise(time(), SUNFUNCS_RET_DOUBLE, $lat, $long, 90.583333, 0);
		$sunset = date_sunset(time(), SUNFUNCS_RET_DOUBLE, $lat, $long, 90.583333, 0);
		$now = date("H") + date("i") / 60 + date("s") / 3600; 
		
		if ($sunrise < $sunset) 
		{
			if (($now > $sunrise) && ($now < $sunset)) return "day"; 
			else return "night";
		}
		else 
		{
			if (($now > $sunrise) || ($now < $sunset)) return "day"; 			
			else return "night";
		}
	} 
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Weather at <?php echo $device["station_name"]; ?></title>
	<link rel="icon" href="favicon.ico">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.10/css/weather-icons.min.css">
	<link rel="stylesheet" href="<?php echo $css; ?>">
	<!--[if lt IE 9]>
		<script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="<?php echo $timeofday; ?>">
	<div class="container-fluid">
		<div id="icon" class="row bg-primary" onclick="window.location.reload(true);">
			<div id="rain" class="col-xs-4 text-center">
<?php
	if (isset($rain["sum_rain_1"]))
	{
		$rainfall = $rain["sum_rain_1"];			
		if ($rainfall > 0)
		{
?>
				<span class="wi wi-raindrops" title="<?php echo round($rainfall, 1); ?> mm/h"></span>
<?php
		}
	}
?>
			</div>
			<div class="col-xs-4 text-center">
				<span class="wi <?php echo $class; ?>" title="<?php echo $alt; ?>"></span>
			</div>
			<div id="carbon" class="col-xs-4 text-center">
<?php
	$carbon = $indoor["CO2"];
	if ($carbon > 2000)
	{
?>
				<span class="wi wi-smoke" title="<?php echo $carbon; ?> ppm"></span>
<?php
	}
?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 text-center"><small>OUTDOOR</small><h2><?php echo $outdoor["Temperature"]; ?>&#176; <small>C</small></h2></div>
			<div class="col-xs-6 text-center"><small>INDOOR</small><h2><?php echo $indoor["Temperature"]; ?>&#176; <small>C</small></h2></div>
		</div>
		<div class="row">
			<div class="col-xs-6 text-center"><small>PRESSURE</small><h3><?php echo round($indoor["Pressure"]); ?> <small>mbar</small></h3></div>
			<div class="col-xs-6 text-center"><small>HUMIDITY</small><h2><?php echo $indoor["Humidity"]; ?> <small>%</small></h2></div>
		</div>
	</div>	
<?php  
	if (isset($_GET["data"]))
	{
?>
	<pre style="margin-top: 50px; width: 1280px;">
<?php 
		echo "Netatmo: \n";
		print_r($data);
		//echo "OpenWeatherMap: \n";
		echo "Yahoo Weather: \n";
		print_r($obj);
?>
	</pre>
<?php 
	} 
?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
		setInterval(function() { window.location.reload(true); }, 900000);  // refresh page every 15 minutes
	</script>
</body>
</html>
