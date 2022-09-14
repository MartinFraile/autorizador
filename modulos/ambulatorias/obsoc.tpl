<div class="col-25">
    <label class="col-form-label col-form-label-sm" for="cod_obsoc">
      Ob Social
    </label>
</div>
<div class="col-75">
    {include file="$base/tpl/option_btn.tpl" id_opt_btn="cod_obsoc" esrequerido="required" datos=$datos|default options=$obrasoc}
</div>

<script type="text/javascript">
    $( document ).ready(function() { 
      var cod_obsoc =  $('#cod_obsoc').val(); 
      var dataString = "cod_obsoc="+cod_obsoc;
      link_ajax('/base/{$ruta}/get_afil.php?'+dataString+'','div_afil','formulario');
    }); 
    
  $('#cod_obsoc').on('change', function(){ 
     var cod_obsoc = $(this).val(); 
      var dataString = "cod_obsoc="+cod_obsoc; /* STORE THAT TO A DATA STRING */
      link_ajax('/base/{$ruta}/get_afil.php?'+dataString+'','div_afil','formulario');
  });
</script>
