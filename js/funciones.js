function link_ajax(script, div = 'div_principal', formulario, evaluar) {
  if (typeof formulario === "undefined" || formulario === "") {
    var request = $.ajax({
      url: script,
      type: "GET",
      dataType: "html"
    });
    request.done(function(msg) {
       if (evaluar == 'si') {
          if (msg != '') {
            if (window.execScript) window.execScript(msg);
            else {
              window.eval(msg);
            }
          }
        }else{
          $("#" + div).html(msg);
        }
      
    });
    request.fail(function(jqXHR, textStatus) {
      alert("Falló Conexión: " + textStatus);
    });
  } else {
    form_inn = $("#" + formulario);
    var datos = form_inn.find("select,textarea, input").serializeArray();
    var request = $.ajax({
      url: script,
      type: "POST",
      data: datos,
      dataType: "html"
    });
    request.done(function(msg) {
       if (evaluar == 'si') {
          if (msg != '') {
            if (window.execScript) window.execScript(msg);
            else {
              window.eval(msg);
            }
          }
        }else{
          $("#" + div).html(msg);
        }
    });
    request.fail(function(jqXHR, textStatus) {
      alert("Falló Conexión: " + textStatus);
    });
  }
};


(function($) {
  $.fn.extend({
    donetyping: function(callback, timeout) {
      timeout = timeout || 1e3; // 1 second default timeout
      var timeoutReference,
        doneTyping = function(el) {
          if (!timeoutReference) return;
          timeoutReference = null;
          callback.call(el);
        };
      return this.each(function(i, el) {
        var $el = $(el);
        // Chrome Fix (Use keyup over keypress to detect backspace)
        // thank you @palerdot
        $el.is(':input') && $el.on('keyup keypress paste input', function(e) {
          // This catches the backspace button in chrome, but also prevents
          // the event from triggering too preemptively. Without this line,
          // using tab/shift+tab will make the focused element fire the callback.
          if (e.type == 'keyup' && e.keyCode != 8) return;
          // Check if timeout has been set. If it has, "reset" the clock and
          // start over again.
          if (timeoutReference) clearTimeout(timeoutReference);
          timeoutReference = setTimeout(function() {
            // if we made it here, our timeout has elapsed. Fire the
            // callback
            doneTyping(el);
          }, timeout);
        }).on('blur', function() {
          // If we can, fire the event since we're leaving the field
          doneTyping(el);
        });
      });
    }
  });
})(jQuery);

function bus_query(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  /*execute a function presses a key on the keyboard:*/
  var currentFocus ; 
  inp.addEventListener("keydown", function(e) {
    var x = document.getElementById(this.id + "autocomplete-list");
    if (x) x = x.getElementsByTagName("div");
    if (e.keyCode == 40) {
      /*If the arrow DOWN key is pressed,
      increase the currentFocus variable:*/      
      currentFocus++;
      /*and and make the current item more visible:*/
      addActive(x);
    } else if (e.keyCode == 38) { //up
      /*If the arrow UP key is pressed,
      decrease the currentFocus variable:*/
      currentFocus--;
      /*and and make the current item more visible:*/
      addActive(x);
    } else if (e.keyCode == 9) { //tab       
      if (currentFocus > -1) {
        /*and simulate a click on the "active" item:*/
        if (x) x[currentFocus].click();
        currentFocus= -1;
      }
      // closeAllLists();
    } else if (e.keyCode == 13) {
      /*If the ENTER key is pressed, prevent the form from being submitted,*/
      e.preventDefault();
      if (currentFocus > -1) {       
        /*and simulate a click on the "active" item:*/
        if (x) x[currentFocus].click();
        currentFocus= -1;
      }
    }
  });
  var a, b, i, val = inp.value;
  /*close any already open lists of autocompleted values*/
  closeAllLists();
  if (!val) {
    return false;
  }
  currentFocus = -1;
  /*create a DIV element that will contain the items (values):*/
  

  a = document.createElement("DIV");
  a.setAttribute("id", inp.id + "autocomplete-list");
  a.setAttribute("class", "autocomplete-items");
  /*append the DIV element as a child of the autocomplete container:*/
  inp.parentNode.appendChild(a);
  /*for each item in the array...*/
  var codigo = inp.id;
  var descripcion = inp.getAttribute('data-desc');
  var bus_id = inp.getAttribute('data-id');
  var inputSolo = inp.getAttribute('data-name');
  $.each(arr, function(i, item) {
    b = document.createElement("DIV");
    if(inputSolo == "input_search") {
      a.style.marginTop = "0px";
      b.innerHTML = "<small><strong>" +  item[descripcion] + "</strong></small>";
      b.addEventListener("click", function(e) {
        itemSelectSolo(inp, item);
      });
    }else if(inputSolo == "input_search_solo"){ 
      let strcodigo = codigo.replace("input_", "");         
      a.style.marginTop = "0px";
      b.innerHTML = "<small><strong>" + item[strcodigo] + ' - ' +  item[descripcion] + "</strong></small>";
      b.addEventListener("click", function(e) {
        itemFinded(inp, item);
      });
    }
    else{
      b.innerHTML = "<small><strong>" + item[codigo] + ' - ' + item[descripcion] + "</strong></small>";   
      b.innerHTML += "<input type='hidden' value='" + item[codigo] + "'>";
      b.addEventListener("click", function(e) {
        itemSelect(inp, item);
      });
    }   
   
    a.appendChild(b);
  });

  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    if (x[currentFocus]) {
      x[currentFocus].classList.add("autocomplete-active");
      //scroll to element:
      $(".autocomplete-items").scrollTop(0); //set to top
      $(".autocomplete-items").scrollTop($('.autocomplete-active').position().top + $(".autocomplete-items").scrollTop()); //then set equal to the position of the selected element minus the height of scrolling div
    }
  }

  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
};

