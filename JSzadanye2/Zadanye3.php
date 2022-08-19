<!DOCTYPE html>

<html>
    <head>
        <title>JavaScript2 - третье задание</title>
        <meta charset="UTF-8">
        
    </head>
    <body>
        <div>
            <p>Спросить у пользователя какой язык (html, css, js, php) он знает с помощью радио кнопочек. Выведите этот язык в абзац.</p>
            <form>
                <p>Какой язык вы знаете? Выбрите:</p>
                <div>
                    <input id="button" type="radio" name="language" value="HTML">
                    <label>HTML</label>
                    <input id="button" type="radio" name="language" value="css">
                    <label>css</label>
                    <input id="button" type="radio" name="language" value="JavaScript">
                    <label>JavaScript</label>
                    <input id="button" type="radio" name="language" value="php">
                    <label>php</label>
                </div>
                <p id="result"></p>
            </form>
        </div>
    <script>
        var elem = document.getElementsByName('language');
        for (var i = 0; i < elem.length; i++) {
            elem[i].addEventListener('click', func);
        }
        function func() {
            var newElem = document.getElementById('result');
            for (var i = 0; i < elem.length; i++) {
                if (elem[i].checked == true) {
                    newElem.innerHTML = "Вы знаете язык: " + elem[i].value;
                }
            }  
        }
    </script>
    </body>
</html>