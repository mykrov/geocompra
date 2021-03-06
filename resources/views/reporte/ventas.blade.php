
<table  class="table data-table table-striped" id="table-venta">
    <thead>  
        <tr>
            <th>Fecha</th>
            <th>Documento</th>
            <th>Razon Social</th>
            <th>SubTotal</th>
            <th>SubTotal0</th>
            <th>IVA</th>
            <th>Neto</th>
            <th>Estado</th>
            
        </tr> 
    </thead>
    <tbody>
        @foreach ($ventas as $venta)
            <tr>
                <td>{{ $venta->FECHAEMI }}</td>
                <td>{{ $venta->NUMEROFAC }}</td>
                <td>{{ $venta->CLIENTE }}</td>
                <td>{{ round($venta->SUBTOTALFAC,2) }}</td>
                <td>{{ round($venta->SUBTOTAL0,2) }}</td>
                <td>{{ round($venta->IVAFAC,2) }}</td>
                <td>{{ round($venta->NETOFAC,2) }}</td>
                <td>@if ($venta->ESTADO =='N')
                        No Procesado
                    @elseif($venta->ESTADO =='A') 
                        Procesado
                    @else
                        Error
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<script>
         $('#table-venta').DataTable({
                "scrollX": true,
                'responsive': true,
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
</script>