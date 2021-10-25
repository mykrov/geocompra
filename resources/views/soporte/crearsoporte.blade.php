<div>
    <h4>Contacto de Soporte </h4>
</div>
<form class="form-row" id="soporte_form" method="post" enctype="multipart/form-data">
    <input name="id" type="hidden" class="form-control" id="id">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">

    <div class="form-group col-md-12">
        <label for="dataSoporte">Datos del Soporte</label>
        <textarea name="dataSoporte" type="text" class="form-control" id="dataSoporte" rows="5"   aria-describedby="emailHelp" placeholder="" value=""></textarea>
        {{-- <small id="razonsocial" class="form-text text-muted">Nombre del usuario.</small> --}}
    </div>
    <div class="form-group col-md-4">
        <label for="imagen1">Imagen1</label>
        <input name="imagen1" type="file" class="form-control" id="imagen1" aria-describedby="emailHelp" accept=".jpg,.jpeg,.png" placeholder="" >
        <small  class="form-file "></small>
    </div>
    <div class="form-group col-md-4">
        <label for="imagen2">Imagen2</label>
        <input name="imagen2" type="file" class="form-control" id="imagen2" aria-describedby="emailHelp" accept=".jpg,.jpeg,.png" placeholder="" >
        <small  class="form-file "></small>
    </div>
    <div class="form-group col-md-4">
        <label for="imagen3">Imagen3</label>
        <input name="imagen3" type="file" class="form-control" id="imagen3" aria-describedby="emailHelp" accept=".jpg,.jpeg,.png" placeholder="" >
        <small  class="form-file "></small>
    </div>
    <div class="form-group col-md-12 mt-3">
        <button id="save_btn" type="submit" class="btn btn-primary mb-2">Enviar Soporte</button>
    </div>
</form>
<script>

    $("form#soporte_form").submit(function(e) {

            e.preventDefault();
            const formData = new FormData(this);
            console.log(formData);

            jQuery.each(jQuery('#soporte_form')[0].files, function(i, file) {
                formData.append('file-'+i, file);
            });


            $.ajax({
                url: '{{ route('soporteguardar') }}' ,
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);
                    if(data.status == 'ok')
                    {
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Soporte Guardado con extito.!!!',
                            showConfirmButton: false,
                            timer: 1200
                        })

                    }else{
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',
                            title: 'Error al guardar Soporte',
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
