<!DOCTYPE html>
<html lang="es">

<head>
    <title>{{ config('app.name') }} </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Facturacion Movil Fac Ecuador Android App SRI Aplication" />
    <meta name="author" content="Manuel Rangel" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- app favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- plugin stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors.css" />
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">
            <!-- begin pre-loader -->
            <div class="loader">
                <div class="h-100 d-flex justify-content-center">
                    <div class="align-self-center">
                        <img src="assets/img/loader/loader.svg" alt="loader">
                    </div>
                </div>
            </div>
            <!-- end pre-loader -->
            <!-- begin app-header -->
            <header class="app-header top-bar">
                <!-- begin navbar -->
                <nav class="navbar navbar-expand-md">

                    <!-- begin navbar-header -->
                    <div class="navbar-header d-flex align-items-center">
                        <a href="javascript:void:(0)" class="mobile-toggle"><i class="ti ti-align-right"></i></a>
                        <a class="navbar-brand" href="{{route('index')}}">
                            <img src="assets/img/logo.png" class="img-fluid logo-desktop" alt="logo" />
                            <img src="assets/img/logo-icon.png" class="img-fluid logo-mobile" alt="logo" />
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti ti-align-left"></i>
                    </button>
                    <!-- end navbar-header -->
                    <!-- begin navigation -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="navigation d-flex">
                            <ul class="navbar-nav nav-left">
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link sidebar-toggle">
                                        <i class="ti ti-align-right"></i>
                                    </a>
                                </li>                                
                                <li class="nav-item full-screen d-none d-lg-block" id="btnFullscreen">
                                    <a href="javascript:void(0)" class="nav-link expand">
                                        <i class="icon-size-fullscreen"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav nav-right ml-auto">
                                <li class="nav-item dropdown user-profile">
                                    <a href="javascript:void(0)" class="nav-link dropdown-toggle " id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="assets/img/avtar/02.jpg" alt="avtar-img">
                                        <span class="bg-success user-status"></span>
                                    </a>
                                    <div class="dropdown-menu animated fadeIn" aria-labelledby="navbarDropdown">
                                        <div class="bg-gradient px-4 py-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="mr-1">
                                                    @if (Session::has('usuario'))
                                                        @php
                                                            $userDT = Session::get('usuario');
                                                        @endphp
                                                        <h4 class="text-white mb-0">{{ $userDT['nombre'] }}</h4>
                                                        <small class="text-white">RUC: {{ $userDT['ruc'] }}</small>
                                                    @endif
                                                </div>
                                                <a href="{{route('logout')}}" class="text-white font-20 tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Logout"> <i
                                                                class="zmdi zmdi-power"></i></a>
                                            </div>
                                        </div>                                       
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- end navigation -->
                </nav>
                <!-- end navbar -->
            </header>
            <!-- end app-header -->
            <!-- begin app-container -->
            <div class="app-container">
                <!-- begin app-nabar -->
                <aside class="app-navbar">
                    <!-- begin sidebar-nav -->
                    <div class="sidebar-nav scrollbar scroll_light">
                        <ul class="metismenu " id="sidebarNav">
                            <li class="nav-static-title">GeoCompra Menu</li>                            
                            @php
                                $menItems = array();
                                foreach(Session::get('submenus') as $key => $value){
                                    $menItems[] = $value->IDMENU;
                                }                                
                            @endphp
                            @if (Session::has('menus'))                            
                                @foreach (Session::get('menus') as $menu)
                                    @if (in_array($menu->IDMENU,$menItems))                                  
                                        <li class="inactive">
                                            <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                                <i class="nav-icon ti ti-menu"></i>                                        
                                                <span class="nav-title">{{ $menu->MENUNOMBRE }}</span>
                                            </a>
                                            <ul aria-expanded="false">
                                                @foreach (Session::get('submenus') as $item)
                                                    @if ($item->IDMENU == $menu->IDMENU)
                                                        <li class="active" > <a class="url_menu_lateral" href="javascript:void(0)" id_url='{{route("$item->URLOPCION")}}'>{{ $item->NOMBREOPCION }}</a> </li>  
                                                    @endif
                                                @endforeach                                
                                            </ul>
                                        </li> 
                                    @endif                              
                                @endforeach
                            @endif
                            <li><a href="{{ route('documentos') }}" aria-expanded="false"><i class="nav-icon ti ti-comment"></i><span class="nav-title">Documentos</span></a> </li>                            
                        </ul>
                    </div>
                    <!-- end sidebar-nav -->
                </aside>
                <!-- end app-navbar -->
                <!-- begin app-main -->
                <div class="app-main" id="main">
                    <!-- begin container-fluid -->
                    <div class="container-fluid">
                        <!-- begin row -->
                        <div class="row">
                            <div class="col-md-12 m-b-30">
                                <!-- begin page title -->
                                <div class="d-block d-lg-flex flex-nowrap align-items-center">
                                    <div class="page-title mr-4 pr-4 border-right">
                                        <h1>@yield('pagina')</h1>
                                    </div>
                                    <div class="breadcrumb-bar align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="{{route('index')}}"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    @yield('subpagina')
                                                </li>
                                                
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <!-- end page title -->
                            </div>
                        </div>
                        <!-- Notification -->
                        <div class="row">
                            <div class="col-md-12">
                                @php
                                    $userDT2 = Session::get('usuario');
                                    $empresad =  $userDT2['empresa']; 
                                    $numerodoc = $userDT2['numeraciones'];
                                @endphp
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">                                           
                                            <h4 class="card-title">@yield('title')</h4>
                                        </div>
                                    </div>
                                    @section('body')
                                        
                                    @endsection
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
              
                        <!-- event Modal -->
                        <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="verticalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="verticalCenterTitle">Agregar Nuevo evento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="modelemail">Evento Nombre</label>
                                                <input type="email" class="form-control" id="modelemail">
                                            </div>
                                            <div class="form-group">
                                                <label>Escoger Color Evento</label>
                                                <select class="form-control">
                                                    <option>Primary</option>
                                                    <option>Warning</option>
                                                    <option>Success</option>
                                                    <option>Danger</option>
                                                </select>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end container-fluid -->
                </div>
                <!-- end app-main -->
            </div>
            <!-- end app-container -->
            <!-- begin footer -->
            <footer class="footer">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-left">
                        <p>&copy; Copyright 2021.</p>
                    </div>
                    
                </div>
            </footer>
            <!-- end footer -->
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->

    <!-- plugins -->
    <script src="assets/js/vendors.js"></script>

    <!-- custom app -->
    <script src="assets/js/app.js"></script>

    <script>      
    
        // $('#firmaelectronica').on("change", function(){ 
        //     if (!hasExtension('firmaelectronica', ['.p12'])) {
        //         swal({
        //             position: 'top-end',
        //             type: 'error',                          
        //             title: 'Firma con extensión invalida.',
        //             text:'La firma debe ser con extensión .p12',
        //             showConfirmButton: false,
        //             timer: 3200
        //         }) 
        //     }                
        // });
            

        // $("form#empresa_form").submit(function(e) {
            
        //     e.preventDefault();                
        //     const formData = new FormData(this); 
        //     console.log(formData);

        //     if (!hasExtension('firmaelectronica', ['.p12'])) {
        //         swal({
        //             position: 'top-end',
        //             type: 'error',                          
        //             title: 'Firma con extensión invalida.',
        //             text:'La firma debe ser con extensión .p12',
        //             showConfirmButton: false,
        //             timer: 3200
        //         }) 

        //         return 0;
        //     } 

        //     jQuery.each(jQuery('#empresa_form')[0].files, function(i, file) {
        //         formData.append('file-'+i, file);
        //     });
            

        //     $.ajax({
        //         url: '{{ env('APP_URL_APOLO') }}api/store-file' ,
        //         type: 'POST',
        //         data: formData,
        //         success: function (data) {
        //             console.log(data);
        //             if(data.status == 'ok')
        //             {                       
        //                 swal({
        //                     position: 'top-end',
        //                     type: 'success',
        //                     title: 'Datos actualizados de forma correcta.',
        //                     showConfirmButton: false,
        //                     timer: 1200
        //                 })                      
                        
        //             }else{
        //                 console.log(data);
        //                 swal({
        //                     position: 'top-end',
        //                     type: 'error',                          
        //                     title: 'Error al actualizar datos',
        //                     text:data.message,
        //                     showConfirmButton: false,
        //                     timer: 3200
        //                 }) 
        //             }
        //         },
        //         cache: false,
        //         contentType: false,
        //         processData: false,                
        //     });
        // });

         
        // function hasExtension(inputID, exts) {
        //     var fileName = document.getElementById(inputID).value;
        //     return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        // }

        $('.url_menu_lateral').on('click',function(e){
           //alert($(this).attr("id_url"));
            $.ajax({
                url: $(this).attr("id_url"),
                type: 'GET',
                data: null,
                success: function (data) {
                    $('#card-body-content').html(data);
                }
            })
        })
    </script>
</body>

</html>