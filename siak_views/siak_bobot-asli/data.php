
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-globe"></i>Setting Bobot Nilai</div>
	</div>
	<div class="portlet-body" >
		
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addBobot" data-toggle="modal" link="<?php echo URL; ?>siak_bobot/siak_add/" onclick="edit(this)">Tambah</a>
<!-- 			<a class=" btn purple btn-large" onclick="test()">test</a> -->
		</div>
		<hr>
		<table id="bobot" class="table table-striped table-bordered table-hover table-full-width">
		<thead>
			<tr align = "center">
				<td>NO</td>
				<td>PRODI</td>
				<td>MATAKULIAH</td>
				<td>COHORT</td>
				<td>ACTION</td>
			</tr>
		</thead>
		<tbody align='center'>
			<?php
			$i = 0;
			foreach ($this->siak_data_list as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				 foreach($this->prodi as $key => $vale){
					 if ($value['prodi_id']==$vale['prodi_id']) {
						echo "<td>" . $vale['prodi'] . "</td>";
					 }
				 }
				foreach($this->matkul as $key => $vale){
					if ($value['matkul_id']==$vale['kode_matkul']) {
						echo "<td>" . $vale['nama_matkul'] . "</td>";
					}
				}
				echo "<td>" . $value['cohort'] . "</td>";
				echo "<td align = 'center'> <a class='btn blue mini' data-toggle='modal' data-target='#editBobot' onclick='editBobot(this)' link='".URL."siak_bobot/siak_edit/".$value['id']."'><i class='icon-edit'></i>Ubah</a> &nbsp <a class='btn red mini' data-toggle='modal' data-target='#hapusMDP' onclick='asd(this)' link='".URL."siak_bobot/siak_delete/".$value['id']."'><i class='icon-edit'></i>Hapus</a> </td>";
				echo "</tr>";
			}
			?>
			
		</tbody>
	</table>
	</div>
</div>

<div id="addBobot" class="modal hide fade" data-width="840" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="edit">
	
	</div>
</div>

<div id="editBobot" class="modal hide fade" data-width="840" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="editBot">
	
	</div>
</div>

<div id="hapusBobot" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapus" href="#">Hapus</a>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#bobot').DataTable();
	// $('#mulai1').datepicker({
			// dateFormat: 'yy-mm-dd',
			// changeMonth: true,
			// changeYear: true,
			// yearRange: "-100:+0"
		// });
	});
	
function editBobot(value){
      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $('#editBot').html(data);
	  }
      });
}

function getmatkul(value) {
	var strURL = jQuery(value).attr('link');
	var semes = jQuery(value).attr('value');
	var prodi = document.getElementById('prodi').value;
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
		req.open("GET", strURL+ "/" + prodi+ "/" + semes, true);
		req.send(null);
	}
}
	function delet(i){
		 jQuery("#row"+i+"").remove();
	}
	function deletes(i){
		 jQuery("#rows"+i+"").remove();
	}

	// jQuery(document).ready(function() {
// 	var i=0;
// 	var no=1;
// 	function addKom() {
// 		jQuery("#form-komp").append("<div id='row"+i+"'><div class='row-fluid'><div class='span2'><div class='control-group'>"+no+"</div></div><div class='span6'><div class='control-group'><input  value='' placeholder='komponen...' type='text' name='komponen[]' id='xshipto' class='form-control' /></div></div><div class='span2'><div class='control-group'><input value='' type='text' name='persentase[]' maxlength='5' id='xshipto' class='m-wrap span8' /></div></div></div><div class='row-fluid'><div class='span2'><div class='control-group'><button class='btn btn-default btn-xs' type='button' id='addsub' onclick='addSub("+i+");'>ADD</button></div></div><div class='span2'><div class='control-group'><button class='btn btn-default btn-xs' type='button' onclick='delet("+i+")'>DELETE</button></div></div></div><div id='form-groupsubkomp"+i+"'></div><div id='form-subkomp"+i+"'></div><div id='form-groupsubkomp"+i+"'></div><div id='form-subkomp"+i+"'></div></div>");
// 			i++;no++;}
// 			
// 	// });
// 
// 	 function addSub(i){
// 		var is=0;
// 		var nos=is++;
// 			jQuery("#form-subkomp"+i+"").append("<div class='rows' id='rows"+i+"'><div class='row-fluid'><div class='span2'></div><div class='span2'></div><div class='span6'><div class='control-group'><input  value='' placeholder='sub komponen...' type='text' name='sub_komponen"+i+"[]' id='xshipto' class='form-control' /></div>	</div><div class='span2'><div class='control-group'><button class='btn btn-default btn-xs' type='button' onclick='deletes("+i+")'>DELETE</button></div></div></div></div>");
// 				is++;nos++;
// 	 }
// 	 autoCom();
	 
	</script>