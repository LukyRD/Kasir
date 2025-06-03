<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{config('app.name')}} | {{$title}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset ('font-awesome-6.7.2/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset ('font-awesome-6.7.2/css/brands.css')}}">
    <link rel="stylesheet" href="{{asset ('font-awesome-6.7.2/css/solid.css')}}">
    <link rel="stylesheet" href="{{asset ('font-awesome-6.7.2/css/sharp-thin.css')}}">
    <link rel="stylesheet" href="{{asset ('font-awesome-6.7.2/css/duotone-thin.css')}}">
    <link rel="stylesheet" href="{{asset ('font-awesome-6.7.2/css/sharp-duotone-thin.css')}}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('AdminLTE-3.2/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLTE-3.2/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLTE-3.2/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminLTE-3.2/dist/css/adminlte.min.css')}}" />
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <x-navbar></x-navbar>


        <x-sidebar></x-sidebar>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <x-header>{{$title}}</x-header>

            <!-- Main content -->
            <div class="content">
                {{$slot}}
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <x-footer />


        <!-- REQUIRED SCRIPTS -->


        <!-- jQuery -->
        <script src="{{asset('AdminLTE-3.2/plugins/jquery/jquery.min.js')}}"></script>
        
        <!-- Bootstrap -->
        <script src="{{asset('AdminLTE-3.2/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- DataTables  & Plugins -->
         {{--Ganti Dengan DataTables 12  --}}
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

        <!-- AdminLTE -->
        <script src="{{asset('AdminLTE-3.2/dist/js/adminlte.js')}}"></script>

        <!-- OPTIONAL SCRIPTS -->
        <script src="{{asset('AdminLTE-3.2/plugins/chart.js/Chart.min.js')}}"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{asset('AdminLTE-3.2/dist/js/pages/dashboard3.js')}}"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{asset('AdminLTE-3.2/dist/js/pages/dashboard2.js')}}"></script>

        <script src="{{asset('js/main.js')}}"></script>
        
</body>

</html>