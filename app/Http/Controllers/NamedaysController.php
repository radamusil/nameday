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
        $now = Carbon::today();
        $nameday = Nameday::where('day', $now->day)
                            ->where('month', $now->month)
                            ->first();

        return view('index', compact('nameday', 'now'));
    }

    public function api() {
        $names = Nameday::get();

        return $names;
    }

    public function search(Request $request) {
        $term = $request->input('search');
        $nameday = Nameday::where('name','LIKE','%'.$term.'%')
        ->first();
        
        return view('name', compact('nameday'));
    }
}
