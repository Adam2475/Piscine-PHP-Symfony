<?php

require_once 'WeatherFetcher.php';

$apiKey = 'KL9TFTGMUP82AWEN5GPFNU2L4'; // ← Replace this with your real API key
$city = 'Firenze';

try {
    $weather = new WeatherFetcher($apiKey, $city);
    $temp = $weather->fetchAndSaveWeather();
    echo "🌤️ Current temperature in $city: $temp °C\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}