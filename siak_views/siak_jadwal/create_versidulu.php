
<link href='kalender/fullcalendar.css' rel='stylesheet' />
<script src='kalender/jquery.min.js'></script>
<script src='kalender/jquery-ui.custom.min.js'></script>
<script src='kalender/fullcalendar.min.js'></script>

<script>

	jQuery(function() {
		jQuery( "#tanggal_lahir" ).datepicker(option);
		jQuery( "#tgl_sk_ban" ).datepicker(option);
	});
	
	$(document).ready(function() {
		$('#matkul').change(function() {
			var id=$('#matkul').val();
			$.ajax({
            url: '<?php echo URL; ?>siak_jadwal/load_title/'+id,
            dataType: "html",
            success: function (data) {
				$('#ojo').val(data);
			}
		});
		});
		$.ajax({
            url: '<?php echo URL; ?>siak_kalender/getTahun_akademik',
            dataType: "json",
            success: function (list) {
                for (var i = 0; i < list.length; i++) {
				var selected =<?php echo $this->tahun; ?>==list[i].tahun?"selected=selected":"";
				$("#tahun2").append("<option value='" + list[i].tahun + "' "+selected+">" + list[i].nama_tahun + "</option>");
					
                }
				
            }
			});
		$.ajax({
            url: '<?php echo URL; ?>siak_kalender/getTahun_ID/<?php echo $this->tahun;?>',
            dataType: "json",
            success: function (list) {
                for (var i = 0; i < list.length; i++) {
				$("#tahun_id").val(list[i].tahun_id);
				//alert($("#tahun_id").val());
                }
            }
			});
			$.ajax({
				url: '<?php echo URL; ?>siak_jadkul/search',
				cache:false,
				dataType: $(this).serialize(),
				success: function (html) {
						$("#sip").html(html);
				
				//console.log(list)
				
                /*for (var i = 0; i < list.length; i++) {
				//var selected =<?php echo $this->tahun; ?>==list[i].tahun?"selected=selected":"";
				$("#sip").append("<option value='" + list[i].start + "'>" + list[i].title + "&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;<b>"+ list[i].start +"</b></option>");
                }*/
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
		$.ajax({
            url: '<?php echo URL; ?>siak_ruang/getRuang',
            dataType: "json",
            success: function (list) {
                for (var i = 0; i < list.length; i++) {
				//var selected =<?php echo $this->tahun; ?>==list[i].tahun?"selected=selected":"";
				$("#ruang").append("<option value='" + list[i].ruang_id + "'>" + list[i].nama_ruang + "</option>");
                }
            }
		});
		
		$('#tahun2').change(function() {
			
			var tahun=$('#tahun2').val();
			window.location = "<?php echo URL; ?>siak_jadwal?tahun="+tahun;
			//var bulan=0;
			
			 
			//return false;
									
			//alert(bulan+'aih');
			//location.reload();
				//window.location = "<?php echo URL; ?>siak_master?tahun="+tahun+"&bulan="+bulan;
        });
		$('#sip').change(function() {
			
			var sip=$('#sip').val();
			$('#jadkul').fullCalendar('gotoDate',new Date(sip));
			$('#jadkul').fullCalendar('changeView','agendaWeek');
			//window.location = "<?php echo URL; ?>siak_jadwal?tahun="+tahun;
			//var bulan=0;
			
			 
			//return false;
									
			//alert(bulan+'aih');
			//location.reload();
				//window.location = "<?php echo URL; ?>siak_master?tahun="+tahun+"&bulan="+bulan;
        });
		
			
         
			

		
		$('#jadkul').fullCalendar({	
		
			defaultView:'agendaWeek',
			year:getFormattedyear(),
			year:valtahun,
			month:valbulan,
			axisFormat: 'HH:mm',
			slotMinutes: 10,
			
			//day:7,
			header: {
				right: "month,agendaWeek,agendaDay"
			},
			eventRender: function(event, element) {
                    element.css('background-color', event.warna);    
            },
			firstDay:1,
			viewDisplay   : function(view) {
				var takebulan=view.start.getMonth();
				var taketahun=view.start.getFullYear();
				 $('#tahun').val(taketahun);
				 $('#bulan').val(takebulan);
			},
			
			
			editable: true,
			events: '<?php echo URL; ?>siak_jadwal/load_jadwal',
			
			allDayDefault: false,
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
			var view = $('#jadkul').fullCalendar('getView');
			start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
			end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
			 if (allDay == false) {
				$('#start').val(start);
				$('#end').val(end);
				$("#dialog-create").dialog('open');
			}
			
			$('#jadkul').fullCalendar('unselect');
			 if(view.name == 'agendaWeek' && allDay == true){
					$('#jadkul').fullCalendar('gotoDate',new Date(start));
					$('#jadkul').fullCalendar('changeView','agendaDay');
			 }
			 else{
				$('#jadkul').fullCalendar('gotoDate',new Date(start));
				$('#jadkul').fullCalendar('changeView','agendaWeek');
			 }
			 
			},
			editable: true,
			eventDrop: function(event, delta, allDay) {
				 start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
				 end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
				$.ajax({
							url: '<?php echo URL; ?>siak_jadwal/siak_edit_save/'+event.id,
							data: 'start='+ start +'&end='+ end ,
							type: "POST",
							success: function(json) {
							alert("OK");
			
							}
					});
			},
			eventClick:function(event,allDay) {
			alert(allDay);
			},
			eventResize: function(event) {
			//alert(allDay);
			//if (allDay == 0){
			 start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
			 end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
			 $.ajax({
							url: '<?php echo URL; ?>siak_jadwal/siak_edit_save/'+event.id,
							data: 'start='+ start +'&end='+ end ,
							type: "POST",
							success: function(json) {
							alert("OK");
							// window.location = "<?php echo URL; ?>siak_master?tahun="+valtahun+"&bulan="+valbulan;
							}
					});
			// }
			// $('#jadkul').fullCalendar('rerenderEvents');
			}
		});
		$("#dialog-create").dialog({
				autoOpen:false,
				resizable: false,
				draggable: true,
				height: 500,
				width: 550,
				modal: true,
				buttons:[
					{
						text:'Save Event',
						click: function() {
						var start = $('#start').val();
						var end = $('#end').val();
						var matkul = $('#matkul').val();
						var title = $("#judul");
						var values = new Array();
						$.each($("input[name='dosen_utama[]']:checked"), function() {
						values.push($(this).val());
 
						});
						var dosen2 = new Array();
						$.each($("input[name='dosen_pendamping[]']:checked"), function() {
						dosen2.push($(this).val());
 
						});
						//alert(values);
						var topik = $("#kode_topik").val();
						var tahun_id = $("#tahun_id").val();
						//var bvalid = true;
							
						var bvalid =title.val();
						//alert(dosen1);
						if (bvalid !== "" ) {
							
						$.ajax({
						 url: '<?php echo URL; ?>siak_jadwal/siak_create',
						 data: 'start='+ start +'&end='+ end +'&kode_matkul='+ matkul+'&dosen_utama='+ values+'&dosen_pendamping='+ dosen2+'&kode_topik='+ topik+'&tahun_id='+ tahun_id,
						 type: "POST",
						 success: function(json) {
								alert('OK');
								
							 }
						});
						$('#jadkul').fullCalendar('renderEvent',
									{
										 title: $("#ojo").val(),
										 start: start,
										 end: end,
									 },
									false//true // make the event "stick"
								);
					 //load_title(start);
					}
						  
						$(this).dialog("close");
										//location.reload();
						}
					},
					{
						text:'close',
						click: function() {
						//calendar.fullCalendar('unselect');
						$(this).dialog("close");
						}
					 }
				]
			});
			
			$('#tanggal').datepicker({
				//var ada=2013;
				changeMonth: true,
				changeYear: true,
				defaultDate: getFormattedDate(),
				dateFormat: 'DD, d MM, yy',
				minDate: new Date(getFormattedyear(), 0, 1),
				maxDate: new Date(2014, 11, 31),
				
				onSelect: function(dateText,dp){
				$('#jadkul').fullCalendar('gotoDate',new Date(Date.parse(dateText)));
				$('#jadkul').fullCalendar('changeView','agendaWeek');
				//$(this).datepicker('show');
                            }
		});
                $('#search').change(function(){
                                var date_search=$('#search').val();
                                alert(date_search);
				$('#jadkul').fullCalendar('gotoDate',new Date(date_search));
				$('#jadkul').fullCalendar('changeView','agendaWeek');
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
			var year = $('#year').val();
			return year;
		}
			$('#coba').change(function(){
								alert('ok');
			$('#jadkul').fullCalendar('renderEvent',
							{
								 title: 'R.001',
								 
							 },
							true // make the event "stick"
					 );
					 $('#jadkul').fullCalendar('changeView','agendaDay');
		});	
		
	});
	
	// fancy();

</script>
<style>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}

	#jadkul {
		width: 900px;
		margin: 0 auto;
		}

</style>

<div class="panel panel-default">
	<div class="panel-body">
	
	<input type="hidden" id="tahun" >
	<input type="hidden" id="bulan" >
	<input type="hidden" id="start" >
	<input type="hidden" id="id" >
	<input type="hidden" id="end" >
	<input type="hidden" id="title" >
	<input type="hidden" id="tahun_id" >
	<form>
							<fieldset>
							<table align="center" >
							<tr>
									<td><label for="name" >Tahun Akademik</label>
									<select id="tahun2">
									</select></td>
                                   <td><label for="name" >Kegiatan</label><select id='sip'></select></div></td>
									
							</tr>
							</table>
							</fieldset>
						</form>
		
		<div class="form-group col-md-3">
				<label for="tanggal_lahir" >TANGGAL PILIH</label>
				<input type="text" class="form-control" name="tanggal_lahir" id="tanggal" value="<?php echo $value['tanggal_lahir']; ?>">
			</div>
		<!-- CONTENT CALENDAR -->	
		<div id='jadkul'></div>
		<!-- CALL FUNCTION DIALOG IN JQUERY -->
<script src="siak_public/siak_js/jquery-ui.js"></script>
		<!-- ****************************** -->
		<!-- DIALOG CREATE -->
		<div id="dialog-create" title="Create Event">
						<div class="row">
								<div class="form-group col-md-4"><label for="title" class="control-label">JUDUL</label></div>
								<div class="form-group col-md-8"><input type="text" class="form-control" name="title" id="judul" placeholder="Judul..."><input type="text" class="form-control" name="title" id="ojo" placeholder="Judul..."></div>
						</div>
						<div class="row">
								<div class="form-group col-md-4"><label for="kode_matkul" class="control-label">MATA KULIAH</label></div>
								<div class="form-group col-md-8">
									<select name="kode_matkul" class="form-control" link="<?php echo URL;?>siak_jadwal/dosen" onChange="getKurikulum(this)" id='matkul'>
									<?php foreach ($this->siak_matkul as $key => $val) { ?>
										<option value="<?php echo $val['kode_matkul'];?>"><?php echo $val['nama_matkul'];?></option>	
									<?php } ?>
									</select>
								</div>
						</div>
						<div id="statediv"></div>
		</div>
		<script type="text/javascript">
			function getKurikulum(value) {
				var strURL = jQuery(value).attr('link');
				var val = jQuery(value).val();
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
				<!-- *********************************** -->
		</script>