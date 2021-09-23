<div>
    <h4>Edición de Producto</h4>
</div>
<form class="form-row" id="producto_up_form" method="post" enctype="multipart/form-data">
                                    
    <input name="idproducto" type="hidden" class="form-control" id="id" value="{{ $producto->IDPRODUCTO}}">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
        
    <div class="form-group col-md-2">
        <label for="codigopri">Código Principal</label>
        <input name="codigopri" type="text" class="form-control" id="codigopri"  maxlength="6"   aria-describedby="emailHelp" placeholder="" value="{{ $producto->CODIGOPRI}}">
        <small id="codigopri" class="form-text text-muted">Código primario del item.</small>
    </div>
    
    <div class="form-group col-md-5">
        <label for="nombre">Nombre Producto</label>
        <input name="nombre" type="text" class="form-control" maxlength="40" id="nombre" aria-describedby="emailHelp" placeholder="" value="{{ $producto->NOMBRE}}">
        <small id="nombre" class="form-text text-muted">Nombre descriptivo.</small>
    </div>
    <div class="form-group col-md-5">
        <label for="descripcion">Detalle</label>
        <input name="descripcion" type="text" class="form-control" maxlength="240" id="descripcion" aria-describedby="emailHelp" placeholder="" value="{{ $producto->DESCRIPCION}}">
        <small  class="form-text text-muted">Detalle, observación.</small>
    </div>
    <div class="form-group col-md-1">
        <label for="precio">Precio</label>
        <input name="precio" type="number" class="form-control" id="precio" aria-describedby="emailHelp" placeholder="" value="{{ $producto->PRECIO}}">
        <small id="precio" class="form-text text-muted">precio del item</small>
    </div>   
    <div class="form-group col-md-2">
        <label for="costo">Costo</label>
        <input name="costo" type="number" class="form-control" id="costo" aria-describedby="emailHelp" placeholder="" value="{{ $producto->COSTO}}">
        <small id="costo" class="form-text text-muted">costo del item.</small>
    </div> 
    <div class="form-group mb-0 col-md-2" data-select6-id="6">
        <label>Graba IVA</label>
        <select class="js-basic-single form-control" name="grabaiva" data-select6-id="1" tabindex="-1" aria-hidden="true" value="{{ $producto->GRABAIVA}}">
                <option value="S" data-select6-id="1">Si</option>
                <option value="N" data-6-id="2">No</option>                                          
        </select>
    </div>
    <div class="form-group mb-0 col-md-2" data-select6-id="6">
        <label>Estado</label>
        <select class="js-basic-single form-control" name="estado"  aria-hidden="true" >
                <option value="A"
                @if ($producto->ESTADO == 'A')
                    selected="selected"
                @endif 
                data-select6-id="1">Activo</option>
                <option value="I" 
                @if ($producto->ESTADO == 'I')
                    selected="selected"
                @endif 
                data-6-id="2">Inactivo</option>                                          
        </select>
    </div>  
    <div class="form-group col-md-4">
        <label for="imagen">Imagen</label>
        <input name="imagen" type="file" class="form-control" id="imagen" aria-describedby="emailHelp" accept=".jpg,.jpeg" placeholder="" >
        <small id="imagen" class="form-file "></small>
    </div>
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Proveedor</label>
        <select class="js-basic-single form-control" name="proveedor"  aria-hidden="true">
            @foreach ($proveedores as $prov)
                <option value="{{$prov->IDPROVEEDOR}}" 
                @if ($prov->IDPROVEEDOR == $producto->IDPROVEEDOR)
                    selected="selected"
                @endif 
                data-select6-id="1">{{$prov->NOMBREPROV}}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Categoria</label>
        <select class="js-basic-single form-control" name="idcategoria"  aria-hidden="true">
            @foreach ($categorias as $cat)
                <option 
                value="{{$cat->IDCATEGORIA}}" 
                @if ($cat->IDCATEGORIA == $producto->IDCATEGORIA)
                    selected="selected"
                @endif
                >{{$cat->NOMBRE}}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Marca</label>
        <select class="js-basic-single form-control" name="idmarca" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($marcas as $marc)
                <option 
                value="{{$marc->IDMARCA}}"
                @if ($marc->IDMARCA == $producto->IDMARCA)
                    selected="selected"
                @endif
                >{{$marc->NOMBRE}}</option>
            @endforeach                             
        </select>
    </div> 
    <div class="form-group col-md-12 mt-3">
        <button id="save_btn" type="submit" class="btn btn-primary mb-2">Actualizar</button>
    </div> 
</form>
<script>

    $("form#producto_up_form").submit(function(e) {
            
            e.preventDefault();                
            const formData = new FormData(this); 
            console.log(formData); 

            jQuery.each(jQuery('#producto_up_form')[0].files, function(i, file) {
                formData.append('file-'+i, file);
            });

            

            $.ajax({
                url: '{{ route('productoupdate') }}',
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);
                    if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Producto Actualizado.',
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