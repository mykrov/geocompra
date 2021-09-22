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
            <select class="js-basic-single form-control" id="idmotivo" name="idmotivo" data-select6-id="1" tabindex="-1" aria-hidden="true">
                @foreach ($motivos as $mot)
                    <option value="{{ $mot->IDMOTIVO }}" data-select6-id="1">{{ $mot->NOMBRE }}</option>
                @endforeach                             
            </select>
        </div>
        <div class="form-group mb-0 col-md-3" data-select6-id="6">
            <label>Bodega</label>
            <select class="js-basic-single form-control" id="idbodega" name="idbodega" data-select6-id="1" tabindex="-1" aria-hidden="true">
                @foreach ($bodegas as $bod)
                    <option value="{{ $bod->IDBODEGA }}" data-select6-id="1">{{ $bod->NOMBRECOMERCIAL }}</option>
                @endforeach                             
            </select>
        </div>
    </div>
    
</form>
<button class="btn btn-primary boton-seleccionar-pro mb-2" >Agregar Producto <i class="fa fa-plus"></i></button>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive" id="tabla_detalles_ncr">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>SubTotal</th>
                        <th>Descuento</th>
                        <th>IVA</th>
                        <th>Neto</th>
                    </tr>
                </thead>
                <tbody id="tbody_produtos_ncr">
    
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="form-group col-md-12 mt-3">
    <button id="save_btn_ncr" type="submit" class="btn btn-primary mb-2">Guardar</button>
