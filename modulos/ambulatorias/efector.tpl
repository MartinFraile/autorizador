<div class="row" >
    <div class="col-25">
      <label class="col-form-label col-form-label-sm" for="cod_efector">
        Efector
      </label>
    </div>
    <div class="col-75" >
      {include file="$base/tpl/buscador_live.tpl" id_buscador="matefec" id_desc_buscador="apellidos" bus_script="busefector" bus_id="matefecbus"   }
    </div>
</div>
<script type="text/javascript">
  $( document ).ready(function() {  
     document.getElementById("matefec").required = true;  
     document.getElementById("matefec_desc").required = true;
 }); 

 </script>