<div class="row-fluid">
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Setup Alumni</div>
			</div>

			<div class="portlet-body">		
		
			<form class="form-horizontal" method = "post" action="<?php echo URL;?>alumni/create">
			
			<div class="row-fluid">
				<div class="span6">
				<div class="control-group">
					<label class="control-label" for="tanggal_mulai">Gelombang</label>
					<div class="controls">
						<select id="prodi" name="prodi" class="m-wrap span6" link="<?=URL?>alumni/get_cohort" onchange="getCohort(this)">
						      <option value="">--Pilih Prodi--</option>
						<?php 
						foreach($this->prodi as $prodi => $field){
						?>
							<option value="<?=$field['prodi_id']?>"><?=$field['prodi']?></option>
						<?php } ?>
						</select>
					</div>
				</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
				<div class="control-group">
					<label class="control-label" for="tanggal_mulai">Tahun</label>
					<div class="controls">
						<span id="data">
							<select class="m-wrap span6" id="tahunid" name="tahun">
								<option value="">-- TAHUN ANGKATAN --</option>
							</select>
						</span>
					</div>
				</div>
				</div>
			</div>
				<table id='mhs_alumni' class='table table-bordered table-striped table-hover table-contextual table-responsive dataTable'>
					<thead>
					<tr align = 'center'>
						<td>NO</td>
						<td>NIM</td>
						<td>NAMA</td>
						<td>NILAI TESIS</td>
						<td>GRADE</td>
						<td>IPK</td>
					</tr>
					</thead>
					<tbody id="data_mhs">
					</tbody>
				</table>
			</form>
			</div>
		</div>
	</div>
</div>

<script>

jQuery(document).ready(function(){
	var strURL = '<?php echo URL."alumni/get_data"?>';
	
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('data_mhs').innerHTML=req.responseText;            
				} else {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}       
		}     
		req.open("GET", strURL, true);
		req.send(null);
	}
});

function getCohort(value) {
	var strURL = jQuery(value).attr('link');
	var prodi = document.getElementById('prodi').value;
	
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('data').innerHTML=req.responseText;            
				} else {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}       
		}     
		req.open("GET", strURL+ "/" + prodi , true);
		req.send(null);
	}
}

function getMhs(value) {
	var strURL = jQuery(value).attr('link');
	var prodi = document.getElementById('prodi').value;
	var semes = jQuery(value).val();
	var cohort = document.getElementById('tahunid').value;
	
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('data_mhs').innerHTML=req.responseText;            
				} else {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}       
		}     
		req.open("GET", strURL+ "/" + prodi + "/" + cohort, true);
		req.send(null);
	}
}

function create() {
	jQuery.ajax({
		url:'<?php echo URL."alumni/create"; ?>',
		type:'post',
		data:{
		      nim: '',
		      ref:'nama' 
		      },
		success:function(data){
			data = JSON.parse(data);
			var content = '';
			jQuery.each(data,function(key, val){
				//content += '<option value="' + val.nama + '">' + val.nama + '</option>';
				jQuery('#data_mhs').val(val.prodi_id);
			});
		},
		beforesend:function(){
		},
		error:function(){
		}
	});
};
</script>
