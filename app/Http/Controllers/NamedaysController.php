<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Nameday;

class NamedaysController extends Controller
{
    public function index()
    {
        //get todays date
        $now = Carbon::today();
        //get data for today
        $nameday = Nameday::where('day', $now->day)
                            ->where('month', $now->month)
                            ->first();

        return view('index', compact('nameday', 'now'));
    }

    public function api() {
        //send all namedays to search input
        $names = Nameday::get();

        return $names;
    }

    public function search(Request $request) {
        //search for the name from request
        $term = $request->input('search');
        $nameday = Nameday::where('name','LIKE','%'.$term.'%')
        ->first();

        return view('name', compact('nameday'));
    }
}
