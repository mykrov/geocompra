<div>
    <h4>
        Guias de Remisión
    </h4>
</div>


<table class="table data-table table-striped" id="table-guias">
    <thead>  
        <tr>
            <th>Secuencial</th>
            <th>Fecha</th>
            <th>Factura Secuencial</th>
            <th>Motivo</th>
            <th>Observación</th>
            <th>Clave Acceso</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr> 
    </thead>
    <tbody>
        @foreach ($guias as $guia)
            <tr>
                <td>{{ $guia->SECUENCIAL }}</td>
                <td>{{ $guia->FECHAEMI }}</td>
                <td>{{ $guia->SECUENCIALFAC }}</td>
                <td>{{ $guia->MOTIVO }}</td>
                <td>{{ $guia->OBSERVACION }}</td>
                <td>{{ $guia->CLAVEACCESO }}</td>
                                
                <td><a href="javascript:void(0);" data-id="{{ $guia->SECUENCIAL }}" class="btn btn-icon btn-xs btn-info btn_editar"><i class="fa fa-edit"></i></a></td>
                <td><a href="javascript:void(0);" data-id="{{ $guia->SECUENCIAL }}" class="btn btn-icon  btn-xs btn-danger btn_eliminar"><i class="fa fa-trash"></i></a></td>
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
        
        let idbod = 0;
        idbod = $(this).data("id");       
        
        $.ajax({
            url: 'editarmarca/'+idbod ,
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
        formData.append("idcat", idbod);
        
        $.ajax({
            url: '{{route('marcadelete')}}',
            type: 'POST',
            data: formData,
            success: function (data) {
                if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Marca Eliminada.',
                            showConfirmButton: false,
                            timer: 1200
                        })                      
                        
                    }else{
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error al eliminar Marca',
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
