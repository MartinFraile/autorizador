<div class="row" >
    <div class="col-15">
      <label class="col-form-label col-form-label-sm" for="cod_diagno">
        Diagno
      </label>
    </div>
    <div class="col-85">
      {include file="$base/tpl/buscador_live.tpl" id_buscador="id_tdiagnostico" id_desc_buscador="descripcion" bus_script="busdiagno" bus_id="diagno_id"   }
    </div>
</div>
<script type="text/javascript">
  $( document ).ready(function() {  
     document.getElementById("cod_diagno").required = true;  
 }); 

 </script>