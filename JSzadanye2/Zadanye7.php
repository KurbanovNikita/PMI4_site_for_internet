<!DOCTYPE html>

<html>
    <head>
        <title>JavaScript2 - седьмое задание</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div>
            <p>В инпут через запятую вводятся страны. По нажатию на кнопку все страны записываются в ul под инпутом (каждая страна отдельный li)</p>
            <div>
                <input id = "inp" type = "text" value = "" placeholder = "Введите страны через запятую">
                <button id="task">НАЖИМАЙ!</button>
                <ul id="list"></ul>
            </div>
    <script>
        var elem = document.getElementById('task');
        elem.addEventListener('click', func);
        
        function func() {
            var elem1 = document.getElementById('inp');
            var newUl = document.getElementById('list');
            var arr = elem1.value.split(',');
            newUl.innerHTML = '';
            if (elem1.value != 0) {
                for (var i = 0; i < arr.length; i++) {
                    var li = document.createElement('li');
                    li.innerHTML = arr[i];
                    newUl.appendChild(li);
                }
            }
            else {
                elem1.placeholder = "Введите страны через запятую";
            }
        }
    </script>
    </body>
</html>