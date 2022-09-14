<?php
/* Smarty version 3.1.39, created on 2021-08-26 20:02:57
  from 'C:\wamp\www\pwa\modulos\ambodont\aut_dia.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6127f3715a09d1_32092317',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7ee44367a91a52563145db4e560b198b232e59e7' => 
    array (
      0 => 'C:\\wamp\\www\\pwa\\modulos\\ambodont\\aut_dia.tpl',
      1 => 1622137445,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6127f3715a09d1_32092317 (Smarty_Internal_Template $_smarty_tpl) {
?> <form action="" autocomplete="off" id="form_aut_dia" method="post" name="form_aut_dia">
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
    <input class="form-control form-control-sm" id="fecha" name="fecha" required="" type="date" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['fecha'])===null||$tmp==='' ? '' : $tmp);?>
">
    </input>
  </div>
  <div class="col-25 center">
     <input class="btn btn-normal"  id="buscar" name="buscar" type="button" value="Buscar">
  </div>
</div>
</form>
<div id="div_listado" ></div>
<?php echo '<script'; ?>
 type="text/javascript">
$( document ).ready(function() { 
    document.getElementById("fecha").value = fncGetToday();
    document.getElementById("fecha").setAttribute("max", fncGetToday());
    link_ajax('/base/<?php echo $_smarty_tpl->tpl_vars['ruta']->value;?>
/listado.php','div_listado','form_aut_dia');
});

  $('#buscar').on('click', function(){  // capture the click         
   link_ajax('/base/<?php echo $_smarty_tpl->tpl_vars['ruta']->value;?>
/listado.php','div_listado','form_aut_dia');
  });
<?php echo '</script'; ?>
>
<?php }
}
