<!-- <script defer="" src="/base/js/draganddrop.js"></script> -->
<style type="text/css">
  /* drag and drop */
#drop_file_zone {
    background-color: #EEE;
    border: #999 1px dashed;
    width: 100%;
    padding: 8px;
    font-size: 14px;
}
#drag_upload_file {
  width:100%;
  margin:0 auto;  
  text-align: center;
}
#drag_upload_file>a{
  text-decoration: none;
}

.img-wrap>img{
  padding: 5px;
  height: 100px;
  width: auto;
}
.img-wrap {
  padding: 5px;
  position: relative;
  display: inline-block;
  font-size: 0;
}
.img-wrap .closeImg {
  position: absolute;
  top: 5px;
  right: 5px;
  z-index: 100;
  background-color: #FFF;
  padding: 3px;
  color: red;
  font-weight: bold;
  cursor: pointer;
  opacity: .2;
  text-align: center;
  font-size: 28px;
  line-height: 14px;
  border-radius: 50%;
}
.img-wrap:hover .closeImg {
  opacity: 1;
}
.msjprac{
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeeba;
}
</style>
<div class="col-80 col-center">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {$titulo|default}
                <span class="close">
                    ×
                </span>
            </h3>
        </div>
        <div class="card-body">
            <form action="" autocomplete="off" id="formulario" method="post" name="formulario">
                <div id="blockdate">
                    <div class="row">
                {*         <div class="col-33">
                            <div class="col-50">
                                <label class="col-form-label col-form-label-sm" for="fecha">
                                    Fecha
                                </label>
                            </div>
                            <div class="col-50">
                                <input class="form-control form-control-sm" id="fecha" name="fecha" required="" type="date" value="{$datos.fecha|default}">
                                </input>
                            </div>
                        </div> *}
                        <div class="col-50">
                            <div class="col-25">
                                <label class="col-form-label col-form-label-sm" for="codigo">
                                    Obra Social
                                </label>
                            </div>
                            <div class="col-75">
                                {include file="$base/tpl/option_btn.tpl"  id_opt_btn="cod_obsocconec" esrequerido="required" datos=$datos|default options=$obsoc}
                                </div>
                        </div>

                        <div  id="div_asociacion" name="div_asociacion">
                            {$asociacion|default}
                        </div>

                    </div>
                   
                    <div class="" id="div_efector" name="div_efector">
                        {$efector|default}
                        <input id="minstituciones_id" name="minstituciones_id" type="hidden" value="{$datos.minstituciones_id|default}"/>
                        <input id="matriculaefec" name="matriculaefec" type="hidden" value="{$datos.matriculaefec|default}"/>

                        <input id="asossn" name="asossn" type="hidden" value="S"/>

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

                            {include file="$base/tpl/buscador_live.tpl" id_buscador="nro_documento" id_desc_buscador="apenom" bus_script="busafil" bus_id="nroafil"   }
                            
                            <input id="cod_plan" name="cod_plan" type="hidden" value="{$datos.cod_plan|default}"/>
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
                            {include file="$base/tpl/buscador_live.tpl" id_buscador="codnum" id_desc_buscador="descripcion" bus_script="buspractiodont" bus_id="cod_practi"    }

                            <input id="cod_imgp" name="cod_imgp" type="hidden" />
                            <input id="cod_imgg" name="cod_imgg" type="hidden" />
                            <input id="tipotrod" name="tipotrod" type="hidden" />
                            <input id="codsegmento" name="codsegmento" type="hidden" />
                            <input id="coseguro" name="coseguro" type="hidden" />
                            <input id="importeprac" name="importeprac" type="hidden" />
                            
                                                  
                        </div>
                    </div>
                    <div class="row" id="div_msjprac" hidden>
                        <div class="col msjprac" >
                            <label class="col-form-label col-form-label-sm" for="" id="msjprac">                                    
                            </label>         
                        </div>
                    </div>
                    
                    <div class="row">                        
                        <div  id="piezasnok" class="col-50" style="padding-right: 0px" hidden>
                            <div class="col-25">
                                <label class="col-form-label col-form-label-sm" for="nropieza">
                                    Pieza
                                </label>
                            </div>
                            <div class="col-75">
                                 {include file="$base/tpl/input_search_solo.tpl" id_buscador="nropieza" id_desc_buscador="despieza" bus_script="buspiezaodont" bus_id="despieza"   }
                                  
                            </div>
                        </div>
                        <div id="carasnok" class="col-50" hidden>
                            <div class="col-50" >
                                <label class="col-form-label col-form-label-sm " for="codcara">
                                    Cara o combinaciones
                                </label>
                            </div>
                            <div class="col-50">
                                {include file="$base/tpl/input_search_solo.tpl" id_buscador="codcara" id_desc_buscador="descara" bus_script="buscaraodont" bus_id="descara"   }
                                <input id="ttipocara_id" name="ttipocara_id" type="hidden" />
                            </div>
                        </div>                        
                    </div>
                    <div class="row"> 
                        <div class="col-15">
                            <label class="col-form-label col-form-label-sm" for="observaciones">
                            Observ.
                            </label>
                        </div>
                        <div class="col-85">
                            <input class="form-control form-control-sm" id="observaciones" name="observaciones" type="text" >
                            </input>
                        </div>
                    </div>
                    <div class="row" id="div_adjunto" hidden>
                        <div class="col-100">
                            <div id="drop_file_zone" >
                                <div id="drag_upload_file">
                                    <p>Arrastre su archivo aquí (*.jpg .jpeg .png .pdf)</p>
                                    <p>o</p>
                                    <input type="file" id="file" name="file[]" multiple accept="image/*,.pdf,.word,.txt" style="display:none" onchange="showThumbnail(this.files)">
                                    <a class="btn btn-primary" href="javascript:doClick()">Seleccione algunos archivos</a>
                                </div>
                            </div>
                            <div class="row" id="div_errores" name="div_errores">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-100" style="text-align: center;">
                            <input class="" id="nrorow" name="nrorow" type="hidden"/>
                            <input class="" id="tablavalor" name="tablavalor" type="hidden"/>
                            <input class="btn btn-outline-success" id="additem" name="additem" type="button" value="Ingresa"/>
                            <input class="btn btn-outline-danger" disabled="disabled" id="delitem" name="delitem" type="button" value="Elimina"/>      
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="no-more-tables">
                    </div>
                </div>
                <div class="card-footer text-center">
                    <input id="matricula" name="matricula" type="hidden" value="{$matricula|default}"/>
                    <input id="cuitpres" name="cuitpres" type="hidden" value="{$cuitpres|default}"/>                    
                    <input id="ruta" name="ruta" type="hidden" value="{$ruta}"/>                    
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
<script type = "text/javascript" >




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
    },{
        "label": "ttipocara_id",
        "name": "ttipocara_id",
        "hidden": "hidden",
        "opciones": {
            "alias": "ttipocara_id",
            "nom_campo": "ttipocara_id"
        }
    },{
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
    }, {
        "label": "observaciones",
        "name": "observaciones",
        "hidden": "hidden",
        "opciones": {
            "alias": "observaciones",
            "nom_campo": "observaciones"
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
        var nropieza = $('#nropieza').val();
        var codcara = $('#codcara').val();
        
       // var txtcarasns = $('#codcara').val();
       // var txtpiezasn = $('#nropieza').val();

        if (descripcion.length < 1) {
            $('#codnum').val('');
            msgsnackbar("Practica Invalida", "warning");
        }
        if ($('#bus_tabla tr:not(.d-none, .table-warning)').length > 4) {
            msgsnackbar("Permite hasta 4 items por orden", "warning");
            e.stopPropagation();
            return false;
        }
       
        /*if (piezasn == 1 && txtpiezasn.length < 1) {
            msgsnackbar("Requiere nro. de pieza", "warning");         
            return false;
         }
        if (carasn == 1 && txtcarasns == 0) {
             msgsnackbar("Requiere cara", "warning");
            return false;
        }*/

        if (piezasn == 1 &&  nropieza.length < 1) {
            msgsnackbar("Requiere nro. de pieza", "warning");         
            return false;
         }
        if (carasn == 1 && codcara.length < 1) {
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

            validaIng().then(respuesta => {     
                 if(respuesta.nivelaudi == 99 ){
                    msgsnackbar(respuesta.mensaje, "warning");
                    return false;
                }  
                $('#importeprac').val(respuesta.importeorig);
                $('#coseguro').val(respuesta.coseguro);
                if(respuesta.estado > 5){
                    msgsnackbar("Requiere auditoría", "warning");
                }       

                $("#blockdate input,select").attr('readonly', 'readonly');
                var datos = Array($("#formulario").serializeFormJSON());
                var tableJson = $('#bus_tabla').tableToJSON({
                    ignoreHiddenRows: true
                });
                 
                var $existe = false;            
                sumaCoseguro();
                $.each(tableJson, function(i, item) {
                    
                    if (datos[0].codnum == item.Cod_Prac && datos[0].codcara == item.cara && datos[0].nropieza == item.pieza && datos[0].Row != item.nrorow) {
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
                        var tableJson = $('#bus_tabla').tableToJSON();
                    
                        $("#delitem").prop('disabled', true);
                        $("#additem").prop('value', 'Ingresa');
                        $("#codnum").focus();
                        limpiarmsj();
                        return false;
                    }
                }).catch(error => console.log("Error en existeItem"));
            }).catch(error => console.log("Error en Validacion"));
        }
    });
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
    link_ajax('/base/{$ruta}/get_obsoc.php?' + dataString + '', 'div_obsoc', 'formulario');
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
    var ajaxurl ='/base/{$ruta}/controlPlanAsoc.php?param='+ param +'' ;
    $.ajax({
        url: ajaxurl,            
        success: function (data) {                               
             var data = $.parseJSON(data);   
   
                if (data.existe < 1) {
                 msgsnackbar("No admite plan del beneficiario: "+$('#nro_documento_desc').val(), "warning");
                  $('#nro_documento').trigger('limpiar');
                /* $('#nro_documento').val('');
                 $('#nro_documento_desc').val('');
                 $('#nro_documento').focus();*/
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
    
    let msjprac = datos['mjeprac'];
    if(msjprac.length > 0 ){
        $("#msjprac").text(msjprac);
        $("#div_msjprac").show('slow');
    }else{
        limpiarmsj();
    }

    let muestrapieza = datos['piezasn'];    
    if(muestrapieza > 0 ){
        $("#piezasnok").show('slow');
        $("#piezasnok").focus();
    }else{
        $('#piezasnok').hide();
        $('#carasnok').hide();
    }
    
    let muestracara = datos['carasn'];    
    if(muestracara > 0 ){
        $("#carasnok").show('slow');
    }else{        
        $('#carasnok').hide();
    }

    let muestraadjunto = datos['codnum'];    
    if(muestraadjunto == 801 || muestraadjunto == 1009 || muestraadjunto == 601 || muestraadjunto == 603
    || muestraadjunto == 605 || muestraadjunto == 606 || muestraadjunto == 612 || muestraadjunto == 613 
    || muestraadjunto == 614){
        $("#div_adjunto").show('slow');
    }else{        
        $('#div_adjunto').hide();
    }

});

$('#codcara').on('encontrado', function() { 
    var datos = $('#codcara').data('datos');
    $('#descara').val(datos['descara']);
    $('#ttipocara_id').val(datos['ttipocara_id']);
   
});
$('#nropieza').on('encontrado', function() {   
    var datos = $('#nropieza').data('datos');   
    $('#despieza').val(datos['despieza']);
});
function limpiarmsj() {     
    $("#msjprac").text('');
    $('#div_msjprac').hide();
};


$('#cod_obsocconec').on('change', function() {   
    $('#matricula').trigger('limpiar');
    $('#nro_documento').trigger('limpiar');
    $('#codnum').trigger('limpiar');
     link_ajax("/base/{$ruta}/carga_asoc.php", 'div_asociacion', 'formulario');
});



function existePrac() {

 return new Promise(function (resolve, reject) {
        var ajaxurl = '/base/{$ruta}/existePrac.php';
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
        var ajaxurl = '/base/{$ruta}/sumaCoseguro.php';

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

function validaIng() {

 return new Promise(function (resolve, reject) {
        var ajaxurl = '/base/{$ruta}/valida_ingresa.php';
        var postData = $("#formulario").serialize();
        $.ajax({
            url: ajaxurl,
            data: postData,
            success: function (data) {
                var session = $.parseJSON(data); 
                resolve(session);               
/// ESTO DEVUELVE  ImporteOrig , Coseguro , Estado  NivelAudi , Mensaje 
// MENSAJE VIENE VACIO O "REQUIERE AUDITORIA" SI REQUIERE HAY Q AVISARLE 
// POR OTRO LAO HAY Q LLENAR ImporteOrig , Coseguro
              /*  if (session.existe >= 1) {                     
                    resolve(true);
                } else {
                    resolve(false);
                }*/
            }
        });
    });
}


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
     imprimeFicha();

    $('#guardar').attr("disabled", true);   
    var datos = $('#nro_documento').data('datos');
    $('#cod_plan').val(datos.cod_plan);
    $('#tipoing').val(datos.tipoing);
     
    var tableJson = $('#bus_tabla').tableToJSON(); // Convert the 
    //    console.log(JSON.stringify(tableJson));
    $('#tablavalor').val(JSON.stringify(tableJson)); 
    let imgs = document.querySelectorAll(".obj");
    if(imgs.length >0){
        upLoadFiles("file");
    }else{
      loading('show');
      console.log('ELSE');
      link_ajax('/base/{$ruta}/modificar.php', 'div_principal', 'formulario', 'si');  
    }  
       
});

function   imprimeFicha() { 
  var datos = $('#codnum').data('datos'); 
  let imprimeficha = datos['codnum'];    
    if(imprimeficha == 801 ){
        void window.open('/base/modulos/descargas/listar.php?camino=FichaPeriodontal.pdf','_blank');       
    }else if (imprimeficha == 101 ) {        
        void window.open('/base/modulos/descargas/listar.php?camino=fichaodont.pdf','_blank')
    }
}



/*------*/

var dropbox;

dropbox = document.getElementById("drop_file_zone");
dropbox.addEventListener("dragenter", dragenter, false);
dropbox.addEventListener("dragover", dragover, false);
dropbox.addEventListener("drop", drop, false);

function deleteImg(el) {  
  var imgWrap = el.parentElement;
  imgWrap.parentElement.removeChild(imgWrap);
}

function dragenter(e) {
  e.stopPropagation();
  e.preventDefault();
}

function dragover(e) {
  e.stopPropagation();
  e.preventDefault();
}
function drop(e) {
  e.stopPropagation();
  e.preventDefault();

  var dt = e.dataTransfer;
  var files = dt.files;
  //console.log(files);

  showThumbnail(files);
}


function doClick() {
  var el = document.getElementById("file");
  if (el) {
    el.click();
  }
}

      $('#file').on('change', function(e) { 
          $(this).val('');          
      });

      function showThumbnail(files) {
        const preview = document.getElementById('div_errores');

         for (let i = 0; i < files.length; i++) {
            const file = files[i];

          //  if (!file.type.startsWith('image/')){ continue }
            const div_img = document.createElement("div");
            div_img.className = "img-wrap";
            var newSpan = document.createElement('span');
            newSpan.className = "closeImg";
            newSpan.innerHTML = '&times;';
            newSpan.onclick = function() {              
              deleteImg(this);
              this.innerHTML = '';
            };

            div_img.append(newSpan);
            const img = document.createElement("img");
            img.classList.add("obj");
            img.file = file;
            div_img.append(img);
            preview.appendChild(div_img);

           var ext = file.name.split('.').pop();
           if (ext == "pdf") {
             img.src = "/{$rootDir|default}/img/pdf.png";
           } else if (ext == "doc" | ext == "txt" | ext == "word") {
             img.src = "/{$rootDir|default}/img/docs.png";
           } else if (file.type.startsWith('image/') ){
            const reader = new FileReader();
            reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
            reader.readAsDataURL(file);
           }
          }
      }  


  
    function upLoadFiles(fileId) {
        loading('show');
        // The Javascript
       // var formData = $('#formulario').serialize();
        var formData = new FormData($('form')[0]);
        const imgs = document.querySelectorAll(".obj");

        for (let i = 0; i < imgs.length; i++) {        
            var f = imgs[i].file.size;
            if (f > 4388608 || f > 4388608) {
                msgsnackbar("Archivo excede tamaño de subida", 'warning');
                return false;
            }
            formData.append('file[]', imgs[i].file);  
        }

        formData.append('accion', "guardar");

        $.ajax({
            url : '/{$rootDir}/{$ruta}/carga_img.php' ,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                loading('hide');
                var json = $.parseJSON(respuesta); // create an object with the key of the array
                console.log(json);
                var color = (json.cod_error == 1) ? 'warning' : 'success';
                if(json.cod_error == 0){
                  param =  btoa(json.param);                  
                  void window.open('/base/{$ruta}/imprimeOrden.php?param='+param);
                  link_ajax('/base/blanquea.php','div_principal');
                  setTimeout(function(){ msgsnackbar(json.mensaje, color); }, 1000);
                }else if(json.cod_error == 9){
                   msgsnackbar(json.mensaje + " Pendiente de Auditoria", color);
                   link_ajax('/base/blanquea.php','div_principal');
                   setTimeout(function(){ msgsnackbar(json.mensaje, color); }, 1000);
                }
                msgsnackbar(json.mensaje, color);
            },
            error: function(e) {
                msgsnackbar("Error al subir archivo", 'warning');
            }
        });
    }


 </script>
