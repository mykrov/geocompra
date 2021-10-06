<table class="table data-table table-striped" id="table-empresa">
    <thead>  
        <tr>
            <th>Razon social</th>
            <th>RUC</th>
            <th>Correo</th>
            
            <th>Estado</th>
            <th>Ambiente</th>
            <th>Contri.Espec.</th>
            <th>Contabilidad</th>  
        </tr> 
    </thead>
    <tbody>
        @foreach ($empresas as $pro)
            <tr>
                <td>{{ $pro->RAZONSOCIAL }}</td>
                <td>{{ $pro->RUC }}</td>
                <td>{{ $pro->CORREO }}</td>
               
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
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $('#table-empresa').DataTable({
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