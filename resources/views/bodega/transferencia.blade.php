<div>
    <h4>Transferencia de Bodega</h4>
</div>
<form class="form-row" id="itembodega_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
        
    <div class="form-group mb-0 col-md-6" data-select6-id="6">
        <label>Bodega origen</label>
        <select class="js-basic-single form-control" name="idbodegaorigen" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($bodegas as $bod)
                <option value="{{$bod->IDBODEGA}}" data-select6-id="1">{{$bod->NOMBRECOMERCIAL}}</option>
            @endforeach                             
        </select>
    </div>
    
    <div class="form-group mb-0 col-md-6" data-select6-id="6">
        <label>Bodega Destino</label>
        <select class="js-basic-single form-control" name="idbodegadestino" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($bodegas as $bod)
                <option value="{{$bod->IDBODEGA}}" data-select6-id="1">{{$bod->NOMBRECOMERCIAL}}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group mb-0 col-md-6" data-select6-id="6">
        <label>Producto</label>
        <select class="js-basic-single form-control" name="idproducto" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($productos as $pro)
                <option value="{{$pro->IDPRODUCTO}}" data-select6-id="1">{{ $pro->CODIGOPRI.' => '.$pro->NOMBRE }}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="stock">Transferir</label>
        <input name="transferir" type="text" class="form-control" maxlength="15" id="stockdestino" aria-describedby="emailHelp" placeholder="" value="">
        <small class="form-text text-muted"></small>
    </div>

    <div class="form-group col-md-12 mt-3">
        <button id="save_btn" type="submit" class="btn btn-primary mb-2">Transferir</button>
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
                url: '{{ route("creartrans") }}' ,
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);
                    if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Transferencia de Bodega Exitosa.',
                            showConfirmButton: false,
                            timer: 1200
                        })                      
                        
                    }else{
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error al Transferir Producto.',
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