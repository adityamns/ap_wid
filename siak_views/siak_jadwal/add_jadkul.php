<?php
 
$start=$_POST['start'];
$end=$_POST['end'];
$title=$_POST['title'];
 
// connexion à la base de données
 try {
 $bdd = new PDO('mysql:host=localhost;dbname=unhansiak', 'root', '');
 } catch(Exception $e) {
 exit('Impossible de se connecter à la base de données.');
 }
 
$sql = "INSERT INTO jadkul (start, end, title, ruang_id) VALUES (:start, :end, :title, :title )";
$q = $bdd->prepare($sql);
$q->execute(array( ':start'=>$start, ':end'=>$end, ':title'=>$title));
?>