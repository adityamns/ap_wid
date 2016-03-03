<div class="portlet">
	<div class="portlet-body">
    	<div class='tabbable tabbable-custom tabbable-full-width'>
        	<ul class="nav nav-tabs">
            	<li <?php echo ($this->get_fix == "1")?"":"class='active'"; ?>><a href="#" data-toggle="tab" style="cursor:pointer" onClick="actTab('ClassroomArea')">Classroom</a></li>
                <li <?php echo ($this->get_fix == "1")?"class='active'":""; ?>><a href="#" data-toggle="tab" style="cursor:pointer" onClick="actTab('ScheduleArea')">Schedule</a></li>
                <!--
                <li><a href="#" data-toggle="tab" style="cursor:pointer" onClick="actTab('AbsenArea')">Absen</a></li>
                -->
            </ul>
        </div>
    </div>
</div>

<div id="ClassroomArea" class="portlet box green tabActive">
	<div class="portlet-title">
    	<div class="caption"><i class="icon-globe"></i>Monitoring Kelas</div>
    </div>
    <div class="portlet-body">
    	<?php
		/*echo "<table cellpadding='9'>";
		$inline = 1;
		$jml_data = 0;
		foreach($this->classroom as $dataClassroom){
			if($inline < 13){
				if($inline == 1){
					echo "<tr>";
				}
				echo "<td><a href='#dataModal' data-toggle='modal' style='text-decoration:none'><img src='".URL."siak_public/img/classroom_black.png' width='70' height='70' style='cursor:pointer'><br>".$dataClassroom['nama_ruang']."</a></td>";
				$inline++;
			}else{
				//echo "</tr>";
				echo "</tr><tr><td><a href='#dataModal' data-toggle='modal' style='text-decoration:none'><img src='".URL."siak_public/img/classroom_black.png' width='70' height='70' style='cursor:pointer'><br>".$dataClassroom['nama_ruang']."</a></td>";
				//$inline = 1;
				$inline = 2;
			}
			
			$jml_data++;
			
			if($jml_data == $this->jml_classroom){
				echo "</tr>";
			}
		}
		echo "</table>";*/
		//echo $this->jml_classroom;
		?>
        <div id="val_status"></div>
    </div>
</div>

<div id="dataModal" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Data Ruang</h3>
	</div>
	<div class="modal-body">
    	<form class="horizontal-form">
        	<div class="row-fluid">
            	<div class="span6">
                	<div class="control-group">
                    	<label class="control-label" for="kode_kurikulum">ID Ruang</label>
                        <div class="controls">
                        	<input type="text" class="m-wrap span12" readonly>
                        </div>
                    </div>
                </div>
                <div class="span6">
                	<div class="control-group">
                    	<label class="control-label" for="kode_kurikulum">Nama Ruang</label>
                        <div class="controls">
                        	<input type="text" class="m-wrap span12" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
            	<div class="span6">
                	<div class="control-group">
                    	<label class="control-label" for="kode_kurikulum">Kapasitas</label>
                        <div class="controls">
                        	<input type="text" class="m-wrap span12" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn">Tutup</button>
    </div>
</div>

<!-- TAB SCHEDULE -->

<!--<div id="ScheduleArea" class="portlet box green tabActive">
	<div class="portlet-title">
    	<div class="caption"><i class="icon-globe"></i>Monitoring Jadwal</div>
    </div>
    <div class="portlet-body">-->
    	<!-- A -->
        
        <?php 
function hari($b){
		
					if($b==1)
					{$hari="SENIN";}
					elseif($b==2)
					{$hari="SELASA";}
					elseif($b==3)
					{$hari="RABU";}
					elseif($b==4)
					{$hari="KAMIS";}
					elseif($b==5)
					{$hari="JUMAT";}
					elseif($b==6)
					{$hari="SABTU";}
					elseif($b==7)
					{$hari="MINGGU";}
				return $hari;
		}
 ?>
        
        <div id="ScheduleArea" class='row-fluid tabActive'>
		<div class="span12">
						<!-- BEGIN BORDERED TABLE PORTLET-->
						<div class="portlet box yellow">
							<div class="portlet-title">
								<div class="caption"><i class="icon-coffee"></i>JADWAL KULIAH</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<div class="portlet-body">
                            <span>TANGGAL : </span><input type="text" class="m-wrap span3" name="tanggal" id="tanggal" value="<?php echo $this->tahun_fix."-".$this->tanggal_fix."-".$this->bulan_fix; ?>">
								<table class="table table-bordered table-hover" id="jadwal">
							<thead>
								<tr>
									<th >HARI</th>
									<th  rowspan="2">PRODI</th>
									<th  rowspan="2">MATAKULIAH / PUKUL</th>
									<th  colspan="2">TM</th>
									<th  rowspan="2">DOSEN</th>
									<th  rowspan="2">TEMPAT</th>
								</tr>
								<tr>
									<th >TGL</th>
									<th >KE</th>
									<th >DARI</th>
								</tr>
								<tr>
									<?php 
										for($i = 1;$i<=7;$i++){
									?>
									<th  ><?php echo $i;?></th>
										<?php }?>
								</tr>
							</thead>
									<tbody>
									<?php foreach($this->siak_jadwal as $key => $row){ 
									if($row['waktu'] == $this->tahun_fix."-".$this->bulan_fix."-".$this->tanggal_fix){
									$dari = $this->db->siak_getfield('pertemuan','matakuliah',"kode_matkul='".$row['kode_matkul']."'");
									?>
									<tr>
										<td  align="center" style="background-color: #eee"><b><?php echo hari(date('N',strtotime($row['waktu']))).'<br>'.$row['waktu']; ?></b></td>
										<td align="center"><?php echo $row['prodi_id']; ?></td>
										<td align="center"><b><?php echo $row['nama_matkul']; ?></b> / <?php echo $row['waktu_mulai'].' - '.$row['waktu_akhir']; ?></td>
										
										<td align="center"><?php echo $row['pertemuanke']; ?></td>
										<td align="center"><?php echo $dari; ?></td>
										<td align="center" style="background-color: #eee"><?php echo $row['nama']; ?></td>
										<td align="center"><?php echo $row['nama_ruang']; ?></td>
										
									</tr>
									<?php }}?>
								</tbody>
								</table>
							</div>
						</div>
						<!-- END BORDERED TABLE PORTLET-->
		</div>
	</div>
        
        <!-- Z -->
    <!--</div>
