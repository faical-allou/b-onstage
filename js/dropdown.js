(function( $ ){	
	var methods = {

		init : function(options){
			return this.each(function() {				
				var elem = $(this);
				
				//event click
				elem.on('click', function(event){	
					$('.wrapper-dropdown').removeClass('active');
					$(this).toggleClass('active');
					event.stopPropagation();
				});
				
				$(document).on('click', function(event){
					if(elem.hasClass('active'))					
						elem.removeClass('active');
				});
				
			});	
		}	
	};

$.fn.dropdown = function( method ) {

	if ( methods[method] ) {
	return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
	} else if ( typeof method === 'object' || ! method ) {
	return methods.init.apply( this, arguments );
	} else {
	$.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
	}
};
})( jQuery );