jQuery(function(){
	
	// Display data
	jQuery.get('siak_dashboard/siak_xhrGetListings', function(o){		
		for (var i = 0; i < o.length; i++) {
			jQuery('#listInsert').append('<div>' + o[i].text + ' ' + o[i].text2 + ' <a class = "delete" rel = "'+ o[i].id +'" href = "#" >Delete</a> </div> ');
		};

		// Delete Data
		jQuery('.delete').on('click',function(){
			delItem = jQuery(this);
			var id = jQuery(this).attr('rel');
			jQuery.post('siak_dashboard/siak_xhrDeleteListings', {'id' : id}, function(o){
				delItem.parent().remove();
			});

		});

	}, 'json');
 

	// Insert data
	jQuery('#randomInsert').submit(function(){
		var url  = jQuery(this).attr('action');
		var data = jQuery(this).serialize();
		jQuery.post(url, data, function(o){
			jQuery('#listInsert').append('<div>' + o.text + ' ' + o.text2 + ' <a class = "delete" rel = "'+ o.id +'" href = "#" >Delete</a></div>');
		}, 'json');
		return false;
	});


});