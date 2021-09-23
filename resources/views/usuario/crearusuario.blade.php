<div>
    <h4>Creación de Usuario</h4>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
 
</div>
<form class="form-row" id="usuario_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
        
    <div class="form-group col-md-3">
        <label for="nombre">Nombre</label>
        <input name="nombre" type="text" class="form-control" id="nombre"  maxlength="50"   aria-describedby="emailHelp" placeholder="" value="">
        <small id="nombre" class="form-text text-muted">Nombre del usuario.</small>
    </div>
    <div class="form-group col-md-2">
        <label for="cedula">Cedula</label>
        <input name="cedula" type="text" class="form-control" maxlength="15" id="cedula" aria-describedby="emailHelp" placeholder="" value="">
        <small  class="form-text text-muted">Cedula.</small>
    </div>
    <div class="form-group col-md-2">
        <label for="telefono">Telefono</label>
        <input name="telefono" type="text" class="form-control" maxlength="10" id="telefono" aria-describedby="emailHelp" placeholder="" value="">
        <small id="telefono" class="form-text text-muted">Telefono dle usuario.</small>
    </div>
    <div class="form-group col-md-3">
        <label for="correo">Correo</label>
        <input name="correo" type="text" class="form-control" id="correo" aria-describedby="emailHelp" placeholder="" value="">
        <small id="correo" class="form-text text-muted">Dirección de Correo</small>
    </div>   
    <div class="form-group col-md-2">
        <label for="usuario">Nombre de Usuario</label>
        <input name="usuario" type="usuario" class="form-control" id="usuario" aria-describedby="emailHelp" placeholder="" value="">
        <small id="usuario" class="form-text text-muted">Username.</small>
    </div>
    <div class="form-group col-md-2">
        <label for="clave">Clave</label>
        <input name="clave" type="password" class="form-control" id="clave" aria-describedby="emailHelp" placeholder="" value="">
       
    </div>
    <div class="col-md-1 text-center">
        <div style="margin-top: 30px;margin-left:-3rem">
            <i class="form-control-feedback bi bi-eye-slash" style="cursor: pointer; color:red;font-size:1.5rem;"  id="togglePassword"></i>
        </div>
    </div>
    <div class="form-group mb-0 col-md-2" data-select6-id="6">
        <label>Rol</label>
        <select class="js-basic-single form-control" name="idrol" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($roles as $rol)
                <option value="{{$rol->IDROLES}}" data-select6-id="1">{{$rol->NOMBRE}}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group mb-0 col-md-3" data-select6-id="6">
        <label>Bodega</label>
        <select class="js-basic-single form-control" name="idbodega" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($bodegas as $bod)
                <option value="{{$bod->IDBODEGA}}" data-select6-id="1">{{$bod->NOMBRECOMERCIAL}}</option>
            @endforeach                             
        </select>
    </div>
    @if (Session::get('rol') == 'PRO')
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Empresa</label>
        <select class="js-basic-single form-control" name="idempresa" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($empresas as $empre)
                <option value="{{$empre->IDEMPRESA }}" data-select6-id="1">{{ $empre->RAZONSOCIAL }}</option>
            @endforeach                             
        </select>
    </div>
    @endif
    
    <div class="form-group col-md-12 mt-3">
        <button id="save_btn" type="submit" class="btn btn-primary mb-2">Guardar</button>
    </div> 
</form>
<script src="assets/js/ruc_jquery_validator.min.js"></script>

