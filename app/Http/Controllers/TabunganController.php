<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\tabungan;
use App\Models\nasabah;
use App\Http\Requests\TabunganRequest;
class TabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(nasabah $tabungan)
    {
        return view('tabungan.create', compact('tabungan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TabunganRequest $request, nasabah $tabungan)
    {
        $authID = Auth::user()->id;

        $tabungans      = intval($request->tabungan);
        $tabungan_awal = intval($tabungan->jumlah_tabungan);
        $total_tabungan = $tabungan_awal + $tabungans;

         $tabungan->update([
            'jumlah_tabungan'    => $total_tabungan,
        ]);

        $dompet = new tabungan;
        $dompet = tabungan::create([
            'nasabah_id'      => $tabungan->id,
            'karyawan_id'     => $authID,
            'simpan_tabungan' => $request->tabungan,
            'ambil_tabungan' =>  0,
            'tabungan'         => $total_tabungan,
        ]);

        return redirect()->route('jTAB')->with('pesan', "Tabungan $tabungan->nama Sudah Di tambahkan");
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
    public function edit(nasabah $tabungan)
    {
        return view('tabungan.ambil', compact('tabungan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TabunganRequest $request, nasabah $tabungan)
    {
        $authID = Auth::user()->id;
        $Ambil_tabungan = intval($request->tabungan);
        $tabungans      = intval($tabungan->jumlah_tabungan);
        $ambil          = $tabungans - $Ambil_tabungan;
     

        $nasabah_id = $tabungan->id;

        $dompet   = tabungan::where('nasabah_id',$nasabah_id )->orderBy('id', 'DESC')->first();
        $dompets = intval($dompet->tabungan);
        $ambilTab = $dompets - $Ambil_tabungan;

        if($ambil < 0){
            return redirect()->route('tabungan.edit', ['tabungan' => $tabungan])->with('danger', "Jumlah yang kamu masukan melebihi sisa Tabungan !.");
        }

        $dompet->create([
            'nasabah_id'      => $tabungan->id,
            'karyawan_id'     => $authID,
            'simpan_tabungan' => 0,
            'ambil_tabungan'  => $Ambil_tabungan,
            'tabungan'        => $ambilTab,
        ]);
        
        $tabungan->update([
            'jumlah_tabungan' => $ambil,
        ]);

        return redirect()->route('jTAB', ['tabungan' => $tabungan])->with('delete', "Tabungan Nasabah $tabungan->nama Berhasil di Ambil !");

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
