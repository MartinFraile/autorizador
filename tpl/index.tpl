<!DOCTYPE html>
<html>
  <head>
    <meta content="width=device-width, user-scalable=no" name="viewport"/>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <link href="/base/css/styles.css" rel="stylesheet"/>    
    <script src="/base/js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="/base/js/funciones.js" type="text/javascript"></script>
    <script src="/base/js/tablas.js" type="text/javascript"></script>
    <link href="/base/manifest.json" rel="manifest"/>
<style type="text/css">

   a.collapse::after {
    position: absolute;
    content: '';
    height: 16px;
    width: 16px;
    right: 5%;
    top: 50%;
    bottom: auto;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    background: url(/base/img/cd-arrow.svg);
}
a.selected::after {
    -webkit-transform: translateY(-50%) rotate(180deg);
    -moz-transform: translateY(-50%) rotate(180deg);
    -ms-transform: translateY(-50%) rotate(180deg);
    -o-transform: translateY(-50%) rotate(180deg);
    transform: translateY(-50%) rotate(180deg);
}
</style>
  </head>
  <body>
    <div class="wrapper " id="div_contenedor">
      {$menu.principal|default}
      <div class="content " id="main">
        <ul class="breadcrumb">
          <li>
            <button class="navbar-btn" id="sidebarCollapse" name="sidebarCollapse"  type="button">
              <span>
              </span>
              <span>
              </span>
              <span>
              </span>
            </button>
          </li>
          <li class="nav-right">
            {$menu.usuario|default}
          </li>
        </ul>
        <div id="div_principal">
        </div>
      </div>
    </div>   
    <footer class="footer">
      <span class="text-muted">
        Sistema Web Deportivo
      </span>
    </footer>
<script>

$(function link_activos() {  

    $('li a').not('.collapse').click(function(e) {   
        $('.sidenav').find('.active').removeClass('active');
        $(this).addClass('active');
         var ul=$('.sidenav>li>ul').not($(this).parent()).hide(); //Hide/close all containers

        if(!$(this).parent('ul').length > 0){
       //  $('.collapse').removeClass('selected');  
        }else{

         // $( ".collapse" ).not(':parent > a.selected').parent().removeClass('selected');
        }
        
    });
         $('li a').click(function(e) {   
      //$('.collapse').not($(this).parent().has('ul')).removeClass('selected');
  
     
     //    $('.collapse').removeClass('selected');
    });
});

$(function show_submenus() {
         //Set default open/close settings
  var ul=$('.sidenav>li>ul').hide(); //Hide/close all containers
  var arefs=$('.collapse').click(function () {   
    
     var ulact=$('.sidenav>li>ul:has(:not(a.active))').slideUp();  
      $(this).next().slideToggle()
     //   $(this).addClass('selected');
        
      return false; //Prevent the browser jump to the link anchor
  });
});

$(function change_primary_color() {
  $('.sidenav>li>ul').hide();
  setTimeout(function() {
    var html = document.getElementsByTagName('html')[0];
    var cod_club =  {$menu.cod_club|default};
    switch (cod_club) { 
        case 7:          
           html.style.cssText  = "--primary-color: #cd5c5c;--primary-dark-color:#982c33;--primary-light-color: #ff8c89";            
          break;
        case 9: 
          html.style.cssText  = "--primary-color: #7C9DAF;--primary-dark-color:#496A7C;--primary-light-color: #AFD0E2"; 
          break;
      
        default:
        
      }
   
  }, 0);
});

$(function OpenSideBar() {
  $('#sidebarCollapse').click(function(e) {
     $(this).toggleClass('active');
      var x = document.getElementById("myNavbar");
      if (x.className === "sidenav") { 
           x.className += " active";
      } else {    
       x.className = "sidenav";
      }
  });
});


/* JavaScript Media Queries */
if (matchMedia) {
    const mq = window.matchMedia("(max-width: 900px)");

    mq.addListener(WidthChange);
    WidthChange(mq);
}

function cierraMenu() {
   $( "#sidebarCollapse" ).trigger( "click" );
}
// media query change
function WidthChange(mq) {
    if(mq.matches){
      $('.sidenav>li>a').not('.collapse').on('click', cierraMenu);
      $('.sidenav>li>ul>a').on('click', cierraMenu);
    }
    else{
      $('.sidenav>li>a').not('.collapse').off('click', cierraMenu);
      $('.sidenav>li>ul>a').off('click', cierraMenu);
    }
}
</script>


 <script>
      if('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/service-worker.js', { scope: '/' })
          .then(function(registration) {
                console.log('Service Worker Registered');
          });
        navigator.serviceWorker.ready.then(function(registration) {
           console.log('Service Worker Ready');
        });
      }
    </script>

  </body>
</html>
