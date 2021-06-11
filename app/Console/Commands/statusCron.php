<?php

namespace App\Console\Commands;
use App\Models\noTransaksi;
use Illuminate\Console\Command;

class statusCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        \Log::info("Cron is working fine!");

        $update = noTransaksi::all();
        $upd    = $update->all();
        foreach($upd as $u){
            $u->update([
                'status' => '0',
            ]);
        }

     
    }
}
