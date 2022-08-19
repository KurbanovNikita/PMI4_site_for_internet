<?
use Libs\App;
?>
<!DOCTYPE html>

<html>
    
    <head>
        <script>
            window.BASE_DIR_AJAX = "<?=BASE_DIR_AJAX?>";
            window.BASE_DIR = "<?=ADMIN_PREFIX?>"
        </script>
        <title>
            <?=$this->getTitle();?>
        </title>
        <meta charset = "UTF-8"/>
        <meta name = "viewport" content = "width=device-width, initial-scale=1">
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="<?=TEMPLATE_ADMIN_PATH?>/css/bootstrap.min.css?<?=rand()?>" rel="stylesheet"/>
        <link href="<?=TEMPLATE_ADMIN_PATH?>/css/datepicker3.css?<?=rand()?>" rel="stylesheet"/>
        <link href="<?=TEMPLATE_ADMIN_PATH?>/css/font-awesome.min.css?<?=rand()?>" rel="stylesheet"/>
        <link href="<?=TEMPLATE_ADMIN_PATH?>/css/styles.css?<?=rand()?>" rel="stylesheet"/>
        <link href="<?=TEMPLATE_ADMIN_PATH?>/style.css?<?=rand()?>" rel="stylesheet"/>
        <link href="<?=MAIN_PREFIX?>/app/css/preloader08.css?<?=rand()?>" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <script src="<?=TEMPLATE_ADMIN_PATH?>/script.js?<?=rand()?>"></script>
        
        <?if (isset($this->addjs)):?>
            <script type="text/javascript" src="<?=$this->addjs?>?<?=rand()?>"></script>
        <?endif?>
        <?if (isset($this->addcss)):?>
            <link type="stylesheet" href="<?=$this->addcss?>?<?=rand()?>">
        <?endif?>
            
        <!-- Подключение текстового редактора-->
        <script
            type="text/javascript"
            src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js'
            referrerpolicy="origin">
        </script>
        <script type="text/javascript">
            tinymce.init({
                selector: '#news_text',
                plugins: [
                    'advlist autolink link image lists charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                    'table emoticons template paste help'
                ],
                toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
                        'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                        'forecolor backcolor emoticons | help | tablecellvalign',

                menubar: 'favs file edit view insert format tools table help',

            });
        </script>
        
    </head>
    
    <body>

        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span></button>
                        <a class="navbar-brand" href="<?=MAIN_PREFIX."/"?>"><span>НАЙФ</span>ПРОМБЫТ</a>
                    
                </div>
            </div><!-- /.container-fluid -->
        </nav>
        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="profile-sidebar">
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"><?= \Libs\User::getLogin()?></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="divider"></div>
            <ul class="nav menu">
                <li class="<?= App::getCurPage() == ADMIN_PREFIX.'/' ? "active": ""?>"><a href="<?=MAIN_PREFIX?>/admin/"><em class="fa fa-dashboard">&nbsp;</em>Админ панель</a></li>
                <li class="<?= App::getCurPage() == ADMIN_PREFIX.'/sections/' ? "active": ""?>"><a href="<?=MAIN_PREFIX?>/admin/sections/"><em class="glyphicon glyphicon-briefcase">&nbsp;</em> Категории товаров</a></li>
                <li class="<?= App::getCurPage() == ADMIN_PREFIX.'/category/' ? "active": ""?>"><a href="<?=MAIN_PREFIX?>/admin/category/"><em class="glyphicon glyphicon-briefcase">&nbsp;</em> Категории новостей</a></li>
                <li class="<?= App::getCurPage() == ADMIN_PREFIX.'/products/' ? "active": ""?>"><a href="<?=MAIN_PREFIX?>/admin/products/"><em class="glyphicon glyphicon-trash">&nbsp;</em> Товары</a></li>
                <li class="<?= App::getCurPage() == ADMIN_PREFIX.'/news/' ? "active": ""?>"><a href="<?=MAIN_PREFIX?>/admin/news/"><em class="glyphicon glyphicon-bookmark">&nbsp;</em> Новости</a></li>
                <li><a href="<?=MAIN_PREFIX?>/reg/logout/"><em class="fa fa-power-off">&nbsp;</em>Выйти</a></li>
            </ul>
        </div><!--/.sidebar-->
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                            <em class="fa fa-home"></em>
                        </a></li>
                    <li class="active"><?=$this->getTitle();?></li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?=$this->getTitle();?></h1>
                </div>
            </div><!--/.row-->