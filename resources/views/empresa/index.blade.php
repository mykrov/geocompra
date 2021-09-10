<div>
    <h4>
        Listado de Empresas
    </h4>
</div>
<table class="table data-table table-striped" id="table-user">
    <thead>  
        <tr>
            <th>Razon social</th>
            <th>RUC</th>
            <th>Correo</th>
            <th>Provincia</th>
            <th>Estado</th>
            <th>Ambiente</th>
            <th>Contri.Espec.</th>
            <th>Contabilidad</th>           

            <th>Editar</th>
            <th>Eliminar</th>
        </tr> 
    </thead>
    <tbody>
        @foreach ($empresas as $pro)
            <tr>
                <td>{{ $pro->RAZONSOCIAL }}</td>
                <td>{{ $pro->RUC }}</td>
                <td>{{ $pro->CORREO }}</td>
                <td>{{ $pro->PROVINCIA }}</td>
                <td>@if ($pro->ESTADO =='A')
                        Activo
                    @else 
                        Inactivo
                    @endif
                </td>
                <td>@if ($pro->AMBIENTE ==1)
                    Prueba
                @else 
                    Producción
                @endif
                </td>
                <td>@if ($pro->CONTRIBUYENTEESPECIAL ==1)
                    SI
                @else 
                    NO
                @endif
                </td>
                <td>{{ $pro->OBLIGADOCONTA }}</td>
                
                <td><a href="javascript:void(0);" data-id="{{$pro->IDEMPRESA}}" class="btn btn-icon btn-xs btn-info btn_editar"><i class="fa fa-edit"></i></a></td>
                <td><a href="javascript:void(0);" data-id="{{$pro->IDEMPRESA}}" class="btn btn-icon  btn-xs btn-danger btn_eliminar"><i class="fa fa-trash"></i></a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('#table-user').DataTable({
        "scrollX": true,
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
            url: 'editarempresa/'+idbod ,
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
            url: '{{route('empresadelete')}}',
            type: 'POST',
            data: formData,
            success: function (data) {
                if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Empresa Desahabilitada.',
                            showConfirmButton: false,
                            timer: 1200
                        })                      
                        
                    }else{
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error al deshabilitar empresa',
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
