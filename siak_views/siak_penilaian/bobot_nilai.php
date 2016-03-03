<br>
<?php 
	function cek_nilai($data_komponen,$nim,$komponen){
			foreach($data_komponen as $v =>$row){
				if($row['id_komponen'] == $komponen){
					if($row['nim']==$nim){
						return array(true,$row['nilai']);
					}
				}
			}
			return array(false,'');	

	}
?>
<script>
$(document).ready(function(){
	//alert('ok'); 
	var link = '<?php echo URL; ?>siak_mahasiswa/data_pribadi/<?php echo $this->nim."/".$this->jenis;?>/edit';
      $.ajax({
	  url: link,
	  success: function(data) {
			$("#tab1").attr('class',$("#tab_1_1").attr('class') + ' active');
			$("#litab1").attr('class','active');
			$("#tabs1").html(data);
	  }
      });
});
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
			<li id='litab_1_1'><a href="#tab_1_1" data-toggle="tab" url='<?php echo URL;?>siak_penilaian/bobot'>BOBOT & KOMPONEN</a></li>
			<li id='litab_1_2'><a href="#tab_1_2" data-toggle="tab" url='<?php echo URL;?>siak_penilaian/range_nilai'>Range Nilai</a></li>
			<li id='litab_1_3'><a href="#tab_1_3" data-toggle="tab" url='<?php echo URL;?>siak_penilaian/list_nilai'>Penilaian</a></li>
			
		</ul>
	<div class="tab-content">
		<div class="tab-pane row-fluid" id="tab_1_1">
		<div class='span6'>
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
									<a href="#addForm" data-toggle="modal" onclick='addModul(this);' link='<?php echo URL; ?>siak_penilaian/form_isian/<?php echo $this->prodi."/".$this->tahun."/".$this->semester."/".$this->matkul."/".$value['id_komponen']; ?>/<?php echo $n; ?>'><i class='icon-external-link'></i></a>
									<a href="#" ><i class='icon-tags'></i></a>
								</td>
								<td>
									<center><a onclick='update_check("<?php echo $n;?>");'  ><input type='hidden' id='pilihcheck<?php echo $n;?>' value='<?php echo $status; ?>'><div id='check<?php echo $n;?>' ><i class='<?php echo $icon; ?>'></i></div></a></center>
								</td>
							</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		</div>
		
		<div class="tab-pane row-fluid " id="tab_1_2">
			<center>
			<div class='span6'>
			<table id="mahasiswa" class="table table-striped table-bordered table-advance table-hover">
				<thead>
					<tr align = "center">
						<th>NO</th>
						<th>NILAI</th>
						<th>MIN</th>
						<th>MAX</th>
						<th>BOBOT</th>
					</tr>
				</thead> 
				<tbody>
					<?php $n=0; foreach ($this->range_nilai as $key => $value) { $n++; ?>
							<tr>
								<td><?php echo $n; ?></td>
								<td><?php echo $value['nama'] ?></td>
								<td><?php echo $value['nilaimin'] ?></td>
								<td><?php echo $value['nilaimax'] ?></td>
								<td><?php echo $value['bobot'] ?></td>
								
							</tr>
					<?php } ?>
				</tbody>
			</table>
			</div>
			</center>
		</div>
		<div class="tab-pane row-fluid " id="tab_1_3">
			<div class="portlet box green" >
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>NILAI MAHASISWA</div>
	</div>
	<div class="portlet-body">
	<?php if($this->status=='t'){ ?>
		<div class="row-fluid">
				<div class="span12">
						<div class="control-group">
							<marquee><h3 style='color:blue;'><b>WAKTU PENGISIAN NILAI TINGGAL <?php echo $this->jarak; ?></b></h3></marquee>
						</div>
				</div>
		</div>
	<?php
	}elseif ($this->status=='f' && $this->data_nilai > 0){ ?>
		<div class="row-fluid">
				<div class="span12">
						<div class="control-group">
							<marquee><h3 style='color:green;'><b>WAKTU PENGISIAN NILAI SUDAH HABIS</b></h3></marquee>
						</div>
				</div>
		</div>
	<?php }else{ ?>
		<div class="row-fluid">
				<div class="span12">
						<div class="control-group">
							<marquee><h3 style='color:red;'><b>WAKTU PENGISIAN NILAI BELUM DI TENTUKAN SILAHKAN KONFIRMASI DENGAN DOSEN PENANGGUNG JAWAB</b></h3></marquee>
						</div>
				</div>
		</div>
	<?php } ?>
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td rowspan="2">NO</td>
			<td rowspan="2">NIM</td>
			<td rowspan="2">NAMA</td>
			<?php foreach ($this->bobot as $key => $value) { $i++; ?>
			<td rowspan="2"><?php echo $value['komponen'];?></td>
			<?php } ?>
			<td rowspan="2">ABSEN</td>
			<td colspan="2">NILAI AKHIR</td>
			
			<tr>
				<td align='center'>NILAI</td>
				<td align='center'>GRADE</td>
			</tr>
		</tr>
	</thead> 
	<tbody>
		<?php
		$asd = array();
		foreach ($this->data_nilai_mhs as $key => $value) {
			$asd[] =  $value['nim'];
		}
		$i = 0;
		foreach ($this->data_mahasiswa as $key => $value) {
			$i++;
			$nilaiabs = $this->db->siak_getfield("nilai", "nilai_absen", "nim = '".$value['nim']."' and prodi = '".$this->prodi."' and tahun = '".$this->tahun."' and semester = ".$this->semester." and kode_matkul = '".$this->matkul."'");
			if(empty($nilaiabs)){
				$nilai_absen = 0;
			}else{
				$nilai_absen = $nilaiabs;
			}			
			echo "<tr>";
			echo "<td align = 'center'>" . $i . "</td>";
			echo "<td>" . $value['nim'] . "<input type='hidden' id='nim' value='" . $value['nim'] . "'></td>";
			echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
			$datanim = sizeof($this->data_mahasiswa);
			//$status=$this->status == "t"? "<td align='center'><a data-toggle='modal' link='".URL."siak_penilaian/form_nilai/".$this->prodi."/".$this->semester."/".$value['nim']."/".$this->matkul."/".$this->tahun."' url='".$i."' onclick='add(this)'class='btn blue icn-only' href = '#formNilai'> Nilai </a></td>":"<td align='center'> - </td>" ;
			$datanimlai = sizeof($this->data_nilai);
			$datanimla = sizeof($this->data_nilai)+1;
			if (count($this->data_komponen_nilai) > 0) {
				// foreach ($this->data_nilai as $key => $vals) { $datanimla--;
					// $nilai = explode(',', $vals['nilai']);
					// if (($vals['nim']==$value['nim'] && $datanimla != 0) || ($vals['nim']==$value['nim'] && $datanimla != 0)) {
						// $urut=1;
						// foreach ($nilai as $key) {
							// echo "<td align='center'><div id='td".$i."".$urut."'>".number_format($key, 2, '.', '.')."</div></td>";
							// $urut++;
						// }
						// echo "<td align='center'>".$nilai_absen."</td>";
						// echo "<td align='center'><div id='tot".$i."'>".number_format($vals['nilai_total'], 2, '.', ',')."</div></td>";
						// echo "<td align='center'><div id='grade".$i."'>".$vals['grade']."</div></td>";
						// echo $status;
					
					// }
				// }
				// $datanimla--;
				
					foreach ($this->bobot as $key => $bobot) {
						$nilai=cek_nilai($this->data_komponen_nilai,$value['nim'],$bobot['id_komponen']);
						if($nilai[0]){
							echo "<td align='center'>".$nilai[1]."</td>";
						}
						else{
							echo "<td align='center'>0</td>";
						}
							
					}
					// foreach ($this->data_komponen_nilai as $key => $col) { $x++;
						// if($value['nim']==$col['nim']){
							echo "<td align='center'>".$nilai_absen."</td>";
							$SUM= $this->db->siak_query("select", "SELECT SUM(hasil_bobot) as rata_rata 
							FROM komponen_nilai where id_komponen IN (".$this->idAll.") and nim='".$value['nim']."'   
							");
							foreach($SUM as $v=>$rat){
								foreach($this->range_nilai as $i=>$range){
									if($range['nilaimin'] <= (int)$rat['rata_rata'] && $range['nilaimax'] >= (int)$rat['rata_rata']){
										echo "<td align='center'><div id='tot".$i."'>".$rat['rata_rata']."</div></td>";
										echo "<td align='center'><div id='grade".$i."'>".$range['nama']."</div></td>";
									}
								}
							}
							
						// }
					//}
			}else{
				$urut=1;
				foreach ($this->bobot as $key => $valu) {
					echo "<td align='center'><div id='td".$i."".$urut."'>-</div></td>";
					$urut++;
				}
				echo "<td align='center'>".$nilai_absen."</td>";
				echo "<td align='center'>-</td>";
				echo "<td align='center'>-</td>";
				
			}
			echo "</tr>";
		}
		?>
	</tbody>
</table>
</div>
</div>
		</div>
	</div>
	</div>
	</div>
							
				
</div>
<div id="addForm" class="modal hide fade" data-width='900'>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>

	<div id="addModul">
	
	</div>
</div>

