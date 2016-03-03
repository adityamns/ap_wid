<script>
	function edit_save(id){
		var val=$('#status'+id).val();
		  $.ajax({
  			url: '<?php echo URL;?>siak_penilaian/siak_edit_save/'+id,
  			type:"post",
  			data:{status:val},
  			async: false,
  			success: function (data) {
				if(val==1){
					$('#button'+id).html("<input type='hidden' id='status"+id+"' value='2' name='status'><button type='button' onclick='edit_save("+id+")' class='btn red mini'>EDIT</button>");	
				}
				else{
					$('#button'+id).html("<input type='hidden' id='status"+id+"' value='1' name='status'><button type='button' onclick='edit_save("+id+")' class='btn green mini'>PUBLISH</button>");	
				}
  			}
  		});
	}
</script>
<?php 
//if ($this->loads == "t") { ?>
<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
				<div class="caption"><i class="icon-globe"></i>Daftar Nilai Mahasiswaw</div>
			<div class="portlet-title">
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="btn-group pull-right">
						<button class="btn dropdown-toggle" data-toggle="dropdown">Cetak / Download <i class="icon-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right">
							<li><a href="#">Cetak</a></li>
							<li><a href="#">PDF</a></li>
							<li><a href="#">Excel</a></li>
						</ul>
					</div>
					<div id='bejo'>
					</div>
				</div>
				<br>
				<br>
				<?php //if ($this->reades == "t") { ?>
					<table id="example" class="table table-striped table-bordered table-hover table-full-width">
					<thead>
						<tr align = "center">
							<th>NO</th>
							<th>NIM</th>
							<th>NAMA</th>
							<th>PRODI</th>
							<th>NILAI</th>
							<th>GRADE</th>
							<th>STATUS</th>
						</tr>
					</thead> 
					<tbody>
						<?php
						$i = 0;
						foreach ($this->siak_data as $key => $value) {
							$i++;
							if($value['status']==1){
									$val=2;
									$isi="<button type='button' onclick='edit_save(".$value['id'].")' class='btn red mini'>EDIT</button>";
								}else{
									$val=1;
									$isi="<button type='button' onclick='edit_save(".$value['id'].")' class='btn green mini'>PUBLISH</button>";
								}
							echo "<tr class='active'>";
							echo "<td align = 'center'>" . $i . "</td>";
// 							echo $this->reades=="t"?"<td><a href = '".URL."siak_master/siak_mahasiswa/".$value['nim']."/".$value['jenis']."'>" . $value['nim'] . "</a></td>":"<td>" . $value['nim'] . "</td>";
							echo "<td>" . $value['nim'] . "</a></td>";
							echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
							echo "<td>" . $value['prodi'] . "</td>";
							echo "<td>" . number_format($value['nilai_total'],2,",",".") . "</td>";
							echo "<td>" . $value['grade'] . "</td>";
							echo "	<td>
									
									<div id='button".$value['id']."'><input type='hidden' id='status".$value['id']."' value='".$val."' name='status'>".$isi."</div>
									</td>";
								
								// elseif($value['status']==3){
									// echo "<td></td>";
								// }
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
				<?php //} ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#mahasiswa').DataTable();
} );
</script>
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>