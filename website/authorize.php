<!DOCTYPE html>
<?php
	//ini_set('display_errors', 1);
	//ini_set('display_startup_errors', 1);
	//error_reporting(E_ALL);

	$clientId = "10101010acb39bc818e57892";
	$clientSecret = "1010101010ababababababab";
		
	require_once("Netatmo/autoload.php");
	use Netatmo\Clients\NAWSApiClient;
	use Netatmo\Exceptions\NAClientException;

	$config = array (
		"client_id" => $clientId, 
		"client_secret" => $clientSecret, 
		"scope" => "read_station"
	);
	$client = new NAWSApiClient($config);

	if(isset($_GET["code"]))
	{
		try
		{
			$tokens = $client->getAccessToken();
			$refresh_token = $tokens["refresh_token"];
			$access_token = $tokens["access_token"];
		}
		catch(Netatmo\Exceptions\NAClientException $ex)
		{
			echo "An error occured while trying to retrieve your tokens <br>";
		}
	}
	else if(isset($_GET["error"]))
	{
		if($_GET["error"] === "access_denied")
		{
			echo "You refused that this application access your Netatmo Data";
		}
		else echo "An error occured <br>";
	}
	else
	{
		// redirect to Netatmo Authorize URL
		$redirect_url = $client->getAuthorizeUrl();
		header("HTTP/1.1 ". OAUTH2_HTTP_FOUND);
		header("Location: ". $redirect_url);
		die();
	}
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Netatmo Authorization</title>
	<link rel="icon" href="favicon.ico">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.10/css/weather-icons.min.css">
	<!--[if lt IE 9]>
		<script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 text-center"><h3>refresh_token: <?php echo $tokens["refresh_token"]; ?></h3></div>
		</div>
	</div>	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>