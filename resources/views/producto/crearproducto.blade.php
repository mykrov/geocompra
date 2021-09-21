<div>
    <h4>Creación de Producto</h4>
</div>
<form class="form-row" id="producto_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
    <div class="form-group col-md-2">
        <label for="codigopri">Código Principal</label>
        <input name="codigopri" type="text" class="form-control" id="codigopri"  maxlength="6"   aria-describedby="emailHelp" placeholder="" value="">
        <small id="codigopri" class="form-text text-muted">Código primario del item.</small>
    </div>
    <div class="form-group col-md-2">
        <label for="codigosec">Código Secundario</label>
        <input name="codigosec" type="text" class="form-control" maxlength="6" id="codigosec" aria-describedby="emailHelp" placeholder="" value="">
        <small id="codigosec" class="form-text text-muted">Código adicional.</small>
    </div>
    <div class="form-group col-md-4">
        <label for="nombre">Nombre Producto</label>
        <input name="nombre" type="text" class="form-control" maxlength="40" id="nombre" aria-describedby="emailHelp" placeholder="" value="">
        <small id="nombre" class="form-text text-muted">Nombre descriptivo.</small>
    </div>
    <div class="form-group col-md-2">
        <label for="precio">Precio</label>
        <input name="precio" type="decimal" class="form-control" id="precio"  placeholder="" value="">
        <small  class="form-text text-muted">precio del item</small>
    </div>   
    <div class="form-group col-md-1">
        <label for="costo">Costo</label>
        <input name="costo" type="decimal" class="form-control" id="costo"  placeholder="" value="">
        <small  class="form-text text-muted">costo del item.</small>
    </div> 
    <div class="form-group col-md-1">
        <label for="stock">Stock</label>
        <input name="stock" type="decimal" class="form-control" id="stock"  placeholder="" value="">
        <small  class="form-text text-muted">Stock</small>
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
        <small  class="form-file "></small>
    </div>
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Proveedor</label>
        <select class="js-basic-single form-control" name="proveedor" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($proveedores as $prov)
                <option value="{{$prov->IDPROVEEDOR}}" data-select6-id="1">{{$prov->NOMBREPROV}}</option>
            @endforeach                             
        </select>
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

    $("form#producto_form").submit(function(e) {
            
            e.preventDefault();                
            const formData = new FormData(this); 
            console.log(formData);
            
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