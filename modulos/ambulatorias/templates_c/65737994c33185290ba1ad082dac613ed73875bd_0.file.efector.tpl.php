<?php
/* Smarty version 3.1.39, created on 2021-10-08 18:54:46
  from 'C:\wamp\www\pwa\modulos\ambodont\efector.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_616093f679a563_85133867',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '65737994c33185290ba1ad082dac613ed73875bd' => 
    array (
      0 => 'C:\\wamp\\www\\pwa\\modulos\\ambodont\\efector.tpl',
      1 => 1633719055,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_616093f679a563_85133867 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row" >
    <div class="col-15">
      <label class="col-form-label col-form-label-sm" for="cod_efector">
        Efector
      </label>
    </div>
    <div class="col-85">
      <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['base']->value)."/tpl/buscador_live.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('id_buscador'=>"matricula",'id_desc_buscador'=>"apellidos",'bus_script'=>"busefectorodon",'bus_id'=>"mmedicos_id"), 0, true);
?>
    </div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
  $( document ).ready(function() {  
     document.getElementById("matricula").required = true;  
 }); 

 <?php echo '</script'; ?>
><?php }
}
