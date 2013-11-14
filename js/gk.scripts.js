//
var page_loaded = false;
// animations
var elementsToAnimate = [];
//
window.addEvent('load', function() {
	//
	page_loaded = true;
	// smooth anchor scrolling
	new SmoothScroll(); 
	// style area
	if(document.id('gkStyleArea')){
		document.id('gkStyleArea').getElements('a').each(function(element,i){
			element.addEvent('click',function(e){
	            e.stop();
				changeStyle(i+1);
			});
		});
	}
	// font-size switcher
	if(document.id('gkTools') && document.id('gkMainbody')) {
		var current_fs = 100;
		var content_fx = new Fx.Tween(document.id('gkMainbody'), { property: 'font-size', unit: '%', duration: 200 }).set(100);
		document.id('gkToolsInc').addEvent('click', function(e){ 
			e.stop(); 
			if(current_fs < 150) { 
				content_fx.start(current_fs + 10); 
				current_fs += 10; 
			} 
		});
		document.id('gkToolsReset').addEvent('click', function(e){ 
			e.stop(); 
			content_fx.start(100); 
			current_fs = 100; 
		});
		document.id('gkToolsDec').addEvent('click', function(e){ 
			e.stop(); 
			if(current_fs > 70) { 
				content_fx.start(current_fs - 10); 
				current_fs -= 10; 
			} 
		});
	}
	// K2 font-size switcher fix
	if(document.id('fontIncrease') && document.getElement('.itemIntroText')) {
		document.id('fontIncrease').addEvent('click', function() {
			document.getElement('.itemIntroText').set('class', 'itemIntroText largerFontSize');
		});
		
		document.id('fontDecrease').addEvent('click', function() {
			document.getElement('.itemIntroText').set('class', 'itemIntroText smallerFontSize');
		});
	}
	// create the list of elements to animate
	document.getElements('.gkHorizontalSlideRightColumn').each(function(element, i) {
		elementsToAnimate.push(['animation', element, element.getPosition().y]);
	});
	
	document.getElements('.layered').each(function(element, i) {
		elementsToAnimate.push(['animation', element, element.getPosition().y]);
	});
	
	document.getElements('.gkPriceTableAnimated').each(function(element, i) {
		elementsToAnimate.push(['queue_anim', element, element.getPosition().y]);
	});
});
//
window.addEvent('scroll', function() {
	// menu animation
    /*
     JD: commenting this out to have a consistent navbar that slides down the
         the page, rather than have it show up after the user has scrolled
         down a full page length 
	if(page_loaded && document.getElement('body').hasClass('imageBg')) {
		// if menu is not displayed now
		if(window.getScroll().y > document.id('gkHeader').getSize().y && !document.id('gkMenuWrap').hasClass('active')) {
			document.id('gkHeaderNav').inject(document.id('gkMenuWrap'), 'inside');
			document.id('gkHeader').setProperty('class', 'gkNoMenu');
			document.id('gkHeader').getElement('div').setStyle('display', 'none');
			document.id('gkMenuWrap').setProperty('class', 'active');
		}
		//
		if(window.getScroll().y <= document.id('gkHeader').getSize().y && document.id('gkMenuWrap').hasClass('active')) {
			document.id('gkHeader').getElement('div').setStyle('display', 'block');
			document.id('gkHeaderNav').inject(document.id('gkHeader').getElement('div'), 'top');
			document.id('gkHeader').setProperty('class', '');
			document.id('gkMenuWrap').setProperty('class', '');
		}
	}
    */
	// animate all right sliders
	if(elementsToAnimate.length > 0) {		
		// get the necessary values and positions
		var currentPosition = window.getScroll().y;
		var windowHeight = window.getSize().y;
		
		//console.log(currentPosition + (windowHeight / 2.0));
		
		// iterate throught the elements to animate
		if(elementsToAnimate.length) {
			for(var i = 0; i < elementsToAnimate.length; i++) {
				if(elementsToAnimate[i][2] < currentPosition + (windowHeight / 1.5)) {
					// create a handle to the element
					var element = elementsToAnimate[i][1];
					// check the animation type
					if(elementsToAnimate[i][0] == 'animation') {
						//console.log('(XXX)' + elementsToAnimate[i][2]);
						gkAddClass(element, 'loaded', false);
						// clean the array element
						elementsToAnimate[i] = null;
					}
					// if there is a queue animation
					else if(elementsToAnimate[i][0] == 'queue_anim') {
						//console.log('(XXX)' + elementsToAnimate[i][2]);
						element.getElements('dl').each(function(item, j) {
							gkAddClass(item, 'loaded', j);
						});
						// clean the array element
						elementsToAnimate[i] = null;
					}
				}
			}
			// clean the array
			elementsToAnimate = elementsToAnimate.clean();
		}
	}
});
//
function gkAddClass(element, cssclass, i) {
	var delay = element.getProperty('data-delay');
	
	if(!delay) {
		delay = (i !== false) ? i * 150 : 0;
	}

	setTimeout(function() {
		element.addClass(cssclass);
	}, delay);
}
//
window.addEvent('domready', function() {
	//
	var menuwrap = new Element('div', {
		'id': 'gkMenuWrap'
	});
	//
	menuwrap.inject(document.getElement('body'), 'bottom');
	//
	if(!document.getElement('body').hasClass('imageBg')) {
		document.id('gkHeaderNav').inject(document.id('gkMenuWrap'), 'inside');
		document.id('gkHeader').setProperty('class', 'gkNoMenu');
		document.id('gkHeader').getElement('div').setStyle('display', 'none');
		document.id('gkMenuWrap').setProperty('class', 'active');	
	}
	//
	// some touch devices hacks
	//
	
	// hack modal boxes ;)
	document.getElements('a.modal').each(function(link) {
		// register start event
		var lasttouch = [];
		// here
		link.addEvent('touchstart', function() {
			lasttouch = [link, new Date().getTime()];
		});
		// and then
		link.addEvent('touchend', function() {
			// compare if the touch was short ;)
			if(lasttouch[0] == link && Math.abs(lasttouch[1] - new Date().getTime()) < 500) {
				window.location = link.getProperty('href');
			}
		});
	});
});
// function to set cookie
function setCookie(c_name, value, expire) {
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expire);
	document.cookie=c_name+ "=" +escape(value) + ((expire==null) ? "" : ";expires=" + exdate.toUTCString());
}
// Function to change styles
function changeStyle(style){
	var file1 = $GK_TMPL_URL+'/css/style'+style+'.css';
	var file2 = $GK_TMPL_URL+'/css/typography/typography.style'+style+'.css';
	var file3 = $GK_TMPL_URL+'/css/typography/typography.iconset.style'+style+'.css';
	new Asset.css(file1);
	new Asset.css(file2);
	new Asset.css(file3);
	Cookie.write('gk_simplicity_j25_style', style, { duration:365, path: '/' });
}

