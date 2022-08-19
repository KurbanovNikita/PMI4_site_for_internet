<!DOCTYPE html>

<html>
    <head>
        <title>JavaScript2 - десятое задание</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div>
            <p>Калькулятор валют. Есть два селекта - селект с исходной валюты, селект с той валютой, в которую мы хотим перевести деньги, инпут, в который вводится сумма для обмена. Курсы валют храните в массиве. В селектах нельзя выбрать две одинаковых валюты. </p>
            <div>
                <select id="from" name="startCurrency">
                    <option class="startCurrency" value="rub" selected>Рубль</option>
                    <option class="startCurrency" value="uan">Юань</option>
                    <option class="startCurrency" value="cnd">Канадский доллар</option>
                    <option class="startCurrency" value="tng">Тенге</option>
                </select>
                <select id="to" name="endCurrency">
                    <option class="endCurrency" value="rub" hidden>Рубль</option>
                    <option class="endCurrency" value="uan" selected>Юань</option>
                    <option class="endCurrency" value="cnd">Канадский доллар</option>
                    <option class="endCurrency" value="tng">Тенге</option>  
                </select>
                <input id = "inp" type = "text" value = "" placeholder = "Введите сумму">
                <p id="result"></p>
            </div>
    <script>
        var elem1 = document.getElementById('from');
        var elem2 = document.getElementById('to');
        var elem3 = document.getElementById('inp');
        elem1.addEventListener('change', func1);
        elem3.addEventListener('blur', func2);

        function func1() {
            var elem = document.getElementById('to');
            for (var i = 0; i < elem.length; i++) {
                if (elem[i].value == elem1.value) {
                    elem[i].hidden = true;
                    elem[i].selected = false;
                }
                else {
                    elem[i].hidden = false;
                }
            }
        }
        
        rate = [[1, 0.089, 0.017, 5.95],
            [11.23, 1, 0.19, 66.70],
            [57.82, 5.16, 1, 343.85],
            [0.17, 0.015, 0.0029, 1]];
        
        function func2() {
            var elem1 = document.getElementById('from');
            var elem2 = document.getElementById('to');
            var res = document.getElementById('result');
            if (elem3.value != 0) {
                res.innerHTML = "Конвертация: " + 
                        elem3.value * rate[elem1.selectedIndex][elem2.selectedIndex] 
                        + " " + elem2.options[elem2.selectedIndex].text;
            } 
        }
    </script>
    </body>
</html>