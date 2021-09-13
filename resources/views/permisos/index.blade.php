<h3>Permisos de Usuarios</h3>
<div class="row">
    <form id="form_1" class="form col-md-12" >
        <div class="form-group mb-2 col-md-4" >
            <label>Usuario:</label>
            <select class="js-basic-single form-control" id="usuario" name="usuario" data-select6-id="1" tabindex="-1" aria-hidden="true">
                @foreach ($usuarios as $user)
                    @if ($loop->first)
                        
                        @php
                            $firstUser = $user->IDUSUARIO;
                            $permiso = 'N';
                            $IdAcceso = 0;
                        @endphp

                        @if ($userbuscado != 0)
                            @php
                                $firstUser = $userbuscado;
                                $permiso = 'N';
                                $IdAcceso = 0;
                            @endphp                     
                        @endif
                    @endif
                    <option value="{{$user->IDUSUARIO}}" 
                        
                        @if ($userbuscado != 0 && $user->IDUSUARIO == $userbuscado  )
                            selected="selected"
                        @endif
                        
                        data-select6-id="2">{{$user->NOMBRE.' - '.$user->CORREO}}  </option>
                @endforeach                                       
            </select>   
        </div>
        <div class="form-group mb-2 col-md-4">
            <button class="btn btn-primary buscar_permiso" >Buscar</button>
        </div>
    </form>
</div>

<form  id="form_permisos" action="">
    <div class="row mt-2">
        @foreach ($menus as $menu)
        <div class="col-lg-4">
            <div class="card card-statistics">
                <div class="card-header">
                    <div class="card-heading">
                        <h4 class="card-title">{{$menu->MENUNOMBRE }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($opcion as $opci)
                        @if ($opci->IDMENU == $menu->IDMENU)
                           @foreach ($accesos as $acc)
                                @if($opci->IDOPCION == $acc->IDOPCION && $acc->IDUSUARIO == $firstUser && $acc->ESTADO == 'S')
                                    @php $permiso = 'S'  @endphp 
                                    @php $IdAcceso = $acc->IDACCESO  @endphp  
                                @elseif($opci->IDOPCION == $acc->IDOPCION && $acc->IDUSUARIO == $firstUser && $acc->ESTADO == 'N')
                                    @php $permiso = 'N'  @endphp 
                                    @php $IdAcceso = $acc->IDACCESO  @endphp                                 
                                @endif
                           @endforeach  
                            <div class="form-group">
                                <div class="checkbox checbox-switch">
                                    <label>
                                        <input type="checkbox" class="permiso_s"
                                        name="switch_{{$opci->IDOPCION}}" data-acceso="{{ $IdAcceso }}"
                                        @if ($permiso == 'S')
                                            checked="checked"
                                        @else
                                        
                                        @endif
                                    >
                                        <span></span>
                                        {{$opci->NOMBREOPCION }}
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
</form>


<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 

    $('.buscar_permiso').on('click',function(e){
        e.preventDefault();
        let user = 0;
        user = $('#usuario').val();
        $(".loader").show();
        $.ajax({
            url: 'buscarpermisos/'+user ,
            type: 'GET',
            data: null,
            success: function (data) {
                $('#card-body-content').html(data);
                $(".loader").hide();
            },
            cache: false,
            contentType: false,
            processData: false,                
        });        
    });

    

    $('.permiso_s').change(function() {
        
        let idacceso = 0;
        idacceso = $(this).data("acceso");
        let usuario = $('#usuario').val();
        let value = 'N';

        console.log(idacceso);
        
        if($(this).is(":checked")) {
            value = 'S'
        }

        const formData = new FormData(); 
        formData.append('idacceso',idacceso);
        formData.append('idusuario',usuario);
        formData.append('estado',value);
        console.log(formData);

        $.ajax({
            url: 'updatepermiso',
            type: 'POST',
            data: formData,
            success: function (data) {
                if(data.status == 'ok')
                {                       
                    Command: toastr["success"]("Permiso Cambiado", "Exito")

                    toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": 200,
                    "hideDuration": 300,
                    "timeOut": 1000,
                    "extendedTimeOut": 1000,
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                    }
                    
                }else{
                    Command: toastr["error"]("Inconveniente al cambiar Permiso", "Error")

                    toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": 200,
                    "hideDuration": 300,
                    "timeOut": 1000,
                    "extendedTimeOut": 1000,
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                    }
                }
                //$('#card-body-content').html(data);
            },
            cache: false,
            contentType: false,
            processData: false,                
        }); 
                
    });

</script>


