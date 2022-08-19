<?php

class Catalog extends Controller{
    
    public function __construct() {
        parent::__construct();     
    }
    
    public function show_list($section = '') {        
        if ( $section != '' ){
            
        }
        $data = $this->model->getList();
        ///
        ///
        ///
        $this->view->data = $data;
        $this->view->render(strtolower(get_class($this)).'/show_list');
    }
}

?>
