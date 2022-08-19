<?
    use Libs\App;
    
    require_once __DIR__.'/../app/libs/Bootstrap.php';
    
    if (Libs\User::isLogin() && Libs\User::isAdmin()) {
        $app = new App('/admin/');
    } else {
        // Если пользователь не авторизован и если он не админ, то у него не будет доступа к данной странице и он будет переадресован на главную
        header("location: ".MAIN_PREFIX.'/');
    }
    
?>