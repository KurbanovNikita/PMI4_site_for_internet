var elem = document.getElementById('input');
elem.addEventListener('blur', func);

function func() {
	var elem = document.getElementById('input');
	var newStr = "";
	if (elem.value != 0) {
		var str = elem.value;
		var arr = str.split(' ');
		for (var i = 0; i < arr.length; i++) {
			if (arr[i] != 0) {
				arr[i] = arr[i][0].toUpperCase() + arr[i].slice(1);
				newStr += arr[i] + " ";
			}
		}
		var newElem = document.getElementById('input');
		newElem.value = newStr;
	}
	if (elem.value == 0) {
		elem.placeholder = "Введите ФИО";
	}
}