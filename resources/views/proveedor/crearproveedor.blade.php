<div>
    <h4>Creación de Proveedor</h4>
</div>
<form class="form-row" id="proveedor_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
        
    <div class="form-group col-md-3">
        <label for="nombre">Nombre</label>
        <input name="nombre" type="text" class="form-control" id="nombre"  maxlength="20"   aria-describedby="emailHelp" placeholder="" value="">
        <small id="nombre" class="form-text text-muted">Nombre de Proveedor.</small>
    </div>  
    <div class="form-group col-md-3">
        <label for="nombre">RUC</label>
        <input name="ruc" type="text" class="form-control" id="nombre"  maxlength="13"   aria-describedby="emailHelp" placeholder="" value="">
        <small id="ruc" class="form-text text-muted">Ruc.</small>
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

    $("form#proveedor_form").submit(function(e) {
            
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

            // jQuery.each(jQuery('#producto_form')[0].files, function(i, file) {
            //     formData.append('file-'+i, file);
            // });
            

            $.ajax({
                url: '{{ route('proveedorguardar') }}' ,
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);
                    if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Proveedor Guardado.',
                            showConfirmButton: false,
                            timer: 1200
                        })                      
                        
                    }else{
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error al guardar marca',
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