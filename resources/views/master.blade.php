
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        @yield('title')
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="stylesheet" href="{{asset('css/master.css')}}">
        {{-- Bootstrap 5 --}}
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}" type="text/css">
        {{-- Data Tables --}}
        <link rel="stylesheet" href="{{asset('dataTables/datatables.min.css')}}" type="text/css">
        <!-- font Awesome -->
        <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}">
        <!-- font Awesome -->
        <link href="{{asset('AdminLTE/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="{{asset('AdminLTE/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="{{asset('AdminLTE/css/morris/morris.css')}}" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="{{asset('AdminLTE/css/jvectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="{{asset('AdminLTE/css/fullcalendar/fullcalendar.css')}}" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="{{asset('AdminLTE/css/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="{{asset('AdminLTE/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{asset('AdminLTE/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{asset('css/karyawan.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.html" class="logo" style="font-family: Arial, Helvetica, sans-serif">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
               KSP KRAKATAU
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                    @csrf
                                    <button class="btn btn-default btn-flat"><i class="fas fa-sign-out-alt"></i> Sign out</button>
                                </form>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            {{-- <img src="{{asset('AdminLTE/img/avatar3.png')}}" class="img-circle" alt="User Image" /> --}}
                        </div>
                        <div class="pull-left info">
                            <p>{{Auth::user()->name}}</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="{{route('home')}}">
                                <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        @if (Auth::user()->level === 'admin')
                        <li>
                            <a href="{{route('karyawan.index')}}">
                                <i class="fa fa-user"></i> <span>Data Karyawan</span>
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{route('nasabah.index')}}">
                                <i class="fas fa-users"></i> <span>Data Nasabah</span>
                            </a>
                        </li>
                        @if (Auth::user()->level === 'admin')
                        <li>
                            <a href="index.html">
                                <i class="fas fa-money-check-alt"></i> <span>Gaji Karyawan</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->level === 'karyawan')
                        <li>
                            <a href="{{route('transaksi.dashboard')}}">
                                <i class="fas fa-money-check-alt"></i> <span>Transaksi</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->level === 'karyawan')
                        <li >
                            <a href="{{route('laba.index')}}">
                                <i class="fas fa-balance-scale-right"></i> <span>Laba</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->level === 'karyawan')
                        <li>
                            <a href="{{route('piutang.index')}}">
                                <i class="far fa-chart-bar"></i> <span>Piutang</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->level === 'admin')
                        <li >
                            <a href="index.html">
                                <i class="fas fa-balance-scale-right"></i> <span>Laba KSP Krakatau</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->level === 'admin')
                        <li>
                            <a href="index.html">
                                <i class="far fa-chart-bar"></i> <span>Piutang KSP Krakatau</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

           

                    @yield('content')
                
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
        {{-- Bootstrap 5 --}}
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        {{-- Jquery --}}
        <script src="{{asset('js/jquery-3.6.0.min.js')}}" type="text/javascript"></script>
        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="{{asset('AdminLTE/js/jquery-ui-1.10.3.min.js')}}" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="{{asset('AdminLTE//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js')}}"></script>
        <script src="{{asset('AdminLTE/js/plugins/morris/morris.min.js' )}}" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="{{asset('AdminLTE/js/plugins/sparkline/jquery.sparkline.min.js')}}" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="{{asset('AdminLTE/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"  type='text/javascript'></script>
        <script src="{{asset('AdminLTE/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="{{asset('AdminLTE/js/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{asset('AdminLTE/js/plugins/jqueryKnob/jquery.knob.js')}}" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="{{asset('AdminLTE/js/plugins/daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{asset('AdminLTE/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="{{asset('AdminLTE/js/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('AdminLTE/js/AdminLTE/app.js')}}" type="text/javascript"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{asset('AdminLTE/js/AdminLTE/dashboard.js')}}" type="text/javascript"></script>       
         {{--Data Tables  --}}
         <script src="{{asset('dataTables/datatables.min.js')}}" type="text/javascript"></script>

    </body>
</html>