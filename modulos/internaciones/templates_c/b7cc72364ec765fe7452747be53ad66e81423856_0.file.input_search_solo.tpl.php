<?php
/* Smarty version 3.1.39, created on 2021-09-27 19:04:22
  from 'c:\wamp\www\pwa\tpl\input_search_solo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_615215b6dbd528_10603117',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b7cc72364ec765fe7452747be53ad66e81423856' => 
    array (
      0 => 'c:\\wamp\\www\\pwa\\tpl\\input_search_solo.tpl',
      1 => 1622137446,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_615215b6dbd528_10603117 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="autocomplete">
  <div class="input-group">
    <input class="col-100 form-control form-control-sm search" data-name="input_search_solo" data-desc="<?php echo $_smarty_tpl->tpl_vars['id_desc_buscador']->value;?>
" data-id="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['bus_id']->value)===null||$tmp==='' ? '' : $tmp);?>
" id="input_<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
" name="input_<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
" type="text" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value[$_smarty_tpl->tpl_vars['id_buscador']->value])===null||$tmp==='' ? '' : $tmp);?>
">
      <input id="<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
" type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value[$_smarty_tpl->tpl_vars['id_buscador']->value])===null||$tmp==='' ? '' : $tmp);?>
">       
      <input id="<?php echo $_smarty_tpl->tpl_vars['bus_id']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['bus_id']->value;?>
" type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value[$_smarty_tpl->tpl_vars['bus_id']->value])===null||$tmp==='' ? '' : $tmp);?>
">       
          <?php if ((($tmp = @$_smarty_tpl->tpl_vars['boton']->value)===null||$tmp==='' ? '' : $tmp) == "nuevo") {?>
          <button class="btn btn-sm add" id="<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
_nuevo" name="<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
_nuevo" type="button">
          </button>
          <?php }?>
        </input>
      </input>
    </input>
  </div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
   
  
$('#<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
_nuevo').click(function(event){  
 open_form_in_modal("/base/modulos/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['modulo']->value)===null||$tmp==='' ? '' : $tmp);?>
/modificar.php");
  
});


$('#input_<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
, #<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
').on('limpiar',function() {    
  closeAllLists();  
  $('#<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
').val(""); 
  var id = $('#<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
').attr("id");
  $('#'+id+'_desc').val(""); 
  var bus_id = $('#<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
').parent().find('input[type=hidden]').attr("id");   
  $('#'+bus_id).val("");
  jQuery.removeData( $('#<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
'), "datos" ); 
});


$('#input_<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
, #<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
').donetyping(function(){
  var query =$(this).val(); 
  closeAllLists();
  $('#input_<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
').trigger('tipeando');  
  if(query.length < 1) return false;
  bus_<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
(query) ;
});


    function bus_<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
(query) {
    var inn = document.getElementById("input_<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
"); 
     datosform = $("form").serialize();
     $.ajax({
              url: "/base/script/buscar_json.php",
              data:  { script: '<?php echo $_smarty_tpl->tpl_vars['bus_script']->value;?>
' ,id_bus :'input_<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
', tipo: 'json', input_<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
: query , datosform: datosform },           
              dataType: "json",
              type: "POST",
              success: function (response) {                 
               if (response.length == 0){
                  $('#input_<?php echo $_smarty_tpl->tpl_vars['id_buscador']->value;?>
').trigger('limpiar');                  
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


<?php echo '</script'; ?>
>
<?php }
}
