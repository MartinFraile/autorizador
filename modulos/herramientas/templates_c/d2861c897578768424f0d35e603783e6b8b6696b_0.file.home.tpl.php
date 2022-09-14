<?php
/* Smarty version 3.1.44, created on 2022-06-29 17:46:53
  from 'c:\wamp64\www\comercial\tpl\home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_62bc900d48c3b3_29094147',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd2861c897578768424f0d35e603783e6b8b6696b' => 
    array (
      0 => 'c:\\wamp64\\www\\comercial\\tpl\\home.tpl',
      1 => 1656524811,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./bottom_nav_afil.tpl' => 1,
  ),
),false)) {
function content_62bc900d48c3b3_29094147 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<style type="text/css">
    .big-btn{
 	display: block;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
	background: #002d5b21;
	width: 50%;
	margin: auto;
	margin-bottom: 10px;
	padding-bottom: 15px;
	text-decoration: none;
 	color: black; 
 	text-transform: uppercase;
 } 
 .big-btn:hover{
	background: #002d5b52;
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
