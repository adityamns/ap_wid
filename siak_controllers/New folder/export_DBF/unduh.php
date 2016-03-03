<?php
//Tidak bisa insert data kosong ke file .dbf ini
//Buat kondisi agar data kosong terisi (-)

$dbname = 'TRAKM.dbf';
$fields = array(
	array('nim', 'C', 50),
	array('nama', 'C', 50),
// 	array('nama_belakang', 'C', 50),
	array('cohort', 'C', 100),
	array('prodi_id', 'C', 10),
	array('semester', 'C', 100),
// 	array('sks_semester', 'C', 10),
	array('totips', 'C', 100),
	array('ips', 'C', 100)
);

// dbase_create($dbname, $fields);
// die();
$db = dbase_create($dbname, $fields);

$data = $this->data;

$count = sizeof($data);
if($db){
	for($i=0;$i<$count;$i++){
		$add = dbase_add_record($db, 
			array(
				$data[$i]['nim'],
				$data[$i]['nama_depan'].''.$data[$i]['nama_belakang'],
// 				$data[$i]['nama_belakang'],
				$data[$i]['cohort'],
				$data[$i]['prodi_id'],
				$data[$i]['semester'],
// 				$data[$i]['totsks'],
				$data[$i]['totips'],
				$data[$i]['ips']
			)
		);
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
header('Content-Disposition: attachment; filename='.basename($dbname));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($dbname));
// ///

// ///
if(readfile($dbname)){
	unlink($dbname); //Hapus file temp
}