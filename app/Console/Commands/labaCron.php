<?php

namespace App\Console\Commands;
// use Auth;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\laba;
use App\Models\nasabah;
use App\Models\transaksi;
class labaCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laba:cron';

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

        $karyawan = User::where('level', 'karyawan')->get();
        foreach($karyawan as $kry){
            $k = $kry->id;

            $today     = Carbon::now()->isoFormat('YYYY-MM-DD');
            $transaksi = transaksi::where('karyawan_id', $k)->where('tanggal', $today)->with('nasabah')->get();
            $pendapatan = $transaksi->sum('jumlah_pembayaran');
            $keuntungan = $pendapatan * 20/100;
            
            laba::create([
                'karyawan_id' => $k,
                'pendapatan'  => $pendapatan,
                'keuntungan'  => $keuntungan,
            ]);    
           
        }
        
       
    }
}
