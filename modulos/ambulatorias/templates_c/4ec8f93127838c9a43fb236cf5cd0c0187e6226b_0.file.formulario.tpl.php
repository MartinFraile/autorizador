<?php
/* Smarty version 3.1.39, created on 2021-10-08 21:14:38
  from 'C:\wamp\www\pwa\modulos\ambodont\formulario.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6160b4be192721_97377516',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ec8f93127838c9a43fb236cf5cd0c0187e6226b' => 
    array (
      0 => 'C:\\wamp\\www\\pwa\\modulos\\ambodont\\formulario.tpl',
      1 => 1633727670,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6160b4be192721_97377516 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="col-80 col-center">
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
            <form action="" autocomplete="off" id="formulario" method="post" name="formulario">
                <div id="blockdate">
                    <div class="row">
                                        <div class="col-50">
                            <div class="col-25">
                                <label class="col-form-label col-form-label-sm" for="codigo">
                                    Obra Social
                                </label>
                            </div>
                            <div class="col-75">
                                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['base']->value)."/tpl/option_btn.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('primeritem'=>"vacio",'id_opt_btn'=>"cod_obsocconec",'esrequerido'=>"required",'datos'=>(($tmp = @$_smarty_tpl->tpl_vars['datos']->value)===null||$tmp==='' ? '' : $tmp),'options'=>$_smarty_tpl->tpl_vars['obsoc']->value), 0, true);
?>
                                </div>
                        </div>
                        <div  id="div_asociacion" name="div_asociacion">
                            <?php echo (($tmp = @$_smarty_tpl->tpl_vars['asociacion']->value)===null||$tmp==='' ? '' : $tmp);?>

                        </div>
                    </div>
                   
                    <div class="" id="div_efector" name="div_efector">
                        <?php echo (($tmp = @$_smarty_tpl->tpl_vars['efector']->value)===null||$tmp==='' ? '' : $tmp);?>

                        <input id="minstituciones_id" name="minstituciones_id" type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['minstituciones_id'])===null||$tmp==='' ? '' : $tmp);?>
"/>
                        <input id="matriculaefec" name="matriculaefec" type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['matriculaefec'])===null||$tmp==='' ? '' : $tmp);?>
"/>
                    </div>
                    <div class="row">
                
                        <div class="col-15">
                            <label class="col-form-label col-form-label-sm" for="nro_documento">
                                Afiliado
                            </label>
                        </div>
                        <div class="col-85">

                         <input id="cod_obsoc" name="cod_obsoc" type="hidden" value="1"/>
                         </input>

                            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['base']->value)."/tpl/buscador_live.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('id_buscador'=>"nro_documento",'id_desc_buscador'=>"apenom",'bus_script'=>"busafil",'bus_id'=>"nroafil"), 0, true);
?>
                            
                            <input id="cod_plan" name="cod_plan" type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['cod_plan'])===null||$tmp==='' ? '' : $tmp);?>
"/>
                            <input id="tipodoc" name="tipodoc" type="hidden" />
                            <input id="edad" name="edad" type="hidden" />
                      
                        </div>
                                              
                    </div>
                </div>
                <div id="div_items">
                    <div class="row">
                        <div class="col-15">
                            <label class="col-form-label col-form-label-sm" for="codnum">
                                Codigo
                            </label>
                        </div>
                        <div class="col-85">
                            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['base']->value)."/tpl/buscador_live.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('id_buscador'=>"codnum",'id_desc_buscador'=>"descripcion",'bus_script'=>"buspractiodont",'bus_id'=>"cod_practi"), 0, true);
?>

                            <input id="cod_imgp" name="cod_imgp" type="hidden" />
                            <input id="cod_imgg" name="cod_imgg" type="hidden" />
                            <input id="tipotrod" name="tipotrod" type="hidden" />
                            <input id="codsegmento" name="codsegmento" type="hidden" />
                           
                      
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-50" style="padding-right: 0px;">
                            <div class="col-25">
                                <label class="col-form-label col-form-label-sm" for="nropieza">
                                    Pieza
                                </label>
                            </div>
                            <div class="col-75">
                                 <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['base']->value)."/tpl/input_search_solo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('id_buscador'=>"nropieza",'id_desc_buscador'=>"despieza",'bus_script'=>"buspiezaodont",'bus_id'=>"nropieza"), 0, true);
?>
                                  <input id="despieza" name="despieza" type="hidden" />
                            </div>
                        </div>
                        <div class="col-50" >
                            <div class="col-25" >
                                <label class="col-form-label col-form-label-sm " for="codcara">
                                    Cara
                                </label>
                            </div>
                            <div class="col-75">
                                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['base']->value)."/tpl/input_search_solo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('id_buscador'=>"codcara",'id_desc_buscador'=>"descara",'bus_script'=>"buscaraodont",'bus_id'=>"codcara"), 0, true);
?>
                                <input id="descara" name="descara" type="hidden" />
                            </div>
                        </div>                        
                    </div>
                    <div class="row"> 
                        <div class="col-15">
                            <label class="col-form-label col-form-label-sm" for="observacion">
                            Observaciones
                            </label>
                        </div>
                        <div class="col-85">
                            <input class="form-control form-control-sm" id="observaciones" name="observaciones" type="text" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['observaciones'])===null||$tmp==='' ? '' : $tmp);?>
">
                            </input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-100" style="text-align: center;">
                            <input class="" id="nrorow" name="nrorow" type="hidden">
                                <input class="" id="tablavalor" name="tablavalor" type="hidden">
                                    <input class="btn btn-outline-success" id="additem" name="additem" type="button" value="Ingresa"/>
                                    <input class="btn btn-outline-danger" disabled="disabled" id="delitem" name="delitem" type="button" value="Elimina">
                                    </input>
                                </input>
                            </input>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="no-more-tables">
                    </div>
                </div>
                <div class="card-footer text-center">
                    <input id="matricula" name="matricula" type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['matricula']->value)===null||$tmp==='' ? '' : $tmp);?>
"/>
                    <input id="cuitpres" name="cuitpres" type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['cuitpres']->value)===null||$tmp==='' ? '' : $tmp);?>
"/>                    
                    <input id="ruta" name="ruta" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ruta']->value;?>
"/>                    
                    <input id="accion" name="accion" type="hidden" value="guardar"/>
                    <input class="btn btn-success" id="guardar" name="guardar" type="button" value="Guardar">
                        <input class="btn btn-primary" onclick="link_ajax('/base/blanquea.php','div_principal');" type="button" value="Cancelar">
                        </input>
                    </input>
                </div>
            </form>
        </div>
    </div>
</div>
<style type="text/css">
    .is-invalid{
  border-bottom: 1px solid red;
}
.d-none {
    display: none!important; 
}
input[disabled], select[disabled] { cursor: not-allowed!important; }
</style>
<?php echo '<script'; ?>
 type = "text/javascript" >

//$(document).ready(function() {
   // $('#cod_obsocconec').onchange(function() {
       // $('#matricula').val('');
       // $('#nro_documento').val('');
       // $('#codnum').val('');
       // $('#nropieza').val('');
       // $('#cod_cara').val('');
       // $('#observaciones').val('');
  //});
//});


$(document).ready(function() {
    //document.getElementById("fecha").value = fncGetToday();
    //document.getElementById("fecha").setAttribute("max", fncGetToday());
    document.getElementById("codnum").required = true;
      document.getElementById("nro_documento").required = true;  
    var inn_nrodoc = $("#nro_documento");
    if (inn_nrodoc.val() > 0) {
        bus_nro_documento(inn_nrodoc.val());
    }
    var headers = [{
        "label": "Cod_Prac",
        "name": "codnum",
        "opciones": {
            "alias": "cod_prac",
            "nom_campo": "codnum"
        }
    }, {
        "label": "pieza",
        "name": "nropieza",
        "opciones": {
            "alias": "pieza",
            "nom_campo": "nropieza"
        }
    }, {
        "label": "cara",
        "name": "codcara",
        "opciones": {
            "alias": "codcara",
            "nom_campo": "codcara"
        }
    }, {
        "label": "importeprac",
        "name": "importeprac",
        "opciones": {
            "alias": "importeprac",
            "nom_campo": "importeprac"
        }
    }, {
        "label": "coseguro",
        "name": "coseguro",
        "opciones": {
            "alias": "coseguro",
            "nom_campo": "coseguro"
        }
    },  {
        "label": "editar",
        "name": "editar",
        "opciones": {
            "clase": "listadosgrilla",
            "funcion": "pmodificar",
            "campos": {
                "nroafil": {
                    "alias": "nro. afiliado",
                    "nom_campo": "nroafil"
                }
            },
            "class": "text-center",
            "div": "div_principal",
            "script": "modificar"
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
        "label": "Cod_Practi",
        "name": "cod_practi",
        "hidden": "hidden",
        "opciones": {
            "alias": "Cod_Practi",
            "nom_campo": "cod_practi"
        }
    }, {
        "label": "descara",
        "name": "descara",
        "hidden": "hidden",
        "opciones": {
            "alias": "descara",
            "nom_campo": "descara"
        }
    }, {
        "label": "despieza",
        "name": "despieza",
        "hidden": "hidden",
        "opciones": {
            "alias": "despieza",
            "nom_campo": "despieza"
        }
    }, {
        "label": "cod_imgg",
        "name": "cod_imgg",
        "hidden": "hidden",
        "opciones": {
            "alias": "cod_imgg",
            "nom_campo": "cod_imgg"
        }
    }, {
        "label": "cod_imgp",
        "name": "cod_imgp",
        "hidden": "hidden",
        "opciones": {
            "alias": "ccod_imgp",
            "nom_campo": "cod_imgp"
        }
     }, {
        "label": "tipotrod",
        "name": "tipotrod",
        "hidden": "hidden",
        "opciones": {
            "alias": "tipotrod",
            "nom_campo": "tipotrod"
        }
    }, {
        "label": "codsegmento",
        "name": "codsegmento",
        "hidden": "hidden",
        "opciones": {
            "alias": "codsegmento",
            "nom_campo": "codsegmento"
        }
    }, {
        "label": "piezasn",
        "name": "piezasn",
        "hidden": "hidden",
        "opciones": {
            "alias": "piezasn",
            "nom_campo": "piezasn"
        }
        },{
        "label": "carasn",
        "name": "carasn",
        "hidden": "hidden",
        "opciones": {
            "alias": "carasn",
            "nom_campo": "carasn"
            }
        }, {
        "label": "tipodoc",
        "name": "tipodoc",
        "hidden": "hidden",
        "opciones": {
            "alias": "tipodoc",
            "nom_campo": "tipodoc"
        }
    }, {
        "label": "edad",
        "name": "edad",
        "hidden": "hidden",
        "opciones": {
            "alias": "edad",
            "nom_campo": "edad"
        }
    }
    ];
    $("#no-more-tables").html(cabecera(headers));
    $('#additem').on('click', function(e) { // capture the click 
        var datoscodnum = $('#codnum').data('datos');
        var datoscodcara = $('#codcara').data('datos');
       // var descara = datoscodcara.descara;        
        var descripcion = $('#codnum_desc').val();
        var piezasn = datoscodnum.piezasn;
        var carasn = datoscodnum.carasn;
        var txtcarasns = $('#codcara').val();
        var txtpiezasn = $('#nropieza').val();

        if (descripcion.length < 1) {
            $('#codnum').val('');
            msgsnackbar("Practica Invalida", "warning");
        }
        if ($('#bus_tabla tr:not(.d-none)').length > 4) {
            msgsnackbar("Permite hasta 4 items por orden", "warning");
            e.stopPropagation();
            return false;
        }
       
        if (piezasn == 1 && txtpiezasn.length < 1) {
            msgsnackbar("Requiere nro. de pieza", "warning");         
            return false;
         }
        if (carasn == 1 && txtcarasns == 0) {
             msgsnackbar("Requiere cara", "warning");
            return false;
        }


        $("input , select").removeClass('is-invalid');
        var form = document.getElementById('formulario');
        var isValidForm = form.checkValidity();
        if (isValidForm === false) {
            $("input:invalid,select:invalid").addClass('is-invalid');
            e.stopPropagation();
        } else {
            e.stopPropagation();
            $("#blockdate input,select").attr('readonly', 'readonly');
            var datos = Array($("#formulario").serializeFormJSON());
            var tableJson = $('#bus_tabla').tableToJSON({
                ignoreHiddenRows: true
            });
            var $existe = false;            
            sumaCoseguro();
            $.each(tableJson, function(i, item) {
                if (datos[0].codnum == item.Cod_Prac && datos[0].codcara == item.cara && datos[0].nropieza == item.pieza) {
                    msgsnackbar("Practica ya ingresada.", "warning");
                    $existe = true;
                    return false;
                }
                $existe = false;
            });
            
            if ($existe) return false;
            existePrac().then(finalResult => {              
                if (finalResult) {
                     msgsnackbar("Ya existe el consumo.", "warning");
                    return false;
                } else {
                    var rowval = datos[0]['nrorow'];
                    if (!rowval > 0) {
                        datos[0]['nrorow'] = $('#bus_tabla tr').length;
                    }



                    var modif = "<a class='' data-toggle='tooltip' title='Modificar' href='#' onclick='editarRow($(this));'  ><div class='d-none'>" + datos[0]['nrorow'] + "</div><img src=\"\/base\/img\/editar.svg\"  alt=\"Editar\"\r\n            height=\"25px\"  width=\"30px\" \/></a>";
                    datos[0]['editar'] = modif;
                    if (rowval > 0) {
                        var $row = $("tr td:contains('" + rowval + "') ").closest("tr");
                        var $row = $('tr:has(td[id="nrorow"]:contains("' + rowval + '"))');
                        $($row).replaceWith(detalle(datos, headers));
                    } else {
                        $("#bus_tabla tbody").append(detalle(datos, headers));
                    }
                    paginador();
                    var inputs = $('input, textarea, select').not(':input[type=button], :input[type=submit], :input[type=reset]');
                    $("#div_items").find(inputs).each(function() {
                        $(this).val('');
                    });
                    //   var tableJson = $('#bus_tabla').tableToJSON(); // Convert the 
                    //console.log(tableJson);
                    $("#delitem").prop('disabled', true);
                    $("#additem").prop('value', 'Ingresa');
                    $("#codnum").focus();
                    return false;
                }
            }).catch(error => console.log("Error en existeItem"));
        }
    });
});
$('#guardar').on('click', function() { // capture the click    
    if ($('#fecha').val() > fncGetToday()) {
        msgsnackbar("La fecha no puede ser mayor al día de hoy.", "warning");
        return false;
    }
    var tableJson = $('#bus_tabla').tableToJSON();
    if (tableJson.length == 0) {
        msgsnackbar("Complete los datos.", "warning");
        return false;
    }
    $('#guardar').attr("disabled", true);   
    var datos = $('#nro_documento').data('datos');
    $('#cod_plan').val(datos.cod_plan);
    $('#tipoing').val(datos.tipoing);
    var tableJson = $('#bus_tabla').tableToJSON(); // Convert the 
    //    console.log(JSON.stringify(tableJson));
    $('#tablavalor').val(JSON.stringify(tableJson));

    link_ajax('/base/<?php echo $_smarty_tpl->tpl_vars['ruta']->value;?>
/modificar.php', 'div_principal', 'formulario', 'si');
});
$('#delitem').on('click', function() { // capture the click    
    var rowval = $('#nrorow').val();
    var $row = $('tr:has(td[id="nrorow"]:contains("' + rowval + '"))');
    $row.removeClass('table-warning').addClass('d-none');
    $("#delitem").prop('disabled', true);
    $("#additem").prop('value', 'Ingresa');
    $("#div_items").find(':input').not(':input[type=button], :input[type=submit], :input[type=reset]').each(function() {
        $(this).val('');
        $(this).addClass("ignore");
    });
    paginador();
});
$('input, textarea, select').not(':input[type=button], :input[type=submit], :input[type=reset]').keydown(function(e) {
    var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
    if (key == 13) {
        e.preventDefault();
        var inputs = $(this).closest('form').find(':input:visible:not([readonly="readonly"])');
        inputs.eq(inputs.index(this) + 1).focus();
    }
});
$('#cod_region').on('change', function() {
    var cod_region = $(this).val();
    var dataString = "cod_region=" + cod_region; /* STORE THAT TO A DATA STRING */
    link_ajax('/base/<?php echo $_smarty_tpl->tpl_vars['ruta']->value;?>
/get_obsoc.php?' + dataString + '', 'div_obsoc', 'formulario');
});

