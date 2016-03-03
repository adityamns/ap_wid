
<script>

	jQuery(function() {
		jQuery( "#tanggal_lahir" ).datepicker(option);
		jQuery( "#tgl_sk_ban" ).datepicker(option);
	});
	
	jQuery(document).ready(function() {
		
		jQuery.ajax({
            url: '<?php echo URL; ?>siak_ruang/getRuang',
            dataType: "json",
            success: function (list) {
                for (var i = 0; i < list.length; i++) {
				//var selected =<?php echo $this->tahun; ?>==list[i].tahun?"selected=selected":"";
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
				valbulan=0;
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
			
			allDayDefault: false,
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
			var view = jQuery('#jadkul').fullCalendar('getView');
			start = jQuery.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
			end = jQuery.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
			 if (allDay == false) {
				jQuery('#start').val(start);
				jQuery('#end').val(end);
				jQuery("#dialog-create").dialog('open');
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
				jQuery.ajax({
							url: '<?php echo URL; ?>siak_jadwal/siak_edit_save/'+event.id,
							data: 'mulai='+ start +'&akhir='+ end ,
							type: "POST",
							success: function(json) {
							
			
							}
					});
			},
			eventClick:function(event,allDay) {
			alert(allDay);
			},
			eventResize: function(event) {
			//alert(allDay);
			//if (allDay == 0){
			 start = jQuery.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
			 end = jQuery.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
			 jQuery.ajax({
							url: '<?php echo URL; ?>siak_jadwal/siak_edit_save/'+event.id,
							data: 'mulai='+ start +'&akhir='+ end ,
							type: "POST",
							success: function(json) {
							
							}
					});
			},
			eventClick: function(event) {
				 jQuery.ajax({
					url: '<?php echo URL; ?>/siak_kalender/getEvent',
					dataType: "json",
					success: function (list) {
					for (var i = 0; i < list.length; i++) {
					var selected =event.event_id==list[i].id?"selected=selected":"";
			jQuery("#update").append("<option value='" + list[i].id + "' "+selected+">" + list[i].event + "</option>");
					
							}
						}
					});
				jQuery("#form-update").dialog('open');
				jQuery('#id').val(event.id);
				jQuery('#start').val(event.start);
				jQuery('#end').val(event.end);
				jQuery('#start').val(event.title);
				
				
				}
		});
		
		jQuery("#dialog-create").dialog({
				autoOpen:false,
				resizable: false,
				draggable: true,
				height: 'auto',
				width: 550,
				modal: true,
				buttons:[
					{
						text:'Buat Jadwal',
						click: function() {
						var start = jQuery('#start').val();
						var end = jQuery('#end').val();
						var matkul = jQuery('#matkul').val();
						var ruang = jQuery('#ruang').val();
						var semes = jQuery('#semester').val();
						var jenis = '<?php echo $this->jenis; ?>';
						var kohort = '<?php echo $this->kohort; ?>';
						var prodi = '<?php echo $this->prodi; ?>';
						var title = jQuery("#judul");
						var values = new Array();
						jQuery.each(jQuery("input[name='dosen_utama[]']:checked"), function() {
						values.push(jQuery(this).val());
 
						});
						var dosen2 = new Array();
						jQuery.each(jQuery("input[name='dosen_pendamping[]']:checked"), function() {
						dosen2.push(jQuery(this).val());
 
						});
						
						var topik = jQuery("#kode_topik").val();
						var tahun_id = jQuery("#tahun_id").val();
						//var bvalid = true;
							
						var bvalid =title.val();
						//alert(dosen1);
						if (bvalid !== "" ) {
							
						jQuery.ajax({
						 url: '<?php echo URL; ?>siak_jadwal/siak_create',
						 data: 'mulai='+ start +'&akhir='+ end +'&kode_matkul='+ matkul+'&dosen_utama='+ values+'&dosen_pendamping='+ dosen2+'&kode_topik='+ topik+'&tahun_id='+ tahun_id+'&prodi_id='+ prodi+'&cohort='+ kohort+'&ruang_id='+ ruang+'&jenis='+ jenis+'&semester='+ semes,
						 type: "POST",
						 success: function(json) {
								
							jQuery('#jadkul').fullCalendar('refetchEvents');
								
							 }
						});
						// jQuery('#jadkul').fullCalendar('renderEvent',
									// {
										 // title: jQuery("#judul").val(),
										 // start: start,
										 // end: end,
									 // },
									// false//true // make the event "stick"
								// );
					 //load_title(start);
					}
						  
						jQuery(this).dialog("close");
										//location.reload();
						}
					},
					{
						text:'close',
						click: function() {
						//calendar.fullCalendar('unselect');
						jQuery(this).dialog("close");
						}
					 }
				]
			});
			jQuery("#form-update").dialog({
				autoOpen:false,
				resizable: false,
				draggable: true,
				height: 'auto',
				width: 500,
				modal: true,
				buttons:[
					{
						text:'Save Event',
						click: function() {
						var start = $('#start').val();
						var end = $('#end').val();
						var matkul = $('#matkul').val();
						var ruang = $('#ruang').val();
						var semes = $('#semester').val();
						var jenis = '<?php echo $this->jenis; ?>';
						var kohort = '<?php echo $this->kohort; ?>';
						var prodi = '<?php echo $this->prodi; ?>';
						var title = $("#judul");
						var values = new Array();
						jQuery.each(jQuery("input[name='dosen_utama[]']:checked"), function() {
						values.push(jQuery(this).val());
 
						});
						var dosen2 = new Array();
						jQuery.each(jQuery("input[name='dosen_pendamping[]']:checked"), function() {
						dosen2.push(jQuery(this).val());
 
						});
						
						var topik = jQuery("#kode_topik").val();
						var tahun_id = jQuery("#tahun_id").val();
						//var bvalid = true;
							
						var bvalid =title.val();
						//alert(dosen1);
						if (bvalid !== "" ) {
							
						// $.ajax({
						 // url: '<?php echo URL; ?>siak_jadwal/siak_create',
						 // data: '&mulai='+ start +'&akhir='+ end +'&kode_matkul='+ matkul+'&dosen_utama='+ values+'&dosen_pendamping='+ dosen2+'&kode_topik='+ topik+'&tahun_id='+ tahun_id+'&prodi_id='+ prodi+'&cohort='+ kohort+'&ruang_id='+ ruang+'&jenis='+ jenis+'&semester='+ semes,
						 // type: "POST",
						 // success: function(json) {
								
								
							 // }
						// });
						jQuery.ajax({
						 url: '<?php echo URL; ?>siak_jadwal/siak_create',
						 data: jQuery("#formdialog").serialize()+'&mulai='+ start +'&akhir='+ end +'&cohort='+ kohort+'&jenis='+ jenis,
						 type: "POST",
						 success: function(json) {
								
								
							 }
						});
						// jQuery('#jadkul').fullCalendar('renderEvent',
									// {
										 // title: jQuery("#judul").val(),
										 // start: start,
										 // end: end,
									 // },
									// false//true // make the event "stick"
								// );
					 //load_title(start);
					 jQuery('#calendar').fullCalendar('refetchEvents');
					}
						  
						jQuery(this).dialog("close");
										//location.reload();
						}
					},
					{
						text:'close',
						click: function() {
						//calendar.fullCalendar('unselect');
						jQuery(this).dialog("close");
						}
					 }
				]
			});
			
			jQuery('#tanggal').datepicker({
				//var ada=2013;
				changeMonth: true,
				changeYear: true,
				defaultDate: getFormattedDate(),
				dateFormat: 'DD, d MM, yy',
				minDate: new Date(<?php echo $this->tahun; ?>, 0, 1),
				maxDate: new Date(parseInt(<?php echo $this->tahun; ?>)+1, 11, 31),
				
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
<style>

	body {
		
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}

	
	hr.style-seven { 
		height: 30px; 
		border-style: solid; 
		border-color: black; 
		border-width: 1px 0 0 0; 
		border-radius: 20px; 
		}
	hr.style-seven:before {
		/* Not really supposed to work, but does */ 
		display: block; 
		content: ""; 
		height: 30px; 
		margin-top: -31px; 
		border-style: solid; 
		border-color: black; 
		border-width: 0 0 1px 0; 
		border-radius: 20px; 
		}
	label.atas {
		color: red;
		font-weight: bold;
		display: block;
		float: center;
		}

</style>

<div class="panel panel-default">
	<div class="panel-body">
	<div class="row">
					<label for="kode_matkul" class="atas" style='font-size:20px;'>JADWAL PERKULIAHAN</label><hr class='style-seven'></hr>
			</div>
			<br>
			<br>
			<br>
	<input type="hidden" id="tahun" >
	<input type="hidden" id="bulan" >
	<input type="hidden" id="start" >
	<input type="hidden" id="id" >
	<input type="hidden" id="end" >
	
	<input type="hidden" id="title">
	<input type="hidden" id="tahun_id" value='<?php echo $this->tahunid; ?>'>
	
		
		
			<div class="row">
			<div class="form-group col-md-2">
				<div>
						<label for="tanggal_lahir" >TANGGAL PILIH</label>
						<input type="text" class="form-control" name="tanggal_lahir" id="tanggal" value="<?php echo $value['tanggal_lahir']; ?>">
					</div>
					<br><br><br>
					<div>
						
				<label for="kode_matkul" class="control-label">KEGIATAN KALENDER AKADEMIK</label>
		
				<select class='form-control' id='sip'></select>
			
		
					</div>

			</div>
			<div class="form-group col-md-10">
				<!-- CONTENT CALENDAR -->	
					<div id='jadkul'></div>
				<!-- ****************************** -->
		</div>
		<!-- DIALOG CREATE -->
		<div id="dialog-create" title="Buat Kegiatan">
				<form id='form-buat'>
								
						
						<div class="row">
								<div class="form-group col-md-4"><label for="kode_matkul" class="control-label">SEMESTER</label></div>
								<div class="form-group col-md-3">
								<select link="<?php echo URL;?>siak_jadwal/matkul" id='semester' onchange='getCoba(this)' class='form-control' name='semester'>
								<option value='' selected>-- PILIH --</option>
									<option value='1' >1</option>
									<option value='2' >2</option>
									<option value='3'>3</option>
								</select>
								
								</div>
						</div>
				<div class="row">
					<div class="form-group col-md-4">
						<label for="kode_matkul" class="control-label">MATAKULIAH</label>
					</div>
						<div class="form-group col-md-8">
							<div id="statediv">
								<select class='form-control' name='matkul' id='matkul'>
									<option value='' selected>-- PILIH --</option>
									</select>
							</div>
						</div>
					</div>
						<div id="statediv1"></div>

						<div class="row">
								<div class="form-group col-md-4"><label for="kode_matkul" class="control-label">RUANG</label></div>
								<div class="form-group col-md-8">
									<select class='form-control' name='ruang' id='ruang'>
									<option value='' selected>-- PILIH --</option>
									</select>
								</div>
						</div>
					<input type="hidden" name='id_prodi' id="id_prodi" value='<?php echo $this->prodi; ?>'>
						</form>
		</div>
		<!-- DIALOG CREATE -->
		<div id="form-update" title="Create Event">
						<input type="hidden" id="id_prodi" value='<?php echo $this->prodi; ?>'>
								
						
						<div class="row">
								<div class="form-group col-md-4"><label for="kode_matkul" class="control-label">SEMESTER</label></div>
								<div class="form-group col-md-2">
								<select link="<?php echo URL;?>siak_jadwal/matkul" id='semester' onchange='getCoba(this)' class='form-control' name='semester'>
									<option value='' selected>-- PILIH --</option>
									<option value='1'>1</option>
									<option value='2'>2</option>
									<option value='3'>3</option>
								</select>
								
								</div>
						</div>
						<div id="statediv"></div>
						
						<div id="statediv1"></div>

						<div class="row">
								<div class="form-group col-md-4"><label for="kode_matkul" class="control-label">RUANG</label></div>
								<div class="form-group col-md-8">
									<select class='form-control' name='ruang' id='ruang'>
									<option value='' selected>-- PILIH --</option>
									</select>
								</div>
						</div>
		</div>
		<script type="text/javascript">
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