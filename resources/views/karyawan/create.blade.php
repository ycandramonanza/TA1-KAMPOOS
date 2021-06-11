@extends('master')
@section('content')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <i class="fa fa-user"></i> Tambah Karyawan
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('karyawan.create')}}"><i class="active"></i> Tambah Karyawan</a></li>
            <li><a href="{{route('karyawan.index')}}"><i class="fa fa-user"></i> Data Karyawan</a></li>
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
                <form action="{{route('karyawan.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Hak Akses : <i><span style="color: red; font-size:12px">(Harap Melakukan Register Terlebih Dahulu)</span></i></label>
                        <select class="form-control" id="user_id" name="user_id" aria-label="Default select example">
                            <option selected>
                                Pilih Karyawan...
                            </option>
                            @foreach ($user as $usr)
                                 <option value="{{$usr->id}}">
                                    {{$loop->iteration}}. {{$usr->name}}
                                </option>
                            @endforeach
                          </select>
                    </div>
                      <br>
                      <div class="mb-3">
                        <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control @error('nama_karyawan') is-invalid @enderror" id="nama_karyawan" name="nama_karyawan" placeholder="Nama Karyawan" >
                        @error('nama_karyawan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <br>
                      <div class="mb-3">
                        <label for="alamat_karyawan" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat_karyawan') is-invalid @enderror" id="alamat" rows="3" name="alamat_karyawan" placeholder="Alamat"></textarea>
                        @error('alamat_karyawan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <br>
                      <div class="mb-3">
                        <label for="no_telpon" class="form-label">No Telepon</label>
                        <input type="text" class="form-control @error('no_telpon') is-invalid @enderror" id="no_telepon" name="no_telpon" placeholder="No Telepon">
                        @error('no_telpon')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <br>
                      <div class="mb-3">
                        <label for="image" class="form-label">Upload KTP</label>
                        <input type="file" class="form-control" id="image" name="image">
                      </div>
                      <br>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
              </form>
              </div>
        </div>
    </div>
@endsection