<? require_once $_SERVER['DOCUMENT_ROOT'].'/phpWorks/mvc/views/header.php'?>

<?php 

foreach ($this->data['LIST'] as $sections) {
    echo $sections.'<br/>';
}

?>

<? require_once $_SERVER['DOCUMENT_ROOT'].'/phpWorks/mvc/views/footer.php'?>

