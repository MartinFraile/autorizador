<div class="col-50">
  <div class="col-25">
      <label class="col-form-label col-form-label-sm" for="cod_prestador">
          Asociación
      </label>
  </div>
  <div class="col-75">
      {include file="$base/tpl/option_btn.tpl"  id_opt_btn="cod_prestador" esrequerido="required"  datos=$datos|default options=$asociaciones}
   
  </div>
</div>

<script>
$('#cod_prestador').on('change', '', function (e) {
        var $mid = $( "#cod_prestador" ).val();
        var $mef = $( "#cod_prestador option:selected" ).text();
        var $nbarra = $mef.indexOf('|')+1;
        var $nmat = $mef.substring($nbarra);
        var $nmat = $nmat.trim();
      $('#minstituciones_id').val($mid);
      $('#matriculaefec').val($nmat);
      $('#nro_documento').trigger('limpiar');
      $('#codnum').trigger('limpiar'); 
      $('#input_nropieza').val(''); 
      $('#input_codcara').val('');
      $('#observaciones').val('');
      $('#asossn').val('N');
      });
</script>
