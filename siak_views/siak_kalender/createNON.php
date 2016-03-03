


<script type="text/javascript">

jQuery(document).ready(function() {
	//Loading
	$(document).ajaxStart(function(){
	  $("#wait").css("display","block");
	});

	$(document).ajaxComplete(function(){
	  $("#wait").css("display","none");
	});
	//
			// $GET TAHUN DAN BULAN
		var valtahun = "<?php echo $this->tahun; ?>";
		var valbulan = "<?php echo $this->bulan; ?>";
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
			
		/* FULLCALENDAR*/
		$calendar=jQuery('#calendar').fullCalendar({
		header: {
            //left: "prev,next ",
            center: "title",
            right: "month,basicWeek",
			left: "ojo"
        },
		/*PENENTUAN TAHUN DAN BULAN */
		year: valtahun,
		month: valbulan,
		//day:20,
		//FUNCTION UNTUK SET NEXT DAN PREV
			viewDisplay   : function(view) {
			 var takebulan=view.start.getMonth();
			 var taketahun=view.start.getFullYear();
			  jQuery('#bulan').val(takebulan);
			  jQuery('#tahun').val(taketahun);
			},
	
			/*LOAD EVENT */
			editable: true,
			events: '<?php echo URL; ?>siak_kalender/load_event/<?php echo $this->tahunid; ?>/<?php echo $this->jenis; ?>',
			/*RENDER WARNA EVENT*/
			eventRender: function(event, element) {
                
                    element.css('background-color', event.warna);
     
            },
			/*JIKA INGIN MEMAKAI JAM*/
			
				//allDaydefault: false,
			
			/**********/
			selectable: true,
			weekNumbers: true,
			selectHelper: true,
			select: function(start, end, allDay) {  
			start = jQuery.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
			end = jQuery.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
			//jQuery('#title').val('');
			jQuery("#dialog").modal('show');
			var link="<?php echo URL; ?>siak_kalender/form/add";
				addModul(link);
			jQuery('#start').val(start);
			jQuery('#end').val(end);
			var tahunid=jQuery('#tahun_id').val();
			 
			},
			
			editable: true,
			eventDrop: function(event, delta) {
			 start = jQuery.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
			 end = jQuery.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
			 jQuery.ajax({
							url: '<?php echo URL; ?>siak_kalender/siak_edit_save/'+event.id,
							data: 'mulai='+ start +'&akhir='+ end ,
							type: "POST",
							success: function(json) {
							
							
							}
					});
			},
			eventResize: function(event) {
			 start = jQuery.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
			 end = jQuery.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
			 if (end==""){
				end=start;
			 }
			 jQuery.ajax({
							url: '<?php echo URL; ?>siak_kalender/siak_edit_save/'+event.id,
							data: 'mulai='+ start +'&akhir='+ end,
							type: "POST",
							success: function(json) {
							}
					});
			 
			},
			
			eventClick: function(event) {
				jQuery("#dialog").modal('show');
					var link="<?php echo URL; ?>siak_kalender/form/edit/"+event.event_id;
				addModul(link);
				jQuery('#id').val(event.id);
				jQuery('#start').val(event.start);
				jQuery('#end').val(event.end);
				jQuery('#start').val(event.title);
				}
	});
				jQuery('#tanggal').datepicker({
						
						changeMonth: true,
						changeYear: true,
						defaultDate: 01-01-<?php echo $this->tahun; ?>,
						dateFormat: 'd MM, yy',
						minDate: new Date(<?php echo $this->tahun; ?>, 0, 1),
						maxDate: new Date(parseInt(<?php echo $this->tahun; ?>)+2, 3, 30),
						
						onSelect: function(dateText,dp){
						jQuery('#calendar').fullCalendar('gotoDate',new Date(Date.parse(dateText)));
						jQuery('#calendar').fullCalendar('changeView','month');
						
				   }
			
				});
		});
		
		

