<div>
    <h4>Edición de Bodega</h4>
</div>
<form class="form-row" id="bodega_up_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id" value='{{$bod->IDBODEGA}}'>
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
        
    <div class="form-group col-md-2">
        <label for="nombrecomercial">Nombre Comercial</label>
        <input name="nombrecomercial" type="text" class="form-control" id="nombrecomercial"  maxlength="50"   aria-describedby="emailHelp" placeholder="" value="{{$bod->NOMBRECOMERCIAL}}">
        <small id="nombrecomercial" class="form-text text-muted">Nombre del la bodega.</small>
    </div>
    <div class="form-group col-md-2">
        <label for="serie">Serie</label>
        <input name="serie" type="text" class="form-control" maxlength="15" id="serie" aria-describedby="emailHelp" placeholder="" value="{{$bod->SERIE}}">
        <small id="serie" class="form-text text-muted">serie</small>
    </div>
    <div class="form-group col-md-4">
        <label for="secuencial">Secuencial</label>
        <input name="secuencial" type="number" class="form-control" maxlength="12" id="secuencial" aria-describedby="emailHelp" placeholder="" value="{{$bod->NOSECUENCIAL}}">
        <small id="secuencial" class="form-text text-muted">secuencial.</small>
    </div>
    <div class="form-group col-md-4">
        <label for="nnotacredito">Nro Nota Credito</label>
        <input name="nnotacredito" type="number" class="form-control" maxlength="12" id="nnotacredito" aria-describedby="emailHelp" placeholder="" value="{{$bod->NOSECUENCIALNCR}}">
        <small id="nnotacredito" class="form-text text-muted">secuencial nota credito.</small>
    </div>
    <div class="form-group col-md-4">
        <label for="nguiarem">Nro Guia Remision</label>
        <input name="nguiarem" type="number" class="form-control" maxlength="12" id="nguiarem" aria-describedby="emailHelp" placeholder="" value="{{$bod->NOGUIAREMISION}}">
        <small id="nguiarem" class="form-text text-muted">secuencial guia remision.</small>
    </div>
    <div class="form-group col-md-2">
        <label for="correo">Correo</label>
        <input name="correo" type="text" class="form-control" id="correo" aria-describedby="emailHelp" placeholder="" value="{{$bod->CORREO}}">
        <small id="correo" class="form-text text-muted">Dirección de Correo</small>
    </div>  
    <div class="form-group col-md-2">
        <label for="telefono">Telefono</label>
        <input name="telefono" type="text" class="form-control" id="telefono" aria-describedby="emailHelp" placeholder="" value="{{$bod->TELEFONO}}">
        <small id="telefono" class="form-text text-muted">telefono</small>
    </div>  
    <div class="form-group col-md-2">
        <label for="direccion">Direccion</label>
        <input name="direccion" type="text" class="form-control" id="direccion" aria-describedby="emailHelp" placeholder="" value="{{$bod->DIRECCION}}">
        <small id="direccion" class="form-text text-muted">Dirección </small>
    </div> 
    <div class="form-group col-md-2">
        <label for="latitud">Latitud</label>
        <input name="latitud" type="text" class="form-control" id="latitud" aria-describedby="emailHelp" placeholder="" value="{{$bod->LATITUD}}">
        <small id="latitud" class="form-text text-muted">latitud</small>
    </div>
    <div class="form-group col-md-2">
        <label for="longitud">Longitud</label>
        <input name="longitud" type="text" class="form-control" id="longitud" aria-describedby="emailHelp" placeholder="" value="{{$bod->LONGITUD}}">
        <small id="longitud" class="form-text text-muted">longitud</small>
    </div>
  
    <div class="form-group col-md-12 mt-3">
        <button id="save_btn" type="submit" class="btn btn-primary mb-2">Guardar</button>
    </div> 
</form>
<script>

$("form#bodega_up_form").submit(function(e) {
            
            e.preventDefault();                
            const formData = new FormData(this); 
            console.log(formData); 

            // jQuery.each(jQuery('#producto_up_form')[0].files, function(i, file) {
            //     formData.append('file-'+i, file);
            // });

            

            $.ajax({
                url: '{{ route('bodegaupdate') }}',
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);
                    if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Bodega Actualizado.',
                            showConfirmButton: false,
                            timer: 1200
                        })                      
                        
                    }else{
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error al Actualizar',
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