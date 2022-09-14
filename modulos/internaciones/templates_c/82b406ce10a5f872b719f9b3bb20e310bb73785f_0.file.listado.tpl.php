<?php
/* Smarty version 3.1.39, created on 2021-08-26 20:06:59
  from 'c:\wamp\www\pwa\tpl\listado.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6127f463c65214_94776166',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '82b406ce10a5f872b719f9b3bb20e310bb73785f' => 
    array (
      0 => 'c:\\wamp\\www\\pwa\\tpl\\listado.tpl',
      1 => 1622137446,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6127f463c65214_94776166 (Smarty_Internal_Template $_smarty_tpl) {
?>    <style>
.currency::before {
  content: '$'}

  
    </style>
<div class="bg-light" id="div_contenido" >
  <div  id="div_listado" >
    <?php if ((isset($_smarty_tpl->tpl_vars['div']->value))) {?>
       <?php $_smarty_tpl->_assignInScope('var_div', $_smarty_tpl->tpl_vars['div']->value);?> 
    <?php } else { ?>
       <?php $_smarty_tpl->_assignInScope('var_div', 'div_principal');?> 
    <?php }?>   

    <?php if ((isset($_smarty_tpl->tpl_vars['titulo']->value))) {?>
    <div class="row">     
        <h3><?php echo (($tmp = @$_smarty_tpl->tpl_vars['titulo']->value)===null||$tmp==='' ? '' : $tmp);?>
</h3>
    </div>
    <?php }?>

<?php if ((($tmp = @$_smarty_tpl->tpl_vars['hidebus']->value)===null||$tmp==='' ? "false" : $tmp) !== "true") {?>
    <div class="row ">
      <form name="form_buscar" id="form_buscar" class="form-inline justify-content-center float-right" method="POST" >        
        <div class="col-33">
         <input type="text" name="bus_id"  class="form-control" placeholder="Filtro..." id="bus_id" value=""> 
      </div>              
        <input type="hidden" name="buscar" id="buscar" value="si">
      </form>
<?php if ((($tmp = @$_smarty_tpl->tpl_vars['boton']->value)===null||$tmp==='' ? '' : $tmp) == "nuevo") {?>
       <div class="col-50" style="text-align: right;
    float: right;">
        <input type="button" name="nuevo" id="nuevo" class="btn btn-primary" onclick=" javascript: link_ajax('/base/<?php echo $_smarty_tpl->tpl_vars['ruta']->value;?>
/modificar.php','div_principal','','','');" value="Nuevo"  />
      </div>        
<?php }?>
    </div>
<?php }?>    
    <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
    <form name="form_listado" id="form_listado" method="POST" >
      <div class="row">
        <div class="col-md-12">
          <div id="no-more-tables">
           
          </div>

        </div>
      </div>

    </form>
    <?php } else { ?> <strong>No se encontraron resultados</strong>
    <?php }?>
  </div>
</div>
<?php echo '<script'; ?>
>
$(document).ready(function(){

/* The function */
  var datos = <?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value)===null||$tmp==='' ? '' : $tmp);?>
 ;
  var headers = <?php echo (($tmp = @$_smarty_tpl->tpl_vars['headers']->value)===null||$tmp==='' ? '' : $tmp);?>
 ;
  $("#no-more-tables").html(cabecera(headers ));
  $("#bus_tabla tbody").html(detalle( datos ,headers )); 
  paginador(<?php echo (($tmp = @$_smarty_tpl->tpl_vars['cantRow']->value)===null||$tmp==='' ? '' : $tmp);?>
);

  $("#bus_id").on("keyup", function() {   
    var value = $(this).val().toLowerCase(); 
  let newDatos = filterItems(value, datos);
    var p_key = $('.selected').attr('id');
    order = ($('.selected').is('.asc')) ? 1:-1; 
    ordenarDesc(newDatos, p_key , order)
    $("#bus_tabla tbody").html(detalle(newDatos, headers));
    paginador(<?php echo (($tmp = @$_smarty_tpl->tpl_vars['cantRow']->value)===null||$tmp==='' ? '' : $tmp);?>
);
  });
  /*Funcion Sort table*/  
  $('#bus_tabla th').each(function(col) {    
    $(this).click(function() { 
      $('#bus_tabla th').each(function(col) {  
        $(this).find('a').find('i').attr('class', 'arrow right');
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
      var value = $('#bus_id').val().toLowerCase();
      let newDatos = filterItems(value, datos);
      var id = $(this).attr('id');
      ordenarDesc(newDatos, id ,sortOrder);
      $("#bus_tabla tbody").html(detalle( newDatos ,headers ));
      paginador(<?php echo (($tmp = @$_smarty_tpl->tpl_vars['cantRow']->value)===null||$tmp==='' ? '' : $tmp);?>
);
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
<?php echo '</script'; ?>
>
<?php }
}
