@extends('master')
@section('content')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <i class="fa fa-user"></i> Tambah Transaksi {{$transaksi->nama}}
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
                <form action="{{route('store.transaksi', $transaksi->id)}}" method="post">
                @csrf
                <div class="card-body">
                      <div class="mb-3">
                          <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                          <input type="text" class="form-control @error('jumlah_pembayaran') is-invalid @enderror" id="jumlah_pembayaran" name="jumlah_pembayaran" placeholder="Jumlah Pembayaran" >
                          @error('jumlah_pembayaran')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="mb-3">
                          <label for="sisa_pinjaman" class="form-label">Sisa Pinjaman</label>
                          <input type="text" class="form-control @error('sisa_pinjaman') is-invalid @enderror" id="sisa_pinjaman" name="sisa_pinjaman"  readonly  value={{$sisaPinjaman == '0' ? '0' : $sisaPinjaman}} >
                          @error('sisa_pinjaman')
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