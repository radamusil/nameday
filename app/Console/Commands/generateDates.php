<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Nameday;

class generateDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'namedays:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates all namedays with data from nameday.abalin.net';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //clear namedays table
        Nameday::truncate();

        //Prepare time varibles and period of whole year in which we want to get the data
        $now = Carbon::today();
        $start = $now->copy()->firstOfYear();
        $end = $now->copy()->endOfYear();
        $period = CarbonPeriod::create($start, $end);

        //create a row in table namedays for each day of the year
        foreach ($period as $date) {
            $nameday = new Nameday;
            $nameday->day = $date->day;
            $nameday->month = $date->month;
            //get name from the api nameday.abalin.net for specific day
            $response = Http::get('https://nameday.abalin.net/api/V1/getdate', [
                'day'=> "$nameday->day",
                'month'=> "$nameday->month",
                'country'=> 'sk',
            ]);
            
            $body = $response->throw()->getBody();
            $name = json_decode((string) $response)->nameday->sk;    
            $nameday->name = $name;
            $nameday->save();
        }
    }
}
