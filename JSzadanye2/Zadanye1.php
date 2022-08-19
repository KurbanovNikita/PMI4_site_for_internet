<!DOCTYPE html>

<html>
    <head>
        <title>JavaScript2 - первое задание</title>
        <meta charset="UTF-8">
        
    </head>
    <body>
        <div>
            <p>Дана ссылка. Дан чекбокс. По нажатию на ссылку меняется состояние чекбокса с отмеченного на неотмеченное и наоборот.</p>
            <a id="link">Нажми на меня!!! Что-то произойдет</a>
            <input id="checkIt" type="checkbox">
        </div>
    <script>
        var elem = document.getElementById('link');
        elem.addEventListener('click', func);
        function func() {
            var elem1 = document.getElementById('checkIt');
            if (elem1.checked) {
                elem1.checked = false;
            }
            else {
                elem1.checked = true;
            }
        }
    </script>
    </body>
</html>