$('#matricula').on('encontrado', function() { 
    var datos = $('#matricula').data('datos');
    
      $('#minstituciones_id').val(datos['minstituciones_id']);
      $('#matriculaefec').val(datos['matricula']);
});

$('#nro_documento').on('encontrado', function() { 
    var datos = $('#nro_documento').data('datos');
    
      $('#cod_plan').val(datos['cod_plan']);
      $('#tipodoc').val(datos['tipodoc']);
      $('#edad').val(datos['edad']);

    var values  = $('#formulario').serialize() ; 
    var param = window.btoa(values); 
    var ajaxurl ='/base/<?php echo $_smarty_tpl->tpl_vars['ruta']->value;?>
/controlPlanAsoc.php?param='+ param +'' ;
    $.ajax({
        url: ajaxurl,            
        success: function (data) {                               
             var data = $.parseJSON(data);   
   
                if (data.existe < 1) {
                 msgsnackbar("No admite plan del beneficiario.", "warning");
                 $('#nro_documento').limpiar();
            }
        }
    });

});

$('#codnum').on('encontrado', function() {     
    var datos = $('#codnum').data('datos');
    $('#cod_imgp').val(datos['cod_imgp']);
    $('#cod_imgg').val(datos['cod_imgg']);
    $('#tipotrod').val(datos['tipotrod']);
    $('#codsegmento').val(datos['codsegmento']);
    $('#piezasn').val(datos['piezasn']);
    $('#carasn').val(datos['carasn']);

});
$('#codcara').on('encontrado', function() {      
    var datos = $('#codcara').data('datos');
    $('#descara').val(datos['descara']);
});
$('#nropieza').on('encontrado', function() {   
    var datos = $('#nropieza').data('datos');   
    $('#despieza').val(datos['despieza']);
});


function existePrac() {

 return new Promise(function (resolve, reject) {
        var ajaxurl = '/base/<?php echo $_smarty_tpl->tpl_vars['ruta']->value;?>
/existePrac.php';
        var postData = $("#formulario").serialize();
        $.ajax({
            url: ajaxurl,
            data: postData,
            success: function (data) {
                var session = $.parseJSON(data);                

                if (session.existe >= 1) {                     
                    resolve(true);
                } else {
                    resolve(false);
                }
            }
        });
    });
}



function sumaCoseguro() {
    var tableJson = $('#bus_tabla').tableToJSON(); // Convert the 
    //    console.log(JSON.stringify(tableJson));
    $('#tablavalor').val(JSON.stringify(tableJson));
 return new Promise(function (resolve, reject) {
        var ajaxurl = '/base/<?php echo $_smarty_tpl->tpl_vars['ruta']->value;?>
/sumaCoseguro.php';

        var postData = $("#formulario").serialize();
        $.ajax({
            url: ajaxurl,
            data: postData,
            success: function (data) {
                var session = $.parseJSON(data);                
                if (session.existe >= 1) {
                    resolve(true);
                } else {
                    resolve(false);
                }
            }
        });
    });
}


 <?php echo '</script'; ?>
>
<?php }
}
