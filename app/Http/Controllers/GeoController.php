<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeoController extends Controller
{
    public static function getCity()
    {
        $geojson = file_get_contents("http://api.ipstack.com/check?access_key=42fa7efcac0f85a67e38857d619984ca");
        $jsondata = json_decode($geojson);
        $city = $jsondata->city;
        return $city;
    }
}
