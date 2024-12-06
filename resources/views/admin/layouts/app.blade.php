<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>furniture</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
    <link rel="stylesheet" href="{{asset('public/admin/css/styles.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/admin/css/global.css')}}">
</head>

<body>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('admin.includes.aside')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        @include('admin.includes.header')
        <div class="m-4 p-5">
            <!--  Header End -->
            @yield('content')
        </div>
    </div>
</div>
<script src="{{asset('public/admin/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('public/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/admin/js/sidebarmenu.js')}}"></script>
<script src="{{asset('public/admin/js/app.min.js')}}"></script>
<script src="{{asset('public/admin/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('public/admin/libs/simplebar/dist/simplebar.js')}}"></script>
<script src="{{asset('public/admin/js/dashboard.js')}}"></script>

<script>
    "use strict";
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    @if ($errors->any())
        @foreach ($errors->all() as $emsg)
            toastr.error('{{$emsg}}');
        @endforeach
    @endif

    @if(session()->has('alert'))
        @if(session('alert')[0] == 'danger')
            toastr.error('{{ session('alert')[1] }}');
        @elseif(session('alert')[0] == 'success')
            toastr.success('{{ session('alert')[1] }}');
        @else
            toastr.error('{{ session('alert')[1] }}');
        @endif
    @endif

    function systemAlert(type,message){
        if(type === 'danger'){
            toastr.error(message);
        }else if($type === 'success'){
            toastr.success(message);
        }else{
            toastr.error(message);
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,  // Height of the editor
            placeholder: 'Write your content here...'
        });
    });
</script>
@stack('js')

</body>

</html>
