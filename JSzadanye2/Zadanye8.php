<!DOCTYPE html>

<html>
    <head>
        <title>JavaScript2 - восьмое задание</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div>
            <p>По умолчанию есть список стран (ul), по нажатию на страну внутри li со страной появляется список городов</p>
            <div>
                <ul id="countriesList">
                    <li class="countrie" title="russia">Россия
                        <ul id="russia" hidden>
                            <li>Москва</li>
                            <li>Санкт-Петербург</li>
                            <li>Нижний Новгород</li>
                            <li>Воронеж</li>
                            <li>Краснодар</li>
                            <li>Екатеринбург</li>
                            <li>Сургут</li>
                        </ul>
                    </li>
                    <li class="countrie" title="china">Китай
                        <ul id="china" hidden>
                            <li>Пекин</li>
                            <li>Чунцин</li>
                            <li>Шанхай</li>
                            <li>Гуанчжоу</li>
                            <li>Баодин</li>
                        </ul>
                    </li>
                    <li class="countrie" title="canada">Канада
                        <ul id="canada" hidden>
                            <li>Оттава</li>
                            <li>Монреаль</li>
                            <li>Калгари</li>
                            <li>Торонто</li>
                            <li>Эдмонтон</li>
                        </ul>
                    </li>
                    <li class="countrie" title="kazahstan">Казахстан
                        <ul id="kazahstan" hidden>
                            <li>Нур-Султан</li>
                            <li>Караганда</li>
                            <li>Атырау</li>
                            <li>Жезказган</li>
                            <li>Алматы</li>
                        </ul>
                    </li>
                </ul>
            </div>
    <script>
        var elem = document.getElementsByClassName('countrie');
        for (var i = 0; i < elem.length; i++) {
            elem[i].addEventListener('click', func);
        }
        
        function func() {
            var elem1 = document.getElementById(event.target.title);
            if (elem1.hidden == true) {
                elem1.hidden = false;
            }
            else
            {
                elem1.hidden = true;
            }
        }
    </script>
    </body>
</html>