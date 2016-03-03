<?php
require_once('../conn.php');
$Schema = $_COOKIE['schema'];
//$table_name = $_GET['table'];

//$table_name ='mTest';
$table_name = isset($_GET['table']) ? ($_GET['table']) :'mTest' ;

$finalArray = array();

//$query= "SHOW COLUMNS FROM $table_name";
$query= "
	SELECT *
	FROM information_schema.columns
	WHERE table_schema = '$Schema'
	 AND table_name   = '$table_name'
	";

$result= $db->query($query)->fetchALL(PDO::FETCH_ASSOC);

$FieldData = array();

$FieldData[] = array(
                        "TableName" => $table_name,
                        "ColumnName" => '*',
                        "IsPrimaryKey" => FALSE
                    );
                    
foreach($result as $row){

	$FieldData[] = array(
			      "TableName" => $table_name,
			      "ColumnName" => $row['column_name'],
			      "IsPrimaryKey" => ($row['Key'] == 'PRI'? TRUE:FALSE)
			      //"Selected" => true
			     );
    
}

/*
$finalArray = array(
                "TableName"=> $table_name ,
    "Fields" => $FieldData
 
                    );
 */

$finalArray = $FieldData;

print json_encode($finalArray);

?>
