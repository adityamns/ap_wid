<?php
// echo "<pre>";
// var_dump($this->fields);
// echo "</pre>";
// die();

$data = $this->siak_data;
foreach($data as $key => $vals){

	foreach($vals as $key => $val){
	
		if($val == ""){
			$nval[] = "-";
		}else{
			$nval[] = $val;
		}
		
	}
	
	$arrays[] = $nval;
	$nval = array();
	
}

//DBase Name
$dbasename = 'siak_public/siak_upload/DBF/MSMHS.DBF';

//Cols
$fields = $this->fields;

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

