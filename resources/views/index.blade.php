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

    <style>
        input.invalid_field[type="text"]{
            border-color: #ec2222;
        }
        input.invalid_field[type="password"]{
            border-color: #ec2222;
        }
        select.invalid_field{
            border: 1px solid red;
        }

        .top-bar .navbar .nav-link {
            
            padding: 1.4rem 1rem 1.4rem 1rem;
            font-size: 18px;
            color: rgb(39, 102, 219);
            font-weight: 600;
        }   
        .top-bar .navbar .nav-left .dropdown-menu, .top-bar .navbar .nav-right .dropdown-menu {
            background: #ffffff;
            border: none;
            -webkit-box-shadow: 0 1px 20px rgb(115 105 215 / 25%);
            -moz-box-shadow: 0 1px 20px rgba(115,105,215,.25);
            box-shadow: 0 1px 20px rgb(115 105 215 / 25%);
            padding: 13px;
            border-radius: 4px 5px 4px 5px;
            margin-top: 1rem;
            visibility: hidden;
            display: block;
            opacity: 0;
            transition: all .3s ease-in-out;
        }
        .top-bar .navbar .nav-left .nav-item.dropdown .dropdown-menu a {
            padding: .7rem 1.5rem .7rem 1.5rem;
            font-size: 1rem;
            line-height: 18px;
            border: 2px solid #ddc8c8;
            border-radius: 8px;
            background: #1c3195;
            color: white;
            margin-top: 3px;
            padding: autto;
        }
    </style>
   
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
                        <a class="navbar-brand" href="{{ route('index')}} ">
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
                                <li class="nav-item dropdown">
                                    <a class="dropdown-item nav-link" href="javascript:void(0)">Inicio</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="javascript:void(0)" class="nav-link " id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Empresa
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="dropdown-menu animated fadeIn" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item nav-link url_menu_top" id_url="{{ route('empresaindex') }}" href="javascript:void(0)">Datos de Empresa</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="javascript:void(0)" class="nav-link " id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Inventario
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="dropdown-menu animated fadeIn" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item nav-link url_menu_top" id_url="{{ route('productocrear') }}" href="javascript:void(0)">Crear Producto</a>
                                        <a class="dropdown-item nav-link" href="javascript:void(0)">Producto Compuesto</a>
                                        <div class="dropdown-divider"></div>
                                        <span style="margin-left: 1rem;font-size: 0.8rem;color: rgb(42, 120, 165);">MANTENIMIENTO</span>
                                        <a class="dropdown-item nav-link url_menu_top" id_url="{{ route('categoriaindex') }}" href="javascript:void(0)">Categoria</a>
                                        <a class="dropdown-item nav-link url_menu_top" id_url="{{ route('marcaindex') }}" href="javascript:void(0)">Marca</a>
                                        <a class="dropdown-item nav-link url_menu_top" id_url="{{ route('proveedorindex') }}"  href="javascript:void(0)">Proveedor</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="javascript:void(0)" class="nav-link " id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Transacciones
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="dropdown-menu animated fadeIn" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item nav-link url_menu_top" id_url="{{ route('ncrindex') }}" href="javascript:void(0)">Nota de Crédito</a>
                                        <a class="dropdown-item nav-link url_menu_top" id_url="{{ route('guiaremindex') }}" href="javascript:void(0)">Guia de Remisión</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="javascript:void(0)" class="nav-link " id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Movimientos
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="dropdown-menu animated fadeIn" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item nav-link url_menu_top" id_url="{{ route('compraindex') }}" href="javascript:void(0)">Compras</a>
                                        <a class="dropdown-item nav-link url_menu_top" id_url="{{ route('itembodindex') }}" href="javascript:void(0)">Productos por Bodega</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="javascript:void(0)" class="nav-link " id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Parametros
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="dropdown-menu animated fadeIn" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item nav-link url_menu_top" id_url="{{ route('bodegacrear') }}" href="javascript:void(0)">Crear Bodegas</a>
                                        <div class="dropdown-divider"></div>
                                        <span style="margin-left: 1rem;font-size: 0.8rem;color: rgb(42, 120, 165);">USUARIO</span>
                                        <a class="dropdown-item nav-link url_menu_top" id_url="{{ route('usuarioindex') }}" href="javascript:void(0)">Usuarios</a>
                                        <a class="dropdown-item nav-link url_menu_top" id_url="{{ route('repartidorindex') }}" href="javascript:void(0)">Repartidores</a>                                        
                                    </div>
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
                                                            $usuarioActual = $userDT['usuario'];
                                                        @endphp
                                                       
                                                    @endif
                                                    <h4 class="text-white mb-0">{{ $usuarioActual['NOMBRE'] }}</h4>
                                                <br>
                                                <h5 class="text-white">{{ $usuarioActual['CORREO']  }}</h5>
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
                            <li><a href="{{ route('index') }}" aria-expanded="false"><i class="nav-icon ti ti-desktop">
                                </i><span class="nav-title">Dashboard</span></a> 
                            </li>
                           
                            @php
                                $menItems = array();
                                foreach(Session::get('submenus') as $key => $value){
                                    if($value->ESTADO == 'S'){
                                        $menItems[] = $value->IDMENU;
                                    }                                   
                                }                                                              
                            @endphp
                            <!-- Comienzo del menu nuevo de tres niveles-->
                            @foreach(Session::get('mainmenu') as $mMenu)
                            <li class="">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i class="nav-icon ti {{$mMenu->ICON}}"></i><span class="nav-title">{{$mMenu->NOMBRE}}</span></a>
                                <ul aria-expanded="false" class="collapse" style="height: 0px;">
                                    <!-- Inicio Menu-->
                                    @foreach (Session::get('menus') as $menu)
                                        @if (in_array($menu->IDMENU,$menItems))
                                            @if($menu->IDMAINMENU == $mMenu->IDMAINMENU)
                                                <li class="scoop-hasmenu">
                                                    <!--Titulo de SubMenu-->
                                                    <a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                                                        @if ($menu->MENUNOMBRE == 'EMPRESAS')
                                                            @if (Session::get('rol') == 'ADM' || Session::get('rol') == 'OPE' )
                                                                MI EMPRESA
                                                            @else
                                                                {{ $menu->MENUNOMBRE }}
                                                            @endif
                                                        @else
                                                            {{ $menu->MENUNOMBRE }}
                                                        @endif
                                                    </a>
                                                    <!--Fin Titulo de SubMenu-->
                                                    <ul aria-expanded="false" class="collapse" style="">
                                                        <!--Inicio nombre Opcion-->
                                                        @foreach (Session::get('submenus') as $item)
                                                            @if ($item->IDMENU == $menu->IDMENU && $item->ESMENU == 'S' && $item->ESTADO == 'S')
                                                                <li> <a class="url_menu_lateral" href="javascript:void(0)" id_url='{{route("$item->URLOPCION")}}'>{{ $item->NOMBREOPCION }}</a> </li>  
                                                            @endif
                                                        @endforeach 
                                                        <!--fin nombre Opcion-->
                                                    </ul>
                                                </li>
                                            @endif                                            
                                        @endif
                                    @endforeach
                                    <!-- Fin Menu-->
                                </ul>
                            </li>  
                            @endforeach 
                            <!-- Fin Menu de tres niveles-->
                            {{-- @if (Session::has('menus'))                            
                                @foreach (Session::get('menus') as $menu)
                                    @if (in_array($menu->IDMENU,$menItems))                       
                                        <li class="inactive">
                                            <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                                <i class="nav-icon ti ti-menu"></i> 
                                                @if($menu->MENUNOMBRE == 'EMPRESAS')
                                                    @if (Session::get('rol') == 'ADM' || Session::get('rol') == 'OPE' )
                                                        <span class="nav-title">MI EMPRESA</span>
                                                    @else
                                                        <span class="nav-title">{{ $menu->MENUNOMBRE }}</span>
                                                    @endif
                                                @else     
                                                    <span class="nav-title">{{ $menu->MENUNOMBRE }}</span>                           
                                                @endif
                                            </a>
                                            <ul aria-expanded="false">
                                                @foreach (Session::get('submenus') as $item)
                                                    @if ($item->IDMENU == $menu->IDMENU && $item->ESMENU == 'S' && $item->ESTADO == 'S')
                                                        <li class="active" > <a class="url_menu_lateral" href="javascript:void(0)" id_url='{{route("$item->URLOPCION")}}'>{{ $item->NOMBREOPCION }}</a> </li>  
                                                    @endif
                                                @endforeach                                
                                            </ul>
                                        </li> 
                                    @endif                              
                                @endforeach
                            @endif --}}
                        </ul>
                    </div>
                    <!-- end sidebar-nav -->
                </aside>
                <!-- end app-navbar -->
                <!-- begin app-main -->
                <div class="app-main" id="main">
                    <!-- begin container-fluid -->
                    <div class="container-fluid" style="padding-top:68px">                      
                        <div class="row">
                            <div class="col-md-12">
                                @php
                                    $userDT2 = Session::get('usuario');
                                    $empresad =  $userDT2['empresa']; 


                                @endphp 
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Empresa: {{ $empresad->RAZONSOCIAL }} - {{ $empresad->CORREO }}
                                            @if (Session::get('rol') == 'PRO')
                                               <p style='color:red; font-weight: 500'> PROPIETARIO DEL SISTEMA<p>
                                            @endif
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="card-body" id="card-body-content">
                                        <div class="row">
                                            <div class="col-xs-6 col-xxl-3 m-b-30">
                                                <div class="card card-statistics h-100 m-b-0 bg-secondary">
                                                    <div class="card-body">
                                                        <h2 class="text-white mb-0">{{ count($usuarios)}}</h2>
                                                        <p class="text-white">Usuarios</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-xxl-3 m-b-30">
                                                <div class="card card-statistics h-100 m-b-0 bg-primary">
                                                    <div class="card-body">
                                                        <h2 class="text-white mb-0">{{ count($facturas)}}</h2>
                                                        <p class="text-white">Facturas </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-xxl-3 m-b-30">
                                                <div class="card card-statistics h-100 m-b-0 bg-orange">
                                                    <div class="card-body">
                                                        <h2 class="text-white mb-0">{{ count($compras)}}</h2>
                                                        <p class="text-white">Compras </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-xxl-3 m-b-30">
                                                <div class="card card-statistics h-100 m-b-0 bg-info">
                                                    <div class="card-body">
                                                        @php
                                                            $totalComision = 0;     
                                                        @endphp
                                                        @foreach ($comisiones as $item)
                                                           @php $totalComision = $totalComision + $item->MONTO @endphp
                                                        @endforeach
                                                        <h2 class="text-white mb-0">{{  $totalComision }}</h2>
                                                        <p class="text-white">
                                                            @if (Session::get('rol') == 'ADM' || Session::get('rol') == 'OPE' || Session::get('rol') == 'REP' )
                                                                Pago de Servicio Plataforma
                                                            @else
                                                                Comisiones
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" id="chart2"></div>
                                            
                                            <div class="col-md-6" id="chart1"></div>
                                        </div> 
                                    </div>
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
    
    <script src="assets/js/dtutils/dataTables.buttons.min.js"></script>
    <script src="assets/js/dtutils/buttons.html5.min.js"></script>
    <script src="assets/js/dtutils/pdfmake.min.js"></script>
    <script src="assets/js/dtutils/vfs_fonts.js"></script>
   

    <script>     
    
        if($("#chart1").length > 0) {
            
            let documentos2 = JSON.parse("{{ json_encode($chart1) }}".replace(/&quot;/g,'"'));
            let fechasc = [];
            let contador = [];
            
            $.each(documentos2,function(i,item){
                fechasc.push(documentos2[i].FECHAEMI);
                contador.push(documentos2[i].TOTAL);
            });

            const options = {
                series: [{
                id: 'chart_1',
                name: 'Facturas por fechas',
                data: contador
                }],  
                title: {
                text: "Facturas por Fechas"
            }, 
                chart: {
                height: 250,
                type: 'bar'
                },
                dataLabels: {
                enabled:true
                },
                stroke: {
                curve: 'smooth'
                },
                xaxis: {
                type: 'datetime',
                categories: fechasc 
                },
                tooltip: {
                x: {
                    format: 'yy-MM-dd HH:mm:s'
                },
                },
            };
            
            var chart = new ApexCharts(document.querySelector("#chart2"), options);
            chart.render();

            //////////////////////////////////////////////////////////////////////////////////
            const documentos1 = JSON.parse("{{ json_encode($chart2) }}".replace(/&quot;/g,'"'));
        
            
            let fechasc2 = [];
            let contador2 = [];
            let series3 = [];
            let total = 0;

            $.each(documentos1,function(i,item){
                fechasc2.push(documentos1[i].FECHAEMI);
                contador2.push(parseFloat(documentos1[i].NETO));
                total = total + parseFloat(documentos1[i].NETO);
            });

            const options2 = {
            series: contador2,
            id: 'chart_2',
            chart: {
                height: 200,
                type: 'pie',
            },       
            labels:fechasc2,
            title: {
                text: "Netos por Día"
            },
            };
        
            var chart2 = new ApexCharts(document.querySelector("#chart1"), options2);
            chart2.render();
        }

        $('.url_menu_lateral').on('click',function(e){
           
            if($("#chart1").length > 0) {
                var chart_2l = chart2;
                var chartl = chart;
                chart_2l.destroy();
                chartl.destroy();
            }
            
            
            $.ajax({
                url: $(this).attr("id_url"),
                type: 'GET',
                data: null,
                success: function (data) {
                    $('#card-body-content').html(data);
                }
            })
        })

        $('.url_menu_top').on('click',function(e){
           
           if($("#chart1").length > 0) {
               var chart_2l = chart2;
               var chartl = chart;
               chart_2l.destroy();
               chartl.destroy();
           }
           
            let urlvar = $(this).attr("id_url")

           $.ajax({
               url:urlvar ,
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