(function( $ ){		

	//les variables	
	var parent;
	var user_id;
	var user_state;
	
	var methods = {		
		//initialisation 
		init : function(options){		
			return this.each(function() { 				
				
				parent = $(this);
				user_id = options.user_id;
				user_state = options.user_state;					
				
				/********** INIT PAGE MUSIC **********/
				$('#content-sound').sound('init', {user_id : user_id, user_state : user_state});								
				
				/********** INIT PAGE VIDEO **********/		
				$('#content-video').video('init', {user_id : user_id, user_state : user_state});

				/********** INIT PAGE PHOTO**********/
				$('#content-photo').photo('init', {user_id : user_id, user_state : user_state});
						
			});	
		}	
	};
	
  $.fn.media = function( method ) {

    if ( methods[method] ) {
      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
    } 
  };
})( jQuery );
//FIN PLUGIN MEDIA



