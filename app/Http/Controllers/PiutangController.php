<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\piutang;
use App\Models\User;
use App\Models\nasabah;
use App\Models\transaksi;
use Auth;
use Illuminate\Http\Request;

class PiutangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authID = Auth::user()->id;
        $piutang = piutang::where('karyawan_id', $authID )->orderBy('id', 'DESC')->get();
        $count = piutang::where('karyawan_id', $authID )->orderBy('id', 'DESC')->count();

        if($count == 0){
            
           $piutang_total = 0;
            return view('piutang.index', compact('piutang','piutang_total'));  
        }

        $piutang_total = $piutang[0]->Piutang;
        return view('piutang.index', compact('piutang','piutang_total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