</script>
<!-- CONTENT CALENDAR -->	
			
			<div class="row-fluid">
					<div class="portlet box blue calendar">
						<div class="portlet-title">
							<div class="caption"><i class="icon-reorder"></i>Calendar</div>
						</div>
						<div class="portlet-body light-grey">
							<div class="row-fluid">
								<div class="span3 responsive" data-tablet="span12 fix-margin" data-desktop="span8">
									<!-- BEGIN DRAGGABLE EVENTS PORTLET-->    
									<h3 class="event-form-title">Kalender Akademik</h3>
									<div id="external-events">
									
											<input type="text" class="form-control" name="tanggal_lahir" id="tanggal" value="<?php echo $value['tanggal_lahir']; ?>"><br />
									<form id="users" name="users" target='_blank'  method = "post" action = "<?php echo URL;?>siak_cetak/kalender_akademik3">
										<input type='hidden' id="tahun">
										<input type='hidden' name='tahun_ak' value='<?php echo $this->tahun; ?>' id="tah">
										<input type='hidden' name='jenis' value='<?php echo $this->jenis; ?>' id="jenis-2">
											
											<div><button  type='submit' id="event_add" class="btn green">Cetak</button>
									</form>
									&nbsp; <a href="javascript:;"  class="btn yellow" onclick='history.go(-1);'>Kembali </a></div>
											
									
									
										
									</div>
									<!-- END DRAGGABLE EVENTS PORTLET-->            
								</div>
								<div class="span9">
									<div id="calendar" class="has-toolbar"></div>
								</div>
							</div>
							<!-- END CALENDAR PORTLET-->
						</div>
					</div>
				</div>
		
				<input type="hidden" id="start" >
				<input type="hidden" id="id" >
				<input type="hidden" id="event" >
				<input type="hidden" id="end" >
				<input type="hidden" id="judul" >
				<input type="hidden" id="color" >
				<input type='hidden' value='<?php echo $this->tahunid; ?>' id="tahun_id">
				<input type="hidden" id="bulan" >
		
				<div id="dialog" class="modal hide fade" data-width="450">
						
						<div id='addModul'></div>
						
				</div>
	<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
	  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
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
	var start = jQuery('#start').val();
						var end = jQuery('#end').val();
						var tahun_id = jQuery('#tahun_id').val();
						var jenis="<?php echo $this->jenis; ?>";
						var title = jQuery("#title");
						
							
						var bvalid =title.val();
						
						if (bvalid !== "" ) {
							
						jQuery.ajax({
							url: '<?php echo URL; ?>siak_kalender/siak_create',
							data: 'title='+ bvalid+'&mulai='+ start +'&akhir='+ end +'&event_id='+ bvalid+'&tahun_id='+ tahun_id+'&jenis='+ jenis,
							type: "POST",
							success: function(json) {
							
							jQuery('#calendar').fullCalendar('refetchEvents');
								 jQuery('#dialog').modal('hide');
								}
							});
							
						  }
						 else{
							alert('EVENT MASIH KOSONG');
						 }

}
function update_event(){
						var id=jQuery('#id').val();
						var event=jQuery('#title').val();
						jQuery.ajax({
							url: '<?php echo URL; ?>siak_kalender/siak_edit_save/'+id,
							data: 'id='+id+'&event_id='+event,
							type: "POST",
							success: function(json) {
							
							jQuery('#calendar').fullCalendar('refetchEvents');
							
							}
					});
						  jQuery('#dialog').modal('hide');
}
function hapus(){
var id=jQuery('#id').val();
						
						
						jQuery.ajax({
							url: '<?php echo URL; ?>siak_kalender/siak_delete/'+id,
							data: 'id='+id,
							type: "POST",
							success: function(json) {
							alert("Berhasil Dihapus");
							jQuery('#calendar').fullCalendar('refetchEvents');
						
							}
					});
						  jQuery('#dialog').modal('hide');
}
	</script>






