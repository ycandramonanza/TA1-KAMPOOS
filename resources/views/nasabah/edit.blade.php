@extends('master')
@section('content')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <i class="fa fa-user"></i> Ubah Data Nasabah
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('nasabah.create')}}"><i class="active"></i> Tambah Nasabah</a></li>
            <li><a href="{{route('nasabah.index')}}"><i class="fa fa-user"></i> Data Nasabah</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
    <div class="row">
 
        <div class="col-md-6 ">
            @if (session('pesan'))
            <div class="alert alert-danger">
                {{ session('pesan') }}
            </div>
            @endif
            <div class="card">
                <form action="{{route('nasabah.update', $nasabah->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="card-body">
                      <div class="mb-3">
                        <label for="nama" class="form-label">Nama Nasabah</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" value="{{$nasabah->nama}}" >
                        @error('nama')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" class="form-control  @error('alamat') is-invalid @enderror">{{$nasabah->alamat}}</textarea>
                        @error('alamat')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="jenis_kelamin" id="L" value="L" {{old('jenis_kelamin') ?? $nasabah->jenis_kelamin == 'L' ? 'checked' : ''}} >
                              <label style="margin-right: 20px" class="form-check-label" for="L">
                                  <i class="fas fa-male"></i> Laki-Laki
                              </label>
                              <br>
                              <input class="form-check-input"  type="radio" name="jenis_kelamin" id="P" value="P"  {{old('jenis_kelamin') ?? $nasabah->jenis_kelamin == 'P' ? 'checked' : ''}} >
                              <label class="form-check-label" for="P">
                                  <i class="fas fa-female"></i> Perempuan
                            </label>
                       </div>
                      </div>
                      <div class="mb-3">
                        <label for="no_hp" class="form-label">No Hp</label>
                        <input type="text"  class="form-control @error('no_hp')  is-invalid @enderror" id="no_hp" name="no_hp" value="{{$nasabah->no_hp}}">
                        @error('no_hp')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="jumlah_pinjaman" class="form-label">Jumlah Pinjaman</label>
                        <input type="text" class="form-control @error('jumlah_pinjaman') is-invalid @enderror" id="no_telepon" name="jumlah_pinjaman" placeholder="Pinjaman" value="{{$nasabah->jumlah_pinjaman}}">
                        @error('jumlah_pinjaman')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="jumlah_tabungan" class="form-label">Jumlah Tabungan</label>
                        <input type="text" readonly class="form-control @error('jumlah_tabungan') is-invalid @enderror" id="jumlah_tabungan" name="jumlah_tabungan" placeholder="Tabungan" value="{{$nasabah->jumlah_tabungan}}">
                        @error('jumlah_tabungan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="image" class="form-label">Upload KTP</label>
                        <input type="file" class="form-control" id="image" name="image" value="{{$nasabah->gambar}}">
                        <img src="{{asset('storage/image/nasabah/'. $nasabah->karyawan_id . '/' . $nasabah->image)}}" width="150px" alt="KTP">
                      </div>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
              </form>
              </div>
        </div>
    </div>
@endsection