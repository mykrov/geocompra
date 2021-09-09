<!DOCTYPE html>
<html lang="es">

<head>
    <title>Login GEOCOMPRA</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Aplicacion App Android FActuracion SRI" />
    <meta name="author" content="Manuel Rangel" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
                                    <div class="login p-50">
                                        <h1 class="mb-2">BIENVENIDO A GEOCOMPRA</h1>
                                        <p>por favor ingrese.</p>
                                        @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                        @endif
                                        @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                        @endif
                                        @if (session('usuario'))
                                            <p>{{ session('usuario') }}</p>
                                        @endif
                                        <form id="formLogin" action="/authlogin" method="POST" class="mt-3 mt-sm-5">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Email de usuario*</label>
                                                        <input type="text" name="email" class="form-control" placeholder="email" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Contraseña*</label>
                                                        <input type="password" name="password" class="form-control" placeholder="contraseña" />
                                                    </div>
                                                </div>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <div class="col-12">
                                                    <div class="d-block d-sm-flex  align-items-center">
                                                        <div class="form-check">
                                                            <input name="remember" class="form-check-input" type="checkbox" id="gridCheck">
                                                            <label class="form-check-label" for="gridCheck">
                                                                Recordarme
                                                            </label>
                                                        </div>
                                                        <a href="" class="ml-auto">Olvidó contraseña ?</a>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <a id="sendButton" href="" class="btn btn-primary text-uppercase">Ingresar</a>
                                                </div>
                                                <div class="col-12  mt-3">
                                                    <p>Desea registrarse ?<a href=""> Registrarse</a></p>
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
            <!--end login contant-->
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->
    <!-- plugins -->
    <script src="assets/js/vendors.js"></script>

    <!-- custom app -->
    <script src="assets/js/app.js"></script>
    <script>

    async function postFormDataAsJson() {
        $(".loader").show();
        const form = document.getElementById("formLogin");
        const url = '/authlogin';
        const formData2 = new FormData(form);

        const plainFormData = Object.fromEntries(formData2.entries());
        const formDataJsonString = JSON.stringify(plainFormData);

        const fetchOptions = {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
            body: formDataJsonString,
        };

        const response = await fetch(url, fetchOptions);

        if (!response.ok) {
            $(".loader").hide();
            const errorMessage = await response.text();
            throw new Error(errorMessage);
        }else{ 
                      
            const data = await response.json();
            console.log(data);
            
            if(data.status == 'ok'){
                //alert('login exitoso');
                $(".loader").hide();
                window.location.replace('/')
                $(".loader").hide();  
            }else{
                $(".loader").hide();
                swal({
                    position: 'top-end',
                    type: 'error',                          
                    title: 'Error de Login',
                    text:'Los datos ingresados no son validos.',
                    showConfirmButton: false,
                    timer: 3200
                }) 
            }
        }   
       
    }    

    function handleClick(e){
        e.preventDefault();
        postFormDataAsJson()
    }  
    const buttonSend = document.getElementById("sendButton");
    buttonSend.addEventListener('click',handleClick);

    </script>
</body>
</html>