<script>

    var togglePassword = document.querySelector('#togglePassword');
    var password = document.querySelector('#clave');

    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye / eye slash icon
        this.classList.toggle('bi-eye');
    });

    $("form#usuario_form").submit(function(e) {
            
        e.preventDefault();                
        const formData = new FormData(this); 
        console.log(formData);

        let cedula = $('#cedula').val();

        if(cedula.length < 10){
            swal({
                position: 'top-end',
                type: 'error',                          
                title: 'Error al guardar usuario',
                text:"La Cedula debe tener al menos 10 caracteres.",
                showConfirmButton: false,
                timer: 3200
            }) 
            return 0;
        }

        // if(!validarDocumento(cedula)){
        //     return 0;
        // }

           
        jQuery.each(jQuery('#usuario_form')[0].files, function(i, file) {
            formData.append('file-'+i, file);
        });

        $.ajax({
            url: '{{ route('usuarioguardar') }}' ,
            type: 'POST',
            data: formData,
            success: function (data) {
                console.log(data);
                if(data.status == 'ok')
                {                       
                    swal({
                        position: 'top-end',
                        type: 'success',
                        title: 'Usuario Guardado.',
                        showConfirmButton: false,
                        timer: 1200
                    })                      
                    
                }else{
                    console.log(data);
                    swal({
                        position: 'top-end',
                        type: 'error',                          
                        title: 'Error al guardar usuario',
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

    function CedulaInvalida(){
        swal({
            position: 'top-end',
            type: 'error',                          
            title: 'Error al guardar usuario',
            text:"La Cedula Invalida.",
            showConfirmButton: false,
            timer: 3200
        }) 
        return 0;
    }
</script>

<script>
validarDocumento  = function() {          

    numero = document.getElementById('cedula').value;
    /* alert(numero); */

    var suma = 0;      
    var residuo = 0;      
    var pri = false;      
    var pub = false;            
    var nat = false;      
    var numeroProvincias = 22;                  
    var modulo = 11;
                
    /* Verifico que el campo no contenga letras */                  
    var ok=1;
    for (i=0; i<numero.length && ok==1 ; i++){
        var n = parseInt(numero.charAt(i));
        if (isNaN(n)) ok=0;
    }
    if (ok==0){
        alert("No puede ingresar caracteres en el número");         
        return false;
    }
                
    if (numero.length < 10 ){              
        alert('El número ingresado no es válido');                  
        return false;
    }

    /* Los primeros dos digitos corresponden al codigo de la provincia */
    provincia = numero.substr(0,2);      
    if (provincia < 1 || provincia > numeroProvincias){           
        alert('El código de la provincia (dos primeros dígitos) es inválido');
    return false;       
    }

    /* Aqui almacenamos los digitos de la cedula en variables. */
    d1  = numero.substr(0,1);         
    d2  = numero.substr(1,1);         
    d3  = numero.substr(2,1);         
    d4  = numero.substr(3,1);         
    d5  = numero.substr(4,1);         
    d6  = numero.substr(5,1);         
    d7  = numero.substr(6,1);         
    d8  = numero.substr(7,1);         
    d9  = numero.substr(8,1);         
    d10 = numero.substr(9,1);                
        
    /* El tercer digito es: */                           
    /* 9 para sociedades privadas y extranjeros   */         
    /* 6 para sociedades publicas */         
    /* menor que 6 (0,1,2,3,4,5) para personas naturales */ 

    if (d3==7 || d3==8){           
        alert('El tercer dígito ingresado es inválido');                     
        return false;
    }         
        
    /* Solo para personas naturales (modulo 10) */         
    if (d3 < 6){           
        nat = true;            
        p1 = d1 * 2;  if (p1 >= 10) p1 -= 9;
        p2 = d2 * 1;  if (p2 >= 10) p2 -= 9;
        p3 = d3 * 2;  if (p3 >= 10) p3 -= 9;
        p4 = d4 * 1;  if (p4 >= 10) p4 -= 9;
        p5 = d5 * 2;  if (p5 >= 10) p5 -= 9;
        p6 = d6 * 1;  if (p6 >= 10) p6 -= 9; 
        p7 = d7 * 2;  if (p7 >= 10) p7 -= 9;
        p8 = d8 * 1;  if (p8 >= 10) p8 -= 9;
        p9 = d9 * 2;  if (p9 >= 10) p9 -= 9;             
        modulo = 10;
    }         

    /* Solo para sociedades publicas (modulo 11) */                  
    /* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
    else if(d3 == 6){           
        pub = true;             
        p1 = d1 * 3;
        p2 = d2 * 2;
        p3 = d3 * 7;
        p4 = d4 * 6;
        p5 = d5 * 5;
        p6 = d6 * 4;
        p7 = d7 * 3;
        p8 = d8 * 2;            
        p9 = 0;            
    }         
        
    /* Solo para entidades privadas (modulo 11) */         
    else if(d3 == 9) {           
        pri = true;                                   
        p1 = d1 * 4;
        p2 = d2 * 3;
        p3 = d3 * 2;
        p4 = d4 * 7;
        p5 = d5 * 6;
        p6 = d6 * 5;
        p7 = d7 * 4;
        p8 = d8 * 3;
        p9 = d9 * 2;            
    }
                
    suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;                
    residuo = suma % modulo;                                         

    /* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
    digitoVerificador = residuo==0 ? 0: modulo - residuo;                

    /* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/                         
    if (pub==true){           
        if (digitoVerificador != d9){                          
            alert('El ruc de la empresa del sector público es incorrecto.');            
            return false;
        }                  
        /* El ruc de las empresas del sector publico terminan con 0001*/         
        if ( numero.substr(9,4) != '0001' ){                    
            alert('El ruc de la empresa del sector público debe terminar con 0001');
            return false;
        }
    }         
    else if(pri == true){         
        if (digitoVerificador != d10){                          
            alert('El ruc de la empresa del sector privado es incorrecto.');
            return false;
        }         
        if ( numero.substr(10,3) != '001' ){                    
            alert('El ruc de la empresa del sector privado debe terminar con 001');
            return false;
        }
    }      

    else if(nat == true){         
        if (digitoVerificador != d10){                          
            alert('El número de cédula de la persona natural es incorrecto.');
            return false;
        }         
        if (numero.length >10 && numero.substr(10,3) != '001' ){                    
            alert('El ruc de la persona natural debe terminar con 001');
            return false;
        }
    }      
    return true;   
}            

</script>