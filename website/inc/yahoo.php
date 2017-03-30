<?php
	// https://developer.yahoo.com/apps/jLeJoM4u/
	//$clientID = "dj2yJmk9aEdiU1VRODg5RUk0JmQ9WVdrOVpITTNZbXgyTjJjbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD0zYg--";
	//$clientSecret = "b7dec9d002316dda9a83d4fccd5a95d1329d3b5a";
	
	$yahoo = "https://query.yahooapis.com/v1/public/yql?q=";
	$woeid = "729636"; // https://query.yahooapis.com/v1/public/yql?q=select%20woeid%20from%20geo.places(1)%20where%20text%3D%22haarlem%2C%20nl%22&format=json
	$query = "select%20*%20from%20weather.forecast%20where%20woeid%20=".$woeid."&format=json";
	
	$json = file_get_contents($yahoo.$query);
	$obj = json_decode($json, true);
	
	// handle empty result by seting a refresh header
	$count = $obj["query"]["count"];
	if ($count != 1) {
		$class = "wi-refresh";
		$alt = "Loading...";
		header("Refresh:1");
	} else {
		//$condition = $obj["query"]["results"]["channel"]["item"]["condition"];
		$condition = $obj["query"]["results"]["channel"]["item"]["forecast"][0];
		$code = $condition["code"];
		//$icon = "http://l.yimg.com/a/i/us/we/52/".&code.".gif";
		$alt = $condition["text"];
		
		// determine day or night icon
		$icon = $timeofday;
		if ($icon == "night")
		{
			// night-alt icons are prettier
			$icon .= "-alt";
		}

		// https://developer.yahoo.com/weather/documentation.html#codes
		// http://erikflowers.github.io/weather-icons/	
		// http://erikflowers.github.io/weather-icons/api-list.html
		switch ($code) {
			case 0:
				$class = "wi-tornado";
				break;
			case 1:
			case 37:
			case 38:
			case 39:
			case 45:
			case 47:
				$class = "wi-".$icon."-storm-showers";
				break;
			case 2:
				$class = "wi-hurricane";
				break;
			case 3:
			case 4:
				$class = "wi-thunderstorm";
				break;
			case 5:
			case 6:
			case 7:
			case 18:
			case 35:
				$class = "wi-rain-mix";
				break;
			case 8:
			case 10:
			case 17:
				$class = "wi-hail";
				break;
			case 9:
			case 11:
			case 12:
			case 40:
				$class = "wi-showers";
				break;
			case 13:
			case 16:
			case 42:
			case 46:
				$class = "wi-snow";
				break;
			case 14:
				$class = "wi-".$icon."-snow";
				break;
			case 15:
			case 41:
			case 43:
				$class = "wi-snow-wind";
				break;
			case 19:
				$class = "wi-dust";
				break;
			case 11:
			case 12:
			case 40:
				$class = "wi-showers";
				break;
			case 13:
			case 16:
			case 41:
			case 43:
				$class = "wi-snow";
				break;
			case 17:
				$class = "wi-hail";
				break;
			case 19:
				$class = "wi-dust";
				break;
			case 20:
				$class = "wi-fog";
				break;
			case 21:
				$class = "wi-windy";
				break;
			case 22:
				$class = "wi-smoke";
				break;
			case 23:
			case 24:
				$class = "wi-strong-wind";
				break;
			case 25:
				$class = "wi-snowflake-cold";
				break;
			case 26:
				$class = "wi-cloudy";
				break;
			case 27:
			case 28:
			case 29:
			case 30:
				$class = "wi-".$icon."-cloudy";
				break;
			case 31:
				$class = "wi-night-clear";
				break;
			case 32:
				if ($icon == "day") $class = "wi-day-sunny";
				else $class = "wi-night-clear";
				break;
			case 33:
				$class = "wi-".$icon."-partly-cloudy";
				break;
			case 34:
			case 44:
				if ($icon == "day") $class = "wi-day-sunny-overcast";
				else $class = "wi-night-alt-partly-cloudy";
				break;				
			case 36:
				$class = "wi-hot";
				break;				
			case 44:
				$class = "wi-cloud";
				break;
			case 3200:
				$class = "wi-na";
				break;
			default: 
				$class = "wi-day-cloudy-gusts";
		}
	}
?>
