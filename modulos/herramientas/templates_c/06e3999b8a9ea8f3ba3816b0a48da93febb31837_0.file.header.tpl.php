<?php
/* Smarty version 3.1.44, created on 2022-06-29 17:43:02
  from 'c:\wamp64\www\comercial\tpl\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_62bc8f26e23b31_81905821',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '06e3999b8a9ea8f3ba3816b0a48da93febb31837' => 
    array (
      0 => 'c:\\wamp64\\www\\comercial\\tpl\\header.tpl',
      1 => 1656524578,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62bc8f26e23b31_81905821 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
  <head>
    <meta content="width=device-width, user-scalable=no" name="viewport"/>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <link href="/css/styles.css?version=1.1" rel="stylesheet"/>
    <?php echo '<script'; ?>
 src="/js/jquery-3.3.1.min.js" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/js/funciones.js" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/js/tablas.js" type="text/javascript"><?php echo '</script'; ?>
>
    <title>Gestión y Control de Stock</title>
  </head>

<style type="text/css">
 body{        
    padding-top: 59px;       
}
.wrapper-container{
	
     margin-top: 15px;
    padding: 10px 25px 55px 25px
}
.fixed-header{
    width: 100%;
    position: fixed;        
    background:#fff;
    padding: 5px 0;
    color: #555;
    z-index: 1000;
    top: 0;
     display: flex;
    justify-content: space-between ;
       
}
.header-container{
     display:flex;
}

.header-container img{
	max-height: 45px;	
    margin: auto 0 auto 15px;
}
.header-container a>svg{
    height:  25px;
    margin: 13px 0px 0px 10px; 
    fill: #555;

}

   
</style>


    <div class="fixed-header">
        <div class="header-container">
            <a href="#"  class="cancelar" id="backbtn"><?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['base']->value)."/img/backbtn.svg", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></a>
        </div>
        <div style="max-width: 1280px;margin-left: 50px;">
            <img src="/img/logo_3.png" style="max-height: 45px;"  alt="RAS" >
        </div>
        <div style="max-height: 45px; margin: auto 15px auto 15px;">
            <?php echo (($tmp = @mb_strtoupper($_smarty_tpl->tpl_vars['nomusuario']->value, 'UTF-8'))===null||$tmp==='' ? '' : $tmp);?>

        </div>      
    </div>


     <div class="wrapper-container" id="div_principal">
<?php echo (($tmp = @$_smarty_tpl->tpl_vars['msg']->value)===null||$tmp==='' ? '' : $tmp);?>
        

<?php }
}
