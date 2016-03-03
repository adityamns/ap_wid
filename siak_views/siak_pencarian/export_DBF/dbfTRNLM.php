<?php
// echo "<pre>";
// var_dump($this->data);
// echo "</pre>";
// die();
//Tidak bisa insert data kosong ke file .dbf ini
//Buat kondisi agar data kosong terisi (-)

$dbname = 'siak_public/siak_upload/dbf/TRAKM.DBF';

$fields = array(
	array('THNSMSTR', 'C', 2),
	array('KDPT', 'C', 50),
	array('PRODI', 'C', 50),
	array('KDJNJNG', 'C', 2),
	array('NIM', 'C', 50),
	array('NAMA', 'C', 100),
	array('MATKUL', 'C', 100),
	array('NILAI', 'C', 3),
	array('SMSTR', 'C', 2)
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
				$data[$i]['semester'],
				'UNHAN',
				$data[$i]['prodi_id'],
				'S2',
				$data[$i]['nim'],
				$data[$i]['nama_depan'].' '.$data[$i]['nama_belakang'],
				$data[$i]['matkul_id'],
				$data[$i]['grade'],
				$data[$i]['semester']
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