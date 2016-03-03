<?php

$kode_matkul=$_POST['kode_matkul'];
$kode_topik=$_POST['kode_topik'];
$dosen_utama=implode(',', $_POST['dosen_utama']);
$dosen_pendamping=implode(',', $_POST['dosen_pendamping']);
$start=$_POST['start'];
$end=$_POST['end'];

 
// connexion à la base de données
 try {
 $bdd = new PDO('mysql:host=localhost;dbname=unhansiak', 'root', '');
 } catch(Exception $e) {
 exit('Impossible de se connecter à la base de données.');
 }
 
$sql = "INSERT INTO jadwal_kuliah (kode_matkul,kode_topik,dosen_utama,dosen_pendamping,start,end) VALUES (:kode_matkul,:kode_topik,:dosen_utama,:dosen_pendamping,:start,:end)";
$q = $bdd->prepare($sql);
$q->execute(array(':kode_matkul'=>$kode_matkul,':kode_topik'=>$kode_topik,':dosen_utama'=>$dosen_utama,':dosen_pendamping'=>$dosen_pendamping, ':start'=>$start, ':end'=>$end));
?>