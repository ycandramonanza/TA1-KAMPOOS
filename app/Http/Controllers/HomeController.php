<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\nasabah;
use App\Models\tabungan;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Jumlah Nasabah
    if(Auth::user()->level == 'karyawan'){
        $authID  = Auth::user()->id;
        $nasabah = nasabah::where('karyawan_id', $authID)->count();
        $karyawan = User::where('level', 'karyawan')->count();
        $transaksi = nasabah::where('karyawan_id', $authID)->with('transaksi')->get();
        $tabungan     = $transaksi->sum('jumlah_tabungan');
        // foreach($jmlh_transaksi as $jmlh){
        //     $trs = $jmlh->sum('jumlah_pinjaman');
        // };

        return view('dashboard.index', compact('karyawan', 'nasabah','transaksi','tabungan'));
    }
      
        // Jumlah Kayawan
     if(Auth::user()->level == 'admin'){
        $authID  = Auth::user()->id;
        $nasabah = nasabah::all()->count();
        $karyawan = User::where('level', 'karyawan')->count();
        $transaksi = nasabah::where('karyawan_id', $authID)->with('transaksi')->get();
        $tabungan     = $transaksi->sum('jumlah_tabungan');
        return view('dashboard.index', compact('karyawan', 'nasabah','transaksi','tabungan'));
     }
      
      
    }

}
