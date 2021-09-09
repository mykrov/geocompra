<div>
    <h4>
        Listado de Cantones
    </h4>
</div>
* @property int $IDCANTON
 * @property string $NOMBRECANTON
 * @property int $IDPROVINCIA
<table class="table data-table table-striped" id="table-productos">
    <thead>
        <td>Código</td>
        <td>Nombre</td>
        <td>Provincia</td>
        <td>Editar</td>
        <td>Eliminar</td>
    </thead>
    <tbody>
        @foreach ($canton as $can)
            <tr>
                <td>{{ $can->IDCANTON }}</td>
                <td>{{ $can->NOMBRECANTON }}</td>  
                <td><a href="javascript:void(0);" data-id="{{$can->IDCANTON}}" class="btn btn-icon btn-xs btn-info btn_editar"><i class="fa fa-edit"></i></a></td>
                <td><a href="javascript:void(0);" data-id="{{$can->IDCANTON}}" class="btn btn-icon  btn-xs btn-danger btn_eliminar"><i class="fa fa-trash"></i></a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('#table-productos').DataTable({
        
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
            url: 'editarcanton/'+idProducto ,
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