function itemSelect(input, item) {   
  var codigo = input.id;
  var descripcion = input.getAttribute('data-desc');
  var bus_id = input.getAttribute('data-id');
  $('#' + codigo + '_desc').val(item[descripcion]);
  $('#' + bus_id).val(item[bus_id]);
  $('#' + codigo + '').val(item[codigo]);
  $('#' + codigo + '').data('datos', item);
  $('#' + codigo + '_desc').next().focus();
  $('#' + codigo + '').trigger('encontrado');
  $('#' + codigo + '').next().focus();
  closeAllLists();
}

function itemFinded(input, item) {

  let descripcion = input.getAttribute('data-desc'); 
  let codigo = input.id; 
  let strcodigo = codigo.replace("input_", "");   
  let bus_id = input.getAttribute('data-id');
  $('#' + codigo + '').val(item[strcodigo] +" - "+ item[descripcion]);
  $('#' + strcodigo + '').val(item[strcodigo]);
  $('#' + bus_id).val(item[bus_id]);
  $('#' + strcodigo + '').data('datos', item);
  $('#' + strcodigo + '').trigger('encontrado');
  $('#' + codigo + '').next().focus();
  closeAllLists();


  
}

function itemSelectSolo(input, item) {

  var descripcion = input.getAttribute('data-desc'); 
  var codigo = input.id; 
  var bus_id = input.getAttribute('data-id');
  var itemsArr = []; 
  var obj = {};
  var arrdatos = $('#' + bus_id + '').val();
  if(arrdatos.length > 0) itemsArr = JSON.parse($('#' + bus_id + '').val());
  var findItem = $.grep(itemsArr, function (i) { return (i.CodDes == item[codigo] ) });
 if(findItem.length > 0) {
    closeAllLists(); 
    return false;
  }  
 // itemsArr.push(item[codigo]);
  obj['CodDes'] = item[codigo];
  itemsArr.push(obj);

  $('#' + bus_id + '').val(JSON.stringify(itemsArr));
  createTag(input, item);
  
   $('#' + codigo + '').val('');
  closeAllLists();
}
function arrayRemove(arr, value) {
  const res = arr.filter(obj => Object.values(obj).some(val => val!= value));
  return res;
}
function createTag(input, item) { 
  var descripcion = input.getAttribute('data-desc'); 
  var codigo = input.id; 
  var bus_id = input.getAttribute('data-id');
  $('.tags-div').append('<span class="tag-info">' + item[descripcion] +'<span class="delete_tag" data-codigo="' + item[codigo] + '" data-role="remove"></span></span>');
  $('.delete_tag').click(function(event){
    list = JSON.parse($('#' + bus_id + '').val());       
    $('#' + bus_id + '').val(JSON.stringify(arrayRemove(list, $(this).data("codigo"))));
    $(this).parent().remove();
  });
}

