<!DOCTYPE html>

<html>
    <head>
        <title>JavaScript2 - шестое задание</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div>
            <p>Дан абзац. Даны чекбоксы 'перечеркнуть', 'сделать жирным', 'сделать красным'. Если соответствующий чекбокс отмечен - заданное действие происходит с абзацем (становится красным, например). Если чекбоксу снять отметку - действие отменяется</p>
            <form>
                <p id="result">Этот текст невозможно изменить!!!</p>
                <input class="checkIt" type="checkbox" value="crossOut">
                <lable>Перечеркнуть</lable>
                <input class="checkIt" type="checkbox" value="bold">
                <lable>Сделать жирным</lable>
                <input class="checkIt" type="checkbox" value="color">
                <lable>Сделать красным</lable>
            </form>
        </div>
    <script>
        var elem = document.getElementsByClassName('checkIt');
        for (var i = 0; i < elem.length; i++) {
            elem[i].addEventListener('click', func);
        }
        function func() {
            elem1 = document.getElementById('result');
            for (var i = 0; i < elem.length; i++) {
                if (elem[i].checked == true) {
                    if (elem[i].value == "crossOut") {
                        elem1.style = "text-decoration:line-through;"    
                    }
                    else if (elem[i].value == "bold") {
                        elem1.style.fontWeight = "bold";
                    }
                    else {
                        elem1.style.color = "red";
                    }
                }
                else {
                    if (elem[i].value == "crossOut") {
                        elem1.style = "text-decoration:none"    
                    }
                    else if (elem[i].value == "bold") {
                        elem1.style.fontWeight = "none";
                    }
                    else {
                        elem1.style.color = "none";
                    }
                }
                
            }
        }
    </script>
    </body>
</html>