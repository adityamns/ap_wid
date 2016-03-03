<?php
$dbhost = 'localhost';
$dbuser = 'postgres';
$dbpass = '12345';
$dbname = 'SIAK_UNHAN';

$backup_file = $dbname."-". date("Y-m-d-H-i-s") . '.sql';
$command = "PGPASSWORD=12345 pg_dump $dbname -U $dbuser -h $dbhost -F p > $backup_file";

system($command);

///Download file
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($backup_file));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($backup_file));

if(readfile($backup_file)){
	unlink($backup_file); //Hapus file temp
}