<!-- <script defer="" src="/base/js/draganddrop.js"></script> -->
{include file="file:$base/tpl/header.tpl"}
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
<div class="col-75 col-center">
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
                        <div class="col-50">
                            <div class="col-25">
                                <label class="col-form-label col-form-label-sm" for="codigo">
                                    Obra Social
                                </label>
                            </div>
                            <div class="col-75">
                                {include file="$base/tpl/option_btn.tpl"  id_opt_btn="codobsocconec" esrequerido="required" datos=$datos|default options=$obsoc}
                                </div>
                                <input id="cod_obsocconec" name="cod_obsocconec" type="hidden" />
                                <input id="id_minstituciones" name="id_minstituciones" type="hidden" />
                                <input id="cod_agencia" name="cod_agencia" type="hidden" />
                                <input id="operadores_id" name="operadores_id" type="hidden" />
                                <input id="matricula" name="matricula" type="hidden" />
                        </div>
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
                    <div class="row">
                        <div class="col-50" id="div_efector" name="div_efector">
                            {$efector|default}
                        </div>
                        <div class="col-50" id="div_prescriptor" name="div_prescriptor">
                            {$prescriptor|default}
                        </div>
                    </div>
                </div>
                <div id="div_items">
                    <div class="row">
                        <div class="col-15">
                            <label class="col-form-label col-form-label-sm" for="codnum">
                                Practica
                            </label>
                        </div>
                        <div class="col-50" style="width: 62%;">
                            {include file="$base/tpl/buscador_live.tpl" id_buscador="codnum" id_desc_buscador="descripcion" bus_script="buspractica" bus_id="cod_practi"    }
                            <input id="codsegmento" name="codsegmento" type="hidden" />
                            <input id="coseguro" name="coseguro" type="hidden" />
                            <input id="importeprac" name="importeprac" type="hidden" />
                            <input id="img" name="img" type="hidden" />
                        </div>
                        <div class="col-15">
                            <label class="col-form-label col-form-label-sm" for="cantidad">
                            Cantidad
                            </label>
                        </div>
                        <div class="col-15">
                            <input class="form-control form-control-sm" id="cantidad" name="cantidad" type="number" value="1" required>
                            </input>
                        </div>
                    </div>
                    <div class="row" id="div_msjprac" hidden>
                        <div class="col msjprac" >
                            <label class="col-form-label col-form-label-sm" for="" id="msjprac">                                    
                            </label>         
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="" id="div_diagno" name="div_diagno">
                            {$diagno|default}
                            <input id="minstituciones_id" name="minstituciones_id" type="hidden" value="{$datos.cod_diagno|default}"/>
                            <input id="cod_diagno" name="diagno" type="hidden" value="{$datos.cod_diagno|default}"/>

                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-15">
                                <label class="col-form-label col-form-label-sm" for="diagnostico">
                                Diagnostico
                                </label>
                            </div>
                        <div class="col-85">
                            <input class="form-control form-control-sm" id="diagnostico" name="diagnostico" type="text" required>
                            </input>
                        </div>
                    </div>
                    <div id="div_adjunto">                        
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

