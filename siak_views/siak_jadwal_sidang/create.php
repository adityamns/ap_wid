
<script>
	jQuery(document).ready(function() {
		
		jQuery.ajax({
            url: '<?php echo URL; ?>siak_ruang/getRuang',
            dataType: "json",
            success: function (list) {
                for (var i = 0; i < list.length; i++) {
				jQuery("#ruang").append("<option value='" + list[i].ruang_id + "'>" + list[i].nama_ruang + "</option>");
                }
            }
			});
		
			jQuery.ajax({
				url: '<?php echo URL; ?>siak_jadwal_proposal/search/<?php echo $this->tahunid; ?>/<?php echo $this->jenis; ?>',
				cache:false,
				dataType: jQuery(this).serialize(),
				success: function (html) {
						jQuery("#sip").html(html);
				
				
            }
		});
			var date=new Date();
			valtahun="<?php echo $this->tahun; ?>";
			valbulan="<?php echo $this->bulan; ?>";
			if(valtahun == '' && valbulan ==''){
				//alert('kosong2');
				var y = date.getFullYear();
				valtahun=y;
				valbulan=0;
			}
			else if(valtahun !='' && valbulan ==''){
				//alert('<?php echo $this->hariawl; ?>');
				valtahun="<?php echo $this->tahunawl; ?>";
				valbulan=parseInt(<?php echo $this->bulanawl; ?>)-1;
				valdate=<?php echo $this->hariawl; ?>;
			}
			else{
				//alert('ada');
				valtahun="<?php echo $this->tahun; ?>";
				valbulan="<?php echo $this->bulan; ?>";
			}
			
		
		
		jQuery('#sip').change(function() {
			
			var sip=jQuery('#sip').val();
			jQuery('#jadkul').fullCalendar('gotoDate',new Date(sip));
			jQuery('#jadkul').fullCalendar('changeView','agendaWeek');
			
        });

			
		jQuery('#jadtesis').fullCalendar({	
		
			defaultView:'agendaWeek',
			year:valtahun,
			month:valbulan,
			date:valdate,
			axisFormat: 'HH:mm',
			slotMinutes: 10,
			
			//day:7,
			header: {
				right: "month,agendaWeek,agendaDay",
				center:"title",
				left: "ojo"
			},
			eventRender: function(event, element) {
                    element.css('background-color', event.warna);    
            },
			firstDay:1,
			viewDisplay   : function(view) {
				var takebulan=view.start.getMonth();
				var taketahun=view.start.getFullYear();
				jQuery('#tahun').val(taketahun);
				 jQuery('#bulan').val(takebulan);
			},
			
			
			editable: true,
			events: '<?php echo URL; ?>siak_jadwal_sidang_tesis/load_jadwal/<?php echo $this->tahunid; ?>/<?php echo $this->jenis; ?>/<?php echo $this->prodi; ?>',
			
			allDayDefault: false,
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
			var view = jQuery('#jadtesis').fullCalendar('getView');
			start = jQuery.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
			end = jQuery.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
			if (allDay == false) {
				jQuery('#start').val(start);
				jQuery('#end').val(end);
				//document.getElementById("form-buat").reset();
				jQuery('#statediv').html('');
				jQuery('#variablegroup').html('');
				jQuery('#form_isian').modal('show');
				var link="<?php echo URL; ?>siak_jadwal_sidang_tesis/form/<?php echo $this->prodi ?>";
				form_action(link);
			}
			
			jQuery('#jadtesis').fullCalendar('unselect');
			 if(view.name == 'agendaWeek' && allDay == true){
					jQuery('#jadtesis').fullCalendar('gotoDate',new Date(start));
					jQuery('#jadtesis').fullCalendar('changeView','agendaDay');
			 }
			 else{
				jQuery('#jadtesis').fullCalendar('gotoDate',new Date(start));
				jQuery('#jadtesis').fullCalendar('changeView','agendaWeek');
			 }
			 
			},
			editable: true,
						eventDrop: function(event, delta, allDay) {
				 start = jQuery.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
				 end = jQuery.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
				jQuery.ajax({
							url: '<?php echo URL; ?>siak_jadwal_sidang_tesis/siak_edit_save/'+event.id,
							data: 'mulai='+ start +'&akhir='+ end ,
							type: "POST",
							success: function(json) {
							
			
							}
					});
			},
			eventResize: function(event) {
			 start = jQuery.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
			 end = jQuery.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
			 jQuery.ajax({
							url: '<?php echo URL; ?>siak_jadwal_sidang_tesis/siak_edit_save/'+event.id,
							data: 'mulai='+ start +'&akhir='+ end ,
							type: "POST",
							success: function(json) {
							
							}
					});
			},
			eventClick: function(event) {				 
					jQuery("#form_isian").modal('show');
					var link="<?php echo URL; ?>siak_jadwal_sidang_tesis/siak_form_edit/"+event.id;
					addModul(link);
					jQuery('#id').val(event.id);
					jQuery('#start').val(event.start);
					jQuery('#end').val(event.end);
					jQuery('#start').val(event.title);
				
				
				}
		});
		
			jQuery('#tanggal').datepicker({
				//var ada=2013;
				changeMonth: true,
				changeYear: true,
				defaultDate: new Date(<?php echo $this->tahunawl; ?>, parseInt(<?php echo $this->bulanawl; ?>)-1, <?php echo $this->hariawl; ?>),
				dateFormat: 'd MM, yy',
				minDate: new Date(<?php echo $this->tahunawl; ?>, parseInt(<?php echo $this->bulanawl; ?>)-1, <?php echo $this->hariawl; ?>),
				maxDate: new Date(<?php echo $this->tahunakhr; ?>, parseInt(<?php echo $this->bulanakhr; ?>)-1, <?php echo $this->hariakhr; ?>),
				
				onSelect: function(dateText,dp){
				jQuery('#jadtesis').fullCalendar('gotoDate',new Date(Date.parse(dateText)));
				jQuery('#jadtesis').fullCalendar('changeView','agendaWeek');
				
                            }
		});
                jQuery('#search').change(function(){
                                var date_search=$('#search').val();
                                alert(date_search);
				jQuery('#jadtesis').fullCalendar('gotoDate',new Date(date_search));
				jQuery('#jadtesis').fullCalendar('changeView','agendaWeek');
			});
                

		function getFormattedDate() {
			var day = 01;
			var month = 01;
			var year = 2013;
			return day + '-' + month + '-' + year;
		}
		function getFormattedyear() {
			var day = 01;
			var month = 01;
			var year = 2013;
			return year;
		}
		function year2() {
			var year = jQuery('#year').val();
			return year;
		}
				
		
	});
	
	// fancy();

