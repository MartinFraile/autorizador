<div class="col-50 col-center" style="margin-bottom: 20px;">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">
        {$titulo|default}
        <span class="close">
          ×
        </span>
      </h3>
    </div>
    <div class="card-body">
      <form action="" autocomplete="off" id="form_list_pendiente" method="post" name="form_list_pendiente">

        <div class="row">            
          <div class="col-100">
            <div class="col-25">
              <label class="col-form-label col-form-label-sm" for="cod_obsoc">
                Obra Social
              </label>
            </div>
            <div class="col-75">
                  {include file="$base/tpl/option_btn.tpl" id_opt_btn="cod_obsoc" esrequerido="required" datos=$datos|default options=$obrasoc}
            </div>
          </div>
         </div>
         <div class="row">
          <div class="col-50">
            <label class="col-form-label col-form-label-sm" for="fecdesde">
              Fecha Desde
            </label>
            <input class="form-control form-control-sm" id="fecdesde" name="fecdesde" type="date" value="{$datos.fecdesde|date_format:'%d-%m-%Y'|default}">
          </div>
          <div class="col-50">
            <label class="col-form-label col-form-label-sm" for="fechasta">
              Fecha Hasta
            </label>
            <input class="form-control form-control-sm" id="fechasta" name="fechasta" type="date" value="{$datos.fechasta|date_format:'%d-%m-%Y'|default}">
          </div>
        </div>
        
        <div class="card-footer text-center">
          <input id="estado" name="estado" type="hidden" value="{$estado}"/>
          <input id="ruta" name="ruta" type="hidden" value="{$ruta}"/>
          <input id="accion" name="accion" type="hidden" value=""/>
          <input class="btn btn-success" id="list_pendiente" name="list_pendiente" type="button" value="Listado" />
          <input class="btn btn-primary" onclick="link_ajax('/base/blanquea.php','div_principal');" type="button" value="Cancelar" />
        </div>
      </form>

      
    </div>
  </div>
</div>

  <div id="div_listado" name="div_listado"></div>
<script type="text/javascript">
  


  $('#form_list_pendiente #list_pendiente').on('click', function(e){  // capture the click  
      //console.log($estado);
     //$("input , select").removeClass('is-invalid');              
      var form = document.getElementById('form_list_pendiente');
      var isValidForm = form.checkValidity();
     
     if (isValidForm === false) { 
      
      $("input:invalid,select:invalid").addClass('is-invalid');
      e.stopPropagation();
      return false;
    }else{
      e.stopPropagation();  
    
    }
    link_ajax('/base/{$ruta}/list_estado.php','div_listado','form_list_pendiente');
    
  });
</script>
