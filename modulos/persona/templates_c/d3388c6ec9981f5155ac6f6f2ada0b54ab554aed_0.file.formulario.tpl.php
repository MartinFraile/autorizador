<?php
/* Smarty version 3.1.32, created on 2021-04-27 14:13:39
  from 'C:\wamp64\www\confiar\modulos\persona\formulario.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60881c13940575_78345704',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd3388c6ec9981f5155ac6f6f2ada0b54ab554aed' => 
    array (
      0 => 'C:\\wamp64\\www\\confiar\\modulos\\persona\\formulario.tpl',
      1 => 1619531332,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60881c13940575_78345704 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\confiar\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?><div class="card">
  <div class="card-header">
    <h3 class="card-title">
      <?php echo (($tmp = @$_smarty_tpl->tpl_vars['titulo']->value)===null||$tmp==='' ? '' : $tmp);?>

      <span class="close">
        ×
      </span>
    </h3>
  </div>
  <form action="/persona/modificar" id="form_persona" method="post" name="form_persona">
    <div class="card-body">
      <div id="div_cabecera">
        <div class="row">
          <div class="col-33">
            <label class="col-form-label col-form-label-sm" for="tipo_documento">
              Tipo Documento
            </label>
            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['base']->value)."/tpl/option_btn.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('id_opt_btn'=>"tipo_documento",'datos'=>(($tmp = @$_smarty_tpl->tpl_vars['datos']->value)===null||$tmp==='' ? '1' : $tmp),'esrequerido'=>"required",'options'=>$_smarty_tpl->tpl_vars['tipodoc']->value), 0, true);
?>
          </div>
          <div class="col-33">
            <label class="col-form-label col-form-label-sm" for="nro_documento">Número
            </label>
            <input class="form-control form-control-sm" id="nro_documento" name="nro_documento" required="required" type="text" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['nro_documento'])===null||$tmp==='' ? '' : $tmp);?>
">
            </input>
          </div>
          <div class="col-33">
            <label class="col-form-label col-form-label-sm" for="fecha_nacimiento">
              <?php if ((($tmp = @$_smarty_tpl->tpl_vars['codMaestro']->value)===null||$tmp==='' ? '' : $tmp) == 0) {?> Fecha Nacimiento<?php } else { ?> Fecha de Constitución<?php }?>
            </label>
            <input class="form-control form-control-sm" id="fecha_nacimiento" name="fecha_nacimiento" type="date"
              value="<?php echo (($tmp = @smarty_modifier_date_format($_smarty_tpl->tpl_vars['datos']->value['fecha_nacimiento'],'%Y-%m-%d'))===null||$tmp==='' ? '' : $tmp);?>
">
            </input>
          </div>
        </div>
        <div  class="row">
            <?php if ((($tmp = @$_smarty_tpl->tpl_vars['codMaestro']->value)===null||$tmp==='' ? '' : $tmp) == 0) {?>
            <div class="col-50">
              <label class="col-form-label col-form-label-sm" for="apellido">
                Apellido
              </label>
              <input class="form-control form-control-sm" id="apellido" name="apellido" required="required" type="text"
                value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['apellido'])===null||$tmp==='' ? '' : $tmp);?>
">
              </input>
            </div>
            <div class="col-50">
              <label class="col-form-label col-form-label-sm" for="nombre">
                Nombre
              </label>
              <input class="form-control form-control-sm" id="nombre" name="nombre" type="text" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['nombre'])===null||$tmp==='' ? '' : $tmp);?>
">
              </input>
            </div>
            <?php } else { ?>
            <div class="col-100">
              <label class="col-form-label col-form-label-sm" for="apellido">
                Razons Social
              </label>
              <input class="form-control form-control-sm" id="apellido" name="apellido" required="required" type="text"
                value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['apellido'])===null||$tmp==='' ? '' : $tmp);?>
">
              </input>
            </div>
            <?php }?>         
        </div>
        <div class="row">
          <label class="col-form-label col-form-label-sm" for="email">
            Email
          </label>
          <input class="form-control form-control-sm" id="email" name="email" required="required" type="text"
            value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['email'])===null||$tmp==='' ? '' : $tmp);?>
">
          </input>
        </div>
      </div>
      <div class="tabs">
        <input checked="checked" class="tabs-input" id="tab-1" name="tabs" type="radio"/>
        <label class="tabs-label" for="tab-1">
          Datos Básicos
        </label>
        <div class="tabs-panel">
          <div id="div_items">
            <div class="row">
              <div class="col-33">             
                <input placeholder="Celular" required="required"  class="form-control form-control-sm" id="celular" name="celular" type="number" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['celular'])===null||$tmp==='' ? '' : $tmp);?>
">
                </input>
              </div>              
              <div class="col-33">            
                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['base']->value)."/tpl/option_btn.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('id_opt_btn'=>"cod_localidad",'datos'=>(($tmp = @$_smarty_tpl->tpl_vars['datos']->value)===null||$tmp==='' ? '1' : $tmp),'esrequerido'=>"required",'options'=>$_smarty_tpl->tpl_vars['localidad']->value), 0, true);
?>
                <input id="localidad" name="localidad" type="hidden" value="" />
              </div>
              <div class="col-33">              
                <input placeholder="Direccion" required="required" class="form-control form-control-sm" id="direccion" name="direccion" type="text" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['direccion'])===null||$tmp==='' ? '' : $tmp);?>
"/>               
              </div>
            </div>
            <div class="row">
              <div class="col-50">
                <input class="" id="nrorow" name="nrorow" type="hidden" />
                <input class="" id="tablavalor" name="tablavalor" type="hidden" />
                <input class="btn btn-outline-success" id="additem" name="additem" type="button" value="Agrega" />                  
              </div>
            </div>            
          </div>
          <div class="row" >
            <div id="no-more-tables" >
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer text-center">          
      <input id="cod_persona" name="cod_persona" type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['cod_persona'])===null||$tmp==='' ? '' : $tmp);?>
"/>
      <input id="ruta" name="ruta" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ruta']->value;?>
"/>
      <input id="accion" name="accion" type="hidden" value="guardar"/>
      <input class="btn btn-success" id="guardar" name="guardar" type="button" value="Guardar"/>
      <input class="btn btn-primary cancelar" type="button" value="Cancelar"/>
    </div>
  </form>
</div>
<style>
  #form_persona{
    max-width: 800px;
  }
  #bus_tabla{
    font-size: small;
}
</style>
<?php echo '<script'; ?>
 type="text/javascript">

    var headers = [{
    "label": "celular",
    "name": "celular",
    "opciones": {
        "alias": "celular",
        "nom_campo": "celular"
    }
}, {
    "label": "localidad",
    "name": "localidad",
    "opciones": {
        "alias": "localidad",
        "nom_campo": "localidad",      
    }
},  {
    "label": "direccion",
    "name": "direccion",    
    "opciones": {
        "alias": "direccion",
        "nom_campo": "direccion",         
    }
},{
    "label": "",
    "name": "eliminar",
    "opciones": {
        "clase": "listadosgrilla",
        "funcion": "pEliminar",    
        "class": "text-center",
        "div": "div_principal",       
    }
}, {
    "label": "Row",
    "name": "nrorow",
    "hidden": "hidden",
    "opciones": {
        "alias": "Row",
        "nom_campo": "nrorow"
    }
}, {
    "label": "cod_localidad",
    "name": "cod_localidad",
    "hidden": "hidden",
    "opciones": {
        "alias": "cod_localidad",
        "nom_campo": "cod_localidad"
        }
}, {
    "label": "tipo_documento",
    "name": "tipo_documento",
    "hidden": "hidden",
    "opciones": {
      "alias": "tipo_documento",
      "nom_campo": "tipo_documento"
      }
  }, {
    "label": "nro_documento",
    "name": "nro_documento",
    "hidden": "hidden",
    "opciones": {
      "alias": "nro_documento",
      "nom_campo": "nro_documento"
    }
}];
  $("#no-more-tables").html(cabecera(headers));
if(<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['direcciones'])===null||$tmp==='' ? '0' : $tmp);?>
 !== 0){
  var datos = <?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['direcciones'])===null||$tmp==='' ? '0' : $tmp);?>
;
  var eliminar = "<a class='' data-toggle='tooltip' title='Eliminar' href='#' onclick='eliminarRow($(this));'  ><div class='d-none'></div><img src=\"\/img\/eliminar.svg\"  alt=\"Eliminar\"\r\n            height=\"25px\"  width=\"30px\" \/></a>";

  datos.forEach(singleElement => {
    singleElement['eliminar'] = eliminar;
  });  
  $("#no-more-tables tbody").html(detalle(datos, headers));
}



$('#additem').on('click', function(e) { 
    $("input , select").removeClass('is-invalid');
    var form = document.getElementById('form_persona');
    var isValidForm = form.checkValidity();
    if (isValidForm === false) {
        $("input:invalid,select:invalid").addClass('is-invalid');
        e.stopPropagation();
    } else {
        e.stopPropagation();       
        $("#localidad").val($("#cod_localidad option:selected").text());
        var datos = Array($("#form_persona").serializeFormJSON());
           
        var tableJson = $('#bus_tabla').tableToJSON({
            ignoreHiddenRows: true
        });        
   
        var rowval = datos[0]['nrorow'];
        if (!rowval > 0) {
            datos[0]['nrorow'] = $('#bus_tabla tr').length;
        }
        let eliminar = "<a class='' data-toggle='tooltip' title='Eliminar' href='#' onclick='eliminarRow($(this));'  ><div class='d-none'>" + datos[0]['nrorow'] + "</div><img src=\"\/img\/eliminar.svg\"  alt=\"Eliminar\"\r\n            height=\"25px\"  width=\"30px\" \/></a>";
        datos[0]['eliminar'] = eliminar;
        $("#bus_tabla tbody").append(detalle(datos, headers));
   
        var inputs = $('input, textarea').not(':input[type=button], :input[type=submit], :input[type=reset]');        
        $("#div_items").find(inputs).each(function() {
            $(this).val('');
        });      

        return false;              
       
    }
});


  $('#form_persona #guardar').on('click', function (e) {
    $("input:invalid,select:invalid").removeClass('is-invalid');
    $("#div_items :input").attr('disabled', 'disabled');
    let form = document.getElementById('form_persona');
    var isValidForm = form.checkValidity();

    if (isValidForm === false) {      
      $("input:invalid,select:invalid").addClass('is-invalid');
      $("#div_items :input").attr('disabled', null);
      e.stopPropagation();
      return false;
    } else {
      e.stopPropagation();
    }
   
    var tableJson = $('#form_persona #bus_tabla').tableToJSON();
    if (tableJson.length == 0) {
      $("#div_items :input").attr('disabled', null);
      msgsnackbar("Complete los datos.", "warning");
      return false;
    }
   // $('#guardar').attr("disabled", true);
    $('#form_persona #tablavalor').val(JSON.stringify(tableJson));
    $("#div_items :input").attr('disabled', null);    
    link_ajax('/<?php echo $_smarty_tpl->tpl_vars['ruta']->value;?>
/modificar.php', 'div_principal', 'form_persona', 'si');

  });



<?php echo '</script'; ?>
>
<?php }
}
