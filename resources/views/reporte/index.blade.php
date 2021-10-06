<div>
    <h4>
        Reportes
    </h4>
</div>

<form class="form-row" id="reporte_form" method="post" enctype="multipart/form-data">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
    <div class="form-group mb-0 col-md-3" >
        <label>Tipo Informe</label>
        <select class="js-basic-single form-control" id="tipoinforme" name="tipoinforme"  tabindex="-1" aria-hidden="true">
            <option value="empresas" >Empresas Implementadas</option>     
            <option value="comisiones" >Comisiones</option>
            <option value="ventas" >Ventas</option>  
            <option value="contratos" >Contratos</option>                         
        </select>
    </div>  
    <div class="form-group col-md-2">
        <label for="fechadesde">Fecha Desde</label>
        <input name="fechadesde" type="date" class="form-control" id="fechadesde"  >
        <small class="form-text text-muted">Indique desde</small>
    </div>
    <div class="form-group col-md-2">
        <label for="fechahasta">Fecha Hasta</label>
        <input name="fechahasta" type="date" class="form-control" id="fechahasta"  >
        <small class="form-text text-muted">Indique hasta</small>
    </div>
    <div class="form-group mb-0 col-md-3" data-select6-id="6">
        <label>Empresa</label>
        <select class="js-basic-single form-control" id="idempresa" name="idempresa" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($empresas as $empre)
                <option value="{{ $empre->IDEMPRESA }}" data-select6-id="1">{{ $empre->RAZONSOCIAL }}</option>
            @endforeach                             
        </select>
    </div>   
    <div class="form-group col-md-12 mt-3">
        <button id="buscar_informe" type="submit" class="btn btn-primary mb-2">Buscar</button>
    </div> 
</form>
<div class="row col-md-12">
    <div class="col-md-12 mt-3" id="reporte_div">
    </div>
</div>
<script>
    $("#buscar_informe").on('click',function(e) {
        e.preventDefault();
        let myForm = document.getElementById('reporte_form');
        const formData = new FormData(myForm);
        $.ajax({
            url: '{{ route('buscareporte') }}' ,
            type: 'POST',
            data: formData,
            success: function (data) {
                $('#reporte_div').html(data);
            },
            cache: false,
            contentType: false,
            processData: false,                
        });
    });
</script>

