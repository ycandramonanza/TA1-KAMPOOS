@extends('master')
@section('content')
   {{-- Bootstrap 5 --}}
   <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}" type="text/css">
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <i class="fa fa-user"></i> Tabungan Nasabah <i>{{$tabungan->nama}}</i>
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
                <div class="card-header">
                    <a href="{{route('create.tabungan', $tabungan->id)}}" style="color: white" class="btn btn-info"><i class="fas fa-users"></i>  Tambah Tabungan</a>
                    <a href="{{route('tabungan.edit', $tabungan->id)}}" class="btn btn-danger"><i class="fas fa-users"></i>  Ambil Tabungan</a>
                </div>
                <br>
                <br>
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
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                          <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Simpan Tabungan</th>
                                <th scope="col">Ambil  Tabungan</th>
                                <th scope="col">Tabungan</th>  
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($tabungans as $item)
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{$item->nasabah->nama}}</td>
                                    <td>{{$item->created_at->format('d-M-Y/H:i')}}</td>
                                    <td>Rp.{{number_format($item->simpan_tabungan)}}</td>
                                    <td>Rp.{{number_format($item->ambil_tabungan)}}</td>
                                    <td>Rp.{{number_format($item->tabungan)}}</td>
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

  <!-- Modal Tabungan -->
  <div class="modal fade" id="dompet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-address-card"></i> Tabungan Nasabah <span id="nama"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Jumlah Tabungan : <span class="btn btn-success"> Rp.<span id="tbg"></span></span></p> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="" id="route" class="btn btn-primary">Tambah Tabungan</a>
          </div>
      </div>
    </div>
  </div>



    <script src="{{asset('js/jquery-3.6.0.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
        "aLengthMenu": [[5, 10, 75, -1], [5, 10, 75, "All"]],
        "iDisplayLength": 5
    });
        } );
    </script>
       {{-- Bootstrap 5 --}}
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
{{-- Modal KTP --}}
    <script>
        $(document).on("click", "#cek" ,function(){
            var image = $(this).data('image');
            $('#image').attr('src', image);
            
        })
    </script>


{{-- Modal Tabungan --}}
<script>
    $(document).on("click", "#tabungan" ,function(){
        var tabungan = $(this).data('tabungan');
        var nama = $(this).data('nama');
        var id = $(this).data('id');
        $('#tbg').text(tabungan);
        $('#nama').text(nama);
        $('#route').attr('href', id);
        
    })
</script>


@endsection