<?php

namespace App\Http\Controllers;
use App\Http\Requests\KaryawanRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawans = User::where('level', 'karyawan')->get();
        return view('karyawan.index', compact('karyawans'));
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
    public function edit(User $karyawan)
    {   
      
        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KaryawanRequest $request, $id)
    {
        $update=User::whereId($id)->first();
        $dataID = $update->id;
      
        if($request->image){
            if(\File::exists('storage/image/'. $update->id .'/'.$update->image)){
                \File::delete('storage/image/'. $update->id .'/'.$update->image);
            }
            $image = request()->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->file('image')->storeAs('image', $dataID . '/' . $filename,  '');
            $update->update([
                'name'    => $request->name,
                'alamat'  => $request->alamat,
                'no_hp'   => $request->no_hp,
                'image'   => $filename,
            ]);
        }else{
            $update->update([
                'name'    => $request->name,
                'alamat'  => $request->alamat,
                'no_hp'   => $request->no_hp,
                'image'   => $update->image,
            ]);
        }
          
        return redirect()->route('karyawan.index', ['update' => $update])->with('pesan', "Karyawan $update->name Berhasil di Ubah !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $karyawan)
    {
        $karyawan->delete();
        return redirect()->route('karyawan.index')->with('delete', "Data $karyawan->name Berhasil di Hapus !");
    }
}
