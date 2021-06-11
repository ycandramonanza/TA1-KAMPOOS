@extends('master')
@section('content')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user"></i> Ubah Data Karyawan 
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-user"></i> Data Karyawan</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-6 ">
        <div class="card">
            <form action="{{route('karyawan.update', $karyawan->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <div class="card-body">
                  <div class="mb-3">
                    <label for="name" class="form-label">Nama Karyawan</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Karyawan" value="{{$karyawan->name}}" >
                    @error('nama_karyawan')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="3" name="alamat" placeholder="Alamat">{{$karyawan->alamat}}</textarea>
                    @error('alamat')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="no_hp" class="form-label">No Telepon</label>
                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_telepon" name="no_hp" placeholder="No Telepon" value="{{$karyawan->no_hp}}">
                    @error('no_hp')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="image" class="form-label">Upload KTP</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <img src="{{asset('storage/image/'. $karyawan->id . '/' . $karyawan->image)}}" width="150px" alt="image">
                  </div>
                    <input type="submit" class="btn btn-primary" value="Simpan">
            </div>
          </form>
          </div>
    </div>
</div>
@endsection