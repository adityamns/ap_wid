<div class="panel panel-primary">
	<div class="panel-body" >
		<div class="container-fluid">
			<form class="form-horizontal" method = "post" action="<?php echo URL;?>siak_rencana_studi/siak_ok">
				<div class="row" style="padding-left:15px;">
					<div class="form-group col-md-3">
						<select class="form-control" id="tahunid" name="tahun">
							<option value="">-- TAHUN ANGKATAN --</option>
							<?php for ($i=2009; $i <= date('Y'); $i++) { ?>
							<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group col-md-5">
						<select id="prodi" name="prodi" class="form-control" onchange="getData(this.value)">
							<option value="">- PRODI -</option>
						</select>
					</div>
				</div>
				<div>
					<table id='pengampu_pembekalan' class='table table-bordered table-striped table-hover table-contextual table-responsive dataTable'>
						<thead>
						<tr align = 'center'>
							<td>NO</td>
							<td>NIM</td>
							<td>NAMA</td>
							<td>NILAI</td>
							<td>GRADE</td>
							<td>ACTION</td>
						</tr>
						</thead>
						<tbody id="data">
						</tbody>
					<table>
				<div>
			</form>
		</div>
	</div>
</div>
<script>
	jQuery(document).ready(function() {
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
	
	function getData(prodi){
		var tahun = document.getElementById('tahunid').value;
		jQuery.ajax({
			type:"post",
			data:{PRODI:prodi,TAHUN:tahun},
			async: false,
			url:'<?php echo URL;?>siak_hasil_tesis/siak_data',
			success:function(data){
				data = JSON.parse(data);	
				if(data['mahasiswa'] != ''){
					jQuery("#data").html('');
					var i = 1;
					var a = '';
					jQuery.each(data['mahasiswa'],function(k,v){
							a = a+"<tr align='center'>";
							a = a+"<td>"+ i +"</td>";
							a = a+"<td>"+ v.nim +"</td>";
							a = a+"<td>"+ v.nama_depan+' '+v.nama_belakang +"</td>";
							a = a+"<td></td>";
							a = a+"<td></td>";
							a = a+"<td><a href='<?php echo URL;?>siak_hasil_tesis/siak_nilai/"+ v.nim +"'><span class='glyphicon glyphicon-check'>Nilai</span></a></td>";
							a = a+"</tr>";
						i++;
					});
					jQuery("#data").append(a);
					//fancy();
				} else {
					jQuery("#data").html('');
					var a = "<tr align='center'><td colspan='6'>Data Tidak Ditemukan</td></tr>";
					jQuery("#data").append(a);
				}
			},
		});
		return false;
	 };
</script>