<div class="autocomplete">
  <div class="input-group">
    <input class="col-100 form-control form-control-sm search"  autocomplete="off" data-name="input_search_solo" data-desc="{$id_desc_buscador}" data-id="{$bus_id|default}" id="input_{$id_buscador}" name="input_{$id_buscador}" type="text" {$required|default} value="{$datos.$id_buscador|default}">
      <input id="{$id_buscador}" name="{$id_buscador}" type="hidden" value="{$datos.$id_buscador|default}">       
      <input id="{$bus_id}" name="{$bus_id}" type="hidden" value="{$datos.$bus_id|default}">       
          {if $boton|default == "nuevo"}
          <button class="btn btn-sm add" id="{$id_buscador}_nuevo" name="{$id_buscador}_nuevo" type="button">
          </button>
          {/if}
        </input>
      </input>
    </input>
  </div>
</div>
<script type="text/javascript">
   
  
$('#{$id_buscador}_nuevo').click(function(event){  
 open_form_in_modal("/modulos/{$modulo|default}/modificar.php");
  
});


$('#input_{$id_buscador}, #{$id_buscador}').on('limpiar',function() {
  closeAllLists();
  $('#{$id_buscador}').val("");
  var id = $('#{$id_buscador}').attr("id");
  $('#'+id+'_desc').val("");
  var bus_id = $('#{$id_buscador}').parent().find('input[type=hidden]').attr("id");
  $('#'+bus_id).val("");
  jQuery.removeData( $('#{$id_buscador}'), "datos" );
});

$('#input_{$id_buscador}, #{$id_buscador}').donetyping(function(){
  var query =$(this).val(); 
  closeAllLists();
  $('#input_{$id_buscador}').trigger('tipeando');    
  if(query.length < 1){        
    $('#input_{$id_buscador}').trigger('limpiar');
    return false;
  } 
  bus_{$id_buscador}(query) ;
});


    function bus_{$id_buscador}(query) {
    var inn = document.getElementById("input_{$id_buscador}"); 
     datosform = $("form").serialize();
     $.ajax({
              url: "/script/buscar_json.php",
              data:  { script: '{$bus_script}' ,id_bus :'input_{$id_buscador}', tipo: 'json', input_{$id_buscador}: query , datosform: datosform },           
              dataType: "json",
              type: "POST",
              success: function (response) {   
              
               if (response.length == 0){
                    $('#input_{$id_buscador}').trigger('limpiar');
               }
                else if (response.length == 1){
                    itemFinded(inn, response[0]);
                }  else{
                    bus_query(inn , response);  
                }
                
              },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                   alert("Error en Conexión");

                }
          } ) ;
}


</script>
