<?php

namespace App\Services\Weather;

interface WeatherInterface
{
    public function getTemperature(string $city);
}