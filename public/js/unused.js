let widthArray = [];
widthArray.push({'index': index, 'width': width});
widthArray = widthArray.sort(function(a, b){return a.width - b.width});
let sortedWidthArray = [];
let wrapper = $('#home-gallery-container');
sortArray(widthArray, wrapper.width(), sortedWidthArray);
let items = wrapper.children('.home-gallery-entry-container');

//items.detach(); if arr doesn't reuse all items
wrapper.append($.map(sortedWidthArray, function(v) {
	return items[v]
}));
function sortArray(array, requiredValue, newArray) {
	console.log(requiredValue);
	let minDifference = 0;
	let value = 0;
	let isBreak = false;

	if (array.length > 1) {
		value = array[0].width;
		minDifference = Math.abs(requiredValue - value)

		for (let i = 1; i < array.length; i++) {
			if (value == requiredValue) {
				newArray.push(array[i].index);
				array.splice(i, 1);
				isBreak = true;
				break;
			} else if (Math.abs(requiredValue - array[i].width) > minDifference) {
				newArray.push(array[i - 1].index);
				array.splice(i - 1, 1);
				isBreak = true;
				break;
			} else {
				value = array[i].width;
				minDifference = Math.abs(requiredValue - value);
			}
		}
	} else {
		newArray.push(array[0].index);
		return;
	}

	if (!isBreak) {
		newArray.push(array[array.length - 1].index);
		array.splice(array.length - 1, 1);
	}

	console.log("req value: " + (requiredValue - value));
	console.log("array[0]: " + array[0].width);
	if ((requiredValue - value) > 0 &&
			array[0].width < (requiredValue - value)) {
		sortArray(array, (requiredValue - value), newArray);
	} else {
		sortArray(array, $('#home-gallery-container').width(), newArray);
	}
}
