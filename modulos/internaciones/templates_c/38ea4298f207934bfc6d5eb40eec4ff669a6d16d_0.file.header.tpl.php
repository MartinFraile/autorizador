<?php
/* Smarty version 3.1.39, created on 2021-08-26 20:06:54
  from 'c:\wamp\www\pwa\tpl\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6127f45e1af7c4_67142703',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '38ea4298f207934bfc6d5eb40eec4ff669a6d16d' => 
    array (
      0 => 'c:\\wamp\\www\\pwa\\tpl\\header.tpl',
      1 => 1630006490,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6127f45e1af7c4_67142703 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
  <head>
    <meta content="width=device-width, user-scalable=no" name="viewport"/>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <link href="/base/styles.css?version=1.1" rel="stylesheet"/>
    <?php echo '<script'; ?>
 src="/base/js/jquery-3.3.1.min.js" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/base/js/funciones.js?version=1.2" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/base/js/tablas.js" type="text/javascript"><?php echo '</script'; ?>
>

  </head>

<style type="text/css">
 body{        
    padding-top: 59px;       
}
.wrapper-container{
	padding-bottom: 55px;
	 padding-top: 10px;  
}
.fixed-header{
    width: 100%;
    position: fixed;        
    background:var(--primary-light-color);
    padding: 20px 0;
    color: #fff;
    z-index: 1000;
    top: 0;
}

.header-container img{
	max-height: 25px;
	margin-left: 15px;
}
   
</style>
    <div class="fixed-header">
        <div class="header-container">
            <img src="/base/img/logo_<?php echo (($tmp = @$_smarty_tpl->tpl_vars['cod_obsoc']->value)===null||$tmp==='' ? '' : $tmp);?>
.png"  alt="" >
        </div>
    </div>

     <div class="wrapper-container"><?php }
}
