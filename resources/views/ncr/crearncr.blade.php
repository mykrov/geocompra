<div>
    <h4>Nota de Crédito</h4>
</div>

<form class="form-row" id="ncr_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
    <div class="form-group col-md-12">
        <button class="btn btn-primary boton-seleccionar mt-2" >Seleccionar Factura <i class="fa fa-plus"></i></button>
    </div>
    <div class="form-grop col-md-2">
        <label for="facnumero">Número Factura</label>
        <input name="facnumero" type="text" data-id="" class="form-control" maxlength="40" id="facnumero" aria-describedby="emailHelp" placeholder="" value="">  
    </div>
    <div class="form-grop col-md-2">
        <label for="facsecuencial">Seccuencial Factura</label>
        <input name="facsecuencial" type="text" data-id="" class="form-control" maxlength="40" id="facsecuencial" aria-describedby="emailHelp" placeholder="" value="">  
    </div>
    <div class="form-group col-md-4">
        <label for="clientenombre">Cliente</label>
        <input name="clientenombre" type="text" data-id="" class="form-control" maxlength="40" id="clientenombre" aria-describedby="emailHelp" placeholder="" value="">
    </div>
    <div class="form-group col-md-2">
        <label for="netofac">Neto Factura</label>
        <input name="netofac" type="text" class="form-control" maxlength="40" id="netofac" aria-describedby="emailHelp" placeholder="" value="">
    </div>
    <div class="form-group col-md-2">
        <label for="ivafac">Iva Factura</label>
        <input name="ivafac" type="text" class="form-control" maxlength="40" id="ivafac" aria-describedby="emailHelp" placeholder="" value="">
    </div>

   
    <div class="form-row col-md-12">
        <div class="form-group col-md-3">
            <label for="subtotalncr">Sub Total Nota Credito</label>
            <input name="subtotalncr"  type="text" class="form-control" maxlength="40" id="subtotalncr" aria-describedby="emailHelp" placeholder="" value="">
        </div>
        <div class="form-group col-md-3">
            <label for="descuentoncr">Descuento Nota Credito</label>
            <input name="descuentoncr" type="text" class="form-control" maxlength="40" id="descuentoncr" aria-describedby="emailHelp" placeholder="" value="">
        </div>
        <div class="form-group mb-0 col-md-3" data-select6-id="6">
            <label>Motivo</label>
            <select class="js-basic-single form-control" name="idmotivo" data-select6-id="1" tabindex="-1" aria-hidden="true">
                @foreach ($motivos as $mot)
                    <option value="{{ $mot->IDMOTIVO }}" data-select6-id="1">{{ $mot->NOMBRE }}</option>
                @endforeach                             
            </select>
        </div>
        <div class="form-group mb-0 col-md-3" data-select6-id="6">
            <label>Bodega</label>
            <select class="js-basic-single form-control" name="idbodega" data-select6-id="1" tabindex="-1" aria-hidden="true">
                @foreach ($bodegas as $bod)
                    <option value="{{ $bod->IDBODEGA }}" data-select6-id="1">{{ $bod->NOMBRECOMERCIAL }}</option>
                @endforeach                             
            </select>
        </div>
    </div>
    <div class="form-group col-md-12 mt-3">
        <button id="save_btn" type="submit" class="btn btn-primary mb-2">Guardar</button>
    </div> 
</form>
<div class="modal fade" id="modal_tabla_facturas" tabindex="-1" role="dialog" aria-labelledby="verticalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verticalCenterTitle">Seleccione factura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabla_factura_seleccion" class="table data-table table-striped">
                    <thead>
                        <tr> 
                            <th>Secuencial</th>
                            <th>Número</th>                           
                            <th>Fecha</th> 
                            <th>Nombre Cliente</th> 
                            <th>Agregar</th>                          
                        </tr>
                    </thead>
                    <tbody id="table_fac_seleccionar">
        
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>                
            </div>
        </div>
    </div>
</div>
<script>

    $('#facnumero').attr('readonly', true);
    $('#clientenombre').attr('readonly', true);
    $('#facsecuencial').attr('readonly', true);

    var tableSelec = $('#tabla_factura_seleccion').DataTable({
        "scrollX": true,
        "language": {
            "lengthMenu": "Mostrando _MENU_ por pagina",
            "zeroRecords": "...",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros disponibles",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Busq.",
            "paginate": {
                "first":      "Primero",
                "last":       "Ultimo",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        },
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": '<a href="javascript:void(0);" class=" btn btn-icon btn-xs btn-inverse-primary"><i class="fa fa-plus"></i></a>'
        } ]
    });

    $('.boton-seleccionar').on('click',function(e){
        e.preventDefault();
        
        $.ajax({
            url: 'facturalist' ,
            type: 'GET',
            data: null,
            success: function (data) {
                var rows = tableSelec
                    .rows()
                    .remove()
                    .draw();
                if(data.status == 'ok')
                {   
                    let facturasResponse = data.facturas;
                    $.each(facturasResponse,function( key, value ){
                        tableSelec.row.add([
                            value.SECUENCIAL,
                            value.NUMEROFAC,
                            value.FECHAEMI,
                            value.NOMBRECLIENTE
                            
                        ]).draw( false );
                    }) 
                    $('#modal_tabla_facturas').modal('show');
                }else{
                    swal({
                        position: 'top-end',
                        type: 'error',                          
                        title: 'Error al consultal Facturas',
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

    $('#tabla_factura_seleccion tbody').on( 'click', 'a', function () {
        var data = tableSelec.row( $(this).parents('tr') ).data();
        $('#facsecuencial').val(data[0]);
        $('#facnumero').val(data[1]);
        $('#clientenombre').val(data[3]);   
    } );

    $("form#ncr_form").submit(function(e) {
            
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
                            title: 'Nota de Credito Guardada.',
                            showConfirmButton: false,
                            timer: 1200
                        })                      
                        
                    }else{
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error al guardar Nota de Credito',
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