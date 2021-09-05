<?php

namespace App\Services\Weather;

use GuzzleHttp\Client;

class OpenWeatherMapService implements WeatherInterface
{

    /**
     */
    public function getTemperature($city = 'Bryansk')
    {
        $api_key = env('OPEN_WEATHER_API_KEY');
        $client = new Client();
        $mode = "json"; // в каком виде мы получим данные
        $units = "metric"; // Единицы измерения. metric или imperial
        $lang = "ru";
        $res = $client->request('GET', "api.openweathermap.org/data/2.5/weather?q={$city}&mode=$mode&units=$units&lang=$lang&appid={$api_key}");
        return json_decode($res->getBody()->getContents());


    }
}