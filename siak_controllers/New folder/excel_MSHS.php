<?php
//$jumlah=sizeOf($this->isi_table);

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=data_mahasiswa.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<h2>DATA MAHASISWA</h2>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
    <?php $i=0;
			foreach($this->header_table as $row){
				echo "<td>".$row."</td>";	
				$i++;} ?>
	
      
    </tr>
    <?php $x = 0;
		$jumlah=count($this->isi_table);
					foreach ($this->siak_data as $key => $value) {
							echo "<tr class='active'>";
								for($i=0;$i<$jumlah;$i++){	
									echo "<td>".$value[$this->isi_table[$i]]."</td>";
								}
							echo "</tr>";
						}
    ?>
  </tbody>
</table>
