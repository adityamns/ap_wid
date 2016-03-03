<?php
	include_once('../lib.php');
	
	$Schema = $_GET['schema'];
?>
<?php
	$query = "SELECT * FROM information_schema.tables WHERE table_schema = '$Schema'";
	
	$result= $db->query($query)->fetchALL(PDO::FETCH_ASSOC);
    
	foreach($result as $row){
		$tableName = $row['table_name'];
?>
        <div class="item"><?php echo $tableName; ?></div>
<?php
	}
?>