<div>
    <h4>Editar de Repartidor</h4>
</div>
<form class="form-row" id="repartidor_up_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id" value="{{$repartidor->IDREPARTIDOR}}">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Usuario</label>
        <select class="js-basic-single form-control" name="idusuario" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($usuarios as $user)
                <option value="{{$user->IDUSUARIO}}"
                    @if ($user->IDUSUARIO == $repartidor->IDUSUARIO)
                        selected="selected"
                    @endif
                    data-select6-id="1">{{$user->NOMBRE}}</option>
            @endforeach                             
        </select>
    </div>   
    <div class="form-group col-md-2">
        <label for="vehiculo">Vehiculo</label>
        <input name="vehiculo" type="text" class="form-control" id="vehiculo"  maxlength="5"   aria-describedby="emailHelp" placeholder="" value="{{$repartidor->VEHICULO}}">
        <small id="vehiculo" class="form-text text-muted">Vehiculo.</small>
    </div>
    <div class="form-group col-md-2">
        <label for="placa">Placa</label>
        <input name="placa" type="text" class="form-control" maxlength="5" id="placa" aria-describedby="emailHelp" placeholder="" value="{{$repartidor->PLACA}}">
        <small id="placa" class="form-text text-muted">Placa del Vehiculo.</small>
    </div> 
    <div class="form-group col-md-12 mt-3">
        <button id="save_btn" type="submit" class="btn btn-primary mb-2">Guardar</button>
    </div> 
</form>
<script>
 $("form#repartidor_up_form").submit(function(e) {
            
            e.preventDefault();                
            const formData = new FormData(this); 
            console.log(formData); 


            $.ajax({
                url: '{{ route('repartidorupdate') }}',
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);
                    if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Repartidor Actualizado.',
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