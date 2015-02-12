$(function(){
	//init menu
	init_menu(menu_id);

	//init datatable
	$('#stage-list').dataTable( {
		'sDom': "<'row-fluid'<'span6'T><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>"
	});

	//init delete stage
	$('.delete-stage').click(function(){
		stage_id = $(this).data('stage-id');
		$.ajax({
			url 		: '/stage/delete',
			dataType	: 'json',
			type		: 'post',
			data		: {
				stage_id	: stage_id
			},
			success		: function(data){
				console.log(data);
				location.reload(false);
			}
		});

	});

});