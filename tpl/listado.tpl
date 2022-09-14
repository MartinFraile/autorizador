<link href="/css/tablas.css" rel="stylesheet"/>

<div class="bg-light" id="div_contenido" >
  <div  id="div_listado" >
    {if isset($div)}
    {assign var="var_div" value=$div} 
    {else}
    {assign var='var_div' value='div_principal'} 
    {/if}   

    {if isset($titulo)}
    <div class="row">     
      <h3>{$titulo|default}</h3>
    </div>
    {/if}

    {if $hidebus|default:"false" !== "true"}
    <div style="padding: 10px;">
      <form name="form_buscar" id="form_buscar" class="form-inline justify-content-center float-right" method="POST" >        
        <div class="col-25">
         <input type="text" name="bus_id"  class="form-control form-control-sm" placeholder="Filtro..." id="bus_id" value=""> 
       </div>              
       <input type="hidden" name="buscar" id="buscar" value="si">
     </form>
     {if $boton|default == "nuevo"}
     <div class="col-50" style="text-align: right;
     float: right;">
     <input type="button" name="nuevo" id="nuevo" class="btn btn-primary" onclick=" javascript: link_ajax('/{$ruta}/modificar.php','div_principal','','','');" value="Nuevo"  />
   </div>        
   {/if}
 </div>
 {/if}    
 {if $data}
 <form name="form_listado" id="form_listado" method="POST" >
    <div class="limiter">
      <div class="container-table100">
        <div class="wrap-table100">
          <div class="table100">

          </div>
        </div>
      </div>
    </div>
</form>
{else} <strong>No se encontraron resultados</strong>
{/if}
</div>
</div>
<script>
  $(document).ready(function(){


    /* The function */
    var datos = {$data|default} ;
    var headers = {$headers|default} ;
    $("#{$var_div|default} .table100").html(cabecera(headers ));      
    $("#{$var_div|default} #bus_tabla tbody").html(detalle( datos ,headers )); 
    paginador({$cantRow|default});


    $("#{$var_div|default} #bus_id").on("keyup", function() {   
      var value = $(this).val().toLowerCase(); 
      let newDatos = filterItems(value, datos);
      var p_key = $('.selected').attr('id');
      order = ($('.selected').is('.asc')) ? 1:-1; 
      ordenarDesc(newDatos, p_key , order)
      $("#{$var_div|default} #bus_tabla tbody").html(detalle(newDatos, headers));
      paginador({$cantRow|default});
    });
    /*Funcion Sort table*/  
    $('#{$var_div|default} #bus_tabla th').each(function(col) {    
      $(this).click(function() { 
        $('#{$var_div|default} #bus_tabla th').each(function(col) {  
          $(this).find('a').find('i').attr('class', '');
          $(this).removeClass('selected');
        });        
        if ($(this).is('.asc')) {
          $(this).removeClass('asc');
          $(this).addClass('selected desc');
          $(this).find('a').find('i').attr('class', 'arrow top');
          sortOrder = -1;
        } else {
          $(this).removeClass('desc');
          $(this).addClass('selected asc');       
          $(this).find('a').find('i').attr('class', 'arrow bottom');
          sortOrder = 1;
        }
        var value = $('#{$var_div|default} #bus_id').val().toLowerCase();
        let newDatos = filterItems(value, datos);
        var id = $(this).attr('id');
        ordenarDesc(newDatos, id ,sortOrder);
        $("#{$var_div|default} #bus_tabla tbody").html(detalle( newDatos ,headers ));
        paginador({$cantRow|default});
      });
    });  
  });


  function filterItems2(query, arr) {

    return arr.filter(function(obj) {
      return Object.keys(query).every(function(c) {
        return obj[c] == query[c];
      });
    });
  }
</script>
