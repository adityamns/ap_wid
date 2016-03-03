<?php
// liste des événements
 $json = array();
 // requête qui récupère les événements
 $requete = "SELECT * FROM 
(SELECT jadwal_kuliah.id, matakuliah.nama_matkul AS title, jadwal_kuliah.start , jadwal_kuliah.end , NULL AS warna, 
CASE WHEN TIME(jadwal_kuliah.start) THEN 'false' ELSE 'true' END AS allDay FROM jadwal_kuliah 
LEFT JOIN matakuliah ON matakuliah.kode_matkul=jadwal_kuliah.kode_matkul where jadwal_kuliah.tahun_id='$id'
UNION 
SELECT  kalender.id AS id, event.event AS title, kalender.start AS START, kalender.end AS END, event.warna, 
CASE WHEN TIME(kalender.start) THEN 'false' ELSE 'true' END AS allDay 
FROM kalender LEFT JOIN event ON event.id=kalender.event_id where kalender.tahun_id='$id') AS result  ORDER BY START";
 
 // connexion à la base de données
 try {
 $bdd = new PDO('mysql:host=localhost;dbname=unhansiak', 'root', '');
 } catch(Exception $e) {
 exit('Impossible de se connecter à la base de données.');
 }
 // exécution de la requête
 $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
 
 // envoi du résultat au success
 $json = json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));
 $json = str_replace('"true"','true',$json);
 $json = str_replace('"false"','false',$json);
 echo $json;
?>