<?php
namespace Components;
use Libs\App;

class publications extends \Libs\Components{
    
    public function executeComponent(){
        if ($category = App::getController('category')) {
            $this->arResult["CATEGORIES"] = $category->getList();
        }
        if ($news = App::getController('news')) {
            $this->arResult["NEWS"] = $news->getList();
        }
        $this->includeTemplate();
    }
    

}
