var elem = document.getElementById('input');
elem.addEventListener('blur', func);

function func() {
	var elem = document.getElementById('input');
	var newElem = document.getElementById('input');
	var newStr = "";
	if (elem.value != 0) {
		var arr = elem.value.split('.');
		if (arr.length != 3) {
			alert("введена не корректная дата");
		}
		else {
			for (var i = 2; i >= 0; i--) {
				if (arr[i] != 0) {
					if (i == 0 && arr[i] < 32) {
						if (arr[i] > 0 && arr[i] < 10 && arr[i].length == 1) {
							newStr += "0" + arr[i];
						}
						else {
							newStr += arr[i][arr[i].length - 2] + arr[i][arr[i].length - 1];
						}
					}
					else if (i == 1 && arr[i] < 13) {
						if (arr[i] > 0 && arr[i] < 10 && arr[i].length == 1) {
							newStr += "0" + arr[i] + "-";
						}
						else{
							newStr += arr[i][arr[i].length - 2] + arr[i][arr[i].length - 1] + "-";
						}
					}
					else if (i == 2){
						newStr += arr[i] + "-";
					}
				}
			}
			if (newStr.length < 7 || newStr.length > 10) {
				alert("введена не корректная дата");
				newElem.value = "";
			}
			else {
				newElem.value = newStr;
			}
		}
	}
	if (elem.value == 0) {
		elem.placeholder = "Введите дату дд.мм.гггг";
	}
}