</script>
	<input type="hidden" id="tahun" >
	<input type="hidden" id="bulan" >
	<input type="hidden" id="start" >
	<input type="hidden" id="id" >
	<input type="hidden" id="end" >
	<input type="hidden" id="title">
	<input type="hidden" id="tahun_id" value='<?php echo $this->tahunid; ?>'>
	<input type="hidden" id="prodi" value='<?php echo $this->prodi; ?>'>
			
			<div class="row-fluid">
					<div class="portlet box blue calendar">
						<div class="portlet-title">
							<div class="caption"><i class="icon-reorder"></i>Jadwal Sidang Tesis</div>
						</div>
						<div class="portlet-body light-grey">
							<div class="row-fluid">
								<div class="span3 responsive" data-tablet="span12 fix-margin" data-desktop="span8">
									<!-- BEGIN DRAGGABLE EVENTS PORTLET-->    
									<h3 class="event-form-title">Jadwal Tesis</h3>
									<div id="external-events">
									<form class="inline-form">
											<input type="text" class="form-control" name="tanggal_lahir" id="tanggal" value="<?php echo $value['tanggal_lahir']; ?>"><br />
											<div><a href="javascript:;" id="event_add" class="btn green">Cetak Jadwal</a></div>
									</form>
									
									</div>
									<!-- END DRAGGABLE EVENTS PORTLET-->            
								</div>
								<div class="span9">
									<div id="jadtesis" class="has-toolbar"></div>
								</div>
							</div>
							<!-- END CALENDAR PORTLET-->
						</div>
					</div>
				</div>
		
		<div id="form_isian" class="modal hide fade" data-width="450">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>TAMBAH JADWAL</h3>
			</div>
			<div id='form_action'></div>
			<input type="hidden"  id="id_prodi" value='<?php echo $this->prodi; ?>'>
		
	</div>
						
		<script type="text/javascript">
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
function form_action(link){
  $.ajax({
    url: link,
    success: function(data) {
      $('#form_action').html(data);
    }
  });
}

