@extends('master')
@section('content')
<link rel="stylesheet" href="{{asset('css/karyawan.css')}}">
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <i class="fa fa-user"></i> Data Karyawan KSP Krakatau
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('karyawan.index')}}"><i class="active"></i> Data Karyawan</a></li>
            <li> <a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
    <div class="row" >
        <div class="col-md-12" >
            <div class="card">
                <div class="card-header">
                    {{-- <a style="color: white" href="{{route('karyawan.create')}}" class="btn btn-info"><i class="fas fa-user-plus"></i>  Add</a> --}}
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
                                <th scope="col">Nama Karyawan</th>
                                <th scope="col">Alamat Karyawan</th>
                                <th scope="col">No Telpon</th>
                                <th scope="col">KTP</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($karyawans as $karyawan)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>{{$karyawan->name}}</td>
                                <td>{{$karyawan->alamat}}</td>
                                <td>{{$karyawan->no_hp}}</td>
                                <td>
                                    <button type="button" id="cek" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-image = "{{asset('storage/image/'. $karyawan->id . '/' . $karyawan->image)}}">
                                        <i class="fas fa-address-card"></i>
                                    </button>
                                </td>
                                <td>
                                    <a href="{{route('karyawan.edit', $karyawan->id)}}" class="btn btn-success"><i class="fa fa-edit"></i> </a>
                                </td>
                                <td>
                                    <form action="{{route('karyawan.destroy', $karyawan->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"  onclick="return confirm('Peringatan : Menghapus Data Akan Menghapus Hak Akses Pengguna !.. Yakin ingin Menghapus ?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i> </button>
                                    </form>
                                </td>
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
        "aLengthMenu": [[5, 10, 75, -1], [5, 10, 75, "All"]],
        "iDisplayLength": 5
    });
        } );
    </script>

<script>
    $(document).on("click", "#cek" ,function(){
        var image = $(this).data('image');
        $('#image').attr('src', image);
        
    })
</script>
    
@endsection