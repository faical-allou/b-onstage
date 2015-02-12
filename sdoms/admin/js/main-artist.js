$(function(){
	//init menu
	init_menu(menu_id);

	//init datatable
	$('#artist-list').dataTable( {
		'sDom': "<'row-fluid'<'span6'T><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
		"fnDrawCallback": function () {
				//init delete artist
			$('.delete-artist').click(function(){
				artist_id = $(this).data('artist-id');
				$.ajax({
					url 		: '/artist/delete',
					dataType	: 'json',
					type		: 'post',
					data		: {
						artist_id	: artist_id
					},
					success		: function(data){
						console.log(data);
						location.reload(false);
					}
				});

			});
		}
	});
});