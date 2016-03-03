<div class="panel panel-danger" style="width:600px;">
	<div class="panel-heading">
		<h3 class="panel-title">Simpan Data</h3>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
		
		

<?php


echo "<br>
<p align='center'> </p>
<table border='1' cellspacing='0' cellpadding='0' width='100%' id='tab1' repeat_header='1'>
  
    <tr align = 'center'>
      <td align='center'>NO</td>
      <td align='center'>NIM</td>
      <td align='center'>COHORT</td>
      <td align='center'>PRODI</td>
      <td align='center'>IPK</td>
      <td align='center'>GRADE</td>
      
    </tr>";

  $i = 1;
    foreach ($this->data as $key => $value) {
      # code...
      echo "
            <tr align = 'center'>
              <td>'.$i.'</td>
              <td>'.$value['nim'].'</td>
              <td>' . $value['cohort'] . '</td>
              <td>'.$value['prodi'].'</td>
              <td>'.$value['nim'].'</td>
              <td>'.$value['nim'].'</td>
            </tr>
          ";
    $i++;
    } 
?>
</table>
<button type="submit" class="btn btn-default btn-xs" style="float: right" >Simpan Data</button>


</div>
</div>