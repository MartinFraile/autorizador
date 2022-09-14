
<?php

class Smarty_Whal extends Smarty
{

    public function __construct()
    {

        // Class Constructor.
        // These automatically get set with each new instance.

        parent::__construct();

        $this->setTemplateDir('templates/');
        $this->setCompileDir('templates_c/');
        $this->setConfigDir('configs/');
        $this->setCacheDir('cache/');
        $this->assign('menu', isset($_SESSION['menu']) ? $_SESSION['menu'] : '');
        $this->assign('nomusuario', isset($_SESSION['nomope']) ? $_SESSION['nomope'] : '');
        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        $this->assign('base', HOMEDIR);
        $this->assign('app_name', 'Sistema Autorizador');
    }

}
