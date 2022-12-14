<?php

namespace Libs;

class Components {
    public $params;
    public $arResult = array();
    
    public function __construct($name, $template, $param) {
        $this->params["COMPONENT_NAME"] = $name;
        $this->params["COMPONENT_TEMPLATE"] = $template;
        $this->params = array_merge($param, $this->params);
    }
    
    public function executeComponent() {
        
    }
    
    public function includeTemplate($name = 'default'){
        $template_path = __DIR__.'/../components/'.$this->params["COMPONENT_NAME"].'/templates/'.$name.'/template.php';
        $css_path = '/'.$this->params["COMPONENT_NAME"].'/templates/'.$name.'/style.css';
        $js_path = '/'.$this->params["COMPONENT_NAME"].'/templates/'.$name.'/script.js';
        if (file_exists($template_path)) {
            $arResult = $this->arResult;
            require $template_path; // не require_once, потому что может быть необходимо подключать не один раз
        
            if (file_exists(__DIR__.'/../components'.$css_path)) {
                \Libs\App::addHeaderCss($css_path);
            }
            if (file_exists(__DIR__.'/../components'.$js_path)) {
                \Libs\App::addHeaderJs($js_path);
            }
        } else {
            \Libs\App::showError("Template $name does not exists");
        }
    }
}
