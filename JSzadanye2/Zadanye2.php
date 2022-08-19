<!DOCTYPE html>

<html>
    <head>
        <title>JavaScript2 - второе задание</title>
        <meta charset="UTF-8">
        
    </head>
    <body>
        <div>
            <p>Даны чекбокс. Дана кнопка. По нажатию на кнопку все чекбоксы будут отмеченными</p>
            <button id="buton">КНОПКА</button>
            <input class="checkIt" type="checkbox">
            <input class="checkIt" type="checkbox">
            <input class="checkIt" type="checkbox">
            <input class="checkIt" type="checkbox">
            <input class="checkIt" type="checkbox">
        </div>
    <script>
        var elem = document.getElementById('buton');
        elem.addEventListener('click', func);
        function func() {
            var elem1 = document.getElementsByClassName('checkIt');
            for (var i = 0; i < elem1.length; i++) {
                elem1[i].checked = true;
            }
        }
    </script>
    </body>
</html>