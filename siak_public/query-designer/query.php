<?php

include_once('lib.php');
$query = $_POST['sql'];
$result = $db->query($query)->fetchALL(PDO::FETCH_ASSOC);

$keys = array_keys($result[0]);

echo "<table class='display' id='tab-res'>";
	echo "<thead>";
		echo "<tr>";
		foreach($keys as $col){
			echo "<th>".strtoupper($col)."</th>";
		}
		echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

	foreach($result as $row){
		echo "<tr>";
			foreach($keys as $col){
				if($row[$col] == NULL || $row[$col] == ''){
					echo "<td>&nbsp;</td>";
				}else{
					echo "<td>".$row[$col]."</td>";
				}
			}
		echo "</tr>";
	}
	echo "</tbody>";
echo "</table>";
echo "
      <script>
      $(document).ready(function(){
	      $('#tab-res').DataTable({bJQueryUI: true});
      });
      </script>
      ";