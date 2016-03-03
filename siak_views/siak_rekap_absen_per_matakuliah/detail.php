<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
            <thead>
                <tr align = "center">
                    <td >TATAP MUKA</td>
                    <td >JADWAL</td>
                    <td >STATUS</td>
                    <td >WAKTU</td>
                </tr>
            </thead> 
            <tbody>
                <?php
                $i = 0;

                function check_data($mulai, $row) {
                    foreach ($row as $k => $v) {
                        if ($v['tanggal'] == $mulai) {
                            return array(true, $v['status'], $v['waktu']);
                        }
                    }
                    return array(false, '');
                }

                foreach ($this->detail as $key => $value) {
                    $i++;
                    echo "<tr>";
                    echo "<td width='50' align = 'center'>" . $i . "</td>";
                    echo "<td width='200' align = 'center'>" . $value['mulai'] . "</td>";
                    $check_data = check_data($value['mulai'], $this->absen);
                    if ($check_data[0]) {
                        $status = $check_data[1] == 1 ? "HADIR" : "TIDAK HADIR";
                        $waktu = $check_data[2] != '' ? $check_data[2] : "<b>00:00:00</b>";
						// if($check_data[2] != ''){
							// $waktu=$check_data[2];
						// }elseif($check_data[1] == 1){
							// $waktu='-';
						// }else{
							// $waktu=
						// }
                        echo "<td align = 'center'>" . $status . "</td>";
                        echo "<td align = 'center'>" . $waktu . "</td>";
                    } else {
                        echo "<td align='center'> - </td>";
                        echo "<td align='center'><b>00:00:00</b></td>";
                    }

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
        <input type="hidden" value="<?php echo $this->matkul; ?>" name="matkul">
        <input type="hidden" value="<?php echo $this->prodi; ?>" name="prodi">
        <input type="hidden" value="<?php echo $this->semester; ?>" name="semester">
        <input type="hidden" value="<?php echo $this->cohort; ?>" name="cohort">	
        <input type="hidden" value="<?php echo $this->nim; ?>" name="nim">	
        <button class="btn btn-default btn-sm" onclick="this.submit;"><span class="glyphicon glyphicon-print" data-toggle="modal" data-target="#myModal"></span> Cetak Absensi</button>
    </form>
</div>