var elem = document.getElementById('input');
elem.addEventListener('blur', func);

function func() {
	var elem = document.getElementById('input');
	var maxIndex = 0;
	var maxLength = 0;
	if (elem.value != 0) {
		var str = elem.value;
		var arr = str.split(' ');
		for (var i = 0; i < arr.length; i++) {
			if (arr[i] != 0) {
				if (arr[i].length > maxLength) {
					maxIndex = i;
					maxLength = arr[i].length;
				}
			}
		}
		var newElem = document.getElementById('result');
		newElem.innerHTML = "В самом длинном слове '" + arr[maxIndex] + "' " + maxLength + " символов";
	}
	if (elem.value == 0) {
		elem.placeholder = "Введите текст";
	}
}