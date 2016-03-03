<?php
// liste des événements
 $json = array();
 // requête qui récupère les événements
 $requete = "SELECT * FROM 
(SELECT jadkul.*, NULL AS warna, CASE WHEN TIME(jadkul.start) THEN 'false' ELSE 'true' END AS allDay FROM jadkul
UNION 
SELECT kalender.id AS id_jadkul, kalender.start AS START, kalender.end AS END, NULL AS dosen_id, NULL AS ruang_id, event.event AS title, NULL AS tahun_id, event.warna, CASE WHEN TIME(kalender.start) THEN 'false' ELSE 'true' END AS allDay FROM kalender LEFT JOIN event ON event.id=kalender.event_id) AS result  ORDER BY START  ";
 
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