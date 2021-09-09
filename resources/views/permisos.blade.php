<h3>Permisos de Usuarios</h3>


<div class="form-group mb-1 col-md-6" data-select6-id="2">
    <label>Usuario:</label>
    <select class="js-basic-single form-control" name="usuario" data-select6-id="1" tabindex="-1" aria-hidden="true">
        @foreach ($usuarios as $user)
            @if ($loop->first)
                @php
                    $firstUser = $user->IDUSUARIO;
                    $permiso = 'N';
                @endphp
            @endif
            <option value="{{$user->IDUSUARIO}}" data-select6-id="2">{{$user->NOMBRE.' - '.$user->CORREO}}  </option>
        @endforeach                                       
    </select>   
</div>
</div>
<div class="row">
    @foreach ($menus as $menu)
    <div class="col-lg-4">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title">{{$menu->MENUNOMBRE }}</h4>
                </div>
            </div>
            <div class="card-body">
                @foreach ($opcion as $item)
                    @if ($item->IDMENU == $menu->IDMENU)
                       @foreach ($accesos as $acc)
                            @if($item->IDOPCION == $acc->IDOPCION && $acc->IDUSUARIO == $firstUser && $acc->ESTADO == 'S')
                                @php $permiso = 'S' @endphp                                
                            @endif
                       @endforeach

                        <div class="form-group">
                            <div class="checkbox checbox-switch">
                                <label>
                                    <input type="checkbox" 
                                    name="switch{{$item->IDOPCION}}" 
                                    @if ($permiso == 'S')
                                        checked="checked"
                                    @else
                                        checked="false"
                                    @endif
                                   >
                                    <span></span>
                                    {{$item->NOMBREOPCION . ' - '.$permiso}}
                                </label>
                            </div>
                        </div>                         
                    @endif                    
                @endforeach
            </div>
        </div>
    </div>                    
    @endforeach
</div>