// animate on init
window.addEvent('load', function() {
    if(elementsToAnimate.length > 0) {      
        // get the necessary values and positions
        var currentPosition = window.getScroll().y;
        var windowHeight = window.getSize().y;
        // iterate throught the elements to animate
        if(elementsToAnimate.length) {
        	for(var i = 0; i < elementsToAnimate.length; i++) {
        		if(elementsToAnimate[i][2] < currentPosition + (windowHeight / 1.5)) {
        			// create a handle to the element
        			var element = elementsToAnimate[i][1];
        			// check the animation type
        			if(elementsToAnimate[i][0] == 'animation') {
        				//console.log('(XXX)' + elementsToAnimate[i][2]);
        				gkAddClass(element, 'loaded', false);
        				// clean the array element
        				elementsToAnimate[i] = null;
        			}
        			// if there is a queue animation
        			else if(elementsToAnimate[i][0] == 'queue_anim') {
        				//console.log('(XXX)' + elementsToAnimate[i][2]);
        				element.getElements('dl').each(function(item, j) {
        					gkAddClass(item, 'loaded', j);
        				});
        				// clean the array element
        				elementsToAnimate[i] = null;
        			}
        		}
        	}
        	// clean the array
        	elementsToAnimate = elementsToAnimate.clean();
        }
    }
});
