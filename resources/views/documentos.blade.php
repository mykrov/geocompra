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
                                        {{-- <div class="p-4">
                                            <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                                <i class="fa fa-user pr-2 text-success"></i> Cuenta</a>
                                            <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                                <i class="fa fa-envelope pr-2 text-primary"></i> Mensajes
                                                <span class="badge badge-primary ml-auto">6</span>
                                            </a>
                                            <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                                <i class=" ti ti-settings pr-2 text-info"></i> Configuracion
                                            </a>
                                            <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                                <i class="fa fa-compass pr-2 text-warning"></i> Ayuda</a>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <a class="bg-light p-3 text-center d-block" href="#">
                                                        <i class="fe fe-mail font-20 text-primary"></i>
                                                        <span class="d-block font-13 mt-2">Mis Mensajes</span>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a class="bg-light p-3 text-center d-block" href="#">
                                                        <i class="fe fe-plus font-20 text-primary"></i>
                                                        <span class="d-block font-13 mt-2">Crear Nuevo</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
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
                            <li class="nav-static-title">Empresa</li>
                            <li class="active">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i class="nav-icon ti ti-rocket"></i>
                                    <span class="nav-title">Datos</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li class="inactive"> <a href='{{route('index')}}'>Modificar</a> </li>                                   
                                </ul>
                            </li>
                            <li class="active" ><a href="app-chat.html" aria-expanded="false"><i class="nav-icon ti ti-comment"></i><span class="nav-title">Documentos</span></a> </li>
                            
                            
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
                                        <h1>{{ $pagina }}</h1>
                                    </div>
                                    <div class="breadcrumb-bar align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="{{route('index')}}"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    {{ $seccion }}
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Default</li>
                                            </ol>
                                        </nav>
                                    </div>
                                    {{-- <div class="ml-auto d-flex align-items-center secondary-menu text-center">
                                        <a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Todo list">
                                            <i class="fe fe-edit btn btn-icon text-primary"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Projects">
                                            <i class="fa fa-lightbulb-o btn btn-icon text-success"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Task">
                                            <i class="fa fa-check btn btn-icon text-warning"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Calendar">
                                            <i class="fa fa-calendar-o btn btn-icon text-cyan"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Analytics">
                                            <i class="fa fa-bar-chart-o btn btn-icon text-danger"></i>
                                        </a>
                                    </div> --}}
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
                                            <h4 class="card-title">{{ $empresad->NOMBRE }} - {{ $empresad->CORREO }}</h4>
                                        </div>
                                    </div>                                   
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <input type="date" name="fecha1" id="fecha1" class="datepicker">
                                            <input type="date" name="fecha2" id="fecha2" class="datepicker">
                                            <input name="_token" type="hidden" class="form-control " id="_token"  placeholder="Direcion" value="{{ csrf_token() }}">
                                            <button class="btn btn-primary button" id="buscar">Consultar</button>
                                        </div>
                                       
                                       <table style="width: 100%" class="table table-striped table-responsive mt-3" id="tabla">
                                           <thead>
                                               <td>Número</td>
                                               <td>Documento</td>
                                               <td>Estado</td>
                                               <td>Fecha Emisión</td>
                                               <td>Autorización</td>
                                               <td>Cliente</td>
                                               <td>Correo</td>
                                           </thead>
                                           <tbody id="cuerpo_tabla">
                                               
                                           </tbody>
                                       </table>
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
                        <p>&copy; Copyright 2021. Birobid S.A.</p>
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
    
    <script>        

        let table = $('#tabla').DataTable({
            "dom": 'Bfrtip',
            "buttons": [
                'excel',
            ],
            "language": {
                "lengthMenu": "Mostrando _MENU_ registros por pagina",
                "zeroRecords": "Nada que mostrar",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Sin registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Busqueda",
                "paginate": {
                    "first":      "Primero",
                    "last":       "Ultimo",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
            }
        });

        $('.buttons-html5').addClass('btn btn-primary');
        
        const date = new Date();
        const currentDate = date.toISOString().substring(0,10);
        const mespasado = new Date(date.setMonth(date.getMonth()-1));

        $("#fecha1").val( mespasado.toISOString().substring(0,10));
        $("#fecha2").val(currentDate);

        
 

        $("#buscar").click(function(e) {
            
            e.preventDefault();  
            $(".loader").show(); 
            table.clear().draw();              
            let f1 = $("#fecha1").val();
            let f2 = $("#fecha2").val();
            let token = $("#_token").val();

            const formData = new FormData();
            formData.append("fecha1", f1);
            formData.append("fecha2", f2);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 

            $.ajax({
                url: '/obtenerfacturas' ,
                type: 'POST',
                data:formData ,
                success: function (data) {                    
                    $(".loader").hide();
                    if(data.facturas)
                    {         
                        let link = '';
                        let ruc = '{{ $userDT['ruc'] }}';
                        let serverpdf = '{{env('APP_URL_APOLO')}}';                                                            
                        for (var valor of data.facturas) {
                            
                            if(valor.NombreDocumento == null){
                                valor.NombreDocumento="Sin Procesar";
                                link = "Sin Procesar";
                            }else{
                                link ='<a target="blank" href='+serverpdf+'filepdf/'+ruc+'/'+valor.NombreDocumento+'.pdf>'+valor.NombreDocumento + '.pdf<a>';
                            }

                            if(valor.CLAVEACCESO == null){
                                valor.CLAVEACCESO="Sin Procesar";
                            }

                            table.row.add([
                                valor.NUMERO,
                                link,
                                valor.ESTADOPROCESO,
                                valor.FECHAEMI,
                                '<small>'+valor.CLAVEACCESO+'</small>',
                                '<small>'+valor.NOMBRE+'</small>',
                                '<small>'+valor.CORREO+'</small>'
                            ]);

                        }  
                        table.draw(); 
                        
                    }else{
                        $(".loader").hide();
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error consultando Documentos.',
                            text:data.message,
                            showConfirmButton: false,
                            timer: 3200
                        }) 
                    }
                },
                cache: false,
                contentType: false,
                processData: false,                
            });
        });

    </script>
</body>

</html>