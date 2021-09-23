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
        <small id="cedula" class="form-text text-muted">Cedula.</small>
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
            
            // if (!hasExtension('firmaelectronica', ['.p12'])) {
            //     swal({
            //         position: 'top-end',
            //         type: 'error',                          
            //         title: 'Firma con extensión invalida.',
            //         text:'La firma debe ser con extensión .p12',
            //         showConfirmButton: false,
            //         timer: 3200
            //     }) 

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
</script>