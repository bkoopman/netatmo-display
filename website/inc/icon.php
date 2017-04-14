<?php
	$appId = "1111111111";
	$apiUrl = "http://api.openweathermap.org/data/2.5/weather";
	$cityId = "2755003";  // Haarlem, NL
		
	$json = file_get_contents($apiUrl."?id=".$cityId."&appid=".$appId);
	$obj = json_decode($json, true);
	//print_r($obj);
	//$code = $obj["weather"][0]["id"];
	$icon = $obj["weather"][0]["icon"];
	//$alt = $obj["weather"][0]["main"];
	$alt = $obj["weather"][0]["description"];
	//$iconUrl = "//openweathermap.org/img/w/".$icon.".png";

	// http://openweathermap.org/weather-conditions#Icon-list
	// http://erikflowers.github.io/weather-icons/	
	switch ($icon) {
		case "01d":
			$class = "wi-day-sunny";
			break;
		case "01n":
			$class = "wi-night-clear";
			break;
		case "02d":
			$class = "wi-day-cloudy";
			break;
		case "02n":
			$class = "wi-night-alt-cloudy";
			break;
		case "03d":
		case "03n":
			$class = "wi-cloud";
			break;
		case "04d":
		case "04n":
			$class = "wi-cloudy";
			break;
		case "09d":
		case "09n":
			$class = "wi-rain";
			break;
		case "10d":
			$class = "wi-day-rain";
			break;
		case "10n":
			$class = "wi-night-alt-rain";
			break;
		case "11d":
			$class = "wi-day-storm-showers";
			break;
		case "11n":
			$class = "wi-night-alt-storm-showers";
			break;
		case "13d":
			$class = "wi-day-snow";
			break;
		case "13n":
			$class = "wi-night-alt-snow";
			break;
		case "50d":
		case "50n":
			$class = "wi-fog";
			break;
		default: 
			$class = "wi-day-cloudy-gusts";
	}
?>
