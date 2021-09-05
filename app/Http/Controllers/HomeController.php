<?php

namespace App\Http\Controllers;

use App\Services\Weather\WeatherInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     */
    public function index(WeatherInterface $weather)
    {
        return view('home', ['weather' => $weather->getTemperature()]);
    }
}
