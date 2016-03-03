<div class="panel panel-primary">
	<div class="panel-body" >
		<div class="input-group">
			<h4>Isian Data Evaluasi Dosen </h4>
		</div>
		<hr>
		<div class="container-fluid">
<?php


foreach($this->data_matkul as $row => $rec){
	$kd_dosen[]=$rec['no'];
	$prodi_id=$rec['prodi_id'];
}

foreach($this->cek_dosen as $cek => $flow){
	$cek_dosen[] = $flow['nip'];
}

// var_dump($kd_dosen);
// die();

if(count($kd_dosen) <= 0){
      echo '
      <div class="alert alert-error">
	      <button class="close" data-dismiss="alert"></button>
	      <strong>MAAF !!</strong> Absensi Kehadiran Dosen Belum Lengkap.
      </div>
      ';
}

// $i=0;
for($z=0;$z < sizeof($kd_dosen);$z++){

	$sql = "select * from dosen where nip = '$kd_dosen[$z]'";
	$dataDos = $this->db->siak_query("select", $sql);
	
	
	if(in_array($kd_dosen[$z],$cek_dosen) == TRUE){
	
		echo '<div class="form-horizontal">
		      <div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="firstName">Kode Dosen (<strong>'.$kd_dosen[$z].'</strong>)</label>
						<div class="controls">
							<button class="btn red" disabled>SUDAH EVALUASI</button>
							
							'.$dataDos[0][gelar_depan].' '.$dataDos[0][nama].' '.$dataDos[0][gelar_blkng].'
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			</div>';
		
	}else{
	
		echo '<div class="form-horizontal">
		      <div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="firstName">Kode Dosen (<strong>'.$kd_dosen[$z].'</strong>)</label>
						<div class="controls">
							<a class="btn blue" href="#addMEv" data-toggle="modal" link="'.URL.'siak_kartu_hasil_studi/tambah/'.$this->nim.'/'.$this->matkul_id.'/'.$kd_dosen[$z].'/'.$prodi_id.'/'.$this->semester.'" onclick="addEv(this)">EVALUASI</a>
							
							'.$dataDos[0][gelar_depan].' '.$dataDos[0][nama].' '.$dataDos[0][gelar_blkng].'
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			</div>';
		
	}
	

$i++;}
?>
            </div>
        </div>
</div>


<div id="addMEv" class="modal hide fade" data-width="760" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Isi Evaluasi Dosen</h3>
	</div>
	<div class="addEv">
	
	</div>
</div>

<script>
function addEv(value){
    var id = $('.addEv');
    var lth = id.length;
    for(i=0;i<lth;i++){
    
      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  row: i,
	  success: function(data) {
	      id[this.row].innerHTML = data;
	  }
      });
      
    }
}
</script>