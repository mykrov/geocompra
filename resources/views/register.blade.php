<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro Afrodita</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Rangel Manuel" />
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
                                    <div class="register p-5">
                                        <h1 class="mb-2">Afrodita</h1>
                                        <p>Creación de Cuenta</p>
                                        <form id="register_form" action="" class="mt-2 mt-sm-5">
                                            <div class="row">  
                                                <div class="col-md-5 col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Email*</label>
                                                        <input id="email" maxlength="50" name="correo" type="email" class="form-control" placeholder="Email" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="input-group mb-3">
                                                        <input id="ruc_input" name="RUC"  maxlength=13 type="text" class="form-control" placeholder="RUC " aria-label="identificacion" aria-describedby="basic-addon2">
                                                        <div class="input-group-append">
                                                            <button id="btn_buscar_ruc" class="btn btn-outline-primary" type="button">Buscar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Razon Social*</label>
                                                        <input id="Razon_social" name="name" type="text" class="form-control" placeholder="nombre" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label  class="control-label">Contraseña</label>
                                                        <input id="pass1" name="password" type="password"  maxlength="10" minlength="4" class="form-control" placeholder="contraseña" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Repita Contraseña</label>
                                                        <input id="pass2" name="password2" type="password" maxlength="10" minlength="4" class="form-control" placeholder="contraseña" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input name="terminos" class="form-check-input" type="checkbox" id="gridCheck">
                                                        <label class="form-check-label" for="gridCheck">                                                            
                                                            Acepto los <b><a data-toggle="modal" data-target="#scrollingLongContent" style="color:#8956e9" href="">terminos y condiciones</a></b>.
                                                        </label>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group col-md-12 mt-3">
                                                    <button id="registerbtn" type="submit" class="btn btn-primary mb-2">Registrar</button>
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
        let id = '';
        let inputnombre = document.getElementById("Razon_social");
        inputnombre.disabled = false;
       
        const fetchAndLog = async () => {
            $(".loader").show()
            const ruc = document.getElementById("ruc_input"); 
            ruc.disabled = false;            
            const response = await fetch('/validaruc/'+ruc.value);
            const json = await response.json();            

            if(response.status != 200){
                 $(".loader").hide()
                swal({
                    position: 'top-end',
                    type: 'error',                          
                    title: 'Error Afrodita, al consultar RUC',
                    text:"por favor verifique los digitos.",
                    showConfirmButton: false,
                    timer: 2000
                }) 
               let ty = document.getElementById('ruc_input').disabled =false ;
            }else{
                $(".loader").hide()
                if(response.status = 200 && [0].Razon_social != ''){
                    inputnombre.value = "";
                    inputnombre.value = json[0].Razon_social; 
                }else{
                    $(".loader").hide()
                    let ty = document.getElementById('ruc_input').disabled = false;
                    swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error Afrodita, Error al consultar RUC',
                            text:"por favor verifique los digitos.",
                            showConfirmButton: false,
                            timer: 2000
                    }) 
                }
            }
        }
        
        
        document.getElementById('btn_buscar_ruc').addEventListener('click', function(event) {
            const valor = document.getElementById('ruc_input').value;  
            
            if (valor.length == 13) {
                
                fetchAndLog(); 
            }else{
               swal({
                    position: 'top-end',
                    type: 'error',                          
                    title: 'Error Afrodita, Error al consultar RUC',
                    text:"Debe indicar un RUC de 13 digitos.",
                    showConfirmButton: false,
                    timer: 2000
                })  
            }
        }); 


        // document.getElementById('ruc_input').addEventListener('keyup', function(event) {
        //     const valor = document.getElementById('ruc_input').value;            
        //     if (valor.length == 13) {
        //         fetchAndLog(); 
        //     }
        // }); 

        // document.getElementById('ruc_input').addEventListener('paste', function(event) {
        //     const valor = document.getElementById('ruc_input').value;            
        //     if (valor.length == 13) {                 
        //         fetchAndLog(); 
        //     }
        // });
             
        
        $("form#register_form").submit(function(e) {
            
            e.preventDefault()
            let btnReg =  document.getElementById("registerbtn");
            
            let pass1 = document.getElementById("pass1").value;
            let pass2 = document.getElementById("pass2").value;
            let chkBox = document.getElementById("gridCheck");
            let email = document.getElementById("email").value;
            let ruc = document.getElementById("ruc_input").value;
            let nombre = document.getElementById("Razon_social").value;

            if(ruc.length != 13 || nombre == "" ){
                swal({
                    position: 'top-end',
                    type: 'error',                          
                    title: 'Error Afrodita, en formulario',
                    text:"No hay datos asociados al RUC ingresado.",
                    showConfirmButton: false,
                    timer: 3000
                }) 
                return 0; 
            }

            if(email == ""){
                swal({
                    position: 'top-end',
                    type: 'error',                          
                    title: 'Error Afrodita, en formulario',
                    text:"Debe indicar una dirección de email.",
                    showConfirmButton: false,
                    timer: 3000
                }) 
                return 0; 
            }

            
            if(chkBox.checked == false){
                swal({
                    position: 'top-end',
                    type: 'error',                          
                    title: 'Error Afrodita, en formulario',
                    text:"Debe aceptar las condiciones.",
                    showConfirmButton: false,
                    timer: 3000
                }) 
                return 0;
            }

            if(pass1 != pass2 || pass1 == ""){
                swal({
                    position: 'top-end',
                    type: 'error',                          
                    title: 'Error Afrodita, Error en formulario',
                    text:"Por favor digite correctamente las contraseñas.",
                    showConfirmButton: false,
                    timer: 3000
                }) 
                return 0;
            }

           
            const formData = new FormData(this);             
            btnReg.disabled = true
            $(".loader").show();
            $.ajax({
                url: '{{ env("APP_URL_APOLO") }}api/empresa' ,
                type: 'POST',
                data: formData,
                success: function (data) {
                    if(data.status == 'ok')
                    {     
                        $(".loader").hide()
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Registro Afrodita Exitoso',
                            text:"Verifique su correo para activar la cuenta y completar el registro.",
                            showConfirmButton: false,
                            timer: 5000
                        })                      
                        
                    }else{
                        $(".loader").hide()
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error Afrodita, al registrar',
                            text:data.message,
                            showConfirmButton: false,
                            timer: 3200
                        }) 
                        btnReg.disabled = false;
                    }
                },
                error:function (data){
                    $(".loader").hide();
                    console.log(data);
                    swal({
                        position: 'top-end',
                        type: 'error',                          
                        title: 'Error Afrodita, al registrar',
                        text:data.responseJSON.error,
                        showConfirmButton: false,
                        timer: 3200
                    }) 
                    btnReg.disabled = false;
                },
                cache: false,
                contentType: false,
                processData: false,                
            });

        })
    </script>
</body>
</html>