</div> 

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
<div class="modal fade" id="modal_tabla_productos" tabindex="-1" role="dialog" aria-labelledby="verticalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verticalCenterTitle">Seleccione Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabla_productos_seleccion" class="table data-table table-striped">
                    <thead>
                        <tr> 
                            <th>Identificador</th>                           
                            <th>Codigo</th> 
                            <th>Producto</th> 
                            <th>Agregar</th>                          
                        </tr>
                    </thead>
                    <tbody id="table_produto_seleccionar">
        
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
    var tableSelec2 = $('#tabla_productos_seleccion').DataTable({
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

    // $('.boton-add-pro').on('click',function(e){
    //     e.preventDefault();
    //     $('#modal_tabla_productos').modal('show'); 
    // });

   
    $('.boton-seleccionar-pro').on('click',function(e){
        e.preventDefault();
        
        $.ajax({
            url: 'productslist' ,
            type: 'GET',
            data: null,
            success: function (data) {
                var rows = tableSelec2
                    .rows()
                    .remove()
                    .draw();
                if(data.status == 'ok')
                {   
                    let productosResponse = data.productos;
                    $.each(productosResponse,function( key, value ){
                        tableSelec2.row.add([
                            value.IDPRODUCTO,
                            value.CODIGOPRI,
                            value.NOMBRE
                        ]).draw( false );
                    }) 
                    $('#modal_tabla_productos').modal('show');
                }else{
                    swal({
                        position: 'top-end',
                        type: 'error',                          
                        title: 'Error al consultal Productos',
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

    $('#tabla_productos_seleccion tbody').on( 'click', 'a', function () {
        
        let Cantidad = '<td><input type="number" class="cantidad_d"  value="1"></td>';
        let Precio = '<td><input type="decimal" class="precio_d"  value="0"></td>';
        let SubTotal = '<td><input type="decimal" class="subtotal_d" value="0"></td>';
        let Descuento = '<td><input type="decimal" class="descuento_d"  value="0"></td>';
        let IVA = '<td><input type="decimal" class="iva_d"  value="0"></td>';
        let Neto = '<td><input type="decimal" class="neto_d"  value=""></td>';

        var data = tableSelec2.row( $(this).parents('tr') ).data();
        $('#tbody_produtos_ncr').append('<tr><td ><input type="text" class="codigo_d" data-id="'+data[0]+'" disabled="true" value="'+data[1]+'"></input></td>'+Cantidad+Precio+SubTotal+Descuento+IVA+Neto+'</tr>');
    } );

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

    // $("form#ncr_form").submit(function(e) {
            
    //     e.preventDefault();                
    //     const formData = new FormData(this); 
    //     console.log(formData);
            

    //     $.ajax({
    //         url: '{{ route('guardaformapago') }}' ,
    //         type: 'POST',
    //         data: formData,
    //         success: function (data) {
    //             console.log(data);
    //             if(data.status == 'ok')
    //             {                       
    //                 swal({
    //                     position: 'top-end',
    //                     type: 'success',
    //                     title: 'Nota de Credito Guardada.',
    //                     showConfirmButton: false,
    //                     timer: 1200
    //                 })                      
                        
    //             }else{
    //                 console.log(data);
    //                 swal({
    //                     position: 'top-end',
    //                     type: 'error',                          
    //                     title: 'Error al guardar Nota de Credito',
    //                     text:data.message,
    //                     showConfirmButton: false,
    //                     timer: 3200
    //                 }) 
    //             }
    //         },
    //         cache: false,
    //         contentType: false,
    //         processData: false,                
    //     });
    // });
    
    $('#save_btn_ncr').on('click',function(e){
        
        e.preventDefault();       
        let subtotalncr = $('#subtotalncr').val();
        let descuentoncr = $('#descuentoncr').val();
        let ivafac = $('#ivafac').val();
        let netofac = $('#netofac').val();
        let facsecuencial = $('#facsecuencial').val();
        let idbodega = $('#idbodega').val();
        let idmotivo = $('#idmotivo').val();


        if(subtotalncr == '' || descuentoncr == '' || netofac == '' ){
            swal({
                position: 'top-end',
                type: 'error',                          
                title: 'Error en datos de la compra',
                text:'Debe indicar los datos del documento.',
                showConfirmButton: false,
                timer: 3200
            }) 
            return 0;    
        }

        let cabecera = {            
            'subtotalncr':subtotalncr,
            'descuentoncr':descuentoncr,
            'ivafac':ivafac,
            'netofac':netofac,
            'facsecuencial':facsecuencial,
            'idbodega':idbodega,
            'idmotivo':idmotivo
        };

        let detalles = new Array();
        const tableDetNCR = document.getElementById("tbody_produtos_ncr");  
        for (const row of tableDetNCR.rows) {            
           // let idproducto  = $(row).find('td').find('.nombre_d').data('id');
            let idproducto = $(row).find('td').find('.idproducto').data('id');
            let cantidad = $(row).find('td').find('.cantidad_d').val();
            let precio = $(row).find('td').find('.precio_d').val();
            let subtotal = $(row).find('td').find('.subtotal_d').val();
            let descuento = $(row).find('td').find('.descuento_d').val();
            let iva = $(row).find('td').find('.iva_d').val();
            let neto = $(row).find('td').find('.neto_d').val();
            let poriva = $(row).find('td').find('iva_d').val();
            //alert(nombre +' el id es '+ idproducto);

            if(subtotal == 0 || precio == 0 || neto == 0){
                swal({
                    position: 'top-end',
                    type: 'error',                          
                    title: 'Error en datos de Productos',
                    text:'Debe indicar Subtotal, Costo y Neto.',
                    showConfirmButton: false,
                    timer: 3200
                }) 
                return 0;
            }
            
            detalles.push({
                'idproducto':idproducto,
                'cantidad':cantidad,
                'precio':precio,
                'subtotal':subtotal,
                'descuento':descuento,
                'iva':iva,
                'neto':neto,
                'poriva':poriva
            });      
        }

        dataCompra = new Array();
        dataCompra.push({'cabecera':cabecera,'detalles':detalles})
        console.log(dataCompra)
        postData("{{ route('ncrguardar') }}", dataCompra)
        .then(data => {      
            if(data.status == 'ok'){
                swal({
                    position: 'top-end',
                    type: 'success',
                    title: 'Compra Guardada.',
                    showConfirmButton: false,
                    timer: 1200
                })                      
                
            }else{
                console.log(data);
                swal({
                    position: 'top-end',
                    type: 'error',                          
                    title: 'Error al guardar Compras',
                    text:data.message,
                    showConfirmButton: false,
                    timer: 3200
                }) 
            }                  
            console.log({"respuesta":data}); // JSON data parsed by `data.json()` call
        });
    });

    
    async function postData(url = '', data = {}) {
        // Opciones por defecto estan marcadas con un *
        const response = await fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
            // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
    }
</script>