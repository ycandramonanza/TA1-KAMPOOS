<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Tabungan</title>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('dataTables/datatables.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css')}}" type="text/css">
    
</head>
<body>
    <div class="container">
        <h5 align="center">Transaksi Nasabah KSP KRAKATAU <img style="width: 150px" src="{{asset('image/Krakatau.png')}}" alt="logo"></h5>
        <span><b> Karyawan :</b> <i>{{Auth::user()->name}}</i></span>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                  <tr>
                        <th scope="col" class="table-dark">No</th>
                        <th scope="col" class="table-dark">Kode Pembayaran</th>
                        <th scope="col" class="table-dark">Jumlah Pinjaman</th>
                        <th scope="col" class="table-dark">Jumlah Pembayaran</th>
                        <th scope="col" class="table-dark">Sisa Pinjaman</th>
                        <th scope="col" class="table-dark">Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $item)
                        <tr>
                            <td scope="row">{{$loop->iteration}}</td>
                            <td>{{$item->kode_pembayaran}}</td>
                            <td>Rp.{{number_format($item->jumlah_pinjaman)}}</td>
                            <td>Rp.{{number_format($item->jumlah_pembayaran)}}</td>
                            <td>Rp.{{number_format($item->sisa_pinjaman)}}</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        <br>
        <br>
        <table>
            <tr>
                <th>Total Transaksi : </th>
                <th>Rp.{{number_format($transaksi->sum('jumlah_pembayaran'))}}</th> 
            </tr>
        </table>
    </div>
    <script src="{{asset('js/jquery-3.5.1.js')}}" type="text/javascript"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>  
    <script src="{{asset('js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/dataTables.buttons.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jszip.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/pdfmake.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/vfs_fonts.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/buttons.html5.min')}}" type="text/javascript"></script>
    <script src="{{asset('js/buttons.print.min')}}" type="text/javascript"></script>
    
{{-- <script>
$(document).ready(function() {
        $('#myTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                 'excel', 'pdf', 'print'
            ]
        } );
    } );
</script> --}}

</body>
</html>