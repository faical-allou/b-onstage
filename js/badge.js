(function( $ ){
	
	var badge;		
	var counter;	
	var color;
	var settings;
	
	var methods = {
	
		init : function(options){		
			return this.each(function() { 												
				
				/*****INIT VARS*****/
				var defaults = {
					'checkbox' : false
				};
				settings = $.extend({}, defaults, options);				
				badge = $(this);												
					
				/*****COUNTER*****/
				$('<div/>',{
					html : badge.data('counter'),
					'class' : 'ui-badge-counter ui-' + badge.data('color') + ' ui-state-default ui-corner-left'
				}).appendTo(badge);
				
				/*****RENDER*****/			
				badge.addClass('ui-badge');	
				if(settings.checkbox)
					badge.children('input:checkbox').button();
				else
					badge.children('button').button();
					
				badge.badge('_marge');		
					
				/*****EVENT*****/
				badge.change(function(){
					$(this).children('.ui-badge-counter').toggleClass('ui-state-active');					
				});
				
			});				
		},		
		_marge : function(){
			return this.each(function() {
				var marge = (parseInt(counter) > 9) ? '3.2em' : '2.7em'; 
				badge.find('.ui-button').css('padding-left', marge);														
			});
		}
		
	};
	
  $.fn.badge = function( method ) {

    if ( methods[method] ) {
      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
    } 
  };
})( jQuery );