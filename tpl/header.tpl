<!DOCTYPE html>
<html>

<head>
    <meta content="width=device-width, user-scalable=no" name="viewport" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <link href="/css/styles.css?version=1.1" rel="stylesheet" />
    <script src="/js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="/js/funciones.js" type="text/javascript"></script>
    <script src="/js/tablas.js" type="text/javascript"></script>
    <link rel='manifest' href='/manifest.json'>
    
    <link rel="icon" type="image/png" sizes="16x16" href="img/launcher/chrome/chrome-favicon-16-16.png">
    

    <title>Autorizador Web</title>
</head>

<style type="text/css">
    body {
        padding-top: 59px;
    }

    .wrapper-container {

        margin-top: 15px;
        padding: 10px 25px 55px 25px
    }

    .fixed-header {
        width: 100%;
        position: fixed;
        background: #fff;
        padding: 5px 0;
        color: #002d5b;
        z-index: 1000;
        top: 0;
        display: flex;
        justify-content: space-between;
    }

    .header-container {
        display: flex;
    }

    .header-container img {
        max-height: 45px;
        margin: auto 0 auto 15px;
    }

    .header-container a>svg {
        height: 25px;
        margin: 10px;
        fill: #555;

    }
    
    .prompt {
        display: flex;
        background-position-x: 1rem;
        background-position-y: 1rem;
        background-repeat: no-repeat;
        background-size: auto 75%;
        background-color: #ffffff;
        box-shadow: 0 -2px 5px -2px #333;
        padding: 0.5rem 0.5rem 0.5rem 0.5rem;
        position: fixed;
        transition: all 0.5s ease-in-out;
        width: 100vw;
        z-index: 9;
        display: flex;
        width: 100%;
        padding-bottom: 65px;
    }

    .prompt.show {
        transition-delay: 3s;
        bottom: 0;
        opacity: 1;
    }

    .prompt.hide {
        bottom: -100%;
        opacity: 0;
    }
    .font-weight-bold {
        font-weight: 700!important;
    }

    .btn-group-sm>.btn, .btn-sm {
        padding: .25rem .5rem;
        font-size: .875rem;
        line-height: 1.5;
        border-radius: .2rem;
    }
    .btn-link {
        font-weight: 400;
        color: #007bff;
        background-color: transparent;
    }

    .btn-link:hover {
        color: #0056b3!important;
        text-decoration: none;
        background-color: transparent;
        border-color: transparent;
    }
    .text-right {
        text-align: right!important;
    }

</style>
<script>   
$(document).on("keydown", ":input:not(textarea)", function(event) {
    return event.key != "Enter";
}); 
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {        
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            // document.getElementById("nav_header").style.top = "0";
            document.getElementById("nav_bottom").style.bottom = "0";
        } else {
            // document.getElementById("nav_header").style.top = "-100px";
            document.getElementById("nav_bottom").style.bottom = "-100px";
        }
        prevScrollpos = currentScrollPos;
    }
</script>
<div id="prompt" style="display: flex;" class="prompt hide bg-light border-top">
    <div><img src="img/logo_56.png" style="max-height: 80px;"></div>
    <div style="margin-left: 15px;width: 100%;margin-top: 15px;">
        <div class="font-weight-bold">Añadir App al Inicio</div>
        <small>Puedes instalar un acceso directo a la app</small>
        <div class="text-right">
            <button id="buttonCancel" type="button"
                class="font-weight-bold text-muted btn-sm btn btn-link">CANCELAR</button>
            <button id="buttonAdd" type="button"
                class="font-weight-bold text-primary btn-sm btn btn-link">AÑADIR</button>
        </div>
    </div>
</div>

<div class="fixed-header" id="nav_header">
    <div class="header-container">
        <a href="#" class="cancelar" id="backbtn">{include file="$base/img/backbtn.svg" }</a>        
    </div>
    <div style="max-width:100px;width:100px;margin:7px;position:absolute;left:40px;">
        <img src="/img/logo_ingreso.png" style="max-height: 30px;"  alt="Autorizador" >        
    </div>
    <div style="max-width:360px;width:360px;margin:10px;font-size:larger;font-weight:bold;position:absolute;left:85px;">        
        <span>Autorizador Online - </span>
    </div>
    <div style="max-width:200px;width:200px;margin:10px;font-size:larger;font-weight:bold;position:absolute;left:275px;">        
        {$active|default:''}
    </div>    
    <div style="max-width:300px;width:auto;margin:13px;position:absolute;right:15px;">
        <img src="/img/perfil.png" width="16" height="16" style="margin-right:5px;padding-top:2px;"  alt="User" >{$nomusuario|upper|default:''}
    </div>

</div>

<div class="wrapper-container" id="div_principal">
    {$msg|default:''}