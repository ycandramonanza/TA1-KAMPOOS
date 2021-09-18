<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use App\Models\noTransaksi;
use App\Models\nasabah;
use App\Models\tabungan;
use App\Models\transaksi;
use App\Http\Requests\TransaksiRequest;
class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function transaksiTabungan(nasabah $tabungan){
        $nasabah_id = $tabungan->id;
        // dd($nasabah_id);
        $authID    = Auth::user()->id;
        $tabungans = tabungan::where('karyawan_id', $authID)->where('nasabah_id', $nasabah_id)->with('nasabah')->orderBy('id', 'DESC')->get();
        // dd($tabungans);
        return view('transaksi.trsTabungan', compact('tabungans', 'tabungan'));
    }

   public function dashboard(){
       $tanggal   = Carbon::now()->isoFormat('dddd, DD-MM-YYYY');
       $authID    = Auth::user()->id;
       $today     = Carbon::now()->isoFormat('YYYY-MM-DD');
       $transaksi = transaksi::where('karyawan_id', $authID)->where('tanggal', $today)->with('nasabah')->get();
       $blm_transaksi = notransaksi::where('status', '0' )->where('karyawan_id', $authID)->with('nasabah')->get();
       $jmlh_nasabah = $transaksi->count();
       return view('transaksi.dashboard', compact('transaksi','tanggal','jmlh_nasabah','blm_transaksi'));
   }

    public function index(nasabah $transaksi)
    {
        $nasabah_id = $transaksi->id;
        $pembayaran = transaksi::where('nasabah_id', $nasabah_id )->get();
        return view('transaksi.index', compact('transaksi', 'pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(nasabah $transaksi)
    {
        $nasabah_id  = $transaksi->id;
        $pembayaran   = transaksi::where('nasabah_id', $nasabah_id )->count();
        // dd($pembayaran);
        if($pembayaran == 0){
            $sisaPinjaman   = intval($transaksi->jumlah_pinjaman) * 20/100 + intval($transaksi->jumlah_pinjaman) ;
            return view('transaksi.create',compact('transaksi', 'sisaPinjaman'));
        }else{
            $bayar   = transaksi::where('nasabah_id', $nasabah_id )->orderBy('created_at', 'desc')->get();
            $sisapjm      = $bayar->all();
            $sisaPinjaman = $sisapjm[0]['sisa_pinjaman'];
            return view('transaksi.create',compact('transaksi', 'sisaPinjaman'));
        }
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransaksiRequest $request, nasabah $transaksi)
    {
        $lunas = intval($request->sisa_pinjaman);
        if($lunas == 0){
            $trs = $transaksi->id;
            return redirect('transaksi/create/'.  $trs)->with('pesan', "Transaksi Nasabah $transaksi->nama Sudah Lunas, Anda tidak dapat menambahkan pembayaran lagi. ");
        }else{

            $trs = $transaksi->id;
            $sisa_bayar = intval($request->sisa_pinjaman);
            $jmlhpbr  = intval($request->jumlah_pembayaran);
            $sisapbr    = $sisa_bayar - $jmlhpbr; 

           //    Kode pembayaran
            $random_kode = rand(1,9999999);
            $kode_pbr    = 'KSP-'.$random_kode;

            // jumlah pinjaman
            $jpinjaman   = intval($transaksi->jumlah_pinjaman * 20/100 + $transaksi->jumlah_pinjaman );

     
            if($sisapbr < 0){
                return redirect('transaksi/create/'.  $trs)->with('pesan', "Transaksi Nasabah $transaksi->nama Melebihi Sisa Pinjaman, Masukan Jumlah Pembayaran Sesuai dengan Sisa Pinjaman. ");
            }
            
            $today = Carbon::now()->isoFormat('YY/MM/DD');
            
            $authID = Auth::user()->id;
           
            $pembayaran = transaksi::create([
                'nasabah_id'      => $transaksi->id,
                'karyawan_id'       => $authID,
                'tanggal'           => $today,
                'kode_pembayaran'   => $kode_pbr,
                'jumlah_pinjaman'   => $jpinjaman,
                'jumlah_pembayaran' => $request->jumlah_pembayaran,
                'sisa_pinjaman'     => $sisapbr,
                ]);
        }
        // table nasabah sisa pinjaman update
        $update = nasabah::where('karyawan_id', $authID)->where('id', $transaksi->id)->first();
        $update->update([
            'sisa_pinjaman' => $sisapbr,
        ]);


        // table status no Transaksi
         $noTransaksi = transaksi::where('karyawan_id', $authID )->orderBy('id', 'DESC')->first();
         $idTrs       = $noTransaksi->nasabah_id;
         $noTrs       = noTransaksi::where('nasabah_id', $idTrs)->get();
         $update      = $noTrs->all();
         $up          = $update[0];
         $up->update([
             'status' => 1,
         ]);
        return redirect('transaksi/'.  $trs)->with('pesan', "Transaksi Pembayaran Nasabah $transaksi->nama Berhasil ");
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
    public function destroy(transaksi $transaksi)
    {
        $trs = $transaksi->nasabah_id;
        $nsb =  nasabah::where('id', $trs)->first();
        $transaksi->delete();
        $nsb->update([
            'sisa_pinjaman' => intval($nsb->sisa_pinjaman) + intval($transaksi->jumlah_pembayaran),
        ]);

        
         

        // status table notransaksi
         $noTrs       = noTransaksi::where('nasabah_id', $trs)->get();
         $update      = $noTrs->all();
         $up          = $update[0];
         $up->update([
             'status' => 0,
         ]);

        return redirect('transaksi/'. $nsb->id)->with('delete', "Transaksi Nasabah $nsb->nama Berhasil di Hapus");
    }
}
