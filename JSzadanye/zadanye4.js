var elem = document.getElementById('num');
elem.addEventListener('blur', func);

function func() {
	var sum = 0;
	var str = elem.value;
	var arr = str.split(',');
	for (var i = 0; i < arr.length; i++) {
		sum += +arr[i];
	}
	var newElem = document.getElementById('result');
	newElem.innerHTML = sum/arr.length;
}