<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\piutang;
use App\Models\User;
use App\Models\nasabah;
use App\Models\transaksi;

class piutangCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'piutang:cron';

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
            $jumlah_pinjaman = nasabah::where('karyawan_id', $k)->get();
            $jp     = $jumlah_pinjaman->sum('sisa_pinjaman');
            $transaksi = transaksi::where('karyawan_id', $k)->where('tanggal', $today)->with('nasabah')->get();
            $pendapatan = $transaksi->sum('jumlah_pembayaran');
            
            piutang::create([
                'karyawan_id' => $k,
                'Pendapatan'  => $pendapatan,
                'Piutang'     => $jp,
            ]);    
           
           
        }
    }
}
