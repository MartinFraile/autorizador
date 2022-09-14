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
      <form action="" autocomplete="off" id="form_list_aut" method="post" name="form_list_aut">

        <div class="row">            
            <div class="col-100">
              <div class="col-25">
                <label class="col-form-label col-form-label-sm" for="periodo">
                  Periodo
                </label>
              </div>
              <div class="col-75">
               {literal}  <input class="form-control form-control-sm"  pattern="[0-9]{4}-[0-9]{2}"  id="periodo" name="periodo" type="month" min="2010-01" placeholder="aaaa-mm" value=""> {/literal}
                  </input>
              </div>
            </div>
          </div>
       
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
            <div class="col-100" style="padding-right: 0px;">
                <div class="col-25">
                  <label class="col-form-label col-form-label-sm" for="orden">
                    Corte
                  </label>
                </div>
                <div class="col-75">
                    <input type="radio" name="corte"
                    value="ApeyNom" checked> Afiliados
                    <input type="radio" name="corte"
                    value="DesObSoc" > Ob. Social
                     <input type="radio" name="corte"
                    value="DesPres" > Practica
                </div>
              </div>
          </div>
        
        <div class="card-footer text-center">
          
          <input id="ruta" name="ruta" type="hidden" value="{$ruta}"/>
          <input id="accion" name="accion" type="hidden" value=""/>
          <input class="btn btn-normal" id="buscar" name="buscar" type="button" value="Buscar" />
          <input class="btn btn-success" id="imprimir" name="imprimir" type="button" value="Imprimir" />
          <input class="btn btn-primary" onclick="link_ajax('/base/blanquea.php','div_principal');" type="button" value="Cancelar" />
        </div>
      </form>
    </div>
  </div>
</div>
<div id="div_listado" name="div_listado"></div>
<script type="text/javascript">
   $( document ).ready(function() {    
      $('#form_list_aut #periodo').attr('required','required'); 
 });
   
 $('#form_list_aut #buscar').on('click', function(e){  // capture the click  
      //console.log($estado);
     //$("input , select").removeClass('is-invalid');              
      var form = document.getElementById('form_list_aut');
      var isValidForm = form.checkValidity();
     
     if (isValidForm === false) { 
      
      $("input:invalid,select:invalid").addClass('is-invalid');
      e.stopPropagation();
      return false;
    }else{
      e.stopPropagation();  
    
    }  

    link_ajax('/base/{$ruta}/list_buscar_aut.php','div_listado','form_list_aut');
    
  });


  $('#form_list_aut #imprimir').on('click', function(e){  // capture the click  

     $("input , select").removeClass('is-invalid');              
      var form = document.getElementById('form_list_aut');
      var isValidForm = form.checkValidity();
     
     if (isValidForm === false) { 
      
      $("input:invalid,select:invalid").addClass('is-invalid');
      e.stopPropagation();
      return false;
    }else{
      e.stopPropagation();  
    
    }
    $("#accion").val("imprimir");
    $("#desobrasoc").val( $("#cod_obsoc option:selected").text());
   
    link_ajax('/base/{$ruta}/imprimir.php','div_principal','form_list_aut', 'si');
    
  });
</script>
