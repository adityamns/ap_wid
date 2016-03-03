<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Untitled Document</title>
        <style>
            #tab1 {
                border-left: solid 1px black;
                border-top: solid 1px black;
                border-spacing:0;
                border-collapse: collapse;
            }
            #tab1 td {
                border-right: solid 1px black;
                border-bottom: solid 1px black;
            }
        </style>
    </head>
<?php 
function hari($b){
		
					if($b==1)
					{$hari="SENIN";}
					elseif($b==2)
					{$hari="SELASA";}
					elseif($b==3)
					{$hari="RABU";}
					elseif($b==4)
					{$hari="KAMIS";}
					elseif($b==5)
					{$hari="JUMAT";}
					elseif($b==6)
					{$hari="SABTU";}
					elseif($b==7)
					{$hari="MINGGU";}
				return $hari;
		}
 ?>
    <body>
       <!--  <table width="30%" border="0" cellspacing="0" cellpadding="0" align="left">        
            <tr>
                <td align="center"><b>FAKULTAS STRATEGI PERTAHANAN</b></td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid black;" align="center"><b>PROGRAM STUDI DAMAI DAN RESOLUSI KONFLIK</b></td>
            </tr>
     
        </table>
        <br />
        <br />
        <br />-->
	<div class="input-group">
		<form id="form1" action="<?php echo URL; ?>siak_jadwal/print_jadwal" method="post" target="_blank">
			<input type="hidden" value="<?php echo $this->tahun;?>" name="tahunid">
			<input type="hidden" value="<?php echo $this->matkul;?>" name="matkul">
			<!--<input type="hidden" value="<?php echo $_POST['prodi'];?>" name="prodi"> -->
			<input type="hidden" value="<?php echo $this->prodi;?>" name="prodi">
			<input type="hidden" value="<?php echo $this->dosen;?>" name="dosen">
			<input type="hidden" value="<?php echo $this->semester;?>" name="semester">
			<input type="hidden" value="<?php echo $this->from;?>" name="from">
			<input type="hidden" value="<?php echo $this->to;?>" name="to">
			<input type="hidden" value="<?php echo $this->topik;?>" name="topik">
			<input type="hidden" value="<?php echo $this->cohort;?>" name="cohort">	
			<button class="btn btn-default btn-sm" onclick="submit()"><span class="glyphicon glyphicon-print" data-toggle="modal" data-target="#myModal"></span> Print Jadwal</button>
		</form>		
	</div>
       <table width="30%" align="center" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="3" style="text-align:center"><b>JADWAL PERKULIAHAN</b></td>
            </tr>
			
            <tr>
                <td width="40%"><b>SEMESTER</b></td>
                <td width="5%" style="text-align:center"><b>:</b></td>
                <td width="40%" style="text-align:left"><b><?php echo $this->semester;?></b></td>
            </tr>
            <tr>
                <td width="40%"><b>MINGGU KE</b></td>
                <td width="5%" style="text-align:center"><b>:</b></td>
                <td width="40%" style="text-align:left"><b></b></td>
            </tr>
            <tr>
                <td width="40%"><b>TANGGAL</td>
                <td width="5%" style="text-align:center"><b>:</b></td>
                <td width="60%" style="text-align:left"><b><?php echo $this->TAwal." ";
				echo $this->BAwal." s.d ";echo $this->TAkhir.' '; echo $this->BAkhir.' ';  ?></b></td>
            </tr>
        </table>
        <br />
        <table width="100%" cellpadding="0" cellspacing="0" border="0" id="tab1" repeated_header="1">
            <thead>
                <tr>
                    <th style="text-align:center;border: 1px solid black;">HARI</th>
                    <th style="text-align:center;border: 1px solid black;" rowspan="2">JAM <br> KE</th>
                    <th style="text-align:center;border: 1px solid black;" rowspan="2">PUKUL</th>
                    <th style="text-align:center;border: 1px solid black;" rowspan="2">MK <br>TOPIK</th>
                    <th style="text-align:center;border: 1px solid black;" colspan="2">TM</th>
                    <th style="text-align:center;border: 1px solid black;" rowspan="2">DOSEN</th>
                    <th style="text-align:center;border: 1px solid black;" rowspan="2">TEMPAT</th>
                    <th style="text-align:center;border: 1px solid black;" rowspan="2">KETERANGAN</th>
                </tr>
                <tr>
                    <th style="text-align:center;border: 1px solid black;">TGL</th>
                    <th style="text-align:center;border: 1px solid black;">KE</th>
                    <th style="text-align:center;border: 1px solid black;">DARI</th>
                </tr>
                <tr>
                    <?php 
                        for($i = 1;$i<=9;$i++){
                    ?>
                    <th style="text-align:center;border: 1px solid black;" ><?php echo $i;?></th>
                        <?php }?>
                </tr>
            </thead>
                <tbody>
					<?php foreach($this->siak_data as $key => $row){ 
					$dari = $this->db->siak_getfield('pertemuan','matakuliah',"kode_matkul='".$row['kode_matkul']."'");
					?>
                    <tr>
                        <td  align="center" style="background-color: #eee"><b><?php echo hari(date('N',strtotime($row['waktu']))).'<br>'.$row['waktu']; ?></b></td>
                        <td align="center"></td>
                        <td align="center"><?php echo $row['waktu_mulai'].' - '.$row['waktu_akhir']; ?></td>
                        <td align="center" style="background-color: #eee"><?php echo $row['singkatan'].'<br>'.$row['nama_topik']; ?></td>
                        <td align="center"><?php echo $row['pertemuanke']; ?></td>
                        <td align="center"><?php echo $dari; ?></td>
                        <td align="center" style="background-color: #eee"><?php echo $row['nama']; ?></td>
                        <td align="center"><?php echo $row['nama_ruang']; ?></td>
                        <td align="center"></td>
                    </tr>
					<?php }?>
                </tbody>
        </table>
        <p style="text-align: left; font-weight: bold">RM : Research Methodology; IPHS : Indonesian Politics, History and Society; SSE : Strategic Security Environment; NSP : National Power & Strategic Policy Making; INDS:Indonesian National Defence System</p>
    </body>
</html>