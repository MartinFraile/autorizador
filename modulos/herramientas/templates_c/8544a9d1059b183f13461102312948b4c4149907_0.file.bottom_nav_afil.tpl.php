<?php
/* Smarty version 3.1.44, created on 2022-06-22 15:43:59
  from 'c:\wamp64\www\comercial\tpl\bottom_nav_afil.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_62b338bf4333a6_67433858',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8544a9d1059b183f13461102312948b4c4149907' => 
    array (
      0 => 'c:\\wamp64\\www\\comercial\\tpl\\bottom_nav_afil.tpl',
      1 => 1654711969,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62b338bf4333a6_67433858 (Smarty_Internal_Template $_smarty_tpl) {
?><style type="text/css">
body {	 
	 padding-bottom: 50px;
}

.mobile-bottom-nav a{
    text-decoration: none;
    text-transform: uppercase;
    color: #555;

}
 .mobile-bottom-nav {

	 position: fixed;
	 bottom: 0;
	 left: 0;
	 right: 0;
	 z-index: 1000;
	 will-change: transform;
	 transform: translateZ(0);
	 display: flex;
	 height: 50px;
	 box-shadow: 0 -2px 5px -2px #333;
	 background-color: #fff;
}
 .mobile-bottom-nav__item {
 	flex: 1 1 0px;
	 flex-grow: 1;
	 text-align: center;
	 font-size: 12px;
	 display: flex;
	 flex-direction: column;
	 justify-content: center;
     background:  white;
}
 .mobile-bottom-nav__item--active  {
     background:  var(--primary-light-color);
}
 .mobile-bottom-nav__item--active a {
	 color: white;
}
 .mobile-bottom-nav__item--active svg {
	 fill: white;
}
 .mobile-bottom-nav__item-content {
	 display: flex;
	 flex-direction: column;
}
a>svg{
    width: 25px;
	margin: auto;   
	margin-bottom: 5px; 
	margin-top: 5px; 
	fill: #555;

}
 .mobile-bottom-nav__item--active>svg{   
	fill: var(--primary-light-color);

}
</style>
 </div> 
<nav class="mobile-bottom-nav">
    <?php
$__section_item_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['menu']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_item_1_total = $__section_item_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_item'] = new Smarty_Variable(array());
if ($__section_item_1_total !== 0) {
for ($__section_item_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index'] = 0; $__section_item_1_iteration <= $__section_item_1_total; $__section_item_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index']++){
?>       
    
        <div class="mobile-bottom-nav__item" id="<?php echo $_smarty_tpl->tpl_vars['menu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index'] : null)]['descripcion'];?>
">
            <div class="mobile-bottom-nav__item-content">
                <a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index'] : null)]['script'];?>
">
                     <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['base']->value)."/img/".((string)$_smarty_tpl->tpl_vars['menu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index'] : null)]['icono']).".svg", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>               

                    <br/>
                    <?php echo $_smarty_tpl->tpl_vars['menu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index'] : null)]['descripcion'];?>

                </a>
            </div>
        </div> 

    <?php
}
}
?>
</nav>
<?php }
}
