<?php
/* Smarty version 3.1.39, created on 2021-09-27 19:54:41
  from 'C:\wamp\www\pwa\modulos\ambodont\form_list_aut.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61522181f2b7b2_55081615',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '99f7c2cb3cf1d46a070e5504733ce828f3afc716' => 
    array (
      0 => 'C:\\wamp\\www\\pwa\\modulos\\ambodont\\form_list_aut.tpl',
      1 => 1622137445,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61522181f2b7b2_55081615 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="col-50 col-center">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">
        <?php echo (($tmp = @$_smarty_tpl->tpl_vars['titulo']->value)===null||$tmp==='' ? '' : $tmp);?>

        <span class="close">
          ×
        </span>
      </h3>
    </div>
    <div class="card-body">
      <form action="" autocomplete="off" id="form_list_aut" method="post" name="form_list_aut">

        <div class="row">            
            <div class="col-100">
              <div class="col-25">
                <label class="col-form-label col-form-label-sm" for="periodo">
                  Periodo
                </label>
              </div>
              <div class="col-75">
                 <input class="form-control form-control-sm"  pattern="[0-9]{4}-[0-9]{2}"  id="periodo" name="periodo" type="month" min="2010-01" placeholder="aaaa-mm" value=""> 
                  </input>
              </div>
            </div>
          </div>
       
          <div class="row">            
            <div class="col-100">
              <div class="col-25">
                <label class="col-form-label col-form-label-sm" for="cod_prestador">
                  Asociación
                </label>
              </div>
             <div class="col-75">
                  <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['base']->value)."/tpl/option_btn.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('primeritem'=>"vacio",'id_opt_btn'=>"cod_prestador",'esrequerido'=>"required",'datos'=>(($tmp = @$_smarty_tpl->tpl_vars['datos']->value)===null||$tmp==='' ? '' : $tmp),'options'=>$_smarty_tpl->tpl_vars['asociaciones']->value), 0, true);
?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-100" style="padding-right: 0px;">
                <div class="col-25">
                  <label class="col-form-label col-form-label-sm" for="orden">
                    Corte
                  </label>
                </div>
                <div class="col-75">
                    <input type="radio" name="corte"
                    value="ApeyNom" checked> Afiliados
                    <input type="radio" name="corte"
                    value="DesObSoc" > Ob. Social
                     <input type="radio" name="corte"
                    value="DesPres" > Practica
                </div>
              </div>
          </div>
          
        
        
        <div class="card-footer text-center">
          
          <input id="ruta" name="ruta" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ruta']->value;?>
"/>
          <input id="accion" name="accion" type="hidden" value=""/>
          <input class="btn btn-success" id="imprimir" name="imprimir" type="button" value="Imprimir">
            <input class="btn btn-primary" onclick="link_ajax('/base/blanquea.php','div_principal');" type="button" value="Cancelar">
            </input>
          </input>
        </div>
      </form>
    </div>
  </div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
   $( document ).ready(function() {    
      $('#form_list_aut #periodo').attr('required','required'); 
 });
   
 
  $('#form_list_aut #imprimir').on('click', function(e){  // capture the click  

     $("input , select").removeClass('is-invalid');              
      var form = document.getElementById('form_list_aut');
      var isValidForm = form.checkValidity();
     
     if (isValidForm === false) { 
      
      $("input:invalid,select:invalid").addClass('is-invalid');
      e.stopPropagation();
      return false;
    }else{
      e.stopPropagation();  
    
    }
    $("#accion").val("imprimir");
    $("#desobrasoc").val( $("#cod_obsoc option:selected").text());
   
    link_ajax('/base/<?php echo $_smarty_tpl->tpl_vars['ruta']->value;?>
/imprimir.php','div_principal','form_list_aut', 'si');
    
  });
<?php echo '</script'; ?>
>
<?php }
}
