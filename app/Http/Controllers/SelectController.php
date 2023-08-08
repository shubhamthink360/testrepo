<?php

namespace App\Http\Controllers;

use App\Models\World\Country;
use App\Models\World\State;

use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function getCountries()
    {
        $countries = Country::whereNotIn('name', ['India'])->get();
        return response()->json($countries);
    }

    public function getStates($country_id)
    {
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }
}
