<script type="text/javascript">
	function submit()
	{
		document.form1.submit();
	}
</script>
<br>
<div class="row-fluid">
	<div class='span2'>
		<form id="form1" action="<?php echo URL; ?>siak_absensi_mahasiswa/absensi_ujian/uts" method="post" >
			<input type="hidden" value="<?php echo $this->prodi; ?>" name="prodi">
			<input type="hidden" value="<?php echo $this->cohort; ?>" name="cohort">
			<input type="hidden" value="<?php echo $this->matkul; ?>" name="matkul">	
			<button type='submit' class="btn blue"  ><i class="icon-plus" ></i> ABSEN UTS</button>
		</form>
	</div>
	<div class='span2'>
		<form id="form1" action="<?php echo URL; ?>siak_absensi_mahasiswa/absensi_ujian/uas" method="post" target='_blank'>
			<input type="hidden" value="<?php echo $this->prodi; ?>" name="prodi">
			<input type="hidden" value="<?php echo $this->cohort; ?>" name="cohort">
			<input type="hidden" value="<?php echo $this->matkul; ?>" name="matkul">	
			<button type='submit' class="btn green"  ><i class="icon-plus" ></i> ABSEN UAS</button>
		</form>
	</div>
</div>
<br>

    <table id="list_data" class="table table-striped table-bordered table-hover table-full-width">
        <thead>
            <tr align = "center">
                <td rowspan="2">NO</td>
                <td rowspan="2">NIM</td>
                <td rowspan="2">NAMA</td>
                <td colspan="4"> <center>STATUS</center></td>
                <td rowspan="2">ACTION</td>
            <tr>
                <td align='center'><center>UTS</center></td>
                <td align='center'><center>PERSEN %</center></td>
				<td align='center'><center>UAS</center></td>
                <td align='center'><center>PERSEN %</center></td>
            </tr>
            </tr>
        </thead> 
        <tbody>
            <?php
            $i = 0;

            function check_hadir($val,$jenis) {
                if($jenis=='uts'){
					if($val='6'){
						$hasil=100;
					}else{
						$hasil=$val*100/6;
					}
					return $hasil;
				}
				else{
					if($val='14'){
						$hasil=100;
					}else{
						$hasil=$val*100/14;
					}
					return $hasil;
				}
            }

            foreach ($this->data as $key => $value) {
                $i++;
                echo "<tr>";
                echo "<td align = 'center'>" . $i . "</td>";
                echo "<td>" . $value['nim'] . "<input type='hidden' id='nim' value='" . $value['nim'] . "'></td>";
                echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
                 $check_hadir = check_hadir($value['uts'],'uts');
                if ($check_hadir >= 75) {
                    echo "<td align='center' style='color:green'><center><strong>IKUT</center></td>";
                } else {
                    echo "<td align='center' style='color:red'><input type='hidden' value='".$value['nim']."' name='utsnim[]'><center><strong>TIDAK IKUT</center></td>";
                }
				echo "<td align='center' style='color:blue'><center><strong>".number_format($check_hadir,2,",",".")."</strong> %</center></td>";
                $check_hadir = check_hadir($value['uas'],'uas');
                if ($check_hadir >= 75) {
                    echo "<td align='center' style='color:green'><center><strong>IKUT</center></td>";
                } else {
                    echo "<td align='center' style='color:red'><input type='hidden' value='".$value['nim']."' name='uasnim[]'><center><strong>TIDAK IKUT</center></td>";
                }
				echo "<td align='center' style='color:blue'><center><strong>".number_format($check_hadir,2,",",".")." </strong>%</center></td>";
                echo "<td align='center'><a href='#addMDP' data-toggle='modal' url = '" . URL . "siak_absensi_mahasiswa/getDetail/" . $this->prodi . "/" . $this->semester . "/" . $value['nim'] . "/" . $this->matkul . "/" . $this->cohort . "'> <span class='glyphicon glyphicon-check'>DETAIL</span> </a></td>";

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
<script>
	$(document).ready(function() {
    $('#list_data').DataTable();
} );
</script>
