function getXMLHTTP(){
	var xmlhttp=false;  
	try{
		xmlhttp=new XMLHttpRequest();
	}
	catch(e){
		try{
			xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e){
			try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e1){
				xmlhttp = false;
			}
		}
	}
	return xmlhttp;
}
function getBobot(value){
		var link = $(value).attr('url');
			$.ajax({
					url: link,
					success: function(data) {
								$('#formBobot').html(data);
							}
				});
	}function getAturan(value){
		var link = $(value).attr('url');
			$.ajax({
					url: link,
					success: function(data) {
								$('#formAturan').html(data);
							}
				});
	}function getPredikat(value){
		var link = $(value).attr('url');
			$.ajax({
					url: link,
					success: function(data) {
								$('#formPredikat').html(data);
							}
				});
	}
function deleteThisVar(obj){
	obj.parentNode.parentNode.removeChild(obj.parentNode);
}

function add(value){
  var link = $(value).attr('link');
  $.ajax({
    url: link,
    success: function(data) {
      $('#add').html(data);
    }
  });
}

function edit(value){
  var link = $(value).attr('link');
  $.ajax({
    url: link,
    success: function(data) {
      $('#edit').html(data);
    }
  });
}


//Siak Modul

function addModul(value){
  var link = $(value).attr('link');
  $.ajax({
    url: link,
    success: function(data) {
      $('#addModul').html(data);
    }
  });
}

function editModul(value){
  var link = $(value).attr('link');
  $.ajax({
    url: link,
    success: function(data) {
      $('#editModul').html(data);
    }
  });
}

////END Siak Modul

//Siak Grup

function addGrup(value){
  var link = $(value).attr('link');
  $.ajax({
    url: link,
    success: function(data) {
      $('#addGrup').html(data);
    }
  });
}

function editGrup(value){
  var link = $(value).attr('link');
  $.ajax({
    url: link,
    success: function(data) {
      $('#editGrup').html(data);
    }
  });
}

///END Siak Grup

//Siak Users

function addUsers(value){
  var link = $(value).attr('link');
  $.ajax({
    url: link,
    success: function(data) {
      $('#addUsers').html(data);
    }
  });
}

function editUsers(value){
  var link = $(value).attr('link');
  $.ajax({
    url: link,
    success: function(data) {
      $('#editUsers').html(data);
    }
  });
}

//SIAK KEGIATAN
function getPengumuman(value){
  var strURL = $(value).attr('link');
  var val = $(value).attr('value');
  
  // 		alert(strURL+" "+val)
  $.ajax({
    url: strURL + '/' + val,
    success: function(res){
      $('#getpengumuman').html(res);
    }
  });
}

///END Siak Users

// AutoComp
function autoCom(){
(function( jQuery ) {
	jQuery.widget( "custom.combobox", {
		_create: function() {
			this.wrapper = jQuery( "<span>" )
			.addClass( "custom-combobox" )
			.insertAfter( this.element );
			this.element.hide();
			this._createAutocomplete();
			this._createShowAllButton();
		},
		_createAutocomplete: function() {
			var selected = this.element.children( ":selected" ),
			value = selected.val() ? selected.text() : "";
			this.input = jQuery( "<input>" )
			.appendTo( this.wrapper )
			.val( value )
			.attr( "title", "" )
			.addClass( "m-wrap span12" )
			.autocomplete({
				delay: 0,
				minLength: 0,
				source: jQuery.proxy( this, "_source" )
			})
			.tooltip({
				tooltipClass: "ui-state-highlight"
			});
			this._on( this.input, {
				autocompleteselect: function( event, ui ) {
					ui.item.option.selected = true;
					this._trigger( "select", event, {
						item: ui.item.option
					});
				},
				autocompletechange: "_removeIfInvalid"
			});
		},
		_createShowAllButton: function() {
			var input = this.input,
			wasOpen = false;
			jQuery( "<a>" )
			.attr( "tabIndex", -1 )
			.attr( "title", "Show All Items" )
			.tooltip()
			.appendTo( this.wrapper )
			.button({
				icons: {
					primary: "ui-icon-triangle-1-s"
				},
				text: false
			})
			.removeClass( "ui-corner-all" )
			.addClass( "custom-combobox-toggle ui-corner-right" )
			.mousedown(function() {
				wasOpen = input.autocomplete( "widget" ).is( ":visible" );
			})
			.click(function() {
				input.focus();
// Close if already visible
if ( wasOpen ) {
	return;
}
// Pass empty string as value to search for, displaying all results
input.autocomplete( "search", "" );
});
		},
		_source: function( request, response ) {
			var matcher = new RegExp( jQuery.ui.autocomplete.escapeRegex(request.term), "i" );
			response( this.element.children( "option" ).map(function() {
				var text = jQuery( this ).text();
				if ( this.value && ( !request.term || matcher.test(text) ) )
					return {
						label: text,
						value: text,
						option: this
					};
				}) );
		},
		_removeIfInvalid: function( event, ui ) {
// Selected an item, nothing to do
if ( ui.item ) {
	return;
}
// Search for a match (case-insensitive)
var value = this.input.val(),
valueLowerCase = value.toLowerCase(),
valid = false;
this.element.children( "option" ).each(function() {
	if ( jQuery( this ).text().toLowerCase() === valueLowerCase ) {
		this.selected = valid = true;
		return false;
	}
});
// Found a match, nothing to do
if ( valid ) {
	return;
}
// Remove invalid value
this.input
.val( "" )
.attr( "title", value + " didn't match any item" )
.tooltip( "open" );
this.element.val( "" );
this._delay(function() {
	this.input.tooltip( "close" ).attr( "title", "" );
}, 2500 );
this.input.data( "ui-autocomplete" ).term = "";
},
_destroy: function() {
	this.wrapper.remove();
	this.element.show();
}
});
})( jQuery );
jQuery(function() {
	jQuery( "#combobox" ).combobox();
	jQuery( "#toggle" ).click(function() {
		jQuery( "#combobox" ).toggle();
	});
});

}