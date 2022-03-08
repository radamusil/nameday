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
        Nameday::truncate();
        $now = Carbon::today();
        $start = $now->copy()->firstOfYear();
        $end = $now->copy()->endOfYear();
        $period = CarbonPeriod::create($start, $end);
        //dd($period );
        $dates = $period->toArray();

        foreach ($period as $date) {
            $nameday = new Nameday;
            $nameday->day = $date->day;
            $nameday->month = $date->month;

            $response = Http::get('https://nameday.abalin.net/api/V1/getdate', [
                'day'=> "$nameday->day",
                'month'=> "$nameday->month",
                'country'=> 'sk',
            ]);
            //dd($response);
            if ($response->status() != 200) {
                sleep(15);
            }
            $body = $response->getBody();
            $name = json_decode((string) $response)->nameday->sk;    
            $nameday->name = $name;
            $nameday->save();
        }
    }
}
