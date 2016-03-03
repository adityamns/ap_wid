<?php if ($this->rolePage['reades'] == "t") { ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Kalender Akademik Fakultas</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body">

		<div class="panel panel-primary">
			<div class="panel-body" >
			<?php if ($this->rolePage['creates'] == "t") { ?>
				<div class="input-group">
					<a data-toggle='modal' class='btn blue icn-only' link="<?php echo URL; ?>siak_jadwal/siak_add/" href='#formADD' onclick='add(this)' > Tambah</a>
				</div>
					
				<hr>
			<?php } ?>
				<table id = "LIST_JADWAL" class="table table-bordered table-striped table-hover table-contextual table-responsive">
				<thead>
				<tr align = "center">
					<td><center>NO</td>
					<td><center>TAHUN AKADEMIK</td>
					<td><center>PRODI</td>
					<td><center>COHORT</td>
					<td><center>ACTION</td>
				</tr>
				</thead>
				<tbody>
				<?php
					$i = 0;
					foreach ($this->siak_data as $key => $value) {

						$i++;
						echo "<tr class='active'>";
						echo "<td align = 'center'>" . $i . "</td>";
						echo "<td align = 'center'><center><b>" . $value['nama_tahun'] . "</td>";
						echo "<td align = 'center'><b>" . $value['prodi'] . "</td>";
						echo "<td align = 'center'><b><center>" . $value['cohort'] . "</td>";
						echo "<td align = 'center'><center>";
						echo $this->rolePage['updates']=="t"?
						"<a  href = '".URL."siak_jadwal/create/".$value['tahun']."/".$value['tahun_id']."/".$value['prodi_id']."/".$value['cohort']."'class='btn red mini'>Ubah</a>"
						:""
						;
						echo $this->rolePage['deletes']=="t"?
						"&nbsp <a href = '".URL."siak_jadwal/siak_delete/".$value['id']."' class='btn yellow mini'>Hapus</a>"
						:""
						;
					echo "</td></tr>";
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>

</div>
	<div id="formADD" class="modal  hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>FORM JADWAL</h3>
	</div>
	<div id="add"></div>
</div>
<script>
	$('#LIST_JADWAL').DataTable();
	function cek_id(){
		var tahun_ak=jQuery('#tahun_ak').val();
				jQuery.ajax({
				url: '<?php echo URL; ?>siak_kalender/getTahun_ID/'+tahun_ak,
				dataType: "html",
				success: function (data) {
					jQuery('#tahun_id').val(data);
						
					}
			});
		}
	function cek_kalender(){
		var prodi=jQuery('#prodi').val();
		var tahunid=jQuery('#tahun_id').val();
		var cohort=jQuery('#cohort').val();
		jQuery.ajax({
				url: '<?php echo URL; ?>siak_jadwal/cek_kalender/'+tahunid+'/'+prodi,
				dataType: "html",
				success: function (data) {
				
					if(data=="KOSONG"){
							jQuery("#konfim").html("<div style='color:red;'># Kalender Akademik belum Tersedia</div>");
							jQuery('input[type="submit"]').attr('disabled','disabled');
							
						}
					else{
							jQuery("#konfim").html("<div style='color:green;'># Kalender Sudah Tersedia</div>");
							 jQuery('input[type="submit"]').removeAttr('disabled');
						}
						
					}
			});
		if(cohort!=''){
			jQuery.ajax({
				url: '<?php echo URL; ?>siak_jadwal/cek_jadwal/'+tahunid+'/'+prodi+'/'+cohort,
				dataType: "html",
				success: function (data) {
				//alert('jalan');
				var data_jadwal=data;
					
					if(data=="KOSONG"){
							  jQuery("#konfim1").html("<div style='color:green;'># Jadwal belum Tersedia</div>");
							 jQuery('input[type="submit"]').removeAttr('disabled');
						}
					else{
							 jQuery("#konfim1").html("<div style='color:red;'># Jadwal Sudah Tersedia</div>");
							 jQuery('input[type="submit"]').attr('disabled','disabled');
						}
						
					}
			});
		}
			
	}
</script>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>