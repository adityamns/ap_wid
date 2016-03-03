<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		
		<?php foreach ($this->siak_data_list as $key => $value) { ?>
 		<form id="formEditKeg" class="horizontal-form" action = "<?php echo URL;?>siak_pengumuman/siak_edit_save/<?=$value['acara_id']?>" method = "post">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="judul">Judul</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="judul" value="<?=$value['judul']?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="kategori_id">Kategori Agenda / Kegiatan</label>
						<div class="controls">
							<select name="kategori_id" id="kategori_id" onchange="ubah()" class="m-wrap span12" link="<?php echo URL;?>siak_pengumuman/check_form">
								<option value='0'>-- Pilih --</option>
								<?php
								foreach($this->kategori as $key => $vals){
									$selected = ($value['kategori_id'] == $vals['kategori_id'])?"selected":"";
									echo "<option value='$vals[kategori_id]' $selected>$vals[jenis_kategori]</option>";
								}
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
			
 			<div id='berita-d' style="display: none">
 			
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tanggal_mulai">Tanggal Mulai</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tanggal_mulai" id="awal" readonly placeholder="Mulai...">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="pengumuman">Tanggal Selesai</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tanggal_akhir" id="akhir" readonly placeholder="Mulai...">
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="pengumuman">Berita</label>
						<div class="controls">
							<textarea class="m-wrap span12" name="pengumuman" placeholder="Isi Acara..."></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="pengumuman">Program Studi</label>
						<div class="controls">
							<button type="button" class=" btn purple btn-large" onclick="add_row_modul();">Tambah</button>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="pengumuman">Status</label>
						<div class="controls">
							<select name="status" id="status" class="m-wrap span12">
								<option value=''> --Pilih-- </option>
								<option value='Y'>Aktif</option>
								<option value='T'>Tidak Aktif</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<table id ="berita" class="table table-bordered table-striped table-hover table-contextual table-responsive">
				<tr>
					<th width="10%">Prodi</th>
					<th width="5%">Cohort</th>
					<th width="5%">Aksi</th>
				</tr>
			</table>
			
			</div>
 			<div id="umumz">
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tanggal_mulai">Tanggal Mulai</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tanggal_mulai" id="awal2" readonly value="<?=$value['tanggal_mulai']?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="pengumuman">Status</label>
						<div class="controls">
							<select name="status" id="status" class="m-wrap span12">
							<?php 
							$aktif = ($value['status'] == 'Y')?"selected":"";
							$taktif = ($value['status'] == 'T')?"selected":"";
							?>
								<option value=''> --Pilih-- </option>
								<option value='Y' <?=$aktif?>>Aktif</option>
								<option value='T' <?=$taktif?>>Tidak Aktif</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="isi_acara">Pengumuman</label>
						<div class="controls">
							<textarea class="m-wrap span12" name="pengumuman" ><?=$value['isi_acara']?></textarea>
						</div>
					</div>
				</div>
			</div>
			</div>
 		</form>
		<?php } ?>
 		
 		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formEditKeg').submit();">Save changes</button>
</div>
 
<script type="text/javascript">
	$('#kategori_id').on('change', function(e){
	
		var val = $(this).attr('value');
		
		if(val == '1'){
		      $('#umumz').show();
		      $('#berita-d').hide();
		      dis(document.getElementById("berita-d"));
// 		      alert(document.getElementById("umumz").disabled);
		      if(document.getElementById("umumz").disabled == true){ dis(document.getElementById("umumz")); }
		}else{
		      $('#berita-d').show();
		      $('#umumz').hide();
		      dis(document.getElementById("umumz"));
// 		      alert(document.getElementById("berita-d").disabled);
		      if(document.getElementById("berita-d").disabled == true){ dis(document.getElementById("berita-d")); }
		      
		}
		
		
	});
</script>
<script type="text/javascript">
$( "#awal" ).datepicker({
changeMonth: true,
changeYear: true
});
$( "#akhir" ).datepicker({
changeMonth: true,
changeYear: true
});
$( "#awal2" ).datepicker({
changeMonth: true,
changeYear: true
});

function dis(el){
	try {
	    el.disabled = el.disabled ? false : true;
	}catch(E){
	
	}
		if (el.childNodes && el.childNodes.length > 0){
			for (var x = 0; x < el.childNodes.length; x++) 
			{
			dis(el.childNodes[x]);
			}
		}
}

var no = 1;
function add_row_modul()
{	
	jQuery('#berita').append(
		'<tr>' +
		'<td>'+
		'<select class="m-wrap span12" name="prodi_id[]"  link="<?php echo URL;?>siak_pengumuman/cohort" onChange=getCohort(this,' + no + ')>'+
		<?php foreach ($this->prodi as $key => $value) { ?>
			'<option value="<?php echo $value['prodi_id'];?>"><?php echo $value['prodi'];?></option>'+	
		<?php } ?>
		'</select>'+
		'</td>'+
		'<td>'+
		'<div id="statemum' + no + '">'+
		'<select class="m-wrap span12">'+
		'<option value="id_cohort[]">Cohort</option>'+
		'</select>'+
		'</div>'+
		'</td>'+
		'<td><a style="cursor:pointer;" class="btn red mini" title="Hapus" id="hapus_modul"><i class="icon-trash"></i> Hapus</a></td></tr>'

	);
	no++;
}



function click_checkbox(tr, index)
{
	if(jQuery(tr).is(':checked'))
	{
		jQuery(tr).parents('tr').find('td:eq('+index+') input').val('t');
	}
	else
	{
		jQuery(tr).parents('tr').find('td:eq('+index+') input').val('f');
	}
}

jQuery(document).ready(function(){
	dis(document.getElementById("berita-d"));
	jQuery('#berita').on('click','#hapus_modul',function(event){
		if(confirm('Anda yakin?'))
		{
			jQuery(this).closest('tr').remove();
		}
	});
});
</script>