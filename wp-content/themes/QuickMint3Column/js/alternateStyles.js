/* alternateStyles.js */

var altStyles = {
	switchers : Array,			// @Array: all Elements with className of 'altCss'
	allStyleSheets : Array,		// @Array: collection of all <link> element objects
	currentStyle : '',			// @String: 'href' attribute of last set style sheet
	currentStyleName : '',		// @String: name of last set style sheet
	cssSyntax : null,			// @RegExp: replaces '_' in href with ' ' whitespace.
	init : function() {
		if ( !document.getElementById ) return;
		this.switchers = document.getElementsByClassName('altCss');
		this.cssSyntax = /_/g;
		this.allStyleSheets = document.getElementsByTagName('link');
		var switchersLen = this.switchers.length;
		var i;
		for ( i=0;i<switchersLen;i++ ) {
			addEvent(this.switchers[i],'click',this.styleSwitcher);
			// Cancel Click for Safari
			this.switchers[i].onclick = function() { return false; }
		}
	},
	styleSwitcher : function(e) {
		altStyles.currentStyle = this.href;
		if ( window.event ) {
			window.event.cancelBubble = true;
			window.event.returnValue = false;
		} else if ( e.stopPropagation ) {
			e.stopPropagation();
			e.preventDefault();
		}
		altStyles.currentStyleName = altStyles.getStyleName(altStyles.currentStyle);
		var params = 'cssJaxy=true';
		var cssJax = new Ajax.Request(altStyles.currentStyle, {method: 'get', parameters: params, onComplete:altStyles.activeStyleSheet});
		return false;
	},
	getStyleName : function(str) {
		var styleHalves = str.split('?css=');
		return styleHalves[1].replace(this.cssSyntax,' ');
	},
	activeStyleSheet : function(title) {
		var title = altStyles.currentStyleName;
		var i, a, main;
		for( i=0; (a = document.getElementsByTagName("link")[i]); i++) {
			if ( a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title") ) {
				a.disabled = true;
				if ( a.getAttribute("title") == title ) {
					a.disabled = false;
				}
			}
		}
	}
};

function altStylesLoader() {
	altStyles.init();
}

addEvent(window,'load',altStylesLoader);