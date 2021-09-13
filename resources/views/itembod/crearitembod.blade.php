<div>
    <h4>Agregar Item a Bodega</h4>
</div>
<form class="form-row" id="itembodega_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
        
    <div class="form-group mb-0 col-md-3" data-select6-id="6">
        <label>Bodega</label>
        <select class="js-basic-single form-control" name="idbodega" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($bodegas as $bod)
                <option value="{{$bod->IDBODEGA}}" data-select6-id="1">{{$bod->NOMBRECOMERCIAL}}</option>
            @endforeach                             
        </select>
    </div>

    <div class="form-group mb-0 col-md-3" data-select6-id="6">
        <label>Producto</label>
        <select class="js-basic-single form-control" name="idproducto" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($productos as $pro)
                <option value="{{$pro->IDPRODUCTO}}" data-select6-id="1">{{$pro->NOMBRE}}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="stock">Stock</label>
        <input name="stock" type="text" class="form-control" maxlength="15" id="stock" aria-describedby="emailHelp" placeholder="" value="">
        <small id="stock" class="form-text text-muted"></small>
    </div>

    <div class="form-group col-md-12 mt-3">
        <button id="save_btn" type="submit" class="btn btn-primary mb-2">Guardar</button>
    </div> 
</form>
<script>

    $("form#itembodega_form").submit(function(e) {
            
            e.preventDefault();                
            const formData = new FormData(this); 
            console.log(formData);
        

            // jQuery.each(jQuery('#usuario_form')[0].files, function(i, file) {
            //     formData.append('file-'+i, file);
            // });
            

            $.ajax({
                url: '{{ route('itembodguardar') }}' ,
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);
                    if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Item agregado a Bodega.',
                            showConfirmButton: false,
                            timer: 1200
                        })                      
                        
                    }else{
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error al guardar item en bodega.',
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