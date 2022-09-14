{include file="file:./header.tpl" }
<style type="text/css">
 .big-btn{
 	display: block;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
	background: #002d5b21;
	width: 50%;
	margin: auto;
	margin-bottom: 10px;
	padding-bottom: 15px;
	text-decoration: none;
 	color: black; 
 	text-transform: uppercase;
 } 
 .big-btn:hover{
	background: #002d5b52;
 }
 }
</style>
{section name=item loop=$datos}
<a class="big-btn" href="{$datos[item].script}">
    <br/>
    {$datos[item].descripcion}
</a>
{/section}

{include file="file:./bottom_nav_afil.tpl" }
<script type="text/javascript">
	var navItems = $("#{$active|default:"Home"}");
	navItems.addClass("mobile-bottom-nav__item--active");
</script>