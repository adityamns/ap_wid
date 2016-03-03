<?php
// echo $this->hasil;
// die();
?>

<table id='data_alumni2' class='table table-bordered table-striped table-hover table-contextual table-responsive dataTable'>
	<thead>
	<tr align = 'center'>
		<td>NO</td>
		<td>NIM</td>
		<td>NAMA</td>
		<td>NILAI</td>
		<td>GRADE</td>
		
	</tr>
	</thead>
	<tbody>
	<?php
	
	$i = 1;
		  foreach($this->hasil as $rec => $col){
		
		echo  '<tr>
			  <td>'.$i.'</td>
			  <td>'.$col['nim'].'</td>
			  <td>'.strtoupper($col['nama_depan']).'&nbsp;'.strtoupper($col['nama_belakang']).'</td>
			  <td>'.number_format($col['nilai_total'], 2, '.' , ',').'</td>
			  <td>'.$col['grade'].'</td>
			  
			  </tr>';
		  $i++; 
		  }
	
	?>
	</tbody>
</table>

<script>
$(document).ready(function(){
	$('#data_alumni2').DataTable();
})
</script>