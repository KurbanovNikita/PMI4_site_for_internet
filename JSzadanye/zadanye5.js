var elem = document.getElementById('input');
elem.addEventListener('focus', func);
elem.addEventListener('blur', func2);

function func() {
	elem.placeholder = '';
}

function func2() {
	var elem = document.getElementById('input');
	var elems = document.getElementsByClassName('name');
	if (elem.value !== 0) {
		var str = elem.value;
		var arr = str.split(' ');
		for (var i = 0; i < arr.length; i++) {
			elems[i].value = arr[i];
		}
	}
	if (elem.value == 0) {
		elem.placeholder = 'Введите ФИО';
		for (var i = 0; i < elems.length; i++) {
			elems[i].value = '';
		}
	}
}