function closeAllLists() {
  currentFocus = -1;
  /*close all autocomplete lists in the document,
  except the one passed as an argument:*/
  var x = document.getElementsByClassName("autocomplete-items");
  for (var i = 0; i < x.length; i++) {
    x[i].parentNode.removeChild(x[i]);
  }
}

function open_form_in_modal(url) {
  $("#myModal").remove();
  var modal = '<div id="myModal" class="modal">\
  <!-- Modal content -->\
  <div class="modal-content">\
    <span class="close">&times;</span>\
    <p>Cargando espere..</p>\
  </div>\
</div>'
  $("#div_principal").append(modal);
  var data = $('form').serializeArray(); 
  if (data.find(item => item.name === 'accion')) {
    data.find(item => item.name === 'accion').value = "modal";
  }
  $.ajax({
    data: data,
    //  dataType: "json",
    method: 'POST',
    url: url,
    success: function(response) {
      event.preventDefault();
      var content = $('.modal-content');
      content.empty();
      content.html(response);      
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert("Error en Conexión");
    }
  });
  var modal = document.getElementById('myModal');
  modal.style.display = "block";  
}

$(document).on('click', '.close, .cancelar', callback);
  function callback(){ 
     if( $("#myModal").length )
      {
        $("#myModal").remove();
      }else{
        let href = $(".mobile-bottom-nav__item--active").find('a').attr('href');        
        window.location.href = href;        
      }
 
}


(function ($) {
    $.fn.serializeFormJSON = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
})(jQuery);



// modal
 


function confirmModal(msg, fun = '') {
    $(".modal").remove();
    var modal = ' <div id="confirm" name="confirm" class="modal" >\
                    <div class="modal-content">\
                      <div class="modal-header">\
                       <strong> Mensaje </strong> <span class="closeModal">&times;</span>\
                      </div>\
                      <div class="modal-body">\
                           <p>'+msg+'</p>\
                      </div>\
                      <div class="modal-footer">\
                        <input class="btn btn-primary cerrar" id="cancelar" name="cancelar" type="button" value="Cancelar">\
                        <button type="button" onclick="'+fun+'" class="btn btn-success" data-dismiss="modal">Aceptar</button>\
                      </div>\
                    </div>\
                  </div>';
 $("#div_principal").append(modal);

  var modal = document.getElementById('confirm');
  modal.style.display = "block";  
  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("closeModal")[0];
  span.onclick = function() {
    modal.style.display = "none";
  }
  var cerrar = document.getElementsByClassName("cerrar")[0];
  cerrar.onclick = function () {
    modal.style.display = "none";
  }

}



function confirmModal2(msg, fun = '') {
    $("#confirm").remove();
    var modal = ' <div id="confirm" name="confirm" >\
                    <div class="modal-content">\
                      <div class="modal-header">\
                        <button aria-hidden="true" class="close" type="button">×</button>\
                      </div>\
                      <div class="modal-body">\
                        <p>'+msg+'</p>\
                      </div>\
                      <div class="modal-footer">\
                        <input class="btn btn-primary cerrar" id="cancelar" name="cancelar" type="button" value="Cancelar">\
                        <button type="button" onclick="'+fun+'" class="btn btn-success" data-dismiss="modal">Aceptar</button>\
                      </div>\
                    </div>\
                  </div>';
// $("#div_principal").addClass("show-modal");
 $("#div_principal").append(modal);
 $('#confirm').addClass("show-modal");
  }

function cierra_modal() {   
    $('#confirm').removeClass('show-modal ');
  }

function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

function msgsnackbar(msg, clase="success")
{ 
    var snackbark = '<div id="snackbar"></div>';
   $("#div_principal").append(snackbark);
   $('#snackbar').html(msg);  
   $('#snackbar').addClass(clase);
   $('#snackbar').addClass("show");      
   setTimeout(function() { $('#snackbar').removeClass("show"); }, 3000);      
   setTimeout(function() { $('#snackbar').remove(); }, 4000);      
}


 function fncGetToday(){
return new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60000).toISOString().split("T")[0];
}

function chkedit(obj){
obj.val((obj.prop('checked')) ? 1 : 0);
}



function loading(status ="hide")
{ 
    var loading = '<div class="loading"> <img src="/img/loader.gif" class="rotate-center" alt="Cargando..."></div>';
    if (status == 'show'){
    $("body").append(loading);
    }else{
      $(".loading").remove();
    }
  
  
}