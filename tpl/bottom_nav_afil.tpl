<style type="text/css">
body {	 
	 padding-bottom: 50px;
}

.mobile-bottom-nav a{
    text-decoration: none;
    text-transform: uppercase;
    color: #555;

}
 .mobile-bottom-nav {
	 position: fixed;
	 bottom: 0;
	 left: 0;
	 right: 0;
	 z-index: 1000;
	 will-change: transform;
	 transform: translateZ(0);
	 display: flex;
	 height: 50px;
	 box-shadow: 0 -2px 5px -2px #333;
	 background-color: #fff;
}
 .mobile-bottom-nav__item {
 	flex: 1 1 0px;
	 flex-grow: 1;
	 text-align: center;
	 font-size: 12px;
	 display: flex;
	 flex-direction: column;
	 justify-content: center;
     background:  white;
}
 .mobile-bottom-nav__item--active  {
     background:  var(--primary-light-color);
}
 .mobile-bottom-nav__item--active a {
	 color: white;
}
 .mobile-bottom-nav__item--active svg {
	 fill: white;
}
 .mobile-bottom-nav__item-content {
	 display: flex;
	 flex-direction: column;
}
a>svg{
    width: 25px;
	margin: auto;   
	margin-bottom: 5px; 
	margin-top: 5px; 
	fill: #555;

}
 .mobile-bottom-nav__item--active>svg{   
	fill: var(--primary-light-color);

}
</style>
 </div> 
<nav class="mobile-bottom-nav" id="nav_bottom">
    {section name=item loop=$menu}       
    
        <div class="mobile-bottom-nav__item" id="{$menu[item].descripcion}">
            <div class="mobile-bottom-nav__item-content">
                <a href="{$menu[item].script}">
                     {include file="$base/img/{$menu[item].icono}.svg" }               

                    <br/>
                    {$menu[item].descripcion}
                </a>
            </div>
        </div> 

    {/section}
</nav>
