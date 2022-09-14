<input  id="cod_plan" name="cod_plan" type="hidden">
<input  id="tipoing" name="tipoing" type="hidden">
<div class="col-15">
<label class="col-form-label col-form-label-sm" for="nro_documento">
  Afiliado
</label>
</div>
<div class="col-85">
{include file="$base/tpl/buscador_live.tpl" id_buscador="nro_documento" id_desc_buscador="apenom" bus_script="busafil" bus_id="nroafil" boton=$boton   }
</div>

<script type="text/javascript">
     document.getElementById("nro_documento").required = true;  

    $('#nro_documento').on('encontrado', function() {    
	    var obsoc = $('#cod_obsoc').val();
	    var nro_afil = $('#nro_documento').val();
	    if(obsoc == 1){
	    	return false;
	    	loading("show");
	        var ajaxurl = '/base/modulos/beneficiario/get_benef.php?obsoc='+obsoc+'&nroafil='+nro_afil;	        
	        $.ajax({
	            url: ajaxurl,
	           // data: postData,
	            success: function (data) {	        
	            loading("hide");    	
	                var afiliado = $.parseJSON(data);   	               
	                if (afiliado.SocCod == 0) {	  	                
	                	 msgsnackbar(afiliado.mensaje, "warning");
	                	 $('#nro_documento').limpiar();	                	
	                   } 
	               
	            }
	        });
	    }
    
});
</script>
