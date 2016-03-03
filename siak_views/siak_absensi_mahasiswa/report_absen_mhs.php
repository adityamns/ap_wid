<script type="text/javascript">
	function submit()
	{
		document.form1.submit();
	}
</script>

							<div class="row-fluid">
								<div class="span12">
<div class="input-group">
    <form id="form1" action="<?php echo URL; ?>siak_absensi_mahasiswa/rekap_absen_print" method="post" target='_blank'>
        <input type="hidden" value="<?php echo $this->prodi; ?>" name="prodi">
        <input type="hidden" value="<?php echo $this->cohort; ?>" name="cohort">
        <input type="hidden" value="<?php echo $this->semester; ?>" name="semester">
        <input type="hidden" value="<?php echo $this->matkul; ?>" name="matkul">	
        <button onclick="submit()" class="btn btn-default btn-sm" target='blank' ><span class="glyphicon glyphicon-print" data-toggle="modal" data-target="#myModal"></span> Print Absensi</button>
    </form>
</div>
<form>
    <table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
        <thead>
            <tr align = "center">
                <td rowspan="2">NO</td>
                <td rowspan="2">NIM</td>
                <td rowspan="2">NAMA</td>
                <td colspan="2">STATUS</td>
                <td rowspan="2">ACTION</td>
            <tr>
                <td align='center'>HADIR</td>
                <td align='center'>TIDAK HADIR</td>
            </tr>
            </tr>
        </thead> 
        <tbody>
            <?php
            $i = 0;

            function check_hadir($nim, $row) {
                foreach ($row as $k => $v) {
                    if ($v['nim'] == $nim) {
                        return array(true, $v['jumlah']);
                    }
                }
                return array(false, '');
            }

            foreach ($this->data_mahasiswa as $key => $value) {
                $i++;
                echo "<tr>";
                echo "<td align = 'center'>" . $i . "</td>";
                echo "<td>" . $value['nim'] . "<input type='hidden' id='nim' value='" . $value['nim'] . "'></td>";
                echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
                $check_hadir = check_hadir($value['nim'], $this->data_hadir);
                if ($check_hadir[0]) {
                    echo "<td align='center'>" . $check_hadir[1] . "</td>";
                } else {
                    echo "<td align='center'> - </td>";
                }

                $check_hadir = check_hadir($value['nim'], $this->data_alpa);
                if ($check_hadir[0]) {
                    echo "<td align='center'>" . $check_hadir[1] . "</td>";
                } else {
                    echo "<td align='center'> - </td>";
                }
                echo "<td align='center'><a href='#modalDetail' data-toggle='modal' onclick='detail(this)' link = '" . URL . "siak_absensi_mahasiswa/getDetail/" . $this->prodi . "/" . $this->semester . "/" . $value['nim'] . "/" . $this->matkul . "/" . $this->cohort . "'> <span class='glyphicon glyphicon-check'>DETAIL</span> </a></td>";

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</form>