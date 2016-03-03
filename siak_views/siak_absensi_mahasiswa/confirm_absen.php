<script type="text/javascript">
	/*alert('<?php echo "Batas waktu absen : ".$_SESSION['batas']; ?>');
	window.onload=function(){ 
		var tanggal_kuliah = document.getElementById("waktu1").value;
		var waktu_kuliah = tanggal_kuliah.split(" ");
		var jam_kuliah = waktu_kuliah[1];
		
		alert(jam_kuliah);
	
	}*/
	
	function update_color(i)
	{
		var val=document.getElementById("formDiv"+i).value;
			if(val==1){
				color="<span class='btn mini green'>HADIR</span>";
			}
			else if(val==2){
				color="<span class='btn mini yellow'>SAKIT</span>";
			}else if(val==3){
				color="<span class='btn mini blue'>IJIN</span>";
			}else if(val==4){
				color="<span class='btn mini red'>ALPA</span>";
			}

		document.getElementById("status"+i).innerHTML=color;
		
	}
	function doSearch() {
			var searchText = document.getElementById('searchTerm').value.toLowerCase();;
			var targetTable = document.getElementById('konfirmasiabsen');
			var targetTableColCount;
					
			//Loop through table rows
			for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
				var rowData = '';

				//Get column count from header row
				if (rowIndex == 0) {
				   targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
				   continue; //do not execute further code for header row.
				}
						
				//Process data rows. (rowIndex >= 1)
				for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
					rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent.toLowerCase();;
				}

				//If search term is not found in row data
				//then hide the row, else show
				if (rowData.indexOf(searchText) == -1)
					targetTable.rows.item(rowIndex).style.display = 'none';
				else
					targetTable.rows.item(rowIndex).style.display = 'table-row';
			}
		}
		
		
</script>
<script type="text/javascript" language="javascript">// <![CDATA[
function checkAll(formname, checktoggle)
{
  var checkboxes = new Array(); 
  checkboxes = document[formname].getElementsByTagName('input');
 
  for (var i=0; i<checkboxes.length; i++)  {
    if (checkboxes[i].type == 'checkbox')   {
		checkboxes[i].checked = checktoggle;
    }
  }
}
// ]]></script>

<script>    
$(document).ready(function(){
	$('#sesis').change(function(){
		var sesi = $('#sesi').val(); 
		var ul = URL+"siak_absensi_mahasiswa/get_kelas";
		$.ajax({
			type:"POST",
			url: ul,    
			data: 'sesi=' + sesi,        
			success: function (html){                 
				$('#kelas').html(html);
			}  
		});
	});
});
</script>

		<div id='demo'></div>
<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Index</div>
		
	</div>
	
