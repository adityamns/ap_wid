<div class='span12'>
			<table id="mahasiswa" class="table table-striped table-bordered table-advance table-hover">
				<thead>
					<tr align = "center">
						<th><center>NO</th>
						<th><center>KOMPONEN</th>
						<th><center>BOBOT</th>
						<th><center>NILAI TERISI</th>
						<th><center>OPERASI</th>
						<th><center>PUBLISHED</center></th>
					</tr>
				</thead> 
				<tbody>
					<?php $n=0; foreach ($this->bobot as $key => $value) { $n++; 
							$publis=$value['published'];
							if($publis==2){
								$icon='icon-check-empty';
								$status='check';
							}
							elseif($publis==1){
								$icon='icon-check';
								$status='checked';
							}
							else{
								$icon='';
								$status='';
							}
							
					?>
							<tr>
								<td><center><?php echo $n; ?>.</td>
								<td><center><?php echo $value['komponen']; ?><input type='hidden' value='<?php echo $value['id_komponen']; ?>' id='id_komp<?php echo $n; ?>' ></td>
								<td><center><?php echo $value['persentase']; ?> %<input type='hidden' value='<?php echo $value['persentase'];?>' id='persentase<?php echo $n; ?>' name='persentase[]'  ></td>
								<td><center><?php 
									$query=$this->db->siak_query("select", "select komponen,nim from sub_nilai_mahasiswa where komponen=".$value['id_komponen']." and sub_nilai >0 group by komponen,nim");
									$jumlah=count($query);
									echo "<input class='m-wrap span4' readonly type='text' value='".$jumlah."'>"; ?>
								</td>
								<td>
									<center><a href="#addForm" data-toggle="modal" onclick='addModul(this);' link='<?php echo URL; ?>siak_penilaian/form_isian/<?php echo $this->prodi."/".$this->cohort."/".$this->semester."/".$this->matkul."/".$value['id_komponen']; ?>/<?php echo $n; ?>'><i class='icon-external-link'></i></a>&nbsp;
									
									
									<?php
// 									$cek = $this->db->siak_query('select', "select nim from komponen_nilai where nim='".$value['nim']."' and status_perbaikan = true");
									//if($value['komponen'] == 'UAS'){
									?>
<!-- 									<a href="#perbaikan" data-toggle="modal" onclick='addPer(this);' link='<?php echo URL."siak_penilaian/perbaikan_nilai/".$this->prodi."/".$this->cohort."/".$this->semester."/".$this->matkul."/".$value['id_komponen']."/".$n?>'><i class='icon-check'></i>Perbaikan</a> -->
									<?php //}?>
									
								</td>
								<td>
									<center><a onclick='update_check("<?php echo $n;?>");'  ><input type='hidden' id='pilihcheck<?php echo $n;?>' value='<?php echo $status; ?>'><div id='check<?php echo $n;?>' ><i class='<?php echo $icon; ?>'></i></div></a></center>
								</td>
							</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		
<!-- Perbaikan Modal -->
<div id="perbaikan" class="modal hide fade" data-width='900'>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Daftar Mahasiswa Perbaikan</h3>
	</div>

	<div id="modper">
	
	</div>
</div>
<script>
function addPer(value) {
	var strURL = jQuery(value).attr('link');
	var url = strURL;
	
// 	alert(url);
	
	$.ajax({
	      url: url,
	      success: function(data) {
		$('#modper').html(data);
	      }
	});
}
</script>
<!-- end -->

