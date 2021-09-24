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
        <input onkeypress="javascript:return isNumber(event)" name="cedula" type="text" class="form-control" maxlength="15" id="cedula" aria-describedby="emailHelp" placeholder="" value="">
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
        <input name="usuario" type="text" class="form-control" id="usuario" aria-describedby="emailHelp" placeholder="" value="">
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
<script >
    function verificarCedula2(cedula) {
        try {
            var auxCedula = cedula;
            if (auxCedula.length !== 10) {
                return false;
            }
            var primeros2 = +auxCedula.substr(0, 2);
            if (primeros2 < 1 || primeros2 > 24) {
                return false;
            }
            var digitoVerificador = +auxCedula.split("").slice(-1);
            var coeficientes_1 = [2, 1, 2, 1, 2, 1, 2, 1, 2];
            var sumaT = auxCedula.substr(0, 9).split("").reduce(function(p, c, i) {
                var aux = 0;
                var mult = +c * coeficientes_1[i];
                aux = mult > 9 ? mult - 9 : mult;
                return p + aux;
            }, 0);
            var residuo = sumaT % 10;
            return residuo === 0 ? digitoVerificador === 0 : 10 - residuo === digitoVerificador;
        } catch (error) {
            return false;
        }
    }
</script>


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

        }else{
            if(!verificarCedula2(cedula)){
                swal({
                    position: 'top-end',
                    type: 'error',                          
                    title: 'Error al guardar usuario',
                    text:"La Cedula ingresada es invalida.",
                    showConfirmButton: false,
                    timer: 3200
                }) 
                return 0;
            }
        }

        

           
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
                    let fields = data.fieldError;
                    if(fields != null){
                        fields.forEach( function(valor, indice, array) {
                            const element = document.getElementById(valor);
                            element.classList.add("invalid_field");
                        });
                    }
                   
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


    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57 || iKeyCode == 110))
            return false;
        return true;
    }   

</script>
