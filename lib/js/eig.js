/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 var _eig_page = 1;
 var _eig_selector = '#main #content';
 var _eig_prev;
 var _eig_bottom;
 var _eig_loading = false;
 
(function() {
	var $ = jQuery;
	
	$(window).scroll(function(){
		var top = $(window).scrollTop();
		var docheight = $(document).height();
		var diff = docheight - $(window).height();
		var _eig_bottom = diff - top;
		
		if (docheight > 0) {
			var scrollper = _eig_bottom/docheight;
		} else {
			var scrollper = 0;
		}
		
		if(_eig_prev > _eig_bottom) {
			if  (scrollper < .10){
				if(_eig_loading == false) {
					_eig_getMore();
				}
			}
		}
		_eig_prev = _eig_bottom;
	});
})(jQuery);

function _eig_getMore() {
	var $ = jQuery;
	_eig_loading = true;
	_eig_page += 1;
	$.ajax({
		url: 'index.php?eig&page='+_eig_page,
		cache: false,
		success: function(html){
			_eig_callback(html);
		}
	});
}

function _eig_callback(html) {
	var $ = jQuery;
	console.log('loading page ' + _eig_page);
	$(_eig_selector).append(html);
	_eig_loading = false;
}