<br>

<script>
$(document).ready(function(){
	//alert('ok');
	var link = '<?php echo URL; ?>siak_penilaian/getbobot/<?php echo $this->prodi."/".$this->cohort."/".$this->semester."/".$this->matkul;?>';
      $.ajax({
	  url: link,
	  success: function(data) {
			$("#tabs1").attr('class',$("#tabs1").attr('class') + ' active');
			$("#litab1").attr('class','active');
			$("#tabs1").html(data);
		}
      });
	
	$('[data-toggle="tab"]').click(function(e) {
     // e.preventDefault();
		  var li = $(this).attr('href');
		  var targ = $(this).attr('data-target');
		  var url = $(this).attr('url');
		 // alert(loadurl);
			$(targ).load(url, function() {
	      $(targ).tab(); //initialize tabs
	      // $('#data_bhs').DataTable();
	      // $('#data_karya').DataTable();
	      // $('#data_kursus').DataTable();
	      // $('#data_prestasi').DataTable();
	      // $('#data_seminar').DataTable();
	      
	     // loadData();
	      
      });	
      
     });
     setInterval(function(){countPerb()}, 3000);
});

function countPerb(){
	var matkul = "<?php echo $this->matkul;?>";
	var semester = "<?php echo $this->semester;?>";
	var cohort = "<?php echo $this->cohort;?>";
	var url = "<?php echo URL.'siak_penilaian/countPerb';?>";
	$.ajax({
		url: url+"/"+matkul+"/"+semester+"/"+cohort,
		success: function(res){
			$('#countPerb').html(res);
		}
	});
}
function add(value){
	  var link = $(value).attr('link');
	  var id = $(value).attr('url');
	  $.ajax({
		url: link,
		success: function(data) {
		  $('#add').html(data);
		   $('#td').val(id);
		}
	  });
	}
	function save_form(){
						var form=jQuery("#addform").serialize();
						var url=jQuery("#url").val();
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
									jQuery("#addForm").modal("hide");
										// var link = '<?php echo URL; ?>siak_mahasiswa/data_pribadi/<?php echo $this->nim."/".$this->jenis;?>/edit';
									  // $.ajax({
									  // url: link,
									  // success: function(data) {
										  $("#tab_1_2").attr('class',$("#tab_1_2").attr('class') + ' active');
										 // $("#tabs1").html(data);
									  // }
									  // });
								}
							});
	}
	function hasil(urut,id){
		var nilai 		= document.getElementById('nilai'+urut).value;
		var persentase  = document.getElementById('persentase'+id).value;
		var hasil		= nilai*persentase/100;
		
		document.getElementById('hasil'+urut).value=hasil;		
	}

	function hasil_sub(id, urut,id_kom){
		var sub_nilai 		= document.getElementById('sub_nilai'+id+urut ).value;
		var hasils 			= sub_nilai*1;
		document.getElementById('sub_hasil'+id+urut).value=hasils;
		var hasil_all = document.getElementsByName('sub_hasil'+urut+'[]');
		var total=0;
		for(i=0; i<hasil_all.length; i++){
			total = total + parseFloat(hasil_all[i].value);
		}
		sub_totals =+ total;
		sub_totals = sub_totals / hasil_all.length;
		document.getElementById('nilai'+urut).value =+ sub_totals;
		hasil(urut,id_kom);
	}
</script>

<div class="portlet">
							<div class="portlet-title">
								<div class="caption"><i class="icon-cogs"></i>Program Studi <?php echo $this->prodi;?> Cohort () Matakuliah () </div>
							</div>
	<div class="portlet-body">
	<div class='tabbable tabbable-custom tabbable-full-width'>
		<ul class="nav nav-tabs">
			<li id='litab1'><a href="tab1" data-target="#tabs1"  data-toggle="tab" url='<?php echo URL;?>siak_penilaian/getbobot/<?php echo $this->prodi."/".$this->cohort."/".$this->semester."/".$this->matkul;?>'>BOBOT & KOMPONEN</a></li>
			<li id='litab2'><a href="tab2" data-target="#tabs2" data-toggle="tab" url='<?php echo URL;?>siak_penilaian/range_nilai'>Range Nilai</a></li>
			<li id='litab3'><a href="tab3" data-target="#tabs3" data-toggle="tab" url='<?php echo URL;?>siak_penilaian/list_nilai/<?php echo $this->prodi."/".$this->cohort."/".$this->semester."/".$this->matkul;?>'>Penilaian</a></li>
			<li id='litab4'>
				<a href="tab4" data-target="#tabs4" data-toggle="tab" url='<?php echo URL;?>siak_penilaian/perbaikan_nilai/<?php echo $this->prodi."/".$this->cohort."/".$this->semester."/".$this->matkul;?>'>
				Perbaikan Nilai
<!-- 				<i class="icon-bell"></i> -->
				<span class="badge badge-important" id="countPerb">&nbsp;</span>
				</a>
			</li>
			
		</ul>
	<div class="tab-content">
		<div class="tab-pane row-fluid" id="tabs1">
		
		</div>
		
		<div class="tab-pane row-fluid" id="tabs2">
			
		</div>
		<div class="tab-pane row-fluid" id="tabs3">
						
		</div>
		<div class="tab-pane row-fluid" id="tabs4">
						
		</div>
	</div>
<div id="addForm" class="modal hide fade" data-width='900' data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>

	<div id="addModul">
	
	</div>
</div>

