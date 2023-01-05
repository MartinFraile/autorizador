<style type="text/css">
 .modal-content{
   width: 50%;
 }
</style>
<div class="col-80 col-center">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">
        Adjuntar archivo requerido
        <span class="close">
          ×
        </span>
      </h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-100">
          <label class="col-form-label col-form-label-sm" for="observacion">
            Observacion
          </label>
        </div>
        <div class="col-100">
          <input class="form-control form-control-sm" id="observacion" name="observacion" type="text" required>
          </input>
        </div>
      </div>
      <div class="row">
        <div class="col-100">
          <label class="col-form-label col-form-label-sm" for="observacion">
              Adjunta archivo
          </label>
        </div>
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
    </div>
    <div class="card-footer text-center">
            <input id="ruta" name="ruta" type="hidden" value="{$ruta}"/> 
            <input id="accion" name="accion" type="hidden" value="adjunta"/>
            <input class="btn btn-success" id="adjunta" name="adjunta" type="button" value="Adjunta">
        </div>
  </div>
</div>
<script type="text/javascript">
  $('#adjunta').on('click', function() { // capture the click    
      
      let imgs = document.querySelectorAll(".obj");
      if(imgs.length >0){
          upLoadFiles("file");
      }else{
        loading('show');
        console.log('ELSE');
        link_ajax('/base/{$ruta}/modificar.php', 'div_principal', 'formulario', 'si');  
      }  
        
  });
 </script>