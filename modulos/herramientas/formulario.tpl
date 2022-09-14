{include file="file:../../tpl/headers.tpl"}
<head>
    <title>
        Dashboard
    </title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-163606301-1">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'UA-163606301-1');
    </script>
</head>
<link href="/{$rootDir}/css/familiar.css" rel="stylesheet"/>
<link href="/{$rootDir}/css/familiar_responsivo.css" rel="stylesheet"/>
<style>.main-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(265px, 1fr));
    /* Where the magic happens */
    /*grid-auto-rows: 94px;*/
    grid-gap: 20px;
    margin: 20px;
}
.overviewcard {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    background-color: #d3d3;
}
</style><style type="text/css">.card {
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .14), 0 3px 1px -2px rgba(0, 0, 0, .2), 0 1px 5px 0 rgba(0, 0, 0, .12);
    margin-bottom: 15px;
    margin-top: 15px;
    font-size: .875rem;
}
.card-stats .card-header.card-header-icon, .card-stats .card-header.card-header-text {
    text-align: right;
    border-bottom: none;
    background: transparent;
    z-index: 3!important;
}
.card [class*=card-header-] {
    margin: 0 15px;
    padding: 0;
    position: relative;
}
.card [class*=card-header-] .card-icon, .card [class*=card-header-] .card-text {
    border-radius: 3px;
    background-color: #999;
    padding: 15px;
    margin-top: -20px;
    margin-right: 15px;
    float: left;
    box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 10px -5px #2CA2FF;
    background-color: #2CA2FF;
}
.card-stats .card-header .card-category:not([class*=text-]) {
    color: #999;
    font-size: 14px;
}
.card-stats .card-header .card-icon+.card-category, .card-stats .card-header .card-icon+.card-title {
    padding-top: 10px;
    margin: 0;
}
.card .card-title {
    margin-top: .625rem;
    margin-bottom: .75rem;
}
.card-title, .card-title a, .footer-big h4, .footer-big h4 a, .footer-big h5, .footer-big h5 a, .footer-brand, .footer-brand a, .info-title, .info-title a, .media .media-heading, .media .media-heading a, .title, .title a {
    color: #3c4858;
    text-decoration: none;
}
.card-stats .card-header+.card-footer {
    border-top: 1px solid #eee;
    margin-top: 20px;
}
.card .card-footer {
    padding: .75rem 1.25rem;
    background-color: #fff;
    border-top: 1px solid #eee;
    display: flex;
    align-items: center;
    border: 0;
}
.stats{
    text-align: center;
    width: 100%;
    background: #2CA2FF;
    height: 30px;
    line-height: 30px;
    font-size: 16px;
    border-radius: 5px;
}
.stats a{
    color:white;
}
.stats i{
   margin-right: 10px;
}

</style>
<div class="main-overview">
    
    <div class="card card-stats">
        <div class="card-header card-header-icon">
            <div class="card-icon">
                <span style="font-size: 48px; color: white;">
                    <i class="fas fa-user-plus">
                    </i>
                </span>
            </div>
            <p class="card-category">
                Cuidadores
            </p>
            <h3 class="card-title">
               Total: {$datos.cuidadores|default}   <br>          
               Semana: {$datos.cuidadores_semana|default}
            </h3>
        </div>
        <div class="card-footer">
            <div class="stats">                
                <a href="/cuidados/cuidadores/listado.php"><i class="fas fa-list-ul">
                </i>
                    Listado
                </a>
            </div>
        </div>
    </div>
        <div class="card card-stats">
        <div class="card-header card-header-icon">
            <div class="card-icon">
                <span style="font-size: 48px; color: white;">
                    <i class="fas fa-user-check">
                    </i>
                </span>
            </div>
            <p class="card-category">
                Familiares
            </p>
            <h3 class="card-title">
                Total: {$datos.familiares|default}    <br>
                Semana: {$datos.familiares_semana|default}
            </h3>
        </div>
        <div class="card-footer">
            <div class="stats">                
                <a href="/cuidados/familiares/listado.php"><i class="fas fa-list-ul">
                </i>
                    Listado
                </a>
            </div>
        </div>
    </div>
        <div class="card card-stats">
        <div class="card-header card-header-icon">
            <div class="card-icon">
                <span style="font-size: 48px; color: white;">
                    <i class="fas fa-cart-plus">
                    </i>
                </span>
            </div>
            <p class="card-category">
                Pagos
            </p>
            <h3 class="card-title">
                Total: {$datos.pagos|default}   <br>
                Semana: {$datos.pagos_semana|default}
            </h3>
        </div>
        <div class="card-footer">
            <div class="stats">                
                <a href="#pablo"><i class="fas fa-list-ul">
                </i>
                    Listado
                </a>
            </div>
        </div>
    </div>
</div>
{include file="file:../../tpl/footer.tpl"}
