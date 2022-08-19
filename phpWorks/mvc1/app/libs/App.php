<?
namespace Libs;

class App {
    public static $headerCss = array();
    public static $headerJS = array();
    public static $prefix;
    
    public function __construct( $prefix  = '/' ) {
        
        self::$prefix = $prefix;
        
        $get_url = isset($_GET['url']) ? htmlspecialchars($_GET['url']) : false; // isset проверяет на существование
        if ( $get_url ){
            $url = explode("/", rtrim($get_url, "/"));
        }else{
            $url[] = "index";
        }
        
        $file_controller = __DIR__.'/..'.$prefix.'controllers/'.$url[0].'Controller.php';
        // /../ - говорит выйти из папки назад
        
        if (file_exists($file_controller)){ // сущ. ли по данному пути файл?
            require_once $file_controller;
            
            $class_name = $url[0]."Controller";
            //App::dump($url);
            if (class_exists($class_name)){
                $controller = new $class_name($prefix);
                
                if ( isset( $url[1]) ){
                    if (method_exists($controller, $url[1]))
                    {
                        if ( isset($url[2]) ) {
                            $controller->{$url[1]}($url[2]);   
                        }
                        else {
                            $controller->{$url[1]}();
                        }
                    }
                    else {
                        self::showError('Error! Method does not exists!!!'.$url[0].$url[1]);
                    }
                } else {
                    $controller -> index();
                }
                
            } else {
                echo 'Error! Controler Class does not exists!!!';
            }
            
            
        } else {
            self::showError('Error! Controller dose not exists!!!') ;
        }
    }
    
    public static function showError($error) {
        echo $error;
    }
    
    static function dump($param) {
        echo '<pre style="backgreound-color: #eee; padding:10px;">';
        var_dump($param);
        echo '</pre>';
    }
    
    static function getCurPage($params = false){
        $url = $_SERVER["REQUEST_URI"];
        if (!$params && strpos($url, "?")) {
            $url = substr($url, 0, strpos($url, "?"));
        }
        
        $url = str_replace("index.php", "", $url);
        
        return $url;
    }
    
    static function includeComponent($name, $template = 'default', $params = array()){
        
        $file_path = __DIR__.'/../components/'.$name.'/class.php';
        
        if (file_exists($file_path)) {
            require_once $file_path;
            $class_name = 'Components\\'.$name;
            $component = new $class_name($name, $template, $params);
            $component->executeComponent();
        } else {
            self::showError("Component does not exists");
        }
    }
    
    static function addHeaderCss($path){
        self::$headerCss[] = COMPONENTS_PATH.$path;
    }
    
    static function addHeaderJs($path){
        self::$headerJS[] = COMPONENTS_PATH.$path;
    }
    
    static function finish($buffer) {
        $css_links = '';
        $js_src = '';
        foreach (self::$headerCss as $css) {
            $i = rand();
            $css_links .= "<link rel='stylesheet' href='$css?$i'> \n";
        }
        foreach (self::$headerJS as $js) {
            $i = rand();
            $js_src .= "<script src='$js?$i'></script> \n";
        }
        $buffer = str_replace(array("<--#ADD_CSS_PATH#-->","<--#ADD_JS_PATH#-->"), array($css_links,$js_src), $buffer);
        echo $buffer;
    }
    
    public static function getController($name){
        $file_controller = __DIR__.'/..'.self::$prefix.'controllers/'.$name.'Controller.php';
        //var_dump($file_controller);
        if (file_exists($file_controller)){ // сущ. ли по данному пути файл?
            require_once $file_controller;
            $class_name = $name."Controller";
            return $class_name::getInstance(self::$prefix);
        } else {
            return false;
        }
    }
}