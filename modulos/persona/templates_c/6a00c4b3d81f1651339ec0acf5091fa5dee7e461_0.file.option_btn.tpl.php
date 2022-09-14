<?php
/* Smarty version 3.1.32, created on 2021-04-27 14:13:39
  from 'c:\wamp64\www\confiar\tpl\option_btn.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60881c13c2a070_07383940',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a00c4b3d81f1651339ec0acf5091fa5dee7e461' => 
    array (
      0 => 'c:\\wamp64\\www\\confiar\\tpl\\option_btn.tpl',
      1 => 1619531332,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60881c13c2a070_07383940 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\confiar\\vendor\\smarty\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?><select name="<?php echo $_smarty_tpl->tpl_vars['id_opt_btn']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['id_opt_btn']->value;?>
" class="form-control form-control-sm" <?php echo (($tmp = @$_smarty_tpl->tpl_vars['esrequerido']->value)===null||$tmp==='' ? '' : $tmp);?>
>
    <?php if ((($tmp = @$_smarty_tpl->tpl_vars['primeritem']->value)===null||$tmp==='' ? '' : $tmp) !== "vacio") {?>
    <option value=""><?php echo (($tmp = @$_smarty_tpl->tpl_vars['primeritem']->value)===null||$tmp==='' ? 'Seleccionar' : $tmp);?>
</option>
    <?php }?>
    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['options']->value,'selected'=>(($tmp = @$_smarty_tpl->tpl_vars['datos']->value[$_smarty_tpl->tpl_vars['id_opt_btn']->value])===null||$tmp==='' ? '0' : $tmp)),$_smarty_tpl);?>
    
</select>



  

  
<?php }
}
