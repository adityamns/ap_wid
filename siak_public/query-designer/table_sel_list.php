<?php
include_once('lib.php');
//$Schema = "VQD";
$Schema = $_COOKIE['schema'];


?>
<div id="table-selection">
	<div id="">
        Tambah Tabel
    </div>
	<div id="table-list">
    <?php
//     $query = "SELECT * 
//     FROM  `TABLES` 
//     WHERE TABLE_SCHEMA =  '$Schema'";
//     
//     $result= mysqli_query($dbc_info_sch,$query);
//     //echo($query);
//     while($row =  mysqli_fetch_array($result)){
//         $tableName = $row['TABLE_NAME'];
    
    $result= $db->query($query)->fetchALL(PDO::FETCH_ASSOC);
    
	foreach($result as $row){
		$tableName = $row['table_name'];
    $query = "SELECT * FROM information_schema.tables WHERE table_schema = '$Schema'";
    ?>
        <div class="item"><?php echo $tableName; ?></div>
    <?php
    }
    ?>
	</div>	
	<div id="table-btns">
		<span class="butn ok">
			Lanjut
		</span>
		<span class="butn cancel">
			Batal
		</span>
		
	</div>
</div>
