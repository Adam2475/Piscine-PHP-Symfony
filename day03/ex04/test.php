<?php

require_once 'WeatherFetcher.php';

$apiKey = 'KL9TFTGMUP82AWEN5GPFNU2L4';
$city = 'Milano';

$weather = new WeatherFetcher($apiKey, $city);
$temp = $weather->fetchAndSaveWeather();
echo "Current temperature in $city: $temp °C\n";

?>