function simpan (link){
						var start = jQuery('#start').val();
							var end = jQuery('#end').val();
							var tahunid = jQuery('#tahun_id').val();
							var prodi = jQuery('#prodi').val();
															
							jQuery.ajax({
								 url: '<?php echo URL; ?>siak_jadwal_sidang_tesis/cek_ruang',
								 data: jQuery("#form-buat").serialize()+'&mulai='+ start +'&akhir='+end,
								 type: "POST",
								 success: function(data) {
										if(data!==''){								
											alert('Ruang sudah terpakai atau Penguji sudah terpakai');
										}
										else{
											
												jQuery.ajax({
													 url: '<?php echo URL; ?>siak_jadwal_sidang_tesis/siak_create',
													 data: jQuery("#form-buat").serialize()+'&mulai='+start+'&akhir='+end+'&tahun_id='+tahunid+'&prodi_id='+prodi,
													 type: "POST",
													 success: function(json) {
															//jQuery("#dialog-create").dialog("close");
															jQuery('#jadtesis').fullCalendar('refetchEvents');
															jQuery("#form_isian").modal("hide");
														 }
												});
							
										}
							  	
									 }
								});
						
}
function update_event(){
						var form=jQuery("#form-update").serialize();								
						var id = jQuery("#id").val();			
						var ruang = jQuery("#ruang").val();			
						var pengampu = jQuery("#dosen_pengampu").val();			
						
						//**Chech Ruang**\\
							jQuery.ajax({
								 url: '<?php echo URL; ?>siak_jadwal/cek_ruang',
								 data: 'mulai='+ start+'&ruang='+ruang+'&akhir='+end+'&doma='+pengampu,
								 type: "POST",
								 success: function(data) {
										var data=JSON.parse(data);
										
										
										if(data.cek_ruang!='KOSONG' || data.cek_dosen!='KOSONG' ){
											if(data.cek_ruang!='KOSONG'){
												alert('Ruang Sudah Terpakai');
											}
											else{
												alert('Dosen Sudah Terpakai');
											}
										}
										
										else{
											jQuery.ajax({
											 url: '<?php echo URL; ?>siak_jadwal/siak_edit_save/'+id,
											 data: form,
											 type: "POST",
											 success: function(json) {
													
												jQuery('#jadkul').fullCalendar('refetchEvents');
												jQuery("#form_isian").modal("hide");
													
												 }
											});
										}
									 }
								});
}
function hapus(){
var id=jQuery('#id').val();
						jQuery.ajax({
							url: '<?php echo URL; ?>siak_jadwal/siak_delete/'+id,
							data: 'id='+id,
							type: "POST",
							success: function(json) {
							alert("Berhasil Dihapus");
							jQuery('#jadkul').fullCalendar('refetchEvents');
						
							}
					});
						  jQuery('#form_isian').modal('hide');
}
			
			function getCoba(value) {
				var strURL = jQuery(value).attr('link');
				var prodi = document.getElementById('id_prodi').value;
				var semes = jQuery(value).val();
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
					req.open("GET", strURL+ "/" + prodi + "/" + semes, true);
					req.send(null);
				}
			}
			function getKurikulum(value) {
			
				var strURL = jQuery(value).attr('link');
				var val = jQuery(value).val();
				var req = getXMLHTTP();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							if (req.status == 200) {
									document.getElementById('statediv1').innerHTML=req.responseText;      
							} else {
								alert("There was a problem while using XMLHTTP:\n" + req.statusText);
							}
						}       
					}     
					req.open("GET", strURL+ "/" + val, true);
					req.send(null);
				}
			}
				<!-- *********************************** -->
		</script>