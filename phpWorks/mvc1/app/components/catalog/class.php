<?php
namespace Components;
use Libs\App;

class catalog extends \Libs\Components{
    
    public function executeComponent(){
        if ($section = App::getController('sections')) {
            $this->arResult["SECTIONS"] = $section->getList();
        }
        if ($products = App::getController('products')) {
            $this->arResult["PRODUCTS"] = $products->getList();
        }
        $this->includeTemplate();
    }
    

}
