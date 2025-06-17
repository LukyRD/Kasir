<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite('resources/js/app.js')
    <title>{{config('app.name')}} | @yield('content-title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome Icons v 6.7.2-->
    <link rel="stylesheet" href="{{asset ('font-awesome-6.7.2/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset ('font-awesome-6.7.2/css/brands.css')}}">
    <link rel="stylesheet" href="{{asset ('font-awesome-6.7.2/css/solid.css')}}">

    <!-- DataTables v 1.11.4-->
    <link rel="stylesheet" href="{{asset('AdminLTE-3.2/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
        href="{{asset('AdminLTE-3.2/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLTE-3.2/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

    <!-- IonIcons v 2.0.1-->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminLTE-3.2/dist/css/adminlte.min.css')}}" />

    <style>
        .main-sidebar {
          height: 100vh; /* Full viewport height */
          overflow-y: auto; /* Aktifkan scrollbar vertikal */
          position: fixed; /* Tetap di tempat saat scroll halaman */
        }
      
        .content-wrapper {
          margin-left: 250px; /* Sesuaikan lebar sidebar */
        }
      
        @media (max-width: 768px) {
          .content-wrapper {
            margin-left: 0; /* Untuk tampilan mobile */
          }
        }
      </style>
      
    
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    @include('sweetalert::alert')
    <div class="wrapper">

        <x-navbar></x-navbar>

        <x-sidebar></x-sidebar>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <x-header></x-header>

            <!-- Main content -->
            <div class="content">
                @yield('content')

            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <x-footer />
    </div>
    <!-- ./wrapper -->


    <!-- REQUIRED SCRIPTS -->


    <!-- jQuery v 3.6.0 -->
    <script src="{{asset('AdminLTE-3.2/plugins/jquery/jquery.min.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Bootstrap v 4.4-->
    <script src="{{asset('AdminLTE-3.2/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- DataTables & Plugins -->
    <!-- DataTables v 1.11.4 -->
    {{--Ganti Dengan DataTables 12 --}}
    <script src="{{asset('AdminLTE-3.2/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('AdminLTE-3.2/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLTE-3.2/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('AdminLTE-3.2/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLTE-3.2/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('AdminLTE-3.2/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLTE-3.2/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('AdminLTE-3.2/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('AdminLTE-3.2/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('AdminLTE-3.2/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('AdminLTE-3.2/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('AdminLTE-3.2/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <!-- AdminLTE v 3.2 -->
    <script src="{{asset('AdminLTE-3.2/dist/js/adminlte.js')}}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{asset('AdminLTE-3.2/plugins/chart.js/Chart.min.js')}}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('AdminLTE-3.2/dist/js/pages/dashboard3.js')}}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('AdminLTE-3.2/dist/js/pages/dashboard2.js')}}"></script>

    @stack('script')

</body>

</html>