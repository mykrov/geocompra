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
            </tr>
        @endforeach
    </tbody>
</table>