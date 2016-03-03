<?php 


	/**	DATA MAHASISWA AKTIF default **/
	$data=array();
	$series=array();
	$xAxix=array();
	foreach ($this->siak_data as $key => $value) {
		$data['name']=$value['fakultas'];
		$data['data']=$value['jumlah'];
			if($value['fakultas_kd']=='S'){
				$data['color']='red';
			}
			elseif($value['fakultas_kd']=='M'){
				$data['color']='blue';
			}
			elseif($value['fakultas_kd']=='K'){
				$data['color']='green';
			}
		$xAxix=$value['fakultas'];
		array_push($series,$data);
			
	}
	

		$json = json_encode($series);
		$json = str_replace('"'.$value['jumlah'].'"','['.$value['jumlah'].']',$json);
		
		
		
			
?>

<script>
jQuery(document).ready(function() {
	jQuery('#tahun1').change(function() {
		var tahun=jQuery('#tahun1').val();
		//var bulan=jQuery('#bln').val();
		//location.reload();
			window.location = "<?php echo URL; ?>siak_dashboard?tahun1="+tahun;
        });
        });
$(document).ready(function() {
	$('#jadwal').DataTable();
    $('#example').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo URL; ?>server_processing.php"
    } );
} );
</script>
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
<div class="row-fluid">
<div class='span6'>
					<div class="portlet box blue calendar">
						<div class="portlet-title">
							<div class="caption"><i class="icon-reorder"></i>KALENDER UNIVERSITAS</div>
						</div>
						<div class="portlet-body light-grey">
							<div class="row-fluid">
								<div class="span12">
									<div id="default" class="has-toolbar"></div>
								</div>
							</div>
							<!-- END CALENDAR PORTLET-->
						</div>
					</div>
	</div>				
	
<div class="span6">
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
								<table class="table table-bordered table-hover" id="jadwal">
							<thead>
								<tr>
									<th >HARI</th>
									<th  rowspan="2">PRODI</th>
									<th  rowspan="2">PUKUL</th>
									<th  rowspan="2">MK <br>TOPIK</th>
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
										for($i = 1;$i<=8;$i++){
									?>
									<th  ><?php echo $i;?></th>
										<?php }?>
								</tr>
							</thead>
									<tbody>
									<?php foreach($this->siak_jadwal as $key => $row){ 
									$dari = $this->db->siak_getfield('pertemuan','matakuliah',"kode_matkul='".$row['kode_matkul']."'");
									?>
									<tr>
										<td  align="center" style="background-color: #eee"><b><?php echo hari(date('N',strtotime($row['waktu']))).'<br>'.$row['waktu']; ?></b></td>
										<td align="center"><?php echo $row['prodi_id']; ?></td>
										<td align="center"><?php echo $row['waktu_mulai'].' - '.$row['waktu_akhir']; ?></td>
										<td align="center" style="background-color: #eee"><?php echo $row['singkatan'].'<br>'.$row['nama_topik']; ?></td>
										<td align="center"><?php echo $row['pertemuanke']; ?></td>
										<td align="center"><?php echo $dari; ?></td>
										<td align="center" style="background-color: #eee"><?php echo $row['nama']; ?></td>
										<td align="center"><?php echo $row['nama_ruang']; ?></td>
										
									</tr>
									<?php }?>
								</tbody>
								</table>
							</div>
						</div>
						<!-- END BORDERED TABLE PORTLET-->
					</div>
				</div>
	
</div>				
