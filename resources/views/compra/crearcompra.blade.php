<div>
    <h4>Ingreso de Compra</h4>
</div>
<form class="form-row" id="compra_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
    <div class="form-group mb-0 col-md-2" data-select6-id="6">
        <label>Tipo Doc</label>
        <select class="js-basic-single form-control" id="tipodoc" data-select6-id="1" tabindex="-1" aria-hidden="true">
           <option value="FAC">Factura</option> 
           <option value="NTV">Nota Venta</option>                           
        </select>
    </div>    
    <div class="form-group col-md-2">
        <label for="numfac">Número Factura</label>
        <input name="numfac" type="text" class="form-control" id="numfac"  maxlength="10"   aria-describedby="emailHelp" placeholder="" value="">
        <small id="numfac" class="form-text text-muted">Código primario del item.</small>
    </div>
    <div class="form-group col-md-4">
        <label for="autorizacion">Autorización</label>
        <input name="autorizacion" type="text" class="form-control" maxlength="45" id="autorizacion" aria-describedby="emailHelp" placeholder="" value="">
        <small id="autorizacion" class="form-text text-muted">Número de Autorización</small>
    </div>
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Bodega (Compra Productos)</label>
        <select class="js-basic-single form-control" id="bodegacompra" data-select6-id="1" tabindex="-1" aria-hidden="true">
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
</form>
<div class="row">
    <div class="col-md-12 mb-2">
        <div class="form-group col-md-4">
            <button class="btn btn-primary boton-seleccionar" >Agregar Producto <i class="fa fa-plus"></i></button>
            
            <button class="btn btn-info boton-add ml-2" > Crear Producto  <i class="fa fa-plus"></i></button>
        </div>
    </div>         
</div>
<div class="table-responsive-sm">
    <table class="table table-bordered table-striped" id="tabla_detalles_compra">
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
<div class="form-group col-md-12 mt-3">
    <button id="save_btn" type="submit" class="btn btn-primary mb-2">Guardar</button>
</div> 
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

    var tableSelec = $('#tabla_productos_seleccion').DataTable({
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
                var rows = tableSelec
                    .rows()
                    .remove()
                    .draw();
                if(data.status == 'ok')
                {   
                    let productosResponse = data.productos;
                    $.each(productosResponse,function( key, value ){
                        tableSelec.row.add([
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
        var data = tableSelec.row( $(this).parents('tr') ).data();
        
        if(existeItemTabla(data[0]) == false){
            $('#tabla_detalles_compra').append('<tr><td ><input type="text" class="codigo_d" disabled="true" value="'+data[1]+'"></input></td><td><input type="text" class="nombre_d" data-id="'+data[0]+'" disabled="true" value="'+data[2]+'"></td><td><input class="canti_d" type="number"></input></td><td><input class="costo_d" type="number"></input></td><td><input class="iva_d" type="number"></input></td><td><input class="neto_d" type="number"></input></td></tr>');
        }else{
            Command: toastr["error"]("Ya existe el producto en los detalles.", "Error")
            toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 200,
            "hideDuration": 300,
            "timeOut": 1000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
        }        
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

        if(numfac == '' || autorizacion == '' || subtotal == '' || neto == '' || iva == '' || descuento == ''){
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

        let detalles = new Array();
        const table2 = document.getElementById("table_compra_detalles");  

        for (const row of table2.rows) {
            let idproducto  = $(row).find('td').find('.nombre_d').data('id');
            let codigo  = $(row).find('td').find('.codigo_d').val();
            let nombre  =$(row).find('td').find('.nombre_d').val();
            let canti  = $(row).find('td').find('.canti_d').val();
            let precio  = $(row).find('td').find('.costo_d').val();
            let iva  = $(row).find('td').find('.iva_d').val();
            let neto  = $(row).find('td').find('.neto_d').val();

            //alert(nombre +' el id es '+ idproducto);
            if(canti == 0 || precio == 0 || neto == 0){
                swal({
                    position: 'top-end',
                    type: 'error',                          
                    title: 'Error en datos de Productos',
                    text:'Debe indicar Cantidad, Costo y Neto.',
                    showConfirmButton: false,
                    timer: 3200
                })  
                return 0;
            }            
            detalles.push({'idproducto':idproducto,'nombre':nombre,'cantidad':canti,'precio':precio,'iva':iva,'neto':neto});      
        }

        dataCompra = new Array();
        dataCompra.push({'cabecera':cabecera,'detalles':detalles})
        console.log(dataCompra) 

        postData("{{ route('compraguardar') }}", dataCompra)
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
        const response = await fetch(url, {
            method: 'POST', 
            mode: 'cors', 
            cache: 'no-cache',
            credentials: 'same-origin', 
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': "{{ csrf_token() }}"           
            },
            redirect: 'follow', 
            referrerPolicy: 'no-referrer',
            body: JSON.stringify(data) 
        });
        return response.json(); 
    }

    function existeItemTabla(id){
        const table3 = document.getElementById("table_compra_detalles");
        for (const rowl of table3.rows) {
            let idproducto = $(rowl).find('td').find('.nombre_d').data('id');
            console.log('el id que llega a la fuc ' + id)
            console.log('id de la Data-Id en el row ' + idproducto)
            if(idproducto == id){
                return true;
            }
        }
        return false;
    }
</script>