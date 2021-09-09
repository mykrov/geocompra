<div>
    <h4>Editar de Categoria</h4>
</div>
<form class="form-row" id="categoria_up_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id" value="{{$categoria->IDCATEGORIA}}">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
        
    <div class="form-group col-md-2">
        <label for="nombre">Nombre</label>
        <input name="nombre" type="text" class="form-control" id="nombre"  maxlength="15"   aria-describedby="emailHelp" placeholder="" value="{{$categoria->NOMBRE}}">
        <small id="nombre" class="form-text text-muted">Nombre de Categoria.</small>
    </div>   
    
    <div class="form-group col-md-12 mt-3">
        <button id="save_btn" type="submit" class="btn btn-primary mb-2">Guardar</button>
    </div> 
</form>
<script>

$("form#categoria_up_form").submit(function(e) {
            
            e.preventDefault();                
            const formData = new FormData(this); 
            console.log(formData); 

            // jQuery.each(jQuery('#producto_up_form')[0].files, function(i, file) {
            //     formData.append('file-'+i, file);
            // });

            

            $.ajax({
                url: '{{ route('categoriaupdate') }}',
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);
                    if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Categoria Actualizada.',
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