<div>
    <h4>Creación de Empresa</h4>
</div>
<form class="form-row" id="empresa_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
        
    <div class="form-group col-md-3">
        <label for="razonsocial">Razon Social</label>
        <input name="razonsocial" type="text" class="form-control" id="razonsocial"  maxlength="50"   aria-describedby="emailHelp" placeholder="" value="">
        <small id="razonsocial" class="form-text text-muted">Nombre del usuario.</small>
    </div>
    <div class="form-group col-md-3">
        <label for="ruc">RUC</label>
        <input name="ruc" type="text" class="form-control" maxlength="15" id="ruc" aria-describedby="emailHelp" placeholder="" value="">
        <small id="ruc" class="form-text text-muted">Ruc.</small>
    </div>
    <div class="form-group col-md-3">
        <label for="correo">Correo</label>
        <input name="correo" type="text" class="form-control" id="correo" aria-describedby="emailHelp" placeholder="" value="">
        <small id="correo" class="form-text text-muted">Dirección de Correo</small>
    </div>   
    <div class="form-group col-md-3">
        <label for="actividadeconomica">Actividad Económica</label>
        <input name="actividadeconomica" type="text" class="form-control" id="actividadeconomica" aria-describedby="emailHelp" placeholder="" value="">
        <small id="actividadeconomica" class="form-text text-muted">Descripcion.</small>
    </div>
    <div class="form-group col-md-3">
        <label for="clavecertificado">Clave Certificado</label>
        <input name="clavecertificado" type="password" class="form-control" id="clavecertificado" aria-describedby="emailHelp" placeholder="" value="">
        <small id="clavecertificado" class="form-text text-muted">contraaseña de la firma electrónica.</small>
    </div>
    <div class="form-group mb-0 col-md-3" data-select6-id="6">
        <label>Provincia</label>
        <select class="js-basic-single form-control" name="idprovincia" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($provincias as $prov)
                <option value="{{$prov->IDPROVINCIA}}" data-select6-id="1">{{$prov->NOMBRE}}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group mb-0 col-md-3" data-select6-id="6">
        <label>Canton</label>
        <select class="js-basic-single form-control" name="idcanton" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($cantones as $canton)
                <option value="{{$canton->IDCANTON}}" data-select6-id="1">{{$canton->NOMBRECANTON}}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group mb-0 col-md-3" data-select6-id="6">
        <label>Parroquia</label>
        <select class="js-basic-single form-control" name="idparroquia" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($parroquias as $parro)
                <option value="{{$parro->IDPARROQUIA}}" data-select6-id="1">{{$parro->NOMBRE}}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="firmaelectronica">Firma Electrónica 'TIPO ARCHIVO'</label>
        <input name="firma" type="file" class="form-control" id="firmaelectronica" accept=".p12" acearia-describedby="emailHelp" placeholder="" >
        <small style="color:red;" id="firmaelectronica" class="form-file ">LA FIRMA ELECTRÓNICA DEBE SER DE TIPO ARCHIVO.</small>
    </div>
    <div class="form-group mb-0 col-md-3" data-select2-id="7">
        <label>Ambiente</label>
        <select class="js-basic-single form-control" name="ambiente" data-select2-id="1" tabindex="-1" aria-hidden="true">
                <option value="1" data-select2-id="1">Prueba</option>
                <option value="2" data-select2-id="2">Producción</option>                                          
        </select>
    </div>
    <div class="form-group col-md-3 mt-4">
        <div class="checkbox checbox-switch switch-dark">
            <label>
                <input type="checkbox" name="agente">
                <span></span>
                Agente de Retención 
            </label>
        </div>
    </div>
    <div class="form-group col-md-3 mt-4">
        <div class="checkbox checbox-switch switch-dark">
            <label>
                <input type="checkbox" name="contabilidad">
                <span></span>
                Obligado a Contabilidad
            </label>
        </div>
    </div>
    <div class="form-group col-md-3 mt-4">
        <div class="checkbox checbox-switch switch-dark">
            <label>
                <input type="checkbox" name="contibuyente">
                <span></span>
                Contribuyente Especial 
            </label>
        </div>
    </div>
    <div class="form-group col-md-3 mt-4">
        <div class="checkbox checbox-switch switch-dark">
            <label>
                <input type="checkbox" name="usafacelectronica">
                <span></span>
                Usa Fac.Electrónica. 
            </label>
        </div>
    </div>
    <div class="form-group col-md-3 mt-4">
        <div class="checkbox checbox-switch switch-dark">
            <label>
                <input type="checkbox" name="estado">
                <span></span>
                Estado 
            </label>
        </div>
    </div>

    <div class="form-group col-md-12 mt-3">
        <button id="save_btn" type="submit" class="btn btn-primary mb-2">Guardar</button>
    </div> 
</form>
<script>
    
    $('#firmaelectronica').on("change", function(){ 
        if (!hasExtension('firmaelectronica', ['.p12'])) {
            swal({
                position: 'top-end',
                type: 'error',                          
                title: 'Firma con extensión invalida.',
                text:'La firma debe ser con extensión .p12',
                showConfirmButton: false,
                timer: 3200
            }) 
        }
        
    });

    $("form#empresa_form").submit(function(e) {
            e.preventDefault();                
            const formData = new FormData(this); 
            console.log(formData);
            
            if (!hasExtension('firmaelectronica', ['.p12'])) {
                swal({
                    position: 'top-end',
                    type: 'error',                          
                    title: 'Firma con extensión invalida.',
                    text:'La firma debe ser con extensión .p12',
                    showConfirmButton: false,
                    timer: 3200
                }) 

                return 0;
            } 

            jQuery.each(jQuery('#empresa_form')[0].files, function(i, file) {
                formData.append('file-'+i, file);
            });
            

            $.ajax({
                url: '{{ route('empresaguardar') }}' ,
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);
                    if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Empresa Guardada.',
                            showConfirmButton: false,
                            timer: 1200
                        })                      
                        
                    }else{
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error al guardar empresa',
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

        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }
</script>