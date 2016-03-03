<script>
$(function(){
	$(document).ready(function(){
	
	$(document).ajaxStart(function(){
	  $("#wait").css("display","block");
	});

	$(document).ajaxComplete(function(){
	  $("#wait").css("display","none");
	});
})
	
    var hash = window.location.hash;
    if(hash != ""){
      var tabhash = $(hash);
      var loadurl = tabhash.attr('href');
      var targ = tabhash.attr('data-target');
      $.ajax({
	  url: loadurl,
	  success: function(data) {
	      $(targ).attr('class',$(targ).attr('class') + ' active');
	      $(targ).html(data);
	  }
      });
    } else {
      var link = '<?php echo URL; ?>siak_mahasiswa/data_pribadi/<?php echo $this->nim."/".$this->jenis;?>/edit';
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#tabs1").attr('class',$("#tabs1").attr('class') + ' active');
	      $("#tabs1").html(data);
	  }
      });
    }
	
	$('[data-toggle="tab"]').click(function(e) {
      e.preventDefault();
      var loadurl = $(this).attr('href');
      var targ = $(this).attr('data-target');
      
      $(targ).load(loadurl, function() {
	      $(targ).tab(); //initialize tabs
	      // $('#data_bhs').DataTable();
	      // $('#data_karya').DataTable();
	      // $('#data_kursus').DataTable();
	      // $('#data_prestasi').DataTable();
	      // $('#data_seminar').DataTable();
	      
	      loadData();
	      
      });	
      

  });
		jQuery.ajax({
			url: '<?php echo URL; ?>siak_jadwal/load_prodi',
			dataType: "json",
			success: function (list) {
				for (var i = 0; i < list.length; i++) {

					jQuery("#prodi").append("<option value='" + list[i].prodi_id + "'>" + list[i].prodi + "</option>");					
				}
			}
		});
	});
</script>

<div class="portlet box blue" >
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Form Penilaian</div>
	</div>
	<div class="portlet-body">
			<form class="form-horizontal" method = "post" action="<?php echo URL;?>siak_rencana_studi/siak_ok">
				<div class="row-fluid">
					<div class='span2' >
						
							<select class="m-wrap span12" id="cohort" name="cohort">
								<option value="">COHORT</option>
								<?php $x=1; for ($i=2009; $i <= date('Y'); $i++) { ?>
									<option value="<?php echo $x; ?>" ><?php echo $x; ?></option>
								<?php $x++;} ?>
							</select>
						
					</div>
					
						<div class="span4">
							<select id="prodi" name="prodi" class="m-wrap span12">
								<option value="">- PRODI </option>
							</select>
						</div>
					
					
						<div class="span2">
							<select id="semester" name="semester" class="m-wrap span12" link="<?php echo URL;?>siak_penilaian/matkul"  onchange='getCoba(this)'>
								<option value="0" >SEMESTER</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
						
					</div>
					
						<div class="span4">
					<div id="statediv">
							<select id="matkul" align='center' name="matkul" class="m-wrap span12" onchange="">
								<option value="0" >MATA KULIAH</option>
							</select>
						</div>
					</div>
				</div>
				<div id='bobotnilai'>
				</div>
			</form>
		</div>
	</div>
	<div id="formNilai" class="modal  hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>FORM NILAI</h3>
	</div>
	<input type="hidden"  id='td' >
	<div id="add"></div>
</div>