$('#codobsocconec').on('change', '', function (e) {
        var $mid = $( "#codobsocconec option:selected" ).val();
        var $nbarra = $mid.indexOf('|')+1;
        var $nidconect = $mid.substring($nbarra);
        var $nidconect = $nidconect.trim();
        $('#cod_obsocconec').val($nidconect);
        
        });



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
        "label": "nrorow",
        "name": "nrorow",
        "hidden": "hidden",
        "opciones": {
            "alias": "nrorow",
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
    },
    {
        "label": "Cantidad",
        "name": "cantidad",
        "hidden": "hidden",
        "opciones": {
            "alias": "Cantidad",
            "nom_campo": "cantidad"
        }
    },
    {
        "label": "Diagnostico",
        "name": "diagnostico",
        "hidden": "hidden",
        "opciones": {
            "alias": "Diagnostico",
            "nom_campo": "diagnostico"
        }
    }, 
    {
        "label": "cod_diagno",
        "name": "id_tdiagnostico",
        "hidden": "hidden",
        "opciones": {
            "alias": "cod_diagno",
            "nom_campo": "id_tdiagnostico"
        }
    },{
        "label": "codsegmento",
        "name": "codsegmento",
        "hidden": "hidden",
        "opciones": {
            "alias": "codsegmento",
            "nom_campo": "codsegmento"
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
        var descripcion = $('#codnum_desc').val();
        var efector = $('#matefec_desc').val();
        var prescriptor = $('#matpres_desc').val();
        var cant = $('#cantidad').val();

         if (efector.length < 1) {            
            msgsnackbar("Efector Invalido", "warning");
            e.stopPropagation();
            return false;
        } 
        if (prescriptor.length < 1) {            
            msgsnackbar("Prescriptor Invalido", "warning");
            e.stopPropagation();
            return false;
        }

        if (cant == 0) {
            msgsnackbar("Ingrese cantidad", "warning");
            e.stopPropagation();
            return false;
        }

        if (descripcion.length < 1) {
            $('#codnum').val('');
            msgsnackbar("Practica Invalida", "warning");
        }

        if ($('#bus_tabla tr:not(.d-none, .table-warning)').length > 20) {
            msgsnackbar("Permite hasta 20 items por orden", "warning");
            e.stopPropagation();
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
                    open_form_in_modal('/base/{$ruta}/agrega_adjunto.php');
                    msgsnackbar("Requiere auditoría", "warning");
                    
                }       

                $("#blockdate input,select").attr('readonly', 'readonly');
                var datos = Array($("#formulario").serializeFormJSON());
                var tableJson = $('#bus_tabla').tableToJSON({
                    ignoreHiddenRows: true
                });
                 
                var $existe = false;            
                //sumaCoseguro();
                $.each(tableJson, function(i, item) {     
                    if (datos[0].codnum == item.Cod_Prac  && datos[0].nrorow != item.nrorow) {
                        msgsnackbar("Practica ya ingresada.", "warning");
                        $existe = true;
                        return false;
                    }
                    $existe = false;
                });
                
                if ($existe) return false; 
                   
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

     
$('#codobsocconec').on('change', function() { 
    
    var cod_obsocconec = $("#cod_obsocconec").val();      
    var ajaxurl ="/base/{$ruta}/carga_inst.php?cod_obsocconec="+cod_obsocconec+"" ;
    $.ajax({
        url: ajaxurl,            
        success: function (data) {                               
             var data = $.parseJSON(data);   
             
             $('#id_minstituciones').val(data.id_minstituciones);
             $('#cod_agencia').val(data.cod_agencia);
             $('#operadores_id').val(data.operadores_id);
             $('#matricula').val(data.matricula);
            }
    }); 
});


$('#codnum').on('encontrado', function() {     
    var datos = $('#codnum').data('datos');
    $('#codsegmento').val(datos['codsegmento']);

    let msjprac = datos['mjeprac'];
    if(msjprac.length > 0 ){
        $("#msjprac").text(msjprac);
        $("#div_msjprac").show('slow');
    }else{
        limpiarmsj();
    }

});


function limpiarmsj() {     
    $("#msjprac").text('');
    $('#div_msjprac').hide();
};



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
            
            //if (f > 4388608 || f > 4388608) {
             if (f > 6003764 || f > 6003764) {   
                msgsnackbar("Archivo excede tamaño de subida", 'warning');
                return false;
            }
            formData.append('file[]', imgs[i].file);  
        }

        formData.append('accion', "guardar");

        $.ajax({
            url : '/base/{$ruta}/carga_img.php' ,
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
                    $('#img').val = param;
                 // void window.open('/base/{$ruta}/imprimeOrden.php?param='+param);
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
{include file="file:$base/tpl/footer.tpl"}
