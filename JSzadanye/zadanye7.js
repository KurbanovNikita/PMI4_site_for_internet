var elem = document.getElementById('input');
elem.addEventListener('blur', func);

function func() {
	var elem = document.getElementById('input');
	var count = 0;
	if (elem.value != 0) {
		var str = elem.value;
		var arr = str.split(' ');
		for (var i = 0; i < arr.length; i++) {
			if (arr[i] != 0) {
				count += 1;
			}
		}
		var newElem = document.getElementById('result');
		newElem.innerHTML = "Количество слов в предложении: " + count;
	}
	if (elem.value == 0) {
		elem.placeholder = "Введите текст";
	}
}