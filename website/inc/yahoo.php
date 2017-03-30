<?php
	// https://developer.yahoo.com/apps/jLeJoM4u/
	//$clientID = "dj0yJmk9RVFTTVBsRzdYNmVtJmQ9WVdrOWFreGxTbTlOTkhVbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD03Mg--";
	//$clientSecret = "df7b9a9ed53d9a50778bceb66a6fa933e2c6843d";

	$yahoo = "https://query.yahooapis.com/v1/public/yql?q=";
	$woeid = "729636"; // https://query.yahooapis.com/v1/public/yql?q=select%20woeid%20from%20geo.places(1)%20where%20text%3D%22haarlem%$
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

		// https://developer.yahoo.com/weather/documentation.html#codes
		// http://erikflowers.github.io/weather-icons/
		switch ($code) {
			case 0:
				$class = "wi-tornado";
				break;
			case 1:
				$class = "wi-rain-wind";
				break;
			case 2:
				$class = "wi-hurricane";
				break;
			case 3:
			case 37:
			case 38:
				$class = "wi-thunderstorm";
				break;
			case 4:
			case 39:
			case 45:
			case 47:
				$class = "wi-storm-showers";
				break;
			case 5:
			case 35:
				$class = "wi-rain-mix";
				break;
			case 6:
			case 10:
			case 18:
				$class = "wi-sleet";
				break;
			case 7:
			case 8:
			case 14:
			case 15:
			case 42:
			case 46:
				$class = "wi-snow-wind";
				break;
			case 9:
				$class = "wi-sprinkle";
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
				$class = "wi-day-haze";
				break;
			case 22:
				$class = "wi-smoke";
				break;
			case 23:
			case 24:
				$class = "wi-windy";
				break;
			case 25:
				$class = "wi-snowflake-cold";
				break;
			case 26:
				$class = "wi-cloudy";
				break;
			case 27:
				$class = "wi-night-alt-cloudy";
				break;
			case 28:
			case 30:
				$class = "wi-day-cloudy";
				break;
			case 29:
				$class = "wi-night-alt-partly-cloudy";
				break;
			case 31:
			case 33:
				$class = "wi-night-clear";
				break;
			case 32:
				$class = "wi-day-sunny";
				break;
			case 34:
				$class = "wi-day-cloudy-high";
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
