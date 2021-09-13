<div>
    <h4>Ingreso de Compra</h4>
</div>
<form class="form-row" id="compra_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
        
    <div class="form-group col-md-2">
        <label for="numfac">Número Factura</label>
        <input name="numfac" type="text" class="form-control" id="numfac"  maxlength="10"   aria-describedby="emailHelp" placeholder="" value="">
        <small id="numfac" class="form-text text-muted">Código primario del item.</small>
    </div>
    <div class="form-group col-md-6">
        <label for="autorizacion">Autorización</label>
        <input name="autorizacion" type="text" class="form-control" maxlength="45" id="autorizacion" aria-describedby="emailHelp" placeholder="" value="">
        <small id="autorizacion" class="form-text text-muted">Número de Autorización</small>
    </div>
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Bodega (Compra Productos)</label>
        <select class="js-basic-single form-control" name="bodegacompra" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($bodegas as $bodd)
                <option value="{{$bodd->IDBODEGA }}" data-select6-id="1">{{$bodd->NOMBRECOMERCIAL}}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Bodega origen(Transferencia)</label>
        <select class="js-basic-single form-control" name="bodegaori" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($bodegas as $bod)
                <option value="{{$bod->IDBODEGA }}" data-select6-id="1">{{$bod->NOMBRECOMERCIAL}}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Bodega Destino(Transferencia)</label>
        <select class="js-basic-single form-control" name="bodegades" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($bodegas as $bodd)
                <option value="{{$bodd->IDBODEGA }}" data-select6-id="1">{{$bodd->NOMBRECOMERCIAL}}</option>
            @endforeach                             
        </select>
    </div>    
    <div class="form-group col-md-4">
        <label for="iva">IVA</label>
        <input name="iva" type="number" class="form-control" maxlength="40" id="iva" aria-describedby="emailHelp" placeholder="" value="">
        <small id="iva" class="form-text text-muted">iva total</small>
    </div>
    <div class="form-group col-md-4">
        <label for="subtotal">SubTotal</label>
        <input name="subtotal" type="number" class="form-control" maxlength="40" id="subtotal" aria-describedby="emailHelp" placeholder="" value="">
        <small id="subtotal" class="form-text text-muted">sub total.</small>
    </div>
    <div class="form-group col-md-4">
        <label for="descuento">Descuento</label>
        <input name="descuento" type="number" class="form-control" maxlength="40" id="descuento" aria-describedby="emailHelp" placeholder="" value="">
        <small id="descuento" class="form-text text-muted">descuento</small>
    </div>
    <div class="form-group col-md-4">
        <label for="neto">Neto</label>
        <input name="neto" type="number" class="form-control" maxlength="40" id="neto" aria-describedby="emailHelp" placeholder="" value="">
        <small id="neto" class="form-text text-muted">descuento</small>
    </div>
    <div class="form-group col-md-4">
        <label for="fechaemi">Fecha Emisión</label>
        <input name="fechaemi" type="date" class="form-control" id="fechaemi"  >
        <small class="form-text text-muted">Indique fecha</small>
    </div>
    <div class="container">
        <div class="row col-md-12">
        <div class="row mb-2">
            <button class="btn btn-primary boton-seleccionar" >Agregar Producto  <i class="fa fa-plus"></i></button>
            <button class="btn btn-info boton-add ml-2" >Crear Producto  <i class="fa fa-plus"></i></button>
        </div>    
        
        <table class="table data-table table-striped" id="tabla_detalles_compra">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Costo</th>
                    <th>IVA</th>
                    <th>NETO</th>
                </tr>
            </thead>
            <tbody id="table_compra_detalles">

            </tbody>
        </table>
    </div>
    </div>
    
    <div class="form-group col-md-12 mt-3">
        <button id="save_btn" type="submit" class="btn btn-primary mb-2">Guardar</button>
    </div> 
