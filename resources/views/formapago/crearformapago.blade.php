<div>
    <h4>Formas de Pago</h4>
</div>
<form class="form-row" id="forma_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">  
    <div class="form-group col-md-3 mt-4">
        <div class="checkbox checbox-switch switch-dark">
            <label>
                <input type="checkbox"
                name="efectivo">
                <span></span>
                Efectivo
            </label>
        </div>
    </div>
    <div class="form-group col-md-3 mt-4">
        <div class="checkbox checbox-switch switch-dark">
            <label>
                <input type="checkbox"
                name="transferencia">
                <span></span>
                Transferencia
            </label>
        </div>
    </div>
    <div class="form-group col-md-3 mt-4">
        <div class="checkbox checbox-switch switch-dark">
            <label>
                <input type="checkbox"
                name="paypal">
                <span></span>
                PayPal
            </label>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label for="privatekey">Private Key</label>
        <input name="privatekey" type="text" class="form-control" maxlength="40" id="privatekey" aria-describedby="emailHelp" placeholder="" value="">
        <small id="privatekey" class="form-text text-muted">PayPal</small>
    </div>
    <div class="form-group col-md-4">
        <label for="publickey">Public Key</label>
        <input name="publickey" type="text" class="form-control" maxlength="40" id="publickey" aria-describedby="emailHelp" placeholder="" value="">
        <small id="publickey" class="form-text text-muted">PayPal</small>
    </div>
    <div class="form-group col-md-4">
        <label for="machinekey">Machine Key</label>
        <input name="machinekey" type="text" class="form-control" maxlength="40" id="machinekey" aria-describedby="emailHelp" placeholder="" value="">
        <small id="machinekey" class="form-text text-muted">PayPal</small>
    </div>
    <div class="form-group col-md-4">
        <label for="token">Token</label>
        <input name="token" type="text" class="form-control" maxlength="40" id="token" aria-describedby="emailHelp" placeholder="" value="">
        <small id="token" class="form-text text-muted">PayPal</small>
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

    $("form#forma_form").submit(function(e) {
            
            e.preventDefault();                
            const formData = new FormData(this); 
            console.log(formData);
            

            $.ajax({
                url: '{{ route('guardaformapago') }}' ,
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);
                    if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Formas de Pago Guardada.',
                            showConfirmButton: false,
                            timer: 1200
                        })                      
                        
                    }else{
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error al guardar Forma de pago',
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