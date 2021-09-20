<div>
    <h4>
        Notas de Crédito
    </h4>
</div>

<table class="table data-table table-striped" id="table-ncr">
    <thead>
        <tr>
            <th>Numero Factura</th>
            <th>Fecha</th>
            <th>Autorizacion</th>  
            <th>IVA</th>
            <th>Sub.Total</th>
            <th>Descuento</th>
            <th>Neto</th>
            <th>Estado</th>
            <th>Ver</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ncrs as $ncr)
            <tr>
                <td>{{ $ncr->SECFACTURA }}</td>
                <td>{{ $ncr->FECHAEMI }}</td>
                <td>{{ $ncr->NOAUTORIZACION }}</td>
                <td>{{ $ncr->IVAFAC }}</td>
                <td>{{ $ncr->SUBTOTALBNCR }}</td>
                <td>{{ $ncr->DESCUENTONCR }}</td>
                <td>{{ $ncr->NETOFAC }}</td>
                <td>{{ $ncr->ESTADOPROCESO }}</td>
                <td><a href="javascript:void(0);" data-id="{{$ncr->SECUENCIALNCR}}" class="btn btn-icon btn-xs btn-info btn_editar"><i class="fa fa-edit"></i></a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('#table-ncr').DataTable({
        "dom": 'Bfrtip',
        "buttons": [
            'excel',
            'pdfHtml5'
        ],
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

    $('.buttons-html5').addClass('btn btn-primary');
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
