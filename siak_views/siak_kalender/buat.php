
<link href='kalender/fullcalendar.css' rel='stylesheet' />
<script src='kalender/jquery.min.js'></script>
<script src='kalender/jquery-ui.custom.min.js'></script>
<script src='kalender/fullcalendar.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {
	
	// LOAD TAHUN AKADEMIK
	 $.ajax({
            url: '<?php echo URL; ?>siak_kalender/getTahun_akademik',
            dataType: "json",
            success: function (list) {
                for (var i = 0; i < list.length; i++) {
				var selected =<?php echo $this->tahun; ?>==list[i].tahun?"selected=selected":"";
				$("#tahun").append("<option value='" + list[i].tahun + "' "+selected+">" + list[i].nama_tahun + "</option>");
				//$("#tahun_id").append("<input type='text' value='" + list[i].nama_tahun + "'>");
					
                }
				
				
            }
			});
			// $GET TAHUN DAN BULAN
		var valtahun = "<?php echo $this->tahun; ?>";
		var valbulan = "<?php echo $this->bulan; ?>";
		
		/* FUNCTION CHANGE TAHUN AKADEMIK */
	 $.ajax({
            url: '<?php echo URL; ?>siak_kalender/getTahun_ID/<?php echo $this->tahun; ?>',
            dataType: "json",
            success: function (list) {
                for (var i = 0; i < list.length; i++) {
				$("#tahun_id").append("<input type='text' value='" + list[i].tahun_id + "'>");
                }
            }
			});
	
	$('#tahun').change(function() {
		var tahun=$('#tahun').val();
		var bulan=$('#bln').val();
		//location.reload();
			window.location = "<?php echo URL; ?>siak_master?tahun="+tahun+"&bulan="+bulan;
        });
	$('#bln').change(function() {
		var tahun=$('#tahun').val();
		var bulan=$('#bln').val();
		//location.reload();
			window.location = "<?php echo URL; ?>siak_master?tahun="+tahun+"&bulan="+bulan;
        });
		
					
		
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		/* FULLCALENDAR*/
		$calendar=$('#calendar').fullCalendar({
		header: {
            left: "prev,next ",
            center: "title",
            right: "month,agendaDay"
        },
		/*PENENTUAN TAHUN DAN BULAN */
		year: valtahun,
		month: valbulan,
		day:20,
		/*FUNCTION UNTUK SET NEXT DAN PREV*/
			viewDisplay   : function(view) {
			
			  //setMonth(1 + 6); //Adjust as needed
			 
			  var tahun_sampai=parseInt(valtahun) + 1;
			  
			  var cal_date_string = view.start.getMonth()+'/'+view.start.getFullYear();
			  var takebulan=view.start.getMonth();
			  $('#bulan').val(takebulan);
			  var cur_date_string = 0+'/'+valtahun;
			  var end_date_string = 11+'/'+tahun_sampai;			
			  if(cal_date_string == cur_date_string ||  parseInt(tahun) === 0) {				
				jQuery('.fc-button-prev').addClass("fc-state-disabled"); 
			  }
			  else {
				jQuery('.fc-button-prev').removeClass("fc-state-disabled"); 
			  }
			  if(end_date_string == cal_date_string || tahun_sampai === 1) { 
				jQuery('.fc-button-next').addClass("fc-state-disabled"); 
				}
			  else { 
				 jQuery('.fc-button-next').removeClass("fc-state-disabled"); }
				
			},
	
			/*LOAD EVENT */
			editable: true,
			events: '<?php echo URL; ?>/kalender/event.php',
			/*RENDER WARNA EVENT*/
			eventRender: function(event, element) {
                
                    element.css('background-color', event.warna);
     
            },
			/*JIKA INGIN MEMAKAI JAM*/
			
				allDayDefault: false,
			
			/**********/
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {  
			
			start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
			end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
			$('#start').val(start);
			//alert(start);
			$('#end').val(end);
			$('#dialog').dialog('open');
			 
			 
			},
			
			editable: true,
			eventDrop: function(event, delta) {
			 start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
			 end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
			 $.ajax({
							url: '<?php echo URL; ?>kalender/update_events.php',
							data: 'id='+event.id+'&start='+ start +'&end='+ end ,
							type: "POST",
							success: function(json) {
							alert("OK");
							 window.location = "<?php echo URL; ?>siak_master?tahun="+valtahun+"&bulan="+valbulan;
							}
					});
			},
			eventResize: function(event) {
			 start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
			 end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
			 $.ajax({
							url: '<?php echo URL; ?>kalender/update_events.php',
							data: 'id='+event.id+'&start='+ start +'&end='+ end ,
							type: "POST",
							success: function(json) {
							alert("OK");
							 window.location = "<?php echo URL; ?>siak_master?tahun="+valtahun+"&bulan="+valbulan;
							}
					});
			 
			},
			
			eventClick: function(event) {
				//alert(event.event_id);
				 $.ajax({
					url: '<?php echo URL; ?>/siak_kalender/getEvent',
					dataType: "json",
					success: function (list) {
					for (var i = 0; i < list.length; i++) {
					var selected =event.event_id==list[i].id?"selected=selected":"";
			$("#update").append("<option value='" + list[i].id + "' "+selected+">" + list[i].event + "</option>");
					
							}
						}
					});
				$("#dialog-confirm").dialog('open');
				$('#id').val(event.id);
				$('#start').val(event.start);
				$('#end').val(event.end);
				$('#start').val(event.title);
				
				
				}
		
		
		
	});
			$("#dialog").dialog({
				autoOpen:false,
				resizable: false,
				draggable: true,
				height: 300,
				width: 350,
				modal: true,
				buttons:[
					{
						text:'Save Event',
						click: function() {
						var start = $('#start').val();
						var end = $('#end').val();
						var bulantake = $('#bulan').val();
						var title = $("#title");
						//var bvalid = true;
							
						var bvalid =title.val();
						alert(bvalid);
						if (bvalid !== "" ) {
							
						$.ajax({
							url: '<?php echo URL; ?>/kalender/add_events.php',
							cache:false,
							data: 'title='+ bvalid+'&start='+ start +'&end='+ end,
							type: "POST",
							success: function(json) {
								}
							});
							//var taketahun = $('#tahun').val();		
							$(this).dialog("close");
							alert('OK');
							//location.reload();
						 window.location = "<?php echo URL; ?>siak_master?tahun="+valtahun+"&bulan="+bulantake;
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
			$("#dialog-confirm").dialog({
				autoOpen:false,
				  resizable: false,
				  height:300,
				  width:400,
				  modal: true,
				  buttons: {
						"Update Event": function() {
						var id=$('#id').val();
						var event=$('#update').val();
						var bulantake = $('#bulan').val();
						$.ajax({
							url: '<?php echo URL; ?>kalender/update_events.php',
							// url: 'http://localhost:85/siak_unhan/kalender/update_events.php',
							data: 'id='+id+'&event_id='+event,
							type: "POST",
							success: function(json) {
							alert("OK");
							 window.location = "<?php echo URL; ?>siak_master?tahun="+valtahun+"&bulan="+bulantake;
							}
					});
						  $( this ).dialog( "close" );
						},
						"Delete Event": function() {
						var id=$('#id').val();
						var bulantake = $('#bulan').val();
						//var event=$('#update').val();
						$.ajax({
							url: '<?php echo URL; ?>kalender/delete_events.php',
							data: 'id='+id,
							type: "POST",
							success: function(json) {
							alert("OK");
							 window.location = "<?php echo URL; ?>siak_master?tahun="+valtahun+"&bulan="+bulantake;
							}
					});
						  $( this ).dialog( "close" );
						},
						Cancel: function() {
						  $( this ).dialog( "close" );
						}
					  }
					});
		});

</script>
<style>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}
	

	#calendar {
		width: 900px;
		margin: 0 auto;
		}

</style>
	
<div class="panel panel-default">
	<div class="panel-body" >

<input type="hidden" id="bulan" >
	<form>
				<table align="center" >
				<tr>
					<td><label for="name" >Tahun Akademik</label></td>
					<td><select id="tahun">
					</select></td>
					<td><input type='hidden' id="tahun_id"></td>
				
					<td><label for="name" >Bulan</label></td>
					<td><select name='bln' id='bln'>
				<option value='0' checked>Pilih Bulan</option>
				<option value='0' >Januari</option>
				<option value='1'>Februari</option>
				<option value='2'>Maret</option>
				<option value='3'>April</option>
				<option value='4'>Mei</option>
				<option value='5'>Juni</option>
				<option value='6'>Juli</option>
				<option value='7'>Agustus</option>
				<option value='8'>September</option>
				<option value='9'>Oktober</option>
				<option value='10'>November</option>
				<option value='11'>Desember</option>
  </select></td>
				</tr>
					<!--<select name = "jk_mahasiswa" id="tahun" >
						
		<?php
			/*
				foreach ($this->siak_tahun as $kunci => $nilai) { ?>
					
				<option value = "<?php echo $nilai['tahun'];?>" selected><?php echo $nilai['nama_tahun'];?></option></option>	
		<?php  } */?>
					</select>-->
										
				
			</table>
			</form>
		<div id='calendar'></div>
		<!-- CALL FUNCTION DIALOG IN JQUERY -->
		
<script src="siak_public/siak_js/jquery-ui.js"></script>
		
		<div id="dialog-confirm" title="ACTION EVENT">
		
		
			<p class="validateTips">All form fields are required.</p>
			<form>
			<input type="hidden" id="start" >
			<input type="hidden" id="id" >
			<input type="hidden" id="event" >
				<fieldset>
					<label for="name">Name</label>
						<select name = "jk_mahasiswa" id="update">
						
					</select>
					
										
				</fieldset>
			</form>
				</div>
		<div id="dialog" title="Create Event">
		<input type="hidden" id="start" >
		<input type="hidden" id="id" >
		<input type="hidden" id="end" >
		
				
		<p class="validateTips">All form fields are required.</p>
			<form>
				<fieldset>
					<label for="name">Name</label>
						<select name = "jk_mahasiswa" id="title">
						<option value = "">Pilih</option>
		<?php foreach ($this->siak_data as $kunci => $nilai) { ?>		
				<option value= "<?php echo $nilai['id'];?>"><?php echo $nilai['event'];?></option>	
		<?php } ?>
					</select>
										
				</fieldset>
			</form>
		</div>

