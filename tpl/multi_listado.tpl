<link href="/css/tablas.css" rel="stylesheet" />
<div class="bg-light col-85 col-center" id="div_contenido">
    <div id="div_listado">
        {if isset($div)}
            {assign var="var_div" value=$div}
        {else}
            {assign var='var_div' value='div_principal'}
        {/if}

        {if isset($titulo)}
            <div class="row">
                <h3>{$titulo|default}</h3>
            </div>
        {/if}

        {if $data}
            <form name="form_listado" id="form_listado" method="POST">
                <div class="limiter">
                    <div class="container-table100">
                        <div class="wrap-table100">
                            <div class="table100">

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        {else} <strong>No se encontraron resultados</strong>
        {/if}
    </div>
</div>
<script>
    $(document).ready(function() {
        var datos = JSON.stringify( {$data|default} );       
        //datos = JSON.parse(datos.replace(/"\[/g, '[').replace(/\]"/g, ']').replace(/\\/g, '')); 
        datos = JSON.parse(datos.replace(/"\[/g, '[').replace(/\]"/g, ']').replace(/\\/g, ''));
        var headers = {$headers|default} ;
        $("#{$var_div|default} .table100").html(cabecera(headers ));      
        var divSelector = '#{$var_div|default}';   
        $("#{$var_div|default} #bus_tabla tbody").html(detalleMulti(datos,headers));

    });



    function iFnc(e, t) {
        var n = "";
        var r = "";
        var s = "";
        $.each(t[0], function(e, t) {
            s += "<th>" + e + "</th>"
        });
        $.each(t, function(e, t) {
            r += "<tr>";
            $.each(t, function(e, t) {
                var n = 1 + Math.floor(Math.random() * 90 + 10);
                var s = $.isPlainObject(t);
                var o = [];
                if (s) {
                    o = $.makeArray(t)
                }
                r += "<td  data-label='" + e + "'>" + t + "</td>";
            });
            r += "</tr>"
        });
        n += "<table  class='table table-bordered table-hover table-collapsed'><thead>" + s + "</thead><tbody>" + r +
            "</tbody></table>";
        return n;
    }


    function detalleMulti(json, titulos) {

        var headerRow = '';
        var bodyRows = '<tr>';
        var v = titulos.length;
        var n = "";
        var s = 1 + Math.floor(Math.random() * 90 + 10);
        $.each(json, function(i, row) {
            var r = "";
            $.each(row, function(e, t) {
                if ($.isArray(t) && t.length > 0) {
                    n = "<tr class='collapse1 collapsed'><td colspan='" + v +
                        "'><div id='accordion'><div id='" + s + "' class=''>" + iFnc(e, t) +
                        "</div></div></td></tr>"
                }
                var findItem = $.grep(titulos, function(i) { return (e == i.name) });

                $.each(findItem, function(f, g) {
                    clase = '';
                    if (typeof g.opciones !== 'undefined' && typeof g.opciones.atr !==
                        'undefined' && typeof g.opciones.atr.class !== 'undefined') {
                        clase = g.opciones.atr.class;
                    }
                    if (e == g.name) {
                        r += '<td id="' + g.name + '" data-label="' + g.label + '" class="' +
                            clase + '"  ' + g.hidden + ' >' + t + '</td>'
                    }
                });
            });
            bodyRows += r + n;
            bodyRows += '</tr>';
        });

        return bodyRows;

    }

    $("body").on("click", "td:not(#acciones)", function() {
        $(this).parents("tr").next("tr.collapse1").toggleClass("collapsed");
        return false;

    });
</script>