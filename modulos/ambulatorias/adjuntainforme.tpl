<input  id="mensaje" name="mensaje" type="hidden">
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
        <div class="row" id="div_msj" >
            <div class="col-15 msjprac" >
                <span>Informe: &nbsp;</span>
            </div>
            <div class="col-85" id="msj" name="msj">
            {$mensaje} 
            </div>
        </div>
        <div class="row">
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
            <div id="no-more-tables">
            </div>
        </div>
        <div class="card-footer text-center">
            <input id="ruta" name="ruta" type="hidden" value="{$ruta}"/> 
            <input id="cod_obsocconec" name="cod_obsocconec" type="hidden" value="{$cod_obsoc}"/>                   
            <input id="accion" name="accion" type="hidden" value="guardar"/>
            <input class="btn btn-success" id="guardar" name="guardar" type="button" value="Guardar">
            <input class="btn btn-primary" onclick="link_ajax('/base/blanquea.php','div_principal');" type="button" value="Cancelar">
        </div>
      </form>
    </div>
  </div>
</div>   
<script type="text/javascript">
  
 
$('#guardar').on('click', function() { // capture the click    
    
    let imgs = document.querySelectorAll(".obj");
    if(imgs.length >0){
        upLoadFiles("file");
    }else{
      loading('show');
      console.log('ELSE');
      link_ajax('/base/{$ruta}/modificar.php', 'div_principal', 'formulario', 'si');  
    }  
       
});   

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
                var color = (json.cod_error == 1) ? 'warning' : 'success';
                if(json.cod_error == 0){
                  param =  btoa(json.param);
                  void window.open('/base/{$ruta}/imprimeOrden.php?param='+param);
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
