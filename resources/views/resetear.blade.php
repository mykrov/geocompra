<!DOCTYPE html>
<html lang="es">
<head>
    <title>Recuperar Contraseña Afrodita</title>
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
    <link rel="stylesheet" type="text/css" href="http://portalfac2021.test:1432/assets/css/vendors.css" />
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="http://portalfac2021.test:1432/assets/css/style.css" />
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
                        <img src="http://portalfac2021.test:1432/assets/img/loader/loader.svg" alt="loader">
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
                                        <p>Registro de Nueva Contraseña</p>
                                        <form id="register_form" action="" class="mt-2 mt-sm-5">
                                            <div class="row">                                                 
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="input-group mb-3">
                                                        <div class="form-group col-12">
                                                            <input id="token_id" name="token_id" type="hidden" value="{{ $id }}"> 
                                                            <input id="pass1" name="pass1"  maxlength='15'  minlength='4' type="password" class="form-control" placeholder="Contraseña " aria-label="identificacion" aria-describedby="basic-addon2">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <input id="pass2" name="pass2"  maxlength='15'  minlength='4' type="password" class="form-control" placeholder="Repetir Contraseña" aria-label="identificacion" aria-describedby="basic-addon2">
                                                        </div>
                                                    </div>
                                                </div>                                               
                                                <div class="form-group col-md-12 mt-3">
                                                    <button id="cambiar" type="submit" class="btn btn-primary mb-2">Cambiar</button>
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
                                        <img class="img-fluid" src="http://portalfac2021.test:1432/assets/img/bg/login.svg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
        <!-- end app-wrap -->
    </div>
    <!-- end app -->
    <!-- plugins -->
    <script src="http://portalfac2021.test:1432/assets/js/vendors.js"></script>

    <!-- custom app -->
    <script src="http://portalfac2021.test:1432/assets/js/app.js"></script>

    <script>

        $('#cambiar').click(function(e){

            e.preventDefault();
            $("#cambiar").prop('disabled',true);
            let token_id = $('#token_id').val();
            let pass1 = $('#pass1').val();
            let pass2 = $('#pass2').val();

            if(pass2.length < 4){
                $("#cambiar").prop('disabled',false);
                swal({
                    position: 'top-end',
                    type: 'error',                          
                    title: 'Error Afrodita',
                    text:'Las contraseñas debe ser mayor de 4 caracteres.',
                    showConfirmButton: false,
                    timer: 3200
                }) 

                return 0;

            }

            if(pass2 != pass1){
                $("#cambiar").prop('disabled',false);
                swal({
                    position: 'top-end',
                    type: 'error',                          
                    title: 'Error Afrodita',
                    text:'Las contraseñas no coinciden.',
                    showConfirmButton: false,
                    timer: 3200
                }) 

                return 0;

            }

            const formData = new FormData();
            formData.append("pass1", pass2);
            formData.append("token_id", token_id);
            console.log(formData);
           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                url: '{{ route("cambiopass") }}' ,
                type: 'POST',
                data:formData ,
                success: function (data) {
                    if(data.status == 'ok')
                    {    
                        console.log('exito');
                        swal({
                            position: 'top-end',
                            type: 'success',                          
                            title: 'Contraseña Actualizada con exito.',
                            text:data.message,
                            showConfirmButton: false,
                            timer: 5200
                        }) 
                    }else{
                        $("#cambiar").prop('disabled',false);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error Afrodita',
                            text:'Error al intentar actualizar contraseña.',
                            showConfirmButton: false,
                            timer: 5200
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