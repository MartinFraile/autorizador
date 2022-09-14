<?php
/* Smarty version 3.1.39, created on 2021-09-27 19:04:22
  from 'c:\wamp\www\pwa\tpl\option_btn.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_615215b6bf1828_49558511',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a7400faa0b984ad00763795b718aeb4363240b5' => 
    array (
      0 => 'c:\\wamp\\www\\pwa\\tpl\\option_btn.tpl',
      1 => 1622137446,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_615215b6bf1828_49558511 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp\\www\\pwa\\vendor\\smarty\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<select name="<?php echo $_smarty_tpl->tpl_vars['id_opt_btn']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['id_opt_btn']->value;?>
" class="form-control form-control-sm" <?php echo (($tmp = @$_smarty_tpl->tpl_vars['esrequerido']->value)===null||$tmp==='' ? '' : $tmp);?>
>
    <?php if ((($tmp = @$_smarty_tpl->tpl_vars['primeritem']->value)===null||$tmp==='' ? '' : $tmp) <> "vacio") {?>
    <option value=""><?php echo (($tmp = @$_smarty_tpl->tpl_vars['primeritem']->value)===null||$tmp==='' ? 'Seleccionar' : $tmp);?>
</option>
    <?php }?>
    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['options']->value,'selected'=>(($tmp = @$_smarty_tpl->tpl_vars['datos']->value[$_smarty_tpl->tpl_vars['id_opt_btn']->value])===null||$tmp==='' ? '0' : $tmp)),$_smarty_tpl);?>

</select>

  


  
<?php }
}
