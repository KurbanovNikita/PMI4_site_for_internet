var elem = document.getElementById('task2');
elem.addEventListener('click', func);
var elem1 = document.getElementsByClassName('num');

function func() {
    
    var sum = 0;
    for (var i=0; i < elem1.length; i++)
    {
        sum += +elem1[i].value;
    }
    var newElem = document.getElementById('result');
    newElem.innerHTML = sum;
}