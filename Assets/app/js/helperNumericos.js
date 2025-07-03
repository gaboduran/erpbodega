function trim(myString) {
	return myString.replace(/^\s+/g, '').replace(/\s+$/g, '')
}

function devuelve_float(num, prefix) {
	num = Math.round(parseFloat(num) * Math.pow(10, 2)) / Math.pow(10, 2)
	prefix = prefix || '';
	num += '';
	var splitStr = num.split('.');
	var splitLeft = splitStr[0];
	var splitRight = splitStr.length > 1 ? '.' + splitStr[1] : '.00';
	splitRight = splitRight + '00';
	splitRight = splitRight.substr(0, 3);
	var regx = /(\d+)(\d{3})/;
	var mmdev = trim(prefix + ' ' + splitLeft + splitRight);
	if (mmdev == "NaN.00" || mmdev == "NaN")
		mmdev = "0.00";
	return mmdev;
}
