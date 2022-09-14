<?php
/* Smarty version 3.1.39, created on 2021-10-08 14:46:54
  from 'C:\wamp\www\pwa\modulos\ambodont\asociacion.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_616059de8ef1e9_62271639',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4289bc957d46e1c11d6b2446bad5d1b7618c2fe2' => 
    array (
      0 => 'C:\\wamp\\www\\pwa\\modulos\\ambodont\\asociacion.tpl',
      1 => 1633704277,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_616059de8ef1e9_62271639 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="col-50">
  <div class="col-25">
      <label class="col-form-label col-form-label-sm" for="cod_prestador">
          Asociación
      </label>
  </div>
  <div class="col-75">
      <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['base']->value)."/tpl/option_btn.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('primeritem'=>"vacio",'id_opt_btn'=>"cod_prestador",'esrequerido'=>"required",'datos'=>(($tmp = @$_smarty_tpl->tpl_vars['datos']->value)===null||$tmp==='' ? '' : $tmp),'options'=>$_smarty_tpl->tpl_vars['asociaciones']->value), 0, true);
?>
  </div>
</div><?php }
}
