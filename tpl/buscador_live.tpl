<style type="text/css">

</style>
<div class="autocomplete">
  <div class="input-group">
    <input class="col-25 form-control form-control-sm search" data-desc="{$id_desc_buscador}" data-id="{$bus_id|default}" id="{$id_buscador}" name="{$id_buscador}" type="text" value="{$datos.$id_buscador|default}"/>
    <input id="{$bus_id}" name="{$bus_id}" type="hidden" value="{$datos.$bus_id|default}"/>
    <input class="col-75 form-control form-control-sm" id="{$id_buscador}_desc" name="{$id_buscador}_desc" readonly="readonly" type="text" value=""/>
    {if $boton|default == "nuevo"}
        <button class="btn btn-sm add" id="{$id_buscador}_nuevo" name="{$id_buscador}_nuevo" type="button">
        </button>
    {/if}        
  </div>
</div>
<script type="text/javascript">
  /* show lightbox when clicking a thumbnail */
$('#{$id_buscador}_nuevo').click(function(event){
 open_form_in_modal("/modulos/{$modulo|default}/modificar.php");
  
});

$('#{$id_buscador}').change(function(){
  if($('#{$id_buscador}').val().length==0) 
    {
        $('#{$id_buscador}_desc').val(""); 
        $('#{$bus_id}').val(""); 
        jQuery.removeData( this, "datos" );  
    }
  });

  $('#{$id_buscador}').on('limpiar',function() {
    closeAllLists();
    $('#{$id_buscador}').val("");
    var id = $('#{$id_buscador}').attr("id");
    $('#'+id+'_desc').val("");
    var bus_id = $('#{$id_buscador}').parent().find('input[type=hidden]').attr("id");
    $('#'+bus_id).val("");
    jQuery.removeData( $('#{$id_buscador}'), "datos" );
  });



$('#{$id_buscador}').donetyping(function(){
  var query =$(this).val();
  closeAllLists();
  $('#{$id_buscador}').trigger('tipeando');  
  $('#{$id_buscador}_desc').val(""); 
  $('#{$bus_id}').val("");
  jQuery.removeData( this, "datos" );  
   
   !$.isNumeric(query)
   if(!$.isNumeric(query) && query.length < 3)  return;
    bus_{$id_buscador}(query) ;
});

    function bus_{$id_buscador}(query) {
    var inn = document.getElementById("{$id_buscador}"); 
     datosform = $("form").serialize();
     $.ajax({
              url: "/script/buscar_json.php",
              data:  { script: '{$bus_script}' ,id_bus :'{$id_buscador}', tipo: 'json', {$id_buscador}: query , datosform: datosform },           
              dataType: "json",
              type: "POST",
              success: function (response) {
                if (response.length == 0){
                  $('#{$id_buscador}').trigger('limpiar');
                } else if (response.length == 1){
                  itemSelect(inn, response[0]);
                } else{
                  bus_query(inn , response);
                }

              },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                   alert("Error en Conexión");

                }
          } ) ;
}
</script>
