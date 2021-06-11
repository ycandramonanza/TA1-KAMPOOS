@extends('master')
@section('title')
<title>Dashboard {{Auth::user()->level == 'admin' ? 'ADMIN' : 'KARYAWAN' }}</title>
@endsection
@section('content')
 <!-- Right side column. Contains the navbar and content of the page -->
 <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard active"></i> Dashboard</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
<div class="row">
    @if (Auth::user()->level == 'admin')
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
       
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3 style="font-size: 28px">
                 {{$karyawan}}
                </h3>
                <p>
                    Jumlah Karyawan
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="{{route('karyawan.index')}}" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    @endif
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3 style="font-size: 28px">
                 {{$nasabah}} <span style="font-size: 16px">Nasabah</span> 
                </h3>
                <p>
                    Jumlah Nasabah
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="{{route('nasabah.index')}}" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    @if (Auth::user()->level == 'admin')
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3 style="font-size: 28px">
                    Rp.31.000.000
                </h3>
                <p>
                    Gaji Karyawan
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    @endif
    @if (Auth::user()->level == 'karyawan')
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3 style="font-size: 28px">
                 Rp.
               
                 {{number_format($transaksi->sum('jumlah_pinjaman'))}}   
              
                </h3>
                <p>
                    Jumlah Pinjaman
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('jPJM')}}" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    @endif
    @if (Auth::user()->level == 'karyawan')
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3 style="font-size: 28px">
                    Rp.
                   {{number_format($transaksi->sum('jumlah_pinjaman') * 20/100)}}
                </h3>
                <p>
                   Bunga Pinjaman
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-money"></i>
            </div>
            <a href="{{route('bPJM')}}" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    @endif
    @if (Auth::user()->level == 'karyawan')
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
       
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3 style="font-size: 28px">
                    Rp.
                 {{number_format($tabungan)}}
                </h3>
                <p>
                   Tabungan Nasabah
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="{{route('jTAB')}}" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    @endif
</div><!-- /.row -->

<!-- top row -->
<div class="row">
    <div class="col-xs-12 connectedSortable">
        
    </div><!-- /.col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
    <div class="col">
        {{-- <h3 align="center">Yegi</h3> --}}
    </div>
</div><!-- /.row (main row) -->
@endsection
                    
