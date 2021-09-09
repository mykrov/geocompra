<div>
    <h4>
        Listado de Bodegas
    </h4>
</div>


<table class="table data-table table-striped" id="table-user">
    <thead>  
        <tr>
            <th>Nombre Comercial</th>
            <th>Serie</th>
            <th>Nº Secuencial</th>
            <th>Nº Nota Cred.</th>
            <th>Nº Guia Remision</th>
            <th>Telefono</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr> 
    </thead>
    <tbody>
        @foreach ($bodegas as $pro)
            <tr>
                <td>{{ $pro->NOMBRECOMERCIAL }}</td>
                <td>{{ $pro->SERIE }}</td>
                <td>{{ $pro->NOSECUENCIAL }}</td>
                <td>{{ $pro->NOSECUENCIALNCR }}</td>
                <td>{{ $pro->NOGUIAREMISION }}</td>
                <td>{{ $pro->TELEFONO }}</td>
                
                <td><a href="javascript:void(0);" data-id="{{$pro->IDBODEGA}}" class="btn btn-icon btn-xs btn-info btn_editar"><i class="fa fa-edit"></i></a></td>
                <td><a href="javascript:void(0);" data-id="{{$pro->IDBODEGA}}" class="btn btn-icon  btn-xs btn-danger btn_eliminar"><i class="fa fa-trash"></i></a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('#table-user').DataTable({
        
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
        
        let idbod = 0;
        idbod = $(this).data("id");       
        
        $.ajax({
            url: 'editarbodega/'+idbod ,
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
        
        let idbod = 0;
        idbod = $(this).data("id");
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 

        const formData = new FormData();
        formData.append("idbod", idbod);
        
        $.ajax({
            url: '{{route('bodegadelete')}}',
            type: 'POST',
            data: formData,
            success: function (data) {
                if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Bodega Eliminada.',
                            showConfirmButton: false,
                            timer: 1200
                        })                      
                        
                    }else{
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error al eliminar Bodega',
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
