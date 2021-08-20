<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use DB;
class daily_spider_sign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily_spider_sign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'daily_spider_sign';

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
     * @return mixed
     */
    public function handle()
    {
        //
        $client = new Client();
        $date = date('Y-m-d');
        $four_part = ['all','love','job','lucky'];

        try {
            DB::begintransaction();
            for ($x = 0; $x <= 11; $x++) {
                $crawler = $client->request('GET', 'https://astro.click108.com.tw/daily_'.$x.'.php?iAcDay='.$date.'&iAstro='.$x);
                $sign = substr((string)$crawler->filter('.TODAY_CONTENT h3')->text(),2*3,3*3);
                $count = 0;
                $rt = [];
                foreach ($four_part as $key => $value){
                    $rt[$value.'_count'] = substr_count($crawler->filter('.TODAY_CONTENT p')->eq($count)->text(),'★');
                    $rt[$value.'_note'] =  $crawler->filter('.TODAY_CONTENT p')->eq($count+1)->text();
                    $count = $count+2;
                }
    
                $rt['date'] = $date;
                $rt['sign'] = $sign;
    
                $nrw = new \App\Models\sign_log;
                $nrw->fill($rt);
                $nrw->save();
            }
            DB::commit();

        }
        catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
       
    }
}
