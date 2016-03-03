<?php

foreach ($this->siak_dosen as $key => $row) {
	$query="select *from 
	(select a.*,'pendamping' as dosen from dosen_matakuliah b,matakuliah a 
		where a.kode_matkul=b.kode_matkul 
		".($this->prodi ? "AND a.prodi_id = '$this->prodi' " :"")."
		and b.dosen_utama='".$row['nip']."'
	union 
	select a.*,'utama' as dosen from dosen_matakuliah b,matakuliah a 
		where a.kode_matkul=b.kode_matkul 
		".($this->prodi ? "AND a.prodi_id = '$this->prodi' " :"")."
		and b.dosen_pendamping like '%".$row['nip']."%') as dosen 
	order by dosen desc";
	
// 	echo $query."<br>";

	$data = $this->db->siak_query("select", $query);

	foreach($data as $keys => $vals){
		$valse['semester'] = $vals['semester'];
		$valse['UNHAN'] = 'UNHAN';
		$valse['prodi_id'] = $vals['prodi_id'];
		$valse['S2'] = 'S2';
		$valse['nip'] = $row['nip'];
		$valse['nama'] = $row['nama'];
		$valse['kode_matkul'] = $vals['kode_matkul'];
		$valse['kd_kelas'] = '';
		$valse['pert'] = '';
		$valse['pertemuan'] = $vals['pertemuan'];


		foreach($valse as $key => $val){
		
			if($val == ""){
				$nval[] = "-";
			}else{
				$nval[] = $val;
			}

		}
		
		$arrays[] = $nval;
		$nval = array();

		
	}
}

// echo "<pre>";
// var_dump($arrays);
// echo "</pre>";
// die();

//DBase Name
$dbasename = 'siak_public/siak_upload/DBF/TRAKD.DBF';

//Cols
$fields = array(
	array('THNSMSTR', 'C', 50),
	array('KDPT', 'C', 50),
	array('KDPRODI', 'C', 50),
	array('KDJNJNG', 'C', 100),
	array('NIP', 'C', 10),
	array('DOSEN', 'C', 100),
	array('KDMATKUL', 'C', 10),
	array('KDKLS', 'C', 100),
	array('PERT', 'C', 100),
	array('PERTTOTAL', 'C', 100)
);

//Create DBase
$db = dbase_create($dbasename, $fields);

//Count, using new array
$count = sizeof($arrays);

if($db){
	for($i=0;$i<$count;$i++){
		$add = dbase_add_record($db, $arrays[$i]);
		if($add){
// 			echo 'Sukses tambah data<br>';
		} else {
			echo 'Gagal tambah data';
		}
	}
	dbase_close($db);
} else {
	echo 'error!!!!!!!!!';
}

///Download file
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($dbasename));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($dbasename));
///

if(readfile($dbasename)){
	unlink($dbasename); //Hapus file temp
}

