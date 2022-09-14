 <form action="" autocomplete="off" id="form_aut_dia" method="post" name="form_aut_dia">
  <div class="row">     
        <h3>Autorizaciones del día</h3>
    </div>
<div class="row">
  <div class="col-25">
    <label class="col-form-label col-form-label-sm" for="fecha">
      Fecha
    </label>
  </div>
  <div class="col-25">
    <input class="form-control form-control-sm" id="fecha" name="fecha" required="" type="date" value="{$datos.fecha|default}">
    </input>
  </div>
  <div class="col-25 center">
     <input class="btn btn-normal"  id="buscar" name="buscar" type="button" value="Buscar">
  </div>
</div>
</form>
<div id="div_listado" ></div>
<script type="text/javascript">
$( document ).ready(function() { 
    document.getElementById("fecha").value = fncGetToday();
    document.getElementById("fecha").setAttribute("max", fncGetToday());
    link_ajax('/base/{$ruta}/listado.php','div_listado','form_aut_dia');
});

  $('#buscar').on('click', function(){  // capture the click         
   link_ajax('/base/{$ruta}/listado.php','div_listado','form_aut_dia');
  });
</script>
