<div>
    <h4>Creación de Producto Compuesto</h4>
</div>
<form class="form-row" id="producto_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
        
    <div class="form-group col-md-2">
        <label for="codigopri">Código Principal</label>
        <input name="codigopri" type="text" class="form-control" id="codigopri"  maxlength="6"   aria-describedby="emailHelp" placeholder="" value="">
        <small id="codigopri" class="form-text text-muted">Código primario del item.</small>
    </div>
    <div class="form-group col-md-2">
        <label for="codigosec">Código Secundario</label>
        <input name="codigosec" type="text" class="form-control" maxlength="6" id="codigosec" aria-describedby="emailHelp" placeholder="" value="">
        <small id="codigosec" class="form-text text-muted">Código adicional.</small>
    </div>
    <div class="form-group col-md-4">
        <label for="nombre">Nombre Producto</label>
        <input name="nombre" type="text" class="form-control" maxlength="40" id="nombre" aria-describedby="emailHelp" placeholder="" value="">
        <small id="nombre" class="form-text text-muted">Nombre descriptivo.</small>
    </div>
    <div class="form-group col-md-2">
        <label for="precio">Precio</label>
        <input name="precio" type="number" class="form-control" id="precio" aria-describedby="emailHelp" placeholder="" value="">
        <small id="precio" class="form-text text-muted">precio del item</small>
    </div>   
    <div class="form-group col-md-2">
        <label for="costo">Costo</label>
        <input name="costo" type="number" class="form-control" id="costo" aria-describedby="emailHelp" placeholder="" value="">
        <small id="costo" class="form-text text-muted">costo del item.</small>
    </div> 
    <div class="form-group mb-0 col-md-2" data-select6-id="6">
        <label>Graba IVA</label>
        <select class="js-basic-single form-control" name="grabaiva" data-select6-id="1" tabindex="-1" aria-hidden="true">
                <option value="S" data-select6-id="1">Si</option>
                <option value="N" data-6-id="2">No</option>                                          
        </select>
    </div>
    <div class="form-group mb-0 col-md-2" data-select6-id="6">
        <label>Estado</label>
        <select class="js-basic-single form-control" name="estado" data-select6-id="1" tabindex="-1" aria-hidden="true">
                <option value="A" data-select6-id="1">Activo</option>
                <option value="I" data-6-id="2">Inactivo</option>                                          
        </select>
    </div>  
    <div class="form-group col-md-4">
        <label for="imagen">Imagen</label>
        <input name="imagen" type="file" class="form-control" id="imagen" aria-describedby="emailHelp" accept=".jpg,.jpeg" placeholder="" ">
        <small id="imagen" class="form-file "></small>
    </div>
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Proveedor</label>
        <select class="js-basic-single form-control" name="proveedor" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($proveedores as $prov)
                <option value="{{$prov->IDPROVEEDOR}}" data-select6-id="1">{{$prov->NOMBREPROV}}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Categoria</label>
        <select class="js-basic-single form-control" name="idcategoria" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($categorias as $cat)
                <option value="{{$cat->IDCATEGORIA}}" data-select6-id="1">{{$cat->NOMBRE}}</option>
            @endforeach                             
        </select>
    </div>
    <div class="form-group mb-0 col-md-4" data-select6-id="6">
        <label>Marca</label>
        <select class="js-basic-single form-control" name="idmarca" data-select6-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($marcas as $marc)
                <option value="{{$marc->IDMARCA}}" data-select6-id="1">{{$marc->NOMBRE}}</option>
            @endforeach                             
        </select>
    </div> 
    <div class="row col-md-12 mt-2">
        <div class="col-md-12">
            <div class="table-responsive-sm">
                <div class="mt-3">
                    <h3>Productos</h3>
                    <button class="btn btn-primary boton-seleccionar mt-2" >Agregar Producto <i class="fa fa-plus"></i></button>
                </div>
                <table class="table table-bordered table-striped" id="tabla_detalles_compra">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Producto</th>
                        </tr>
                    </thead>
                    <tbody id="table_compra_detalles">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="form-group col-md-12 mt-3">
        <button id="save_btn" type="submit" class="btn btn-primary mb-2">Guardar</button>
    </div> 
</form>

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
        $('#tabla_detalles_compra').append('<tr><td ><input type="text" class="codigo_d" disabled="true" value="'+data[1]+'"></input></td><td><input type="text" class="nombre_d" data-id="'+data[0]+'" disabled="true" value="'+data[2]+'"></td></tr>');
    } );

    $("form#producto_form").submit(function(e) {
            
        e.preventDefault();                
        const formData = new FormData(this); 
        console.log(formData);
        
        $.ajax({
            url: "{{ route('guardaprocompu') }}",
            type: 'POST',
            data: formData,
            success: function (data) {
                console.log(data);
                if(data.status == 'ok')
                {                       
                   console.log('Producto Guardado ' + data.idproducto);
                       
                    //envio de los detalles
                    let idProPrincipal = data.idproducto;
                    let detalles = new Array();
                    const table2 = document.getElementById("table_compra_detalles");  
                    
                    for (const row of table2.rows) {
                        
                        let idproducto  = $(row).find('td').find('.nombre_d').data('id');
                        let codigo  = $(row).find('td').find('.codigo_d').val();
                        let nombre  =$(row).find('td').find('.nombre_d').val();
                       
                        detalles.push({'idproducto':idproducto,'nombre':nombre,'idpadre':idProPrincipal});      
                    }

                    dataDetalles = {'productoshijos': detalles};
                    
                    postData("{{ route('subproductos') }}", dataDetalles)
                    .then(data => {      
                        if(data.status == 'ok'){
                            swal({
                                position: 'top-end',
                                type: 'success',
                                title: 'Producto Copuesto Guardado con exito.',
                                showConfirmButton: false,
                                timer: 1200
                            })                      
                            
                        }else{
                            console.log(data);
                            swal({
                                position: 'top-end',
                                type: 'error',                          
                                title: 'Error al guardar producto',
                                text:data.message,
                                showConfirmButton: false,
                                timer: 3200
                            }) 
                        }                  
                        console.log({"respuesta":data}); // JSON data parsed by `data.json()` call
                    });
                    
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