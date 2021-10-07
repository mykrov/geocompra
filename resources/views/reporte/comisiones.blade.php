
<table  class="table data-table table-striped" id="table-comision">
    <thead>  
        <tr>
            <th>Fecha</th>
            <th>Empresa</th>
            <th>Monto</th>
            <th>SecFactura</th>
        </tr> 
    </thead>
    <tbody>
        @foreach ($comisiones as $comsion)
            <tr>
                <td>{{ $comsion->FECHACREACION }}</td>
                <td>{{ $comsion->EMPRESA }}</td>
                <td>{{ round($comsion->MONTO ,2)}}</td>
                <td>{{ $comsion->SECUENCIALFAC }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


<script>
         $('#table-comision').DataTable({
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