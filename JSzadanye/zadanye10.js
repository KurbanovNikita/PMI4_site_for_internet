var elem = document.getElementById('task');
elem.addEventListener('click', func);

function func() {
	var elem = document.getElementById('input');
	var newElem = document.getElementById('result');
	var currentYear = 2021;
        var diff = currentYear - elem.value;
	if (elem.value > currentYear) {
		newElem.innerHTML = "Будущее еще не наступило!";
	}
	else if ((diff % 10 == 1) && (diff % 100 != 11)) {
		newElem.innerHTML = "Пользователю " + diff + " год";
	}
	else if (diff % 10 > 1 && diff % 10 < 5 && (diff % 100 < 11 || diff % 100 > 14) ) {
		newElem.innerHTML = "Пользователю " + diff + " года";
	}
	else {
		newElem.innerHTML = "Пользователю " + diff + " лет";
	}
	if (elem.value == 0) {
		elem.placeholder = "Введите год рождения";
	}
}