<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<script type="text/javascript">
	
	function getBobot(value){
		var prodi = document.getElementById('prodi').value;
		var cohort = document.getElementById('cohort').value;
		var semes = document.getElementById('semester').value;
		var matkul = jQuery(value).val();
		var link = jQuery(value).attr('link');
		var id = $(value).attr('url');
			$.ajax({
				url: link+ "/" + prodi + "/" + cohort+ "/" + semes+ "/" + matkul,
				success: function(data) {
				  $('#bobotnilai').html(data);
				}
			  });
	}
	function update_form(){
						var form=jQuery("#formedit").serialize();
						var divtd = document.getElementById('td').value;
						var jumlah=jQuery("#jumlah").val();
						// var test ='';
							jQuery.ajax({
								 url: "<?php echo URL;?>siak_penilaian/update_nilai",
								 data: form,
								 type: "POST",
								 success: function(data) {
									data = JSON.parse(data);
									total = parseInt(data.total);
									document.getElementById('grade'+ divtd).innerHTML =data.grade;
									document.getElementById('tot'+ divtd).innerHTML =total.toFixed(2);
									for(i=1; i<=jumlah; i++){
											var val=parseInt(jQuery("#nilai"+i).val());
											document.getElementById('td'+ divtd + i).innerHTML =val.toFixed(2);
									}
									jQuery("#formNilai").modal("hide");
								}
							});
	}
	
	


	function hitung(){
		var hasil_all = document.getElementsByName('hasil[]');
		var total=0;
		for(i=0; i<hasil_all.length; i++){
			total = total + parseFloat(hasil_all[i].value);
		}
		document.getElementById('total').value =+ total;
		document.getElementById('grade').value = "A";
	}

	function getCoba(value) {
		var strURL = jQuery(value).attr('link');
		var prodi = document.getElementById('prodi').value;
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
	// function getBobot(value) {
		// var strURL = jQuery(value).attr('link');
		//alert('ok');
		// var prodi = document.getElementById('prodi').value;
		// var cohort = document.getElementById('cohort').value;
		// var semes = document.getElementById('semester').value;
		// var matkul = jQuery(value).val();

		// var req = getXMLHTTP();
		// if (req) {
			// req.onreadystatechange = function() {
				// if (req.readyState == 4) {
					// if (req.status == 200) {
						// document.getElementById('bobotnilai').innerHTML=req.responseText;
						
					// } else {
						// alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					// }
				// }       
			// }     
			// req.open("GET", strURL+ "/" + prodi + "/" + cohort+ "/" + semes+ "/" + matkul, true);
			// req.send(null);
		// }
	// }
	
// 	function save_formPer(){
// 		var form=jQuery("#addformPer").serialize();
// 		var url="<?php echo URL.'siak_penilaian/upPer';?>";
// 		//var divtd = document.getElementById('td').value;
// 		//var jumlah=jQuery("#jumlah").val();
// 		jQuery.ajax({
// 			  url: url,
// 			  data: form,
// 			  type: "POST",
// 			  success: function(data) {
// 				// data = JSON.parse(data);
// 				// total = parseInt(data.total);
// 				// document.getElementById('grade'+ divtd).innerHTML =data.grade;
// 				// document.getElementById('tot'+ divtd).innerHTML =total.toFixed(2);
// 				// for(i=1; i<=jumlah; i++){
// 						// var val=parseInt(jQuery("#nilai"+i).val());
// 						// document.getElementById('td'+ divtd + i).innerHTML =val.toFixed(2);
// 				//}
// 				
// // 				jQuery("#perbaikan").modal("hide");
// 			}
// 		});
// 	}
	function save_formPer2(){
		var form=jQuery("#addformPer").serialize();
		var url=jQuery("#urlper").val();
		//var divtd = document.getElementById('td').value;
		//var jumlah=jQuery("#jumlah").val();
		jQuery.ajax({
			  url: "<?php echo URL;?>siak_penilaian/"+url,
			  data: form,
			  type: "POST",
			  success: function(data) {
				// data = JSON.parse(data);
				// total = parseInt(data.total);
				// document.getElementById('grade'+ divtd).innerHTML =data.grade;
				// document.getElementById('tot'+ divtd).innerHTML =total.toFixed(2);
				// for(i=1; i<=jumlah; i++){
						// var val=parseInt(jQuery("#nilai"+i).val());
						// document.getElementById('td'+ divtd + i).innerHTML =val.toFixed(2);
				//}
				jQuery("#perbaikan").modal("hide");
			}
		});
	}
	
	function update_check(i)
	{
		var val=document.getElementById("pilihcheck"+i).value;
		var id=document.getElementById("id_komp"+i).value;
		var prodi = $('#prodi').val();
			if(val=='checked'){
				$.ajax({
					 url: "<?php echo URL;?>siak_penilaian/publish/"+id,
					 data: {publis:2, prodi:prodi},
					 type: "POST",
					 success: function(data) {
						
					}
				});
				tombol="<i class='icon-check-empty'></i>";
				document.getElementById("pilihcheck"+i).value='check';
			}
			else if(val=='check'){
				$.ajax({
					 url: "<?php echo URL;?>siak_penilaian/publish/"+id,
					 data: {publis:1, prodi:prodi},
					 type: "POST",
					 success: function(data) {
						
					}
				});
				tombol="<i class='icon-check'></i>";
				document.getElementById("pilihcheck"+i).value='checked';
			}

		document.getElementById("check"+i).innerHTML=tombol;
		
				
		
	}
</script>