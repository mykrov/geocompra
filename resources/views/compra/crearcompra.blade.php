<div>
    <h4>Ingreso de Compra</h4>
</div>
<form class="form-row" id="compra_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
        
    <div class="form-group col-md-2">
        <label for="numfac">Número Factura</label>
        <input name="numfac" type="text" class="form-control" id="numfac"  maxlength="6"   aria-describedby="emailHelp" placeholder="" value="">
        <small id="numfac" class="form-text text-muted">Código primario del item.</small>
    </div>
    <div class="form-group col-md-2">
        <label for="autorizacion">Autorización</label>
        <input name="autorizacion" type="text" class="form-control" maxlength="6" id="autorizacion" aria-describedby="emailHelp" placeholder="" value="">
        <small id="autorizacion" class="form-text text-muted">Número de Autorización</small>
    </div>
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Bodega origen</label>
        <select class="js-basic-single form-control" name="proveedor" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($bodegaO as $bod)
                <option value="{{$bod->IDBODEGA }}" data-select6-id="1">{{$bod->NOMBRECOMERCIAL}}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Bodega Destino</label>
        <select class="js-basic-single form-control" name="proveedor" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($bodegaD as $bodd)
                <option value="{{$bodd->IDBODEGA }}" data-select6-id="1">{{$bodd->NOMBRECOMERCIAL}}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="iva">IVA</label>
        <input name="iva" type="text" class="form-control" maxlength="40" id="iva" aria-describedby="emailHelp" placeholder="" value="">
        <small id="iva" class="form-text text-muted">iva total</small>
    </div>
    <div class="form-group col-md-4">
        <label for="subtotal">SubTotal</label>
        <input name="subtotal" type="text" class="form-control" maxlength="40" id="subtotal" aria-describedby="emailHelp" placeholder="" value="">
        <small id="subtotal" class="form-text text-muted">sub total.</small>
    </div>




    <div class="form-group col-md-4">
        <label for="nombre">Nombre Producto</label>
        <input name="nombre" type="text" class="form-control" maxlength="40" id="nombre" aria-describedby="emailHelp" placeholder="" value="">
        <small id="nombre" class="form-text text-muted">Nombre descriptivo.</small>
    </div>
    <div class="form-group col-md-2">
        <label for="precio">Precio</label>
        <input name="precio" type="number" class="form-control" id="precio" aria-describedby="emailHelp" placeholder="" value="">
        <small id="precio" class="form-text text-muted">precio del item</small>
    </div>   
    <div class="form-group col-md-2">
        <label for="costo">Costo</label>
        <input name="costo" type="number" class="form-control" id="costo" aria-describedby="emailHelp" placeholder="" value="">
        <small id="costo" class="form-text text-muted">costo del item.</small>
    </div> 
    <div class="form-group mb-0 col-md-2" data-select6-id="6">
        <label>Graba IVA</label>
        <select class="js-basic-single form-control" name="grabaiva" data-select6-id="1" tabindex="-1" aria-hidden="true">
                <option value="S" data-select6-id="1">Si</option>
                <option value="N" data-6-id="2">No</option>                                          
        </select>
    </div>
    <div class="form-group mb-0 col-md-2" data-select6-id="6">
        <label>Estado</label>
        <select class="js-basic-single form-control" name="estado" data-select6-id="1" tabindex="-1" aria-hidden="true">
                <option value="A" data-select6-id="1">Activo</option>
                <option value="I" data-6-id="2">Inactivo</option>                                          
        </select>
    </div>  
    <div class="form-group col-md-4">
        <label for="imagen">Imagen</label>
        <input name="imagen" type="file" class="form-control" id="imagen" aria-describedby="emailHelp" accept=".jpg,.jpeg" placeholder="" ">
        <small id="imagen" class="form-file "></small>
    </div>
    
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Categoria</label>
        <select class="js-basic-single form-control" name="idcategoria" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($categorias as $cat)
                <option value="{{$cat->IDCATEGORIA}}" data-select6-id="1">{{$cat->NOMBRE}}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Marca</label>
        <select class="js-basic-single form-control" name="idmarca" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($marcas as $marc)
                <option value="{{$marc->IDMARCA}}" data-select6-id="1">{{$marc->NOMBRE}}</option>
            @endforeach                             
        </select>
    </div> 
    <div class="form-group col-md-12 mt-3">
        <button id="save_btn" type="submit" class="btn btn-primary mb-2">Guardar</button>
    </div> 
</form>
<script>

    $("form#compra_form").submit(function(e) {
            
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

            jQuery.each(jQuery('#producto_form')[0].files, function(i, file) {
                formData.append('file-'+i, file);
            });
            

            $.ajax({
                url: '{{ route('productoguardar') }}' ,
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);
                    if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Producto Guardado.',
                            showConfirmButton: false,
                            timer: 1200
                        })                      
                        
                    }else{
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error al guardar Producto',
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