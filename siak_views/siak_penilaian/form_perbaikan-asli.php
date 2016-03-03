<?php
$count = sizeof($this->data_mahasiswa);
if($count <= 0){
	echo "Nilai belum di Generate";
}else{


$perb = sizeof($this->data_perbaikan_nilai);

if($perb > 0){
	$qu = "updateP";
}else{
	$qu = "insertP";
}
?>

<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption"><i class="icon-reorder"></i>Daftar Mahasiswa Perbaikan Nilai</div>
		</div>
		<div class="portlet-body">

		<form id='addformPerX' >
			<input type='hidden' id='urlper' value='update_per'>
			<input type='hidden' name='qu' value='<?=$qu?>'>
			<input type='hidden' id='' value='insertP'>
			
			<input type='hidden' name='matkul' value='<?php echo $this->matkul;?>'>
			<input type='hidden' name='prodi' value='<?php echo $this->prodi;?>'>
			<input type='hidden' name='semester' value='<?php echo $this->semester;?>'>
			<input type='hidden' name='colspan' value='<?php echo $this->colspan;?>'>
<!-- 			<input type='hidden' name='id_komponen' value='<?php echo $this->idkomp;?>'> -->
		<table id="tabel_modul" class="table table-striped table-bordered table-hover table-full-width">
			<tr>
				<th><center>Kode</center></th>
				<th><center>Nama</center></th>
<!-- 				<th><center>Status Perbaikan</center></th> -->
				<th><center>Nilai Asli</center></th>
				<th><center>Perbaikan</center></th>
				
				
			</tr>
			<?php $urut=1; foreach($this->data_mahasiswa as $v => $value){ ?>
			<tr>
				<td>
					<?php echo $value['nim']; ?>
					<input type='hidden' name='nim[]' value='<?php echo $value['nim'];?>'>
				</td>
				<td>
					<?php echo $value['nama_depan']." ".$value['nama_belakang']; ?>
				</td>
				<!--<td>
					<?php 
					$stPerb = ($value['st_perb'] == 0)?"Pertama":"Kedua";
					//echo $stPerb;
					?>
				</td>-->
				<td>
					<?php echo $value['nilai_total'];?>
				</td>
				<td>
					<input type="hidden" name="idNilaiOld[]" value="<?php echo $value['id_nilai']?>">
					<input type="hidden" name="gradeOld[]" value="<?php echo $value['grade']?>">
					<input type="hidden" name="statusPerb[]" value="<?php echo $value['st_perb']?>">
					<input type="hidden" name="old[]" value="<?php echo $value['nilai_total'];?>">
					<input type="text" name="perb[]" style='width:50px;' value="0">
				</td>
				
			</tr>
			<?php $urut++;} ?>
		</table>
		<div class="row-fluid">
			<div class="span4">
				<div class="input-group">
					<button type="button" onclick='save_formPerX()' class="btn green">Simpan</button>
				</div>
			</div>
		</div>
		</form>
		
	</div>
</div>
<script>
function save_formPerX(){
	var form=jQuery("#addformPerX").serialize();
	var url="<?php echo URL.'siak_penilaian/upPer';?>";
	
// 	alert(url);
	
	jQuery.ajax({
		  url: url,
		  data: form,
		  type: "POST",
		  success: function(data) {
			console.log(data);
			// data = JSON.parse(data);
			// total = parseInt(data.total);
			// document.getElementById('grade'+ divtd).innerHTML =data.grade;
			// document.getElementById('tot'+ divtd).innerHTML =total.toFixed(2);
			// for(i=1; i<=jumlah; i++){
					// var val=parseInt(jQuery("#nilai"+i).val());
					// document.getElementById('td'+ divtd + i).innerHTML =val.toFixed(2);
			//}
			
// 				jQuery("#perbaikan").modal("hide");
		}
	});
}
</script>

<?php 
}
?>