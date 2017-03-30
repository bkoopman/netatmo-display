function addOrUpdateUrlParam(key, value) {
	var url = window.location.href;
	var title = document.title;
	var stateObj = { "html": document.documentElement.outerHTML, "pageTitle": title };
	var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"), hash;

	if (re.test(url)) {
		if (typeof value !== 'undefined' && value !== null) {
			window.history.pushState(stateObj, title, url.replace(re, '$1' + key + "=" + value + '$2$3'));
		} 
		else {
			hash = url.split('#');
			url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
			if (typeof hash[1] !== 'undefined' && hash[1] !== null) {
				url += '#' + hash[1];
			}
			window.history.pushState(stateObj, title, url);
		}
	} 
	else {
		if (typeof value !== 'undefined' && value !== null) {
			var separator = url.indexOf('?') !== -1 ? '&' : '?';
			hash = url.split('#');
			url = hash[0] + separator + key + '=' + value;
			if (typeof hash[1] !== 'undefined' && hash[1] !== null) {
				url += '#' + hash[1];
			}
			window.history.pushState(stateObj, title, url);
		} 
		else {
			window.history.pushState(stateObj, title, url);
		}
	}
}
