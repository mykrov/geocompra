<div>
    <h4>
        Listado de Usuarios
    </h4>
</div>


<table class="table data-table table-striped" id="table-user">
    <thead>  
        <tr>
            <th>Nombre</th>
            <th>Cedula</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>UserName</th>
            <th>Rol</th>
           
            <th>Editar</th>
            <th>Eliminar</th>
        </tr> 
    </thead>
    <tbody>
        @foreach ($usuarios as $pro)
            <tr>
                <td>{{ $pro->NOMBRE }}</td>
                <td>{{ $pro->CEDULA }}</td>
                <td>{{ $pro->TELEFONO }}</td>
                <td>{{ $pro->CORREO }}</td>
                <td>{{ $pro->USUARIO }}</td>
                <td>{{ $pro->ROL }}</td>
                
                <td><a href="javascript:void(0);" data-id="{{$pro->IDUSUARIO}}" class="btn btn-icon btn-xs btn-info btn_editar"><i class="fa fa-edit"></i></a></td>
                <td><a href="javascript:void(0);" data-id="{{$pro->IDUSUARIO}}" class="btn btn-icon  btn-xs btn-danger btn_eliminar"><i class="fa fa-trash"></i></a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('#table-user').DataTable({
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

    $('.buttons-html5').addClass('btn btn-primary');

    $('.btn_editar').on('click',function(){
        
        let iduser = 0;
        iduser = $(this).data("id");

        
        $.ajax({
            url: 'editarusuario/'+iduser ,
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
        
        let iduser = 0;
        iduser = $(this).data("id");
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 

        const formData = new FormData();
        formData.append("idusuario", iduser);
        
        $.ajax({
            url: '{{route('usuariodelete')}}',
            type: 'POST',
            data: formData,
            success: function (data) {
                if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Usuario Eliminado.',
                            showConfirmButton: false,
                            timer: 1200
                        })                      
                        
                    }else{
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error al eliminar usuario',
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
