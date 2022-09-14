<div class="row" >
    <div class="col-15">
      <label class="col-form-label col-form-label-sm" for="cod_efector">
        Efector
      </label>
    </div>
    <div class="col-85">
      {include file="$base/tpl/buscador_live.tpl" id_buscador="matricula" id_desc_buscador="apellidos" bus_script="busefectorodon" bus_id="mmedicos_id"   }
    </div>
</div>
<script type="text/javascript">
  $( document ).ready(function() {  
     document.getElementById("matricula").required = true;  
 }); 

 </script>