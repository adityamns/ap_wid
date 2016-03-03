// jQuery.noConflict();

var option = {
	dateFormat: jQuery.datepicker.ATOM
};

// jQuery(function() {
// 	jQuery( "#tabs" ).tabs({
// 		beforeLoad: function( event, ui ) {
// 			ui.jqXHR.error(function() {
// 				ui.panel.html("Couldn't load this tab. We'll try to fix this as soon as possible.");
// 			});
// 		}
// 	});
// });



jQuery(function() {
	var index = 'key';
	var dataStore = window.sessionStorage;
	try {
		var oldIndex = dataStore.getItem(index);
	} catch(e) {
		var oldIndex = 0;
	}
	jQuery('#tabs').tabs({
		active : oldIndex,
		activate : function( event, ui ){
			var newIndex = ui.newTab.parent().children().index(ui.newTab);
			dataStore.setItem( index, newIndex ) 
		}
	}); 
});



function deleteThisVar(obj){
	obj.parentNode.parentNode.removeChild(obj.parentNode);
}
function deleteThisVarNew(obj){
	console.log(obj.parentNode.parentNode.parentNode.parentNode.parentNode);
	obj.parentNode.parentNode.parentNode.parentNode.parentNode.removeChild(obj.parentNode.parentNode.parentNode.parentNode);
}


// function asd(){
	// jQuery('#mahasiswa').dataTable();
	// jQuery('#dosen').dataTable();
	// jQuery('#fakultas').dataTable();
	// jQuery('#matakuliah').dataTable();
	// jQuery('#ruang').dataTable();
	// jQuery('#jenis_matkul').dataTable();
	// jQuery('#kurikulum').dataTable();
	// jQuery('#prodi').dataTable();
	// jQuery('#predikat').dataTable();
	// jQuery('#pegawai').dataTable();
	// jQuery('#tahun_akademik').dataTable();
	// jQuery('#universitas').dataTable();
	// jQuery('#aturan_nilai').dataTable();
	// jQuery('#badan_hukum').dataTable();
	// jQuery('#prodidikti').dataTable();
	// jQuery('#pendidikan').dataTable();
	// jQuery('#jenis_ruang').dataTable();
	// jQuery('#gedung').dataTable();
	// jQuery('#dosenmatakuliah').dataTable();
	// jQuery('#topik').dataTable();
	// jQuery('#users').dataTable();
	// jQuery('#grupe').dataTable();
	// jQuery('#role').dataTable();
	// jQuery('#setKurikulum').dataTable();
	// jQuery('#modul').dataTable();
	// jQuery('#tampil_cuti').dataTable();
	// jQuery('#materi_pembekalan').dataTable();
	// jQuery('#pengampu_pembekalan').dataTable();
	// jQuery('#pembekalan').dataTable();
	// jQuery('#topik_pembekalan').dataTable();
	// jQuery('#atur_pembekalan').dataTable();
	// jQuery('#cohort').dataTable();
	// jQuery('#aktivasi_pembekalan').dataTable();
// }

function fancyClose(){
	jQuery.fancybox.close();
}

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

function getValue(value) {
	var strURL = "<?php echo URL;?>siak_matakuliah/kurikulum"+value;
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {            
					document.getElementById('statediva').innerHTML=req.responseText;
					askDelete();
					fancy();
				} else {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}
		}
		req.open("GET", strURL, true);
		req.send(null);
	}
}

function getKurikulum(value) {
	var strURL = jQuery(value).attr('link');
	var val = jQuery(value).attr('value');
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('statediv').innerHTML=req.responseText;            
				} else {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}       
		}     
		req.open("GET", strURL+ "/" + val, true);
		req.send(null);
	}
}

function getKurikulum2(value) {
	var strURL = jQuery(value).attr('link');
	var val = jQuery(value).attr('value');
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('statedivs').innerHTML=req.responseText;            
				} else {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}       
		}     
		req.open("GET", strURL+ "/" + val, true);
		req.send(null);
	}
}

function getMatkul(value) {
	var strURL = jQuery(value).attr('link');
	var val = jQuery(value).attr('value');
	var semester = document.getElementById('semester').value;
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('statediv').innerHTML=req.responseText;            
				} else {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}       
		}     
		req.open("GET", strURL + "/" + val + "/" + semester, true);
		req.send(null);
	}
}

function add(value){
// 	var nim = document.getElementById('nim').value;
// 	var semester = document.getElementById('semester').value;
	var url = $(value).attr('link');
	var strURL = url;
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('add').innerHTML=req.responseText;
				} else {
					alert("Mohon lengkapi semua isian...");
				}
			}       
		}     
		req.open("GET", strURL, true);
		req.send(null);
	}

}

function getTopik(value){
	var strURL = jQuery(value).attr('link');
	var val = jQuery(value).attr('value');
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('statedivs').innerHTML=req.responseText;            
				} else {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}       
		}     
		req.open("GET", strURL + "/" + val, true);
		req.send(null);
	}
}


function irs(value){
	var nim = document.getElementById('nim').value;
	var semester = document.getElementById('semester').value;
	var url = jQuery(value).attr('link');
	var strURL = url+"/"+nim+"/"+semester;
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('irs').innerHTML=req.responseText;
					askDelete();
					fancy();
				} else {
					alert("Mohon lengkapi semua isian...");
				}
			}       
		}     
		req.open("GET", strURL, true);
		req.send(null);
	}

}

function ikhs(value){
	var nim = document.getElementById('nim').value;
	var url = jQuery(value).attr('link');
	var strURL = url+"/"+nim;
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('ikhs').innerHTML=req.responseText;
// 					askDelete();
// 					fancy();
				} else {
					alert("Mohon lengkapi semua isian...");
				}
			}       
		}     
		req.open("GET", strURL, true);
		req.send(null);
	}

}

function askDelete(){
	jQuery(document).ready(function() {
		jQuery('.ask-plain').click(function(e) {
			e.preventDefault();
			thisHref = $(this).attr('href');
			if (confirm('Anda Yakin ?')) {
				window.location = thisHref;
			}
		});
		jQuery('.ask-custom').jConfirmAction({question: "Anda Yakin?", yesAnswer: "Ya", cancelAnswer: "Tidak"});
		jQuery('.ask').jConfirmAction();
	});
}

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
			.addClass( "form-control" )
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