<?php 
// echo "<pre>";
// var_dump($this->siak_data_list);
// echo "</pre>";
?>
	<div id="kelas">
		
	</div>
	<div class="portlet-body">
		<!-- form method = "POST" action="<?php echo URL;?>siak_absensi_mahasiswa/DATA_KONFIRMASI">
			<p><center>PILIH ABSENSI</center></p>
			<div class='row-fluid'>
			<div class='span3'>
				<select class="m-wrap span12" id="sesi" name="jam_kuliah">
				<option value="">Pilih Jam Mulai</option>
				<?php foreach($this->siak_jam_mulai_akhir as $key => $val){
					echo "<option value='$val[mulai]'>$val[mulai]</option>";
				} ?>
				</select>
			</div>
			<div class='span3'>
				<select class="m-wrap span12" name="kelas_id">
				<option value="">Pilih Kelas</option>
				<?php foreach($this->siak_data_kelas as $key => $val){
					echo "<option value='$val[kelas_id]'>$val[kelas_id] - $val[nama_kelas]</option>";
				} ?>
				</select>
			</div>
			<div class='span3'>
				<select class="m-wrap span12" name="kode_matkul">
				<option value="">Pilih Mata Kuliah</option>
				<?php foreach($this->siak_data_matkul as $key => $val){
					echo "<option value='$val[kode_matkul]'>$val[kode_matkul] - $val[nama_matkul]</option>";
				} ?>
				</select>
			</div>
			<div class='span3'>
				<input type = "submit" name="Filter"  value = "Filter" class = "btn btn-medium btn-primary "/>
			</div><br>			
			<div class='span3'>
				<input type = "submit" name="Filter"  value = "Filter" class = "btn btn-medium btn-primary "/>
			</div>
		</div>
		</form-->
		
		<div class='row-fluid'>
			<div class='span10'>
				<table>
					<?php 
					if(!empty($this->siak_pilih)){
					foreach($this->siak_pilih as $key => $val){?>
					<form method = "POST" action="<?php echo URL;?>siak_absensi_mahasiswa/DATA_KONFIRMASI">
					<tr>
						<td><?php $jam = explode(" ",$val[mulai]); echo "<h4>Absen <b>".date("d-M-Y", strtotime($jam[0]))."</b> <b>".$jam[1]."</b></h4> | Kelas : ".$val[kelas_id]." | Prodi : ".$val[prodi_id]." | Matkul : ".$val[kode_matkul]; ?></td>
						<td><input type="hidden" name="jam_kuliah" value="<?php echo $val[mulai]?>"></td>
						<td><input type="hidden" name="kelas_id" value="<?php echo $val[kelas_id]?>"></td>
						<td><input type="hidden" name="kode_matkul" value="<?php echo $val[kode_matkul]?>"></td>
						<td><input type = "submit" name="Filter"  value = "Filter" class = "btn btn-medium btn-primary "/></td>
					</tr>
					</form>
					<?php }
					}else{ ?>
					<tr>
						<td colspan="5"><h3>Tidak Ada Jadwal Kuliah</h3></td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
		<hr>
		<form name="formname" method = "post" action="<?php echo URL;?>siak_absensi_mahasiswa/confirm_absen">
			<input type="hidden" name="cohort" value="<?php echo $this->cohort; ?>">
			<center><h1>UNIVERSITAS WIDYATAMA</h1></center>
			<center><h4>DAFTAR MAHASISWA</h4></center>
			
			<?php foreach ($this->prodi as $key => $value) { ?>
			<input type="hidden" name="prodi_id" value="<?php echo $value['prodi_id']; ?>">
			<?php foreach ($this->fakultas as $key => $val) { ?>
			<center><font style="text-transform: uppercase;"><?php echo $value['fakultas_id']==$val['fakultas_id']?$val['fakultas']:""; ?></font></center>
			<?php } ?>
			<center>ABSENSI MAHASISWA <?php echo $value['prodi_id']; ?> COHORT	<?php echo $this->cohort;?> TA 2014/2015</center>
			<?php }?>
			<?php foreach ($this->jadwal as $key => $value) { ?>
			<p>Hari / Tanggal	: <?php echo $value['tgl'];?></p>
			<input type="hidden" name="tgl" value="<?php echo $this->tgl; ?>">
			<p>Mata Kuliah		:
				<?php foreach ($this->data_matkul as $key => $val) { ?>
				<?php echo $value['kode_matkul']==$val['kode_matkul']?$val['nama_matkul']:"";?>
				<?php }?>
			<?php } ?>
			</p>
			<div class="portlet box blue">
							
							<div class="portlet-body">
							<div class='row-fluid'>
								
							</div>
							
			<table id='konfirmasiabsen' class="table table-striped table-bordered table-hover table-full-width">
										<thead>
											<tr>
												<th colspan='5'>
													<div id='clock' style='float:left'></div>
													<div style='float:right'>
														<input type="hidden" name="in_out" value="<?php echo $this->inout; ?>">
														<?php if($this->inout == 0){ ?>
															<span style='color:#ffffff;background-color:#0066ff;padding:3px;padding-left:10px;padding-right:10px;margin-bottom:5px;'>
																<strong>Absen Masuk ! </strong> (Pencatatan absen masuk kelas)
															</span>
															<!--div class="alert alert-info">
																<strong>Absen Masuk ! </strong> (Pencatatan absen masuk kelas)
															</div-->
														<?php }elseif($this->inout == 1){ ?>
															<span style='color:#ffffff;background-color:#ffcc66;padding:3px;padding-left:10px;padding-right:10px;margin-bottom:5px;'>
																<strong>Absen Keluar ! </strong> (Pencatatan absen keluar kelas)
															</span>
															<!--div class="alert alert-warning">
																<strong>Absen Keluar ! </strong> (Pencatatan absen keluar kelas)
															</div-->
														<?php } ?>
													</div>	
												</th>
											<tr>
											<tr>
												<th colspan='5'>
													<div class='span2'>
														KATA KUNCI :
													</div>
													<div class='span2'>
														<input type="text" id="searchTerm" class="search_box" onkeyup="doSearch()" />
													</div>
												</th>
											</tr>
											<tr>
												<th>NO</th>
												<!--th>PHOTO</th-->
												<th class="hidden-phone">NIM</th>
												<th>NAMA</th>
												<!--th class="hidden-phone">WAKTU ABSEN MASUK</th-->
												<th class="hidden-phone">STATUS</th>
												<th>PILIHAN</th>
												<!--th>CHECK</th-->
											</tr>
										</thead>
										<tbody>
					<?php
					$i = 0;
					$urut = 0;
					foreach ($this->siak_data_list as $key => $value) {
						if($value['status']==1){$warna="<span class='btn mini green'>HADIR</span>";}elseif($value['status']==2){$warna="<span class='btn mini yellow'>SAKIT</span>";}elseif($value['status']==3){$warna="<span class='btn mini blue'>IJIN</span>";}elseif($value['status']==4){$warna="<span class='btn mini red'>ALPA</span>";}
						$stat=$value['status']==3?" (Cuti)":"";
						$no = $i+1;
						echo "<input type='hidden' id='waktu".$i."' name='tanggal[]' value='".$value['tanggal']."'>";
// 						$i++; 
						 echo "<tr>";			
												echo"<td>".$no."</td>";
												//echo "<td><img width='50' height='50' src='" . URL."siak_public/siak_images/uploads/".$value['foto'] . "' /></td>";
												echo"<td>".$value['nim']." <input type='hidden' value='".$value['nim']."' name='nim[]'></td>";
												echo"<td class='hidden-phone'><b>".strtoupper($value['nama_depan'])." ".strtoupper($value['nama_belakang'])."</b></td>";
												//echo"<td class='hidden-phone'><input readonly type='text' value='".$value['waktu']."' name='waktu[]'></td>";
												echo"<td  class='hidden-phone'><div id='status".$urut."'>".$warna."</div></td>";
												echo"<td>"; ?>
												<select id='formDiv<?php echo $urut; ?>' onchange='update_color(<?php echo $urut; ?>);' class='m-wrap span12' name='ket[]'  style='color:black;font-weight:bold;' >
<!-- 												<option value='' >Absensi</option> -->
												<option  value='1' <?php if($value['status']=="1") { echo "selected='selected'"; } ?>>H</option>
												<option  value='2' <?php if($value['status']=="2") { echo "selected='selected'"; } ?>>S</option>
												<option  value='3' <?php if($value['status']=="3") { echo "selected='selected'"; } ?>>I</option>
												<option  value='4' <?php if($value['status']=="4") { echo "selected='selected'"; } ?>>A</option></select>
												<?php echo "</td>";?>
												<!--td><label><input <?php if($value['konfirmasi']==1){echo"checked";} ?> type='checkbox' value='1' class='confirm' id='confirm' name='confirm[]' required> Approval</label></td-->
											</tr>
										
										
										
									<?php $i++; $urut++;}
									?>
									</tbody>
										</table>
										</div>
						</div>
									<input type = "submit" value = "Check Absensi" class = "btn btn-medium btn-primary "/>
								</form>
								</div>
<script type="text/javascript">
<!--
function startTime() {
	var date = new Date();
	var day = date.getDate();
	//var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
	var months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
	var month = date.getMonth();
	var yy = date.getYear();
	var year = (yy < 1000) ? yy + 1900 : yy;
    var today=new Date(),
        curr_hour=today.getHours(),
        curr_min=today.getMinutes(),
        curr_sec=today.getSeconds();
		curr_hour=checkTime(curr_hour);
		curr_min=checkTime(curr_min);
		curr_sec=checkTime(curr_sec);
		document.getElementById("clock").innerHTML=
		"<h5><b>Waktu Kuliah : </b>"+document.getElementById("waktu1").value+"</h5>"+
		"<h5><b>Waktu Absen  : </b>"+year+"-"+months[month]+"-"+day+" <span style='background-color:#ffffff;border:#000000 solid 1px;font-size:20px;padding:3px;padding-left:10px;padding-right:10px;'><b>"+curr_hour+":"+curr_min+":"+curr_sec+"</b></span></h5>";
}
function checkTime(i) {
    if (i<10) {
        i="0" + i;
    }
    return i;
}
setInterval(startTime, 500);
//-->
</script>