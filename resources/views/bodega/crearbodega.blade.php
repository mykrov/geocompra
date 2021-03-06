<div>
    <h4>Creación de Bodega</h4>
</div>
<form class="form-row" id="bodega_form" method="post" enctype="multipart/form-data">
                                    
    <input name="id" type="hidden" class="form-control" id="id">
    <input name="_token" type="hidden" class="form-control" id="_token"   value="{{ csrf_token() }}">
        
    <div class="form-group col-md-2">
        <label for="nombrecomercial">Nombre Comercial</label>
        <input name="nombrecomercial" type="text" class="form-control" id="nombrecomercial"  maxlength="50"   aria-describedby="emailHelp" placeholder="" value="">
        <small id="nombrecomercial" class="form-text text-muted">Nombre del la bodega.</small>
    </div>
    <div class="form-group col-md-2">
        <label for="serie">Serie</label>
        <input name="serie" type="text" class="form-control" maxlength="6" id="serie" aria-describedby="emailHelp" placeholder="" value="">
        <small id="serie" class="form-text text-muted">serie</small>
    </div>
    <div class="form-group col-md-4">
        <label for="secuencial">Secuencial</label>
        <input name="secuencial" type="number" class="form-control" maxlength="12" id="secuencial" aria-describedby="emailHelp" placeholder="" value="">
        <small id="secuencial" class="form-text text-muted">secuencial.</small>
    </div>
    <div class="form-group col-md-4">
        <label for="nnotacredito">Nro Nota Credito</label>
        <input name="nnotacredito" type="number" class="form-control" maxlength="12" id="nnotacredito" aria-describedby="emailHelp" placeholder="" value="">
        <small id="nnotacredito" class="form-text text-muted">secuencial nota credito.</small>
    </div>
    <div class="form-group col-md-4">
        <label for="nguiarem">Nro Guia Remision</label>
        <input name="nguiarem" type="number" class="form-control" maxlength="12" id="nguiarem" aria-describedby="emailHelp" placeholder="" value="">
        <small id="nguiarem" class="form-text text-muted">secuencial guia remision.</small>
    </div>
    <div class="form-group col-md-2">
        <label for="correo">Correo</label>
        <input name="correo" type="text" class="form-control" id="correo" aria-describedby="emailHelp" placeholder="" value="">
        <small id="correo" class="form-text text-muted">Dirección de Correo</small>
    </div>  
    <div class="form-group col-md-2">
        <label for="telefono">Telefono</label>
        <input name="telefono" type="text" class="form-control" id="telefono" aria-describedby="emailHelp" placeholder="" value="">
        <small id="telefono" class="form-text text-muted">telefono</small>
    </div>  
    <div class="form-group col-md-2">
        <label for="direccion">Direccion</label>
        <input name="direccion" type="text" class="form-control" id="direccion" aria-describedby="emailHelp" placeholder="" value="">
        <small id="direccion" class="form-text text-muted">Dirección </small>
    </div> 
    <div class="form-group col-md-2">
        <label for="latitud">Latitud</label>
        <input name="latitud" type="text" class="form-control" id="latitud" aria-describedby="emailHelp" placeholder="" value="">
        <small id="latitud" class="form-text text-muted">latitud</small>
    </div>
    <div class="form-group col-md-2">
        <label for="longitud">Longitud</label>
        <input name="longitud" type="text" class="form-control" id="longitud" aria-describedby="emailHelp" placeholder="" value="">
        <small id="longitud" class="form-text text-muted">longitud</small>
    </div>
    @if (Session::get('rol') == 'PRO')
        <div class="form-group mb-0 col-md-4" data-select6-id="6">
            <label>Empresa</label>
            <select class="js-basic-single form-control" name="idempresa" id="idempresa" data-select6-id="1" tabindex="-1" aria-hidden="true">
                @foreach ($empresas as $empre)
                    <option value="{{$empre->IDEMPRESA }}" data-select6-id="1">{{ $empre->RAZONSOCIAL }}</option>
                @endforeach                             
            </select>
        </div>
    @endif 

      <div class="form-group col-md-12 mt-3">
        <button id="save_btn" type="submit" class="btn btn-primary mb-2">Guardar</button> 
     </div> 
     <div id="mapa" style="width:100%; height: 500px;">
     </div>  
  </form>
  <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCj2cMW4qJpN6nRUO9UxWwxJn0HqaSDuB4&callback=initMap">
  </script>

<script>
    $("form#bodega_form").submit(function(e) {
            
            e.preventDefault();                
            const formData = new FormData(this); 
            console.log(formData);
        

            // jQuery.each(jQuery('#usuario_form')[0].files, function(i, file) {
            //     formData.append('file-'+i, file);
            // });
            

            $.ajax({
                url: '{{ route('bodegaguardar') }}' ,
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);
                    if(data.status == 'ok')
                    {                       
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Bodega Guardada.',
                            showConfirmButton: false,
                            timer: 1200
                        })                      
                        
                    }else{
                        console.log(data);
                        swal({
                            position: 'top-end',
                            type: 'error',                          
                            title: 'Error al guardar bodega',
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
<script>
    let map;
    function initMap(){
        map = new google.maps.Map(document.getElementById("mapa"), {
         center: { lat:  -2.1037199992126587, lng: -79.9079500 },//, -79.92878726811496
         zoom: 12,
       //  center: new google.maps.LatLng(-2.2058400,-79.9079500);
         });
         marcador= new google.maps.Marker({
             map:map,
             draggable:true,
             position:{ lat:  -2.1037199992126587, lng: -79.9079500 },
         });
         marcador.addListener('dragend',function(event){
             document.getElementById('latitud').value=this.getPosition().lat();
             document.getElementById('longitud').value=this.getPosition().lng();
         });

    }
    function generarMapas(coordenadas){
        console.log(coordenadas);
        var mapa=new google.maps.Map(document.getElementById('mapa'),
        {
            zoom:15,
           // center: new google.maps.LatLng(coordenadas.lat,coordenadas.lng);
        });
        console.log(mapa);
    }
</script>


