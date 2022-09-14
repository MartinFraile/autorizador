<?php
/* Smarty version 3.1.39, created on 2022-09-12 19:29:21
  from 'c:\wamp64\www\autorizador\tpl\home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_631f88912ed2a7_90889082',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ed0fd7cbbbc4bd48905b325e7d76493b68fc5f1' => 
    array (
      0 => 'c:\\wamp64\\www\\autorizador\\tpl\\home.tpl',
      1 => 1616164727,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./bottom_nav_afil.tpl' => 1,
  ),
),false)) {
function content_631f88912ed2a7_90889082 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<style type="text/css">
    .big-btn{
 	display: block;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
	background: #ccc;
	width: 75%;
	margin: auto;
	margin-bottom: 10px;
	padding-bottom: 15px;
	text-decoration: none;
 	color: black; 
 	text-transform: uppercase;
 }
</style>
<?php
$__section_item_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['datos']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_item_0_total = $__section_item_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_item'] = new Smarty_Variable(array());
if ($__section_item_0_total !== 0) {
for ($__section_item_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index'] = 0; $__section_item_0_iteration <= $__section_item_0_total; $__section_item_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index']++){
?>
<a class="big-btn" href="<?php echo $_smarty_tpl->tpl_vars['datos']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index'] : null)]['script'];?>
">
    <br/>
    <?php echo $_smarty_tpl->tpl_vars['datos']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index'] : null)]['descripcion'];?>

</a>
<?php
}
}
?>

<?php $_smarty_tpl->_subTemplateRender("file:./bottom_nav_afil.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
echo '<script'; ?>
 type="text/javascript">
	var navItems = $("#<?php echo (($tmp = @$_smarty_tpl->tpl_vars['active']->value)===null||$tmp==='' ? "Home" : $tmp);?>
");
	navItems.addClass("mobile-bottom-nav__item--active");
<?php echo '</script'; ?>
><?php }
}
