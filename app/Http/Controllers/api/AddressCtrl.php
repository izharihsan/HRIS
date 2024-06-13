<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Districts;
use App\Models\Village;

class AddressCtrl extends Controller
{
    public function getProvinces()
    {
        $provinces = Province::all(['id', 'name']);
        return response()->json($provinces, 200);
    }

    public function getCities($province_id)
    {
        $cities = City::where('province_id', $province_id)->get(['id', 'name']);
        return response()->json($cities, 200);
    }

    public function getDistricts($city_id)
    {
        $districts = Districts::where('city_id', $city_id)->get(['id', 'name']);
        return response()->json($districts, 200);
    }

    public function getVillages($district_id)
    {
        $villages = Village::where('district_id', $district_id)->get(['id', 'name']);
        return response()->json($villages, 200);
    }
}
