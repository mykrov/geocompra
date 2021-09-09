<!DOCTYPE html>
<html lang="es">
<head>
    <title>Recuperar Contrsaeña Afrodita</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Rangel Manuel" />
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

<body class="bg-white">
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
            <!--start login contant-->
            <div class="app-contant">
                <div class="bg-white">
                    <div class="container-fluid p-0">
                        <div class="row no-gutters">
                            <div class="col-sm-6 col-lg-5 col-xxl-3  align-self-center order-2 order-sm-1">
                                <div class="d-flex align-items-center h-100-vh">
                                    <div class="register p-5">
                                        <h1 class="mb-2">Afrodita</h1>
                                        <p>Recuperación de Contraseña</p>
                                        <form id="register_form" action="" class="mt-2 mt-sm-5">
                                            <div class="row">                                                 
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="input-group mb-3">
                                                        <input id="ruc_input" name="RUC"  maxlength=14 type="text" class="form-control" placeholder="RUC " aria-label="identificacion" aria-describedby="basic-addon2">
                                                        <div class="input-group-append">
                                                            <button id="btn_buscar_ruc" class="btn btn-outline-primary" type="button">Buscar</button>
                                                        </div>
                                                    </div>
                                                </div>                                               
                                               
                                                <div class="col-12  mt-3">
                                                    <p>ya está registrado?<a href="/"> Ingresar</a></p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xxl-9 col-lg-7 bg-gradient o-hidden order-1 order-sm-2">
                                <div class="row align-items-center h-100">
                                    <div class="col-7 mx-auto ">
                                        <img class="img-fluid" src="assets/img/bg/login.svg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="scrollingLongContent" tabindex="-1" role="dialog" aria-labelledby="scrollingLongContent" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Terminos de Uso Afrodita App</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Al registrarme acepto las siguientes condiciones de uso y entiendo los términos, además confirmo que soy una persona mayor de edad, que ha leído y entendido todos los términos que se detallan.</p>
                        <ul>
                            <li> 1.-Soy responsable de las facturas que emito; el cliente y valor que declaro en mi factura es de mi responsabilidad.</li>
                            <li> 2.-Las facturas comerciales que emito son producto de actividades legales en el Ecuador.</li>
                            <li> 3.-Libro de cualquier responsabilidad a BIROBID S.A. por el NO ENVIO de la factura electrónica vía correo electrónico al cliente; entiendo que el no envío por correo electrónico se puede dar por causas ajenas a BIROBID, como correo mal ingresado, APP sin internet, Cola de correos por enviar.</li>
                            <li> 4.-El esquema de facturación electrónica que APLICA AFRODITA es fuera de LINEA, es decir se emite la factura, se firma electrónicamente la factura; se envía por correo al cliente y si la pagina del SRI está en línea se sube la factura al SRI, caso contrario se enviará la factura cuando los servidores del SRI estén en LINEA.</li>
                            <li> 5.-BIROBID S.A. guarda sus datos y realiza respaldos para mayor seguridad y disponibilidad, este es un servicio de BIROBID y no es obligación tener su información respaldada, ya que este servicio es solo un medio de emisión y no de almacenamiento.</li>
                            <li> 6.-Su información será solo accesible a través de su usuario y clave; las claves y demás datos relevantes son almacenados en forma encriptada.</li>
                            <li> 7.-Si la cuenta se encuentra inactiva por mas de 6 mese (180 días) la cuenta se pondrá en estado inactiva.</li>
                            <li> 8.-En la APP afrodita aparecerá BANNER de publicidad, NO puede cambiar ni pedir que no aparezcan dicha publicidad, si la publicidad de una marca me afecta u ofende puedo dejar de usar la aplicación.</li>
                            <li> 9.- Desde el momento en que el cliente recibe el software, el archivo descargado y los códigos de activación son de su entera responsabilidad. Es extremadamente importante que el cliente realice una copia de seguridad del archivo descargado y guardar con extremo celo, los códigos de activación de software, ya que ambos son esenciales en caso de formatear el equipo en que funcionara el software.</li>
                            <li> 10.- La empresa y sus usuarios aceptan que no dará un uso indebido al software, que con el uso no infringirá ni violará los derechos de terceros, ni violará ninguna ley, no contribuirán o alentarán la infracción u otra conducta contraria a la ley, ni de otro modo la información que maneje será obscena, cuestionable o de mal gusto.</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>                        
                    </div>
                </div>
            </div>
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->



    <!-- plugins -->
    <script src="assets/js/vendors.js"></script>

    <!-- custom app -->
    <script src="assets/js/app.js"></script>

    <script>

        $('#btn_buscar_ruc').click(function(e){

            e.preventDefault();
            $("#btn_buscar_ruc").prop("disabled",true);

            let ruc = $('#ruc_input').val()

            if(ruc.length != 13){
                $("#btn_buscar_ruc").prop("disabled",false);
                swal({
                    position: 'top-end',
                    type: 'error',
                    title: 'Error Afrodita',
                    text:'El RUC debe contener 13 digitos.',
                    showConfirmButton: true,
                    timer: 8000
                }) 

                return 0;

            }

            var formData = new FormData();
            formData.append("ruc", ruc);

            console.log(formData);
           

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                url: '/recuperarpass' ,
                type: 'POST',
                data:formData ,
                success: function (data) {
                    if(data.status == 'ok')
                    {    
                        console.log("exito");
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Recuperación de contraseña Afrodita',
                            text:data.message,
                            showConfirmButton: true,
                            timer: 8000
                        }) 
                    }else{
                        console.log('error');
                        $("#btn_buscar_ruc").prop("disabled",false);
                        swal({
                            position: 'top-end',
                            type: 'error',
                            title: 'Recuperación de contraseña Afrodita',
                            text:data.message,
                            showConfirmButton: true,
                            timer: 8000
                        }) 
                    }
                },
                cache: false,
                contentType: false,
                processData: false,                
            });

        })
    </script>
</body>
</html>