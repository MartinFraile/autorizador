<style type="text/css">
.tag-info{
    margin-right: 2px;
    color: white;
    line-height: 2 !important;
        background-color: #5bc0de;
        display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
}
.tag-info [data-role="remove"] {
    margin-left: 8px;
    cursor: pointer;
}
.tag-info [data-role="remove"]:after {
    content: "x";
    padding: 0px 2px;
}

</style>
<div class="autocomplete">
  <div class="input-group">
    <input class="col-100 form-control form-control-sm search" data-name="input_search" data-desc="{$id_desc_buscador}" data-id="{$bus_id|default}" id="{$id_buscador}" name="{$id_buscador}" type="text" value="{$datos.$id_buscador|default}">
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
<div id="{$id_buscador}-div" class="tags-div"></div>
<script type="text/javascript">
   
  /* show lightbox when clicking a thumbnail */
$('#{$id_buscador}_nuevo').click(function(event){
  $('#nro_documento').val(' ');
 open_form_in_modal("/base/modulos/{$modulo|default}/modificar.php");
  
});


$('#{$id_buscador}').donetyping(function(){
  var query =$(this).val(); 
  closeAllLists();
  $('#{$id_buscador}').trigger('tipeando');  
   if(query.length < 1) return false;
  bus_{$id_buscador}(query) ;
});

    function bus_{$id_buscador}(query) {
    var inn = document.getElementById("{$id_buscador}"); 
     datosform = $("form").serialize();
     $.ajax({
              url: "/base/script/buscar_json.php",
              data:  { script: '{$bus_script}' ,id_bus :'{$id_buscador}', tipo: 'json', {$id_buscador}: query , datosform: datosform },           
              dataType: "json",
              type: "POST",
              success: function (response) {     
                if (response.length == 1){
                    itemSelectSolo(inn, response[0]);
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