</form>
<div class="modal fade" id="modal_producto" tabindex="-1" role="dialog" aria-labelledby="verticalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verticalCenterTitle">Crear Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-row">
                    <div class="form-group col-md-4">
                        <label for="modelemail">Código</label>
                        <input type="text" class="form-control" id="codigo_item_new">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="modelemail">Nombre</label>
                        <input type="text" class="form-control" id="nombre_item_new">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="modelemail">Costo</label>
                        <input type="text" class="form-control" id="costo_item_new">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="modelemail">Precio</label>
                        <input type="text" class="form-control" id="precio_item_new">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Proveedor</label>
                        <select class="js-basic-single form-control" id="proveedor_item_new" data-select6-id="1" tabindex="-1" aria-hidden="true">
                            @foreach ($proveedores as $pro)
                                <option value="{{$pro->IDPROVEEDOR }}" data-select6-id="1">{{$pro->NOMBREPROV}}</option>
                            @endforeach                             
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Categoria</label>
                        <select class="js-basic-single form-control" id="categoria_item_new" data-select6-id="1" tabindex="-1" aria-hidden="true">
                            @foreach ($categorias as $cate)
                                <option value="{{$cate->IDCATEGORIA }}" data-select6-id="1">{{$cate->NOMBRE}}</option>
                            @endforeach                             
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Marca</label>
                        <select class="js-basic-single form-control" id="marca_item_new" data-select6-id="1" tabindex="-1" aria-hidden="true">
                            @foreach ($marcas as $marca)
                                <option value="{{$marca->IDMARCA }}" data-select6-id="1">{{$marca->NOMBRE}}</option>
                            @endforeach                             
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Graba Iva</label>
                        <select class="js-basic-single form-control" id="iva_item_new" data-select6-id="1" tabindex="-1" aria-hidden="true">
                          
                            <option value="S" data-select6-id="1">SI</option>
                            <option value="N" data-select6-id="1">NO</option>
                                                      
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success add_producto_nuevo" >Crear Producto y Aregar</button>
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

    var tableSelec = $('#tabla_productos_seleccion').DataTable({
        "scrollX": false,
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

    $('.boton-add').on('click',function(e){
        e.preventDefault();
        $('#modal_producto').modal('show'); 
    });

    $('.boton-seleccionar').on('click',function(e){
        e.preventDefault();
        
        $.ajax({
            url: 'productslist' ,
            type: 'GET',
            data: null,
            success: function (data) {
                
                if(data.status == 'ok')
                {   
                    let productosResponse = data.productos;
                    $.each(productosResponse,function( key, value ){
                        tableSelec.row.add([
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
        var data = tableSelec.row( $(this).parents('tr') ).data();
        $('#tabla_detalles_compra').append('<tr><td ><input type="text" class="codigo_d" disabled="true" value="'+data[0]+'"></input></td><td><input type="text" class="nombre_d" disabled="true" value="'+data[1]+'"></td><td><input class="canti_d" type="number"></input></td><td><input class="costo_d" type="number"></input></td><td><input class="iva_d" type="number"></input></td><td><input class="neto_d" type="number"></input></td></tr>');
    } );
    
    $('.add_producto_nuevo').on('click',function(e){
        
        const formData = new FormData(); 
        let tok = "{{ csrf_token() }}";
        let costo = $('#costo_item_new').val();
        let precio = $('#precio_item_new').val();
        let codigo = $('#codigo_item_new').val();
        let nombre = $('#nombre_item_new').val();
        let marca = $('#marca_item_new').val();
        let proveedor = $('#proveedor_item_new').val();
        let categoria = $('#categoria_item_new').val();
        let iva = $('#iva_item_new').val();
       
        formData.append('codigopri',codigo);
        formData.append('_token',tok);
        formData.append('codigosec',codigo);
        formData.append('nombre',nombre);
        formData.append('precio',precio);
        formData.append('costo',costo);
        formData.append('grabaiva',iva);
        formData.append('estado','A');
        formData.append('proveedor',proveedor);
        formData.append('idcategoria',categoria);
        formData.append('idmarca',marca);

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

    $('#save_btn').on('click',function(e){
        
        e.preventDefault();
       
        let numfac = $('#numfac').val();
        let autorizacion = $('#autorizacion').val();
        let bodegacompra = $('#bodegacompra').val();
        let bodegaori = $('#bodegaori').val();
        let bodegades = $('#bodegades').val();
        let iva = $('#iva').val();
        let subtotal = $('#subtotal').val();
        let descuento = $('#descuento').val();
        let neto = $('#neto').val();
        let fechaemi= $('#fechaemi').val();

        let cabecera = {
            'numfac':numfac,
            'autorizacion':autorizacion,
            'bodegacompra':bodegacompra,
            'bodegaori':bodegaori,
            'bodegades':bodegades,
            'iva':iva,
            'subtotal':subtotal,
            'descuento':descuento,
            'neto':neto,
            'fechaemi':fechaemi,
        };

        let detalle = {};

        var table = document.getElementById("table_compra_detalles");
       
        const table2 = document.getElementById("table_compra_detalles");  
        for (const row of table2.rows) {
            
            let codigo  = $(row).find('td').find('.codigo_d').val();
            let nombre  =$(row).find('td').find('.nombre_d').val();
            let canti  = $(row).find('td').find('.canti_d').val();
            let precio  = $(row).find('td').find('.costo_d').val();
            let iva  = $(row).find('td').find('.iva_d').val();
            let neto  = $(row).find('td').find('.neto_d').val();
            
            detalle.append({'codigo':codigo,'nombre':nombre,'cantidad':canti,'precio':precio,'iva':iva,'neto':neto});      
        }

        console.log(detalle) 

    });

    
    async function postData(url = '', data = {}) {
        // Opciones por defecto estan marcadas con un *
        const response = await fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
            'Content-Type': 'application/json'
            // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
    }

    // postData('', { answer: 42 })
    // .then(data => {
    //     console.log(data); // JSON data parsed by `data.json()` call
    // });

</script>