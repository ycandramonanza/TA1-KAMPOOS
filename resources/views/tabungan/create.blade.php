@extends('master')
@section('content')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <i class="fa fa-user"></i> Tambah Tabungan
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
                <form action="{{route('store.tabungan', $tabungan->id)}}" method="post">
                @csrf
                <div class="card-body">
                      <div class="mb-3">
                          <label for="tabungan" class="form-label">Tambah Tabungan</label>
                          <input type="text" class="form-control @error('tabungan') is-invalid @enderror" id="tabungan" name="tabungan" placeholder="" >
                          @error('tabungan')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
              </form>
              </div>
        </div>
    </div>
@endsection