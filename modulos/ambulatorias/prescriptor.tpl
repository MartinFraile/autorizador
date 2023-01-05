<div class="row" >
    <div class="col-25">
      <label class="col-form-label col-form-label-sm" for="cod_prescriptor">
        Prescriptor
      </label>
    </div>
    <div class="col-75">
      {include file="$base/tpl/buscador_live.tpl" id_buscador="matpres" id_desc_buscador="apellidos" bus_script="busprescriptor" bus_id="matpresbus"   }
    </div>
</div>
<script type="text/javascript">
  $( document ).ready(function() {  
     document.getElementById("matpres").required = true; 
     document.getElementById("matpres_desc").required = true; 
 }); 

 </script>