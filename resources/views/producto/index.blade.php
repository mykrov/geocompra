<div>
    <h4>
        Listado de Productos
    </h4>
</div>

<table class="table data-table table-striped" id="table-productos">
    <thead>
        <td>Código</td>
        <td>Nombre</td>
        <td>Precio</td>
        <td>Stock</td>
        <td>Bodega</td>
        <td>IVA</td>
        <td>Editar</td>
        <td>Eliminar</td>
    </thead>
    <tbody>
        @foreach ($productos as $pro)
            <tr>
                <td>{{ $pro->CODIGOPRI }}</td>
                <td>{{ $pro->NOMBRE }}</td>
                <td>{{ $pro->PRECIO }}</td>
                <td>{{ $pro->STOCK }}</td>
                <td>{{ $pro->NOMBRECOMERCIAL }}</td>
                <td>{{ $pro->GRABAIVA }}</td>
                <td><a href="javascript:void(0);" data-id="{{$pro->IDPRODUCTO}}" class="btn btn-icon btn-xs btn-info btn_editar"><i class="fa fa-edit"></i></a></td>
                <td><a href="javascript:void(0);" data-id="{{$pro->IDPRODUCTO}}" class="btn btn-icon  btn-xs btn-danger btn_eliminar"><i class="fa fa-trash"></i></a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('#table-productos').DataTable({
        "dom": 'Bfrtip',
        "buttons": [
            'excel',
            'pdfHtml5'
        ],        
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por pagina",
            "zeroRecords": "Nada que mostrar",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros disponibles",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Busqueda",
            "paginate": {
                "first":      "Primero",
                "last":       "Ultimo",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });

    $('.btn_editar').on('click',function(){
        
        let idProducto = 0;
        idProducto = $(this).data("id");
        
        $.ajax({
            url: 'editarproducto/'+idProducto ,
            type: 'GET',
            data: null,
            success: function (data) {
                $('#card-body-content').html(data);
            },
            cache: false,
            contentType: false,
            processData: false,                
        });        
    });
    $('.buttons-html5').addClass('btn btn-primary');
    $('.btn_eliminar').on('click',function(){
        
        let idProducto = 0;
        idProducto = $(this).data("id");
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 

        const formData = new FormData();
        formData.append("idProducto", idProducto);
        
      

        $.ajax({
            url: '{{route('productodelete')}}',
            type: 'POST',
            data: formData,
            success: function (data) {
                if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Producto Eliminado.',
                            showConfirmButton: false,
                            timer: 1200
                        })                      
                        
                    }else{
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error al eliminar Producto',
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