</div>-->

<!-- TAB ABSEN -->

<div id="AbsenArea" class="portlet box green tabActive">
	<div class="portlet-title">
    	<div class="caption"><i class="icon-globe"></i>Verifikasi Absen</div>
    </div>
    <div class="portlet-body">
    
    </div>
</div>

<script>
<?php if($this->get_fix != "1"){ ?>
$('.tabActive').css('display','none');
$('#ClassroomArea').css('display','block');
<?php }else{ ?>
$('.tabActive').css('display','none');
$('#ScheduleArea').css('display','block');
<?php } ?>

function actTab(x){
	$('.tabActive').css('display','none');
	$('#'+x).css('display','block');
}

function show_data(){
	$.ajax({
		url: '<?php echo URL; ?>siak_home/cekClassroom',
		success: function(data){
			var json = JSON.parse(data);
			
			var inline = 1;
			var arrRuang = 0;
			
			var tampung = "<table cellpadding='9'>";
			
			/*tampung = tampung + "<table border='1'>";
			tampung = tampung + "<tr><td>ASD</td></tr></table>";
			tampung = tampung + "</table>";
			
			$('#val_status').html(tampung);*/
			//console.log(json.jml_ruang);
			$.each(json.cek, function(i, item){
				if(inline < 13){
					if(inline == 1){
						tampung = tampung + "<tr>";
					}
					if(item == "black"){
						tampung = tampung + "<td><a href='#dataModal' data-toggle='modal' style='text-decoration:none'><img src='<?php echo URL."siak_public/img/classroom_black.png"; ?>' width='70' height='70' style='cursor:pointer'><br>" + json.nama_ruang[arrRuang] + "</a></td>";
					}else if(item == "yellow"){
						tampung = tampung + "<td><a href='#dataModal' data-toggle='modal' style='text-decoration:none'><img src='<?php echo URL."siak_public/img/classroom_yellow.png"; ?>' width='70' height='70' style='cursor:pointer'><br>" + json.nama_ruang[arrRuang] + "</a></td>";
					}else if(item == "blue"){
						tampung = tampung + "<td><a href='#dataModal' data-toggle='modal' style='text-decoration:none'><img src='<?php echo URL."siak_public/img/classroom_blue.png"; ?>' width='70' height='70' style='cursor:pointer'><br>" + json.nama_ruang[arrRuang] + "</a></td>";
					}
					inline++;
				}else{
					//tampung = tampung + "</tr>";
					tampung = tampung + "</tr><tr>";
					if(item == "black"){
						tampung = tampung + "<td><a href='#dataModal' data-toggle='modal' style='text-decoration:none'><img src='<?php echo URL."siak_public/img/classroom_black.png"; ?>' width='70' height='70' style='cursor:pointer'><br>" + json.nama_ruang[arrRuang] + "</a></td>";
					}else if(item == "yellow"){
						tampung = tampung + "<td><a href='#dataModal' data-toggle='modal' style='text-decoration:none'><img src='<?php echo URL."siak_public/img/classroom_yellow.png"; ?>' width='70' height='70' style='cursor:pointer'><br>" + json.nama_ruang[arrRuang] + "</a></td>";
					}else if(item == "blue"){
						tampung = tampung + "<td><a href='#dataModal' data-toggle='modal' style='text-decoration:none'><img src='<?php echo URL."siak_public/img/classroom_blue.png"; ?>' width='70' height='70' style='cursor:pointer'><br>" + json.nama_ruang[arrRuang] + "</a></td>";
					}
					//inline = 1;
					inline = 2;
				}
				
				//console.log(item);
				
				//console.log(json.nama_ruang[arrRuang]);
				
				arrRuang++;
				
				if(arrRuang == json.jml_ruang){
					tampung = tampung + "</tr>";
				}
			})
			
			tampung = tampung + "</table>";
			
			//console.log(arrRuang);
			
			//console.log(tampung);
			$('#val_status').html(tampung);
			//console.log(json.nama_ruang[0]);
		}
	})
}

show_data();
window.setInterval(function(){
	show_data();
}, 60000);

$(document).ready(function() {
	$('#jadwal').DataTable();
    $('#example').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo URL; ?>server_processing.php"
    } );
});

$( "#tanggal" ).datepicker({
	<?php  ?>onSelect: function(date) {
            window.location = "<?php echo URL; ?>siak_home?tgl="+date;
        },<?php  ?>
dateFormat: 'yy-dd-mm',
changeMonth: true,
changeYear: true
});
</script>