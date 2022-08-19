<!DOCTYPE html>

<html>
    <head>
        <title>JavaScript2 - пятое задание</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div>
            <p>Даны чекбоксы. Под каждым чекбоксом размещен абзац. Если чекбокс отмечен - соответствующий абзац видимый, а если не отмечен - не видимый.</p>
            <form>
                <input class="checkIt" type="checkbox" value="1">
                <p id="1">Абзац 1</p>
                <input class="checkIt" type="checkbox" value="2">
                <p id="2">Абзац 2</p>
                <input class="checkIt" type="checkbox" value="3">
                <p id="3">Абзац 3</p>
                <input class="checkIt" type="checkbox" value="4">
                <p id="4">Абзац 4</p>
                <input class="checkIt" type="checkbox" value="5">
                <p id="5">Абзац 5</p>
            </form>
        </div>
    <script>
        var elem = document.getElementsByClassName('checkIt');
        for (var i = 0; i < elem.length; i++) {
            elem[i].addEventListener('click', func);
        }
        function func() {
            for (var i = 0; i < elem.length; i++) {
                if (elem[i].checked == true) {
                    document.getElementById(elem[i].value).hidden = true;
                }
                else
                {
                   document.getElementById(elem[i].value).hidden = false; 
                }
            }
        }
    </script>
    </body>
</html>