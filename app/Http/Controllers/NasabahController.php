<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Models\noTransaksi;
use App\Models\User;
use App\Models\nasabah;
use App\Models\transaksi;
use App\Models\tabungan;
use App\Http\Requests\NasabahRequest;
class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function jumlahTabungan(){
        $authID  = Auth::user()->id;
        $nasabah = nasabah::where('karyawan_id', $authID)->with('tabungan')->get();
        return view('nasabah.jmlhTabungan', compact('nasabah'));
    }

    public function bungaPinjaman(){
        $authID  = Auth::user()->id;
        $nasabah = nasabah::where('karyawan_id', $authID)->get();
        return view('nasabah.bungaPjm', compact('nasabah'));
    }

    public function jumlahPinjaman(){
        $authID  = Auth::user()->id;
        $nasabah = nasabah::where('karyawan_id', $authID)->get();
        return view('nasabah.jmlhPjm', compact('nasabah'));
    }

  
    public function index()
    {
        // mengambil ID karyawan 
        $authID  = Auth::user()->id;
        // Eloquent mencari data nasabah karyawan_id sama dengan id si karyawan
        $nasabah = nasabah::where('karyawan_id', $authID)->get();
        return view('nasabah.index', compact('nasabah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('nasabah.create  ');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NasabahRequest $request)
    {
       
        // cek karyawan id berdasarkan user login si karyawan
        $karyawan_id = Auth::user()->id;

        // Me request data semua dari NasabahRequest
        $data = $request->all();
    
        if($request->hasfile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->file('image')->storeAs('image/nasabah/'. $karyawan_id, $filename,  ''); 
         $data =  nasabah::create([
                'nama'            => $request->nama,
                'alamat'          => $request->alamat,
                'jenis_kelamin'   => $request->jenis_kelamin,
                'no_hp'           => $request->no_hp,
                'image'           => $filename,
                'jumlah_pinjaman' => $request->jumlah_pinjaman,
                'jumlah_pembayaran' => intval($request->jumlah_pinjaman) * 20/100 + intval($request->jumlah_pinjaman) ,
                'sisa_pinjaman'   => intval($request->jumlah_pinjaman) * 20/100 + intval($request->jumlah_pinjaman),
                'jumlah_tabungan' => $request->jumlah_tabungan,
                'karyawan_id'     => $karyawan_id,
            ]);
            // Menambahkan data ke table tabungan;
            $nasabah = nasabah::where('karyawan_id', $karyawan_id)->orderBy('id', 'DESC')->first();
            $nsb_id     = $nasabah->id;
            $kry_id     = $nasabah->karyawan_id;

            tabungan::create([
                'nasabah_id'      => $nsb_id,
                'karyawan_id'     => $kry_id ,
                'simpan_tabungan' => $request->jumlah_tabungan,
                'ambil_tabungan'  => 0,
                'tabungan'        => $request->jumlah_tabungan,
            ]);

            // menambahkan data ke table noTransaksi
            $noTrs = nasabah::where('karyawan_id',$karyawan_id )->orderBy('id', 'DESC')->first();
            $nasabah_id  = $noTrs->id;
            noTransaksi::create([
                    'nasabah_id'   => $nasabah_id,
                    'karyawan_id'  => $karyawan_id,
                    'status'       => 0,
            ]);
    
            $request->session()->flash('pesan', "Nasabah {$data['nama']} Berhasil Di Tambahkan !");
            return redirect()->route('nasabah.index');
        }else{
            return redirect()->route('nasabah.index');
        }

      
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
    public function edit(nasabah $nasabah)
    {
  
        $nasabah_id = $nasabah->id;
        $nasabah_nama = $nasabah->nama;
        return view('nasabah.edit', compact('nasabah'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NasabahRequest $request, $id)
    {
        $update=nasabah::whereId($id)->first();
        $karyawan_id=  $update->karyawan_id;
        $nasabah_id = $update->id;
        // jika transaksi sudah ada tidak dapat mengedit jumlah_pinjaman
        $jmlhpjm  = intval($request->jumlah_pinjaman);
        $pinjaman = intval($update->jumlah_pinjaman);
        $trs      = transaksi::where('nasabah_id',$nasabah_id)->count();
        if($jmlhpjm == $pinjaman){
            if($request->image){
                if(\File::exists('storage/image/nasabah/'. $karyawan_id .'/'.$update->image)){
                    \File::delete('storage/image/nasabah/'. $karyawan_id .'/'.$update->image);
                }
                $image = request()->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $request->file('image')->storeAs('image/nasabah/'.$karyawan_id, $filename,  '');
    
             
               
                $update->update([
                    'nama'            => $request->nama,
                    'alamat'          => $request->alamat,
                    'jenis_kelamin'   => $request->jenis_kelamin,
                    'no_hp'           => $request->no_hp,
                    'image'           => $filename,
                    'jumlah_pinjaman' => $request->jumlah_pinjaman,
                    'jumlah_tabungan' => $request->jumlah_tabungan,
                    'karyawan_id'     => $karyawan_id,
                ]);
            }else{
                $update->update([
                    'nama'            => $request->nama,
                    'alamat'          => $request->alamat,
                    'jenis_kelamin'   => $request->jenis_kelamin,
                    'no_hp'           => $request->no_hp,
                    'image'           => $update->image,
                    'jumlah_pinjaman' => $request->jumlah_pinjaman,
                    'jumlah_tabungan' => $request->jumlah_tabungan,
                    'karyawan_id'     => $update->karyawan_id,
                ]);
            }
              
            return redirect()->route('nasabah.index', ['update' => $update])->with('pesan', "Karyawan $update->nama Berhasil di Ubah !");
        }

        if($trs == 0){
            if($request->image){
                if(\File::exists('storage/image/nasabah/'. $karyawan_id .'/'.$update->image)){
                    \File::delete('storage/image/nasabah/'. $karyawan_id .'/'.$update->image);
                }
                $image = request()->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $request->file('image')->storeAs('image/nasabah/'.$karyawan_id, $filename,  '');
    
             
               
                $update->update([
                    'nama'            => $request->nama,
                    'alamat'          => $request->alamat,
                    'jenis_kelamin'   => $request->jenis_kelamin,
                    'no_hp'           => $request->no_hp,
                    'image'           => $filename,
                    'jumlah_pinjaman' => $request->jumlah_pinjaman,
                    'jumlah_tabungan' => $request->jumlah_tabungan,
                    'karyawan_id'     => $karyawan_id,
                ]);
            }else{
                $update->update([
                    'nama'            => $request->nama,
                    'alamat'          => $request->alamat,
                    'jenis_kelamin'   => $request->jenis_kelamin,
                    'no_hp'           => $request->no_hp,
                    'image'           => $update->image,
                    'jumlah_pinjaman' => $request->jumlah_pinjaman,
                    'jumlah_tabungan' => $request->jumlah_tabungan,
                    'karyawan_id'     => $update->karyawan_id,
                ]);
            }
              
            return redirect()->route('nasabah.index', ['update' => $update])->with('pesan', "Karyawan $update->nama Berhasil di Ubah !");
        }

          
        return redirect()->route('nasabah.create', ['update' => $update])->with('delete', "Hapus Transaksi Nasabah $update->nama dahulu untuk mengubah Jumlah Pinjaman !");
      
        
        

    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(nasabah $nasabah)
    {
  
        $nasabah->delete();

        return redirect()->route('nasabah.index')->with('delete', "Data $nasabah->nama Sudah di Hapus");
    }
}
