<style type="text/css">
 .modal-content{
   width: 75%;
 }
 #bus_tabla{
   font-size: 14px;
 }

</style>
<div class="col-80 col-center">
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
      <form action="" autocomplete="off" id="consulta_aut" method="post" name="consulta_aut">
        <div class="row">
          <div class="col-50">
              <div class="col-25">
                  <label class="col-form-label" for="profecional">
                      Profesional
                  </label>
              </div>
              <div class="col-75">
                  <label class="col-form-label" for="profecional">
                        {$profesional}
                    </label>
              </div>
          </div>
          <div class="col-100">
              <div class="col-50">
                <div class="col-25">
                    <label class="col-form-label" for="profecional">
                        Nro de Orden
                    </label>
                </div>
                <div class="col-75">
                    <label class="col-form-label" for="profecional">
                        {$nro_orden}
                    </label>
                </div>
              </div>
              <div class="col-50">
                <div class="col-25">
                    <label class="col-form-label" for="profecional">
                        Afiliado
                    </label>
                </div>
                <div class="col-75">
                    <label class="col-form-label" for="profecional">
                        {$afiliado}
                    </label>
                </div>
              </div>
          </div>
          <div class="col-50">
              <div class="col-25">
                  <label class="col-form-label" for="profecional">
                      Estado
                  </label>
              </div>
              <div class="col-75" id="profecionalid">
                  <label class="col-form-label" for="profecional" style="font-weight: bold;">
                        {$desestado}
                    </label>
              </div>
          </div>
          <div class="col-50">
              <div class="col-25">
                  <label class="col-form-label" for="importe">
                      Importe Total
                  </label>
              </div>
              <div class="col-75" id="importeid">
                  <label class="col-form-label" for="importe" style="font-weight: bold;">
                        {$imptot}
                    </label>
              </div>
          </div>
          <div class="col-50">
              <div class="col-25">
                  <label class="col-form-label" for="coseguro">
                      Coseg. Total
                  </label>
              </div>
              <div class="col-75" id="coseguroid">
                  <label class="col-form-label" for="coseguro" style="font-weight: bold;">
                        {$cosegtot}
                    </label>
              </div>
          </div>
      </div>
        <div class="row consulta-tabla">
            <div id="no-more-tables">
            </div>
        </div>
        <div class="card-footer text-center">
            <input id="ruta" name="ruta" type="hidden" value="{$ruta}"/> 
            <input id="cod_obsocconec" name="cod_obsocconec" type="hidden" value="{$cod_obsoc}"/>
            <input id="accion" name="accion" type="hidden" value="Anular"/>
            <input class="btn btn-warning" id="anular" name="anular" type="button" onclick="link_ajax('/base/{$ruta}/anula_aut.php?nro_orden={$nro_orden}&codinterno={$cod_obsoc}','div_principal','','si');"  value="Anular" style="display:none;" />                  
            <input id="accion" name="accion" type="hidden" value="imprimir"/>
            <input class="btn btn-success" id="imprimirr" onclick="void window.open('/base/{$ruta}/imprimeOrden.php?nro_orden={$nro_orden}&obsobweb={$cod_obsoc}','_blank');" name="imprimir" type="button"  value="Imprimir" style="display:none;" />
            <input class="btn btn-primary cancelar"  type="button" value="Cancelar" />
        </div>
      </form>
    </div>
  </div>
</div>
 
<script type="text/javascript">
 $(document).ready(function() {

   
   switch ({$estado}) {
      case 0,7,17:
           $('#anular').removeAttr('style');
           $('#imprimirr').removeAttr('style');
           $('#profecionalid').css('color','green');
            break;     
     case 3,8:
          $('#profecionalid').css('color','red');
          break;
      case 6,9:
          $('#anular').removeAttr('style');
          $('#profecionalid').css('color','blue');
          break;
      case 18:
           $('#imprimirr').removeAttr('style');
           $('#profecionalid').css('color','red');
            break;
      default:
          $('#anular').removeAttr('style');
           $('#imprimirr').removeAttr('style');
           $('#profecionalid').css('color','green');
        

  }

});

   var datos =  {$datos};  
    //datos = JSON.parse(datos.replace(/"\[/g, '[').replace(/\]"/g, ']').replace(/\\/g, '')); 
  //  datos = JSON.parse(datos.replace(/"\[/g, '[').replace(/\]"/g, ']').replace(/\\/g, '')); 
 var headers = [{
        "label": "cod_practica",
        "name": "cod_practica",
        "opciones": {
          "alias": "cod_practica",
          "nom_campo": "cod_practica"
        }
      }, {
        "label": "descripcion",
        "name": "descripcion",
        "opciones": {
          "alias": "descripcion",
          "nom_campo": "descripcion",
        }
        },{
        "label": "nropieza",
        "name": "nropieza",
        "opciones": {
          "alias": "nropieza",
          "nom_campo": "nropieza",
        }
        },{
        "label": "cara",
        "name": "cara",
        "opciones": {
          "alias": "cara",
          "nom_campo": "cara",
        }
           
      }];
  $(".consulta-tabla #no-more-tables").html(cabecera(headers));
 
  $(".consulta-tabla #bus_tabla tbody").html(detalle(datos, headers));





 </script>
