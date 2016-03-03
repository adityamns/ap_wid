
<script>
	jQuery(document).ready(function() {
	// $("#manualTrigger").click(function() {
                // $.confirm({
                    // text: "This is a confirmation dialog manually triggered! Please confirm:",
                    // confirm: function() {
                        // alert("You just confirmed.");
                    // },
                    // cancel: function() {
                        // alert("You cancelled.");
                    // }
                // });
            // });
		
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
				url: '<?php echo URL; ?>siak_jadwal/search/<?php echo $this->tahunid; ?>/<?php echo $this->jenis; ?>',
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
				//alert('kosong bulan');
				valtahun="<?php echo $this->tahun; ?>";
				valbulan=8;
			}
			else{
				//alert('ada');
				valtahun="<?php echo $this->tahun; ?>";
				valbulan="<?php echo $this->bulan; ?>";
			}
			//alert(valbulan);		
			jQuery('#sip').change(function() {
				var sip=jQuery('#sip').val();
				jQuery('#jadkul').fullCalendar('gotoDate',new Date(sip));
				jQuery('#jadkul').fullCalendar('changeView','agendaWeek');
			
			});

		jQuery('#jadkul').fullCalendar({	
		
			defaultView:'agendaWeek',
			year:getFormattedyear(),
			year:valtahun,
			month:valbulan,
			axisFormat: 'HH:mm',
			slotMinutes: 10,
			minTime:6,
			maxTime:24,
			timeFormat: {
							agenda: 'H:mm{ - H:mm}'
						},
			
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
			events: '<?php echo URL; ?>siak_jadwal/load_jadwal/<?php echo $this->tahunid; ?>/<?php echo $this->jenis; ?>/<?php echo $this->prodi; ?>/<?php echo $this->kohort; ?>',
			//timeFormat: 'H:mm' ,
			allDayDefault: false,
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
			var view = jQuery('#jadkul').fullCalendar('getView');
			start = jQuery.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
			end = jQuery.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
			jQuery("#edit").val('');
			 if (allDay == false) {
				jQuery('#start').val(start);
				jQuery('#end').val(end);
				//document.getElementById("form-buat").reset();
				jQuery('#statediv1').html('');
				jQuery('#form_isian').modal('show');
				var link="<?php echo URL; ?>siak_jadwal/siak_form/<?php echo $this->prodi ?>";
				addModul(link);
				//jQuery("#dialog-create").dialog('open');
				
			}
			
			jQuery('#jadkul').fullCalendar('unselect');
			 if(view.name == 'agendaWeek' && allDay == true){
					jQuery('#jadkul').fullCalendar('gotoDate',new Date(start));
					jQuery('#jadkul').fullCalendar('changeView','agendaDay');
			 }
			 else{
				jQuery('#jadkul').fullCalendar('gotoDate',new Date(start));
				jQuery('#jadkul').fullCalendar('changeView','agendaWeek');
			 }
			 
			},
			editable: true,
			eventDrop: function(event, delta, allDay) {
				 start = jQuery.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
				 end = jQuery.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
				 ruang=event.ruang_id;
				 values=event.doma;
				// alert(values);
					jQuery.ajax({
								 url: '<?php echo URL; ?>siak_jadwal/cek_ruang',
								 data: 'mulai='+ start+'&ruang='+ruang+'&akhir='+end+'&doma='+values+'&id='+event.id,
								 type: "POST",
								 success: function(data) {
										var data=JSON.parse(data);
										if(data.cek_ruang!='KOSONG' || data.cek_dosen!='KOSONG' ){
											if(data.cek_ruang!='KOSONG' && data.cek_dosen=='KOSONG' ){
												alert('Ruang Sudah Terpakai');
											}
											else if(data.cek_ruang=='KOSONG' && data.cek_dosen!='KOSONG' ){
												alert('Dosen Sudah Terpakai');
											}
											else{
												alert('Ruang dan Dosen Sudah Terpakai');
											}
											jQuery('#jadkul').fullCalendar('refetchEvents');
										}
										else{
											//alert('masuk');
											
											jQuery.ajax({
														url: '<?php echo URL; ?>siak_jadwal/cek_data_absen/'+event.id,
														success: function(json) {
														var jawab=false;
															if(json > 0){
																
																var r = confirm("Apakah Anda Ingin Mengubah Status Absen Yang Sudah Ada ?");
																	if (r == true) {
																		jawab = true;
																	} else {
																		jawab =false;
																	}
															}
														
															jQuery.ajax({
																		url: '<?php echo URL; ?>siak_jadwal/siak_edit_save/'+event.id+'/'+jawab,
																		data: 'mulai='+ start +'&akhir='+ end,
																		type: "POST",
																		success: function(json) {
																			
																		}
																 });
														jQuery('#jadkul').fullCalendar('refetchEvents');
														}
												 });	
											
												 
										}
									}
						});
			},
			eventResize: function(event) {
			start = jQuery.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
				 end = jQuery.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
				 ruang=event.ruang_id;
				 values=event.doma;
				// alert(values);
					jQuery.ajax({
								 url: '<?php echo URL; ?>siak_jadwal/cek_ruang',
								 data: 'mulai='+ start+'&ruang='+ruang+'&akhir='+end+'&doma='+values+'&id='+event.id,
								 type: "POST",
								 success: function(data) {
										var data=JSON.parse(data);
										if(data.cek_ruang!='KOSONG' || data.cek_dosen!='KOSONG' ){
											if(data.cek_ruang!='KOSONG' && data.cek_dosen=='KOSONG' ){
												alert('Ruang Sudah Terpakai');
											}
											else if(data.cek_ruang=='KOSONG' && data.cek_dosen!='KOSONG' ){
												alert('Dosen Sudah Terpakai');
											}
											else{
												alert('Ruang dan Dosen Sudah Terpakai');
											}
											jQuery('#jadkul').fullCalendar('refetchEvents');
										}
										else{
											//alert('masuk');
											
											jQuery.ajax({
														url: '<?php echo URL; ?>siak_jadwal/cek_data_absen/'+event.id,
														success: function(json) {
														var jawab=false;
															if(json > 0){
																
																var r = confirm("Apakah Anda Ingin Mengubah Status Absen Yang Sudah Ada ?");
																	if (r == true) {
																		jawab = true;
																	} else {
																		jawab =false;
																	}
															}
														
															jQuery.ajax({
																		url: '<?php echo URL; ?>siak_jadwal/siak_edit_save/'+event.id+'/'+jawab,
																		data: 'mulai='+ start +'&akhir='+ end,
																		type: "POST",
																		success: function(json) {
																			
																		}
																 });
														jQuery('#jadkul').fullCalendar('refetchEvents');
														}
												 });	
											
												 
										}
									}
						});
			},
			eventClick: function(event) {				 
					jQuery("#form_isian").modal('show');
					var link="<?php echo URL; ?>siak_jadwal/siak_form_edit/"+event.id;
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
				defaultDate: getFormattedDate(),
				dateFormat: 'DD, d MM, yy',
				minDate: new Date(<?php echo $this->tahun; ?>, 8, 1),
				maxDate: new Date(parseInt(<?php echo $this->maxDate; ?>), 11, 31),
				
				onSelect: function(dateText,dp){
				jQuery('#jadkul').fullCalendar('gotoDate',new Date(Date.parse(dateText)));
				jQuery('#jadkul').fullCalendar('changeView','agendaWeek');
				
                            }
		});
                jQuery('#search').change(function(){
                                var date_search=$('#search').val();
                                alert(date_search);
				jQuery('#jadkul').fullCalendar('gotoDate',new Date(date_search));
				jQuery('#jadkul').fullCalendar('changeView','agendaWeek');
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
		<input type="hidden" id="start" >
				<input type="hidden" id="id" >
				<input type="hidden" id="end" >
				<input type="hidden" id="title">
				<input type="hidden" id="tahun_id" value='<?php echo $this->tahunid; ?>'>
		
			<div class="row-fluid">
					<div class="portlet box blue calendar">
						<div class="portlet-title">
							<div class="caption"><i class="icon-reorder"></i>Jadwal Kuliah</div>
						</div>
						<div class="portlet-body light-grey">
							<div class="row-fluid">
								<div class="span3 responsive" data-tablet="span12 fix-margin" data-desktop="span8">
									<!-- BEGIN DRAGGABLE EVENTS PORTLET-->    
									<h3 class="event-form-title">Jadwak Kuliah Prodi <?php echo $this->prodi." Cohort ".$this->kohort; ?></h3>
									<div id="external-events">
									<form class="inline-form">
											<input type="text" class="form-control" name="tanggal_lahir" id="tanggal" value="<?php echo $value['tanggal_lahir']; ?>"><br />
											<div><a href="javascript:;"  class="btn yellow" onclick='history.go(-1);'>Kembali </a></div>
									</form>
									</div>
									<!-- END DRAGGABLE EVENTS PORTLET-->            
								</div>
								<div class="span9">
									<div id="jadkul" class="has-toolbar"></div>
								</div>
							</div>
							<!-- END CALENDAR PORTLET-->
						</div>
					</div>
				</div>
		
	<div id="form_isian" class="modal hide fade" data-width="475">
		
		<div id='addModul'></div>
		<input type="hidden" name='prodi_id' id="id_prodi" value='<?php echo $this->prodi; ?>'>
		
	</div>
	<div id="alert_absen" class="modal hide fade" data-width="475">
		
		<div id='ad'></div>
		<input type="hidden" name='prodi_id' id="id_prodi" value='<?php echo $this->prodi; ?>'>
		
	</div>
	<div id="dialog-message" class="modal hide fade" data-width="250">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Pemberitahuan</h3>
		</div>
		<div class="modal-body">
			<div class='row-fluid'>
			<p>
				<span class="icon-ok" style="float:left; margin:0 7px 50px 0;"></span>
				Jadwal Telah Dibuat
			 <p>
				<span class="icon-ok" style="float:left; margin:0 7px 50px 0;"></span>
				Absen Telah Dibuat
			 </div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn grey">OK</button>
		</div>
	</div>
						
<script type="text/javascript">
function addModul(link){
	var url = link;
	var strURL = url;
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('addModul').innerHTML=req.responseText;
				} else {
					alert("Mohon lengkapi semua isian...");
				}
			}       
		}     
		req.open("GET", strURL, true);
		req.send(null);
	}
}
function simpan (link){
						var form=jQuery("#form-buat").serialize();
						var start	= jQuery('#start').val();
						var end 	= jQuery('#end').val();						
						var jenis 	= '<?php echo $this->jenis; ?>';
						var kohort	= '<?php echo $this->kohort; ?>';
						var prodi 	= '<?php echo $this->prodi; ?>';
						var title 	= jQuery("#judul");
						var bvalid	= title.val();						
						var tahun_id = jQuery("#tahun_id").val();			
						var ruang = jQuery("#ruang").val();			
						var pengampu = jQuery("#dosen_pengampu").val();			
						var kuri = jQuery("#kurikulum").val();			
						
						//**Chech Ruang**\\
							jQuery.ajax({
								 url: '<?php echo URL; ?>siak_jadwal/cek_ruang',
								 data: 'mulai='+ start+'&ruang='+ruang+'&akhir='+end+'&doma='+pengampu,
								 type: "POST",
								 success: function(data) {
										var data=JSON.parse(data);
										
										if(data.cek_ruang!='KOSONG' || data.cek_dosen!='KOSONG' ){
											if(data.cek_ruang!='KOSONG' && data.cek_dosen=='KOSONG' ){
												alert('Ruang Sudah Terpakai');
											}
											else if(data.cek_ruang=='KOSONG' && data.cek_dosen!='KOSONG' ){
												alert('Dosen Sudah Terpakai');
											}
											else{
												alert('Ruang dan Dosen Sudah Terpakai');
											}
										}
										else{
											jQuery.ajax({
											 url: '<?php echo URL; ?>siak_jadwal/siak_create',
											 data: form +'&mulai='+ start +'&akhir='+ end +'&dosen_utama='+ pengampu+'&tahun_id='+ tahun_id+'&prodi_id='+ prodi+'&cohort='+ kohort+'&jenis='+ jenis+'&kurikulum_id='+ kuri,
											 type: "POST",
											 success: function(json) {
													
												jQuery('#jadkul').fullCalendar('refetchEvents');
												jQuery("#form_isian").modal("hide");
												jQuery('#dialog-message').modal('show');
													
												 }
											});
										}
									 }
								});
						
}
function update_event(){
						var form	= jQuery("#form-update").serialize();
						var start	= jQuery('#start').val();
						var end 	= jQuery('#end').val();
						var id 		= jQuery("#id").val();			
						var ruang 	= jQuery("#ruang").val();			
						var values 	= jQuery("#dosen_pengampu").val();			
						//alert(id);
						//**Chech Ruang**\\
							jQuery.ajax({
								 url: '<?php echo URL; ?>siak_jadwal/cek_ruang',
								 data: 'mulai='+ start+'&ruang='+ruang+'&akhir='+end+'&doma='+values+'&id='+id,
								 type: "POST",
								 success: function(data) {
										var data=JSON.parse(data);
										
										
										if(data.cek_ruang!='KOSONG' || data.cek_dosen!='KOSONG' ){
											if(data.cek_ruang!='KOSONG' && data.cek_dosen=='KOSONG' ){
												alert('Ruang Sudah Terpakai');
											}
											else if(data.cek_ruang=='KOSONG' && data.cek_dosen!='KOSONG' ){
												alert('Dosen Sudah Terpakai');
											}
											else{
												alert('Ruang dan Dosen Sudah Terpakai');
											}
										}
										
										else{
												jQuery.ajax({
														url: '<?php echo URL; ?>siak_jadwal/cek_data_absen/'+id,
														success: function(json) {
														var jawab=false;
															if(json > 0){
																
																var r = confirm("Apakah Anda Ingin Mengubah Status Absen Yang Sudah Ada ?");
																	if (r == true) {
																		jawab = true;
																	} else {
																		jawab =false;
																	}
															}
														
															jQuery.ajax({
																 url: '<?php echo URL; ?>siak_jadwal/siak_edit_save/'+id+'/'+jawab,
																 data: form,
																 type: "POST",
																 success: function(json) {
																		
																	jQuery('#jadkul').fullCalendar('refetchEvents');
																	jQuery("#form_isian").modal("hide");
																	
																	 }
															});
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
				var kuri = document.getElementById('kurikulum').value;
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
					req.open("GET", strURL+ "/" + prodi + "/" + semes+ "/" + kuri, true);
					req.send(null);
				}
			}
			function getKurikulum(value) {
			
				var strURL = jQuery(value).attr('link');
				var val = jQuery(value).val();
				var kurikulum = jQuery('#kurikulum').val();
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
					req.open("GET", strURL+ "/" + val+ "/" + kurikulum, true);
					req.send(null);
				}
			}
				<!-- *********************************** -->
		</script>