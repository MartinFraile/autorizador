<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            {$titulo|default}
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
                        {include file="$base/tpl/option_btn.tpl" id_opt_btn="tipo_documento" datos=$datos|default:'1' esrequerido="required" options=$tipodoc}
                    </div>
                    <div class="col-33">
                        <label class="col-form-label col-form-label-sm" for="nro_documento">Número
                        </label>
                        <input class="form-control form-control-sm" id="nro_documento" name="nro_documento"
                            required="required" type="text" value="{$datos.nro_documento|default}">
                        </input>
                    </div>
                    <div class="col-33">
                        <label class="col-form-label col-form-label-sm" for="fecha_nacimiento">
                            {if $codMaestro|default == 0} Fecha Nacimiento{else} Fecha de Constitución{/if}
                        </label>
                        <input class="form-control form-control-sm" id="fecha_nacimiento" name="fecha_nacimiento"
                            type="date" value="{$datos.fecha_nacimiento|date_format:'%Y-%m-%d'|default}">
                        </input>
                    </div>
                </div>
                <div class="row">
                    {if $codMaestro|default == 1}
                        <div class="col-100">
                            <label class="col-form-label col-form-label-sm" for="apellido">
                                Razon Social
                            </label>
                            <input class="form-control form-control-sm" id="apellido" name="apellido" required="required"
                                type="text" value="{$datos.apellido|default}">
                            </input>
                        </div>
                    {else}
                        <div class="col-50">
                            <label class="col-form-label col-form-label-sm" for="apellido">
                                Apellido
                            </label>
                            <input class="form-control form-control-sm" id="apellido" name="apellido" required="required"
                                type="text" value="{$datos.apellido|default}">
                            </input>
                        </div>
                        <div class="col-50">
                            <label class="col-form-label col-form-label-sm" for="nombre">
                                Nombre
                            </label>
                            <input class="form-control form-control-sm" id="nombre" name="nombre" type="text"
                                value="{$datos.nombre|default}">
                            </input>
                        </div>
                    {/if}
                </div>
                <div class="row">
                    <label class="col-form-label col-form-label-sm" for="email">
                        Email
                    </label>
                    <input class="form-control form-control-sm" id="email" name="email" required="required" type="text"
                        value="{$datos.email|default}">
                    </input>
                </div>
            </div>
            <div class="tabs">
                <input checked="checked" class="tabs-input" id="tab-1" name="tabs" type="radio" />
                <label class="tabs-label" for="tab-1">
                    Datos Básicos
                </label>
                <div class="tabs-panel">
                    <div id="div_items">
                        <div class="row">
                            <div class="col-33">
                                <input placeholder="Celular" required="required" class="form-control form-control-sm"
                                    id="celular" name="celular" type="number" value="{$datos.celular|default}">
                                </input>
                            </div>
                            <div class="col-33">
                                {include file="$base/tpl/option_btn.tpl" id_opt_btn="cod_localidad" datos=$datos|default:'1' esrequerido="required"
                options=$localidad}
                                <input id="localidad" name="localidad" type="hidden" value="" />
                            </div>
                            <div class="col-33">
                                <input placeholder="Direccion" required="required" class="form-control form-control-sm"
                                    id="direccion" name="direccion" type="text" value="{$datos.direccion|default}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-50">
                                <input class="" id="nrorow" name="nrorow" type="hidden" />
                                <input class="" id="tablavalor" name="tablavalor" type="hidden" />
                                <input class="btn btn-outline-success" id="additem" name="additem" type="button"
                                    value="Agrega" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="no-more-tables">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <input id="cod_persona" name="cod_persona" type="hidden" value="{$datos.cod_persona|default}" />
            <input id="ruta" name="ruta" type="hidden" value="{$ruta}" />
            <input id="accion" name="accion" type="hidden" value="guardar" />
            <input class="btn btn-success" id="guardar" name="guardar" type="button" value="Guardar" />
            <input class="btn btn-primary cancelar" type="button" value="Cancelar" />
        </div>
    </form>
</div>
<style>
    #form_persona {
        max-width: 800px;
    }

    #bus_tabla {
        font-size: small;
    }
</style>
<script type="text/javascript">
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
    }, {
        "label": "direccion",
        "name": "direccion",
        "opciones": {
            "alias": "direccion",
            "nom_campo": "direccion",
        }
    }, {
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
    if({$datos.direcciones|default:'0'} !== 0){
    var datos = {$datos.direcciones|default: '0'};
    var eliminar =
        "<a class='' data-toggle='tooltip' title='Eliminar' href='#' onclick='eliminarRow($(this));'  ><div class='d-none'></div><img src=\"\/img\/eliminar.svg\"  alt=\"Eliminar\"\r\n            height=\"25px\"  width=\"30px\" \/></a>";

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
            let eliminar =
                "<a class='' data-toggle='tooltip' title='Eliminar' href='#' onclick='eliminarRow($(this));'  ><div class='d-none'>" +
                datos[0]['nrorow'] +
                "</div><img src=\"\/img\/eliminar.svg\"  alt=\"Eliminar\"\r\n            height=\"25px\"  width=\"30px\" \/></a>";
            datos[0]['eliminar'] = eliminar;
            $("#bus_tabla tbody").append(detalle(datos, headers));

            var inputs = $('input, textarea').not(
                ':input[type=button], :input[type=submit], :input[type=reset]');
            $("#div_items").find(inputs).each(function() {
                $(this).val('');
            });

            return false;

        }
    });


    $('#form_persona #guardar').on('click', function(e) {
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
        link_ajax('/{$ruta}/modificar.php', 'div_principal', 'form_persona', 'si');

    });
</script>