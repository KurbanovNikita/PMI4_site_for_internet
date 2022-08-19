<? require_once DIR_PATH_APP.'/views/header.php'?>

<h1>
    Привет <?if (Libs\User::isLogin()):?><?=Libs\User::getLogin()?><?else:?>Всем!<?endif;?>
</h1>
<br/>

<div class="about_main_container">
    <h2>Последние новости</h2>
    <div class="last_news">
        <?if (is_array($this->arResult["NEWS"])):?>
        <div class="myContainer">
            <div class="row">
            <?
                foreach($this->arResult["NEWS"] as $news){?>
                    <div class="news_content"> 
                        <a href="<?=MAIN_PREFIX?>/news/?<?=$news["id"]?>">
                            <div class="news_item_content">
                                <div class="news_title">
                                    <?= $news["title"] ?>
                                </div>
                                <div class="row">
                                    <div class="news_img col-2">
                                        <?= strlen($news["p_img"]) > 0 ? "<img src='" . MAIN_PREFIX . "/upload/{$news["p_img"]}' width='100px'/>" : "" ?>
                                    </div>
                                    <div class="news_description col-8">
                                        <p>
                                            <?= $news["description"] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="news_date">
                                    <p>
                                        <?= substr($news["date"],0,-9) ?>
                                    </p>
                                </div>

                            </div>
                        </a>

                    </div>
                <?}?>
                </div>
            </div>
        <?endif;?>
    </div>
    <div class="about_paragraph">
        <h2>Кто мы</h2>
        <div class="about_text">
        <p>Мы любим ножи больше всего на свете, мы одержимы ножами.</p>
        <p>Мы знаем всё о металле, о сталях, о технологиях, о заточке и полировке, о том, что такое качество и высокий стиль.</p>
        <p>Мы фанатики ножевого дела, которые стремятся быть лучше всех, быть круче всех.</p>
        <p>Мы перфекционисты, для которых важна каждая деталь и совершенство во всем без исключения.</p>
        <p>Мы НАЙФПРОМБЫТ - команда профессионалов, создающих ножи HI-end качества, уникального дизайна.</p>
        </div>
        
    </div>

    <div class="about_img"><img src="<?= MAIN_PREFIX ?>/upload/НАЙФПРОМБЫТ.jpg"></div>
    <div class="about_paragraph">
        <h2>Что мы делаем</h2>
        <div class="about_text">
            <p>Мы творим и созидаем.</p>
        <p>От эскиза до 3Д модели, от 3Д модели до прототипа, от прототипа до серийной модели - мы все делаем сами, не поручая никому нашу работу. Наши ножи - это наша философия. У нас есть собственное представление о том, каким должен быть идеальный нож - тонко сведённый клинок, твёрдая сталь, правильная геометрия, лёгкий вес и прецизионное качество в каждой детали.</p>
        <p>Мы гордимся нашими ножами, потому что в каждый нож и в каждую линейку мы вложили всё, что у нас есть, включая нашу душу.</p>
        <p>Вы поймёте, почему ножи НАЙФПРОМБЫТ лучше режут, почему они удобнее, как только возьмёте их в руку.</p>
        <p>Идеальный баланс, фантастическая острота.</p>
        <p>90% нашего производства - это ручной труд. Абсолютно все ножи НАЙФПРОМБЫТ заточены вручную на мокрых камнях.</p>
        <p>Прецизионность во всем - это главный принцип нашего производства.</p>
        <p>Покупая нож НАЙФПРОМБЫТ, вы получаете максимальный cutting performance.</p>
        </div>
        
    </div>



</div>

<? require_once DIR_PATH_APP.'/views/footer.php'?>
