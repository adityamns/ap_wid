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

<script type="text/javascript">
$( "#awal" ).datepicker({
changeMonth: true,
changeYear: true
});
$( "#akhir" ).datepicker({
changeMonth: true,
changeYear: true
});

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
	jQuery('#berita').on('click','#hapus_modul',function(event){
		if(confirm('Anda yakin?'))
		{
			jQuery(this).closest('tr').remove();
		}
	});
});
</script>