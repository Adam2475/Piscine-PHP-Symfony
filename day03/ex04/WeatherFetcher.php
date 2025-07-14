<?php

require_once "vendor/autoload.php";

class WeatherFetcher
{
    private $apiKey;
    private $city;

    public function __construct($apiKey, $city = 'Florence')
    {
        $this->apiKey = $apiKey;
        $this->city = $city;
    }

    public function fetchAndSaveWeather()
    {
        $client = new RestClient();

        $params = [
            'unitGroup' => 'metric',
            'key' => $this->apiKey,
            'include' => 'current'
        ];

        $endpoint = "https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/{$this->city}/today";

        $result = $client->get($endpoint, $params);

        if ($result->info->http_code !== 200) {
            throw new Exception("API error: " . $result->response); // dump raw error
        }

        $data = json_decode($result->response);

        if (!isset($data->currentConditions)) {
            throw new Exception("Weather data not found in response.");
        }

        $temp = $data->currentConditions->temp;
        file_put_contents(__DIR__ . '/weather.txt', "Current temperature in {$this->city}: {$temp} °C");

        return $temp;
    }
}