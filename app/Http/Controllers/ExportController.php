<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\transaksi;
use App\Models\noTransaksi;
use App\Models\nasabah;
class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tabungan()
    {
        $authID  = Auth::user()->id;
        $nasabah = nasabah::where('karyawan_id', $authID)->with('tabungan')->get();
        return view('export.exportTabungan', compact('nasabah'));
    }


    public function trsprint(Request $request){

       $dari = $request->dari;
       $sampai = $request->sampai;

        $authID  = Auth::user()->id;
        $transaksi = transaksi::where('karyawan_id', $authID)->whereBetween('tanggal',[$dari,$sampai])->with(['karyawan','nasabah'])->get();
        return view('export.exportTransaksi', compact('transaksi'));
    }
    
    public function notrsprint(Request $request){

 
        
        $authID  = Auth::user()->id;
        $transaksi = noTransaksi::where('karyawan_id', $authID)->whereBetween('tanggal',[$dari,$sampai])->with(['karyawan','nasabah'])->get();
        dd($transaksi);
        return view('export.exportTransaksi', compact('transaksi'));

    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
