<select name="{$id_opt_btn}" id="{$id_opt_btn}" class="form-control form-control-sm" {$esrequerido|default}>
    {if $primeritem|default !== "vacio"}
    <option value="">{$primeritem|default:'Seleccionar'}</option>
    {/if}
    {html_options options=$options selected=$datos.$id_opt_btn|default:'0' }    
</select>



  

  
