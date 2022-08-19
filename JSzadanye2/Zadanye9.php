<!DOCTYPE html>

<html>
    <head>
        <title>JavaScript2 - девятое задание</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div>
            <p>Даны два селекта. В первом находятся страны, во втором - города. Когда выбирается определенная страна - в другом селекте появлялись города этой страны. В абзаце ниже отображается выбранная страна и город через запятую</p>
            <div>
                <select id="countries" name="countries">
                    <option class="countries" value="russia">Россия</option>
                    <option class="countries" value="china">Китай</option>
                    <option class="countries" value="canada">Канада</option>
                    <option class="countries" value="kazahstan">Казахстан</option>
                </select>
                <select id="cities" name="cities">
                    <option hidden>Выбертите город</option>
                    
                    <option class="russia" hidden>Москва</option>
                    <option class="russia" hidden>Санкт-Петербург</option>
                    <option class="russia" hidden>Нижний Новгород</option>
                    <option class="russia" hidden>Воронеж</option>
                    <option class="russia" hidden>Краснодар</option>
                    <option class="russia" hidden>Екатеринбург</option>
                    <option class="russia" hidden>Сургут</option>
                    
                    <option class="china" hidden>Пекин</option>
                    <option class="china" hidden>Шанхай</option>
                    <option class="china" hidden>Гуанчжоу</option>
                    <option class="china" hidden>Баодин</option>
                    <option class="china" hidden>Чунцин</option>
                    
                    <option class="canada" hidden>Оттава</option>
                    <option class="canada" hidden>Монреаль</option>
                    <option class="canada" hidden>Калгари</option>
                    <option class="canada" hidden>Торонто</option>
                    <option class="canada" hidden>Эдмонтон</option>
                    
                    <option class="kazahstan" hidden>Нур-Султан</option>
                    <option class="kazahstan" hidden>Караганда</option>
                    <option class="kazahstan" hidden>Атырау</option>
                    <option class="kazahstan" hidden>Жезказган</option>
                    <option class="kazahstan" hidden>Алматы</option>
                    
                </select>
                
                <p id="result"></p>
            </div>
    <script>
        var elem = document.getElementById('countries');
        elem.addEventListener('change', func);
        elem.addEventListener('change', func2);
        
        var elem2 = document.getElementById('cities');
        elem2.addEventListener('change', func2);
        
        function func() {
            var elem1 = document.getElementById('cities');
            for (var i = 0; i < elem1.length; i++) {
                if (elem1[i].className == elem.value) {
                    elem1[i].hidden = false;
                }
                else {
                    elem1[i].hidden = true;
                }
            }
        }
        
        function func2() {
            var r = document.getElementById('result');
            r.innerHTML = "Страна: " + elem.options[elem.selectedIndex].text + 
                    "   Город: " + elem2.options[elem2.selectedIndex].text;
        }
    </script>
    </body>
</html>