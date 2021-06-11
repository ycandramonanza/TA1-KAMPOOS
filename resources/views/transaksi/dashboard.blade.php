@extends('master')
@section('content')
   {{-- Bootstrap 5 --}}
   <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}" type="text/css">
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fas fa-money-bill-wave"></i> Transaksi Nasabah <span style="color: red">{{$tanggal}}</span>
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('nasabah.index')}}"><i class="active"></i> Data Nasabah</a></li>
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
    <div class="row" >
        <div class="col-md-12" >
            <div class="card">
                <div class="card-body">
                    @if (session('pesan'))
                        <div class="alert alert-success">
                            {{ session('pesan') }}
                        </div>
                    @endif
                    @if (session('delete'))
                    <div class="alert alert-danger">
                        {{ session('delete') }}
                    </div>
                @endif
                <h5 style="font-size: 15px" class="alert alert-success">Daftar Nasabah Yang sudah melakukan Transaksi Hari ini</h5>
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                          <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Nasabah</th>
                                <th scope="col">kode Pembayaran</th> 
                                <th scope="col">Jumlah Pembayaran</th>
                                <th scope="col">Status</th>
                                <th scope="col">Detail</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $trs)
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{$trs->nasabah->nama}}</td>
                                    <td>{{$trs->kode_pembayaran}}</td>
                                    <td>Rp.{{number_format($trs->jumlah_pembayaran)}}</td>
                                    <td><i class="fas fa-check-circle"></i></td>
                                    <td><a class="btn btn-info" href="{{url('transaksi',$trs->nasabah_id)}}"><i style="color: white" class="fas fa-wallet"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>    
                <br>
                <br>
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                          <tr>
                                <th scope="col">No</th>
                                <th scope="col">Jumlah Transaksi</th>
                                <th scope="col">Total Pembayaran</th>
                          </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td scope="row">#</td>
                                    <td><b>{{$jmlh_nasabah}} </b> <span style="font-size: 13px">Transaksi</span></td>
                                    <td>Rp.{{number_format($transaksi->sum('jumlah_pembayaran'))}}</td>
                                </tr>
                        </tbody>
                      </table>
                </div>    
                <br>
                <br>
                <h5  style="font-size: 15px" class="alert alert-danger">Daftar Nasabah Yang belum melakukan Transaksi Hari ini</h5>
                <div class="table-responsive">
                    <table class="table" id="myTables">
                        <thead>
                          <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Nasabah</th>
                                <th scope="col">Bayar</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($blm_transaksi as $item)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>{{$item->nasabah->nama}}</td>
                                <td><a href="{{route('create.transaksi', $item->nasabah->id)}}" class="btn btn-success"><i class="fas fa-money-bill-wave" style="font-size: 16px"></i></a></td>
                            </tr>  
                            @endforeach
                        </tbody>
                      </table>
                </div>   
                </div>
              </div>
        </div>
    </div>


  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-address-card"></i> Kartu Tanda Penduduk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <img src="" class="img-fluid" width="460px" id="image" alt="">
        </div>
      </div>
    </div>
  </div>



    <script src="{{asset('js/jquery-3.6.0.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
        "aLengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
        "iDisplayLength": 5
    });
        } );
    </script>
     <script>
        $(document).ready( function () {
            $('#myTables').DataTable({
        "aLengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
        "iDisplayLength": 5
    });
        } );
    </script>
       {{-- Bootstrap 5 --}}
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <script>
        $(document).on("click", "#cek" ,function(){
            var image = $(this).data('image');
            $('#image').attr('src', image);
            
        })
    </script>


@endsection