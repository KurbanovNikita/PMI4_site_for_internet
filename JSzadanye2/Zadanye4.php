<!DOCTYPE html>

<html>
    <head>
        <title>JavaScript2 - четвертое задание</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div>
            <p>Дан чекбокс. Дан инпут. Если чекбокс отмечен - инпут видимый, если не отмечен - не видимый</p>
            <form>
                <input id="check" type="checkbox">
                <input id = "inp" type = "text" placeholder = "Инпут">
            </form>
        </div>
    <script>
        var elem = document.getElementById('check');
        elem.addEventListener('click', func);
        function func() {
            elem1 = document.getElementById('inp');
            if (elem.checked == true) {
                elem1.type = "hidden";
            }
            else {
                elem1.type = "text";
            }
        }
    </script>
    </body>
</html>