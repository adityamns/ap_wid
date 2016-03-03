<script>
	$(document).ready(function(){
		
		 var table = $('#search_mahasiswa').DataTable();
		$('input[type=checkbox]').on( 'click', function (e) {
			var ok=$(this).attr('isi');
			var urut=$(this).attr('data-column');
			
			if(ok=='1'){
				$(this).attr('isi','2');
				$('#span'+urut).removeAttr("class");
				// $('#isi_table'+urut).removeAttr("name");
				// $('#dbfheader'+urut).removeAttr("name");
			}
			else{
				$(this).attr('isi','1');
				$('#span'+urut).attr("class",'checked');
				// $('#header_table'+urut).attr("name",'header_table[]');
				// $('#isi_table'+urut).attr("name",'isi_table[]');
				// $('#dbfheader'+urut).attr("name");
				// $('#header_table'+urut).removeAttr("name");
				
			}
        e.preventDefault();
 
        // Get the column API object
       var column = table.column( $(this).attr('data-column') );
 
        // Toggle the visibility
       column.visible( ! column.visible() );
    } );
	
	
	});
	</script>
		<form method='POST' action='<?php echo URL;?>siak_pencarian/export/' target="_blank">
<?php $header_table= array('KODE PT','PRODI','JENJANG STUDI','NIM','NAMA',
'TEMPAT LAHIR','TANGGAL LAHIR','JENIS KELAMIN','SEMESTER','TAHUN MASUK','BATAS STUDI','ALAMAT','KODE PROPINSI','TANGGAL MASUK','TANGGAL LULUS','STATUS AKTIVITAS','STATUS AWAL','JUMLAH SKS'
); 

$dbfHead = array('KDPT,C,100','PRODI,C,100','JNJNGSTDI,C,100','NIM,C,100','NAMA,C,100','TPTLHR,C,100','TGLLHR,D','JKEL,C,100','SMSTR,C,100','THNMSK,C,100','BTSSTDI,C,100','ALMT,C,100','KDPROP,C,100','TGLMSK,D','TGLLLS,D','STATAKTFTS,C,100','STATAWL,C,100','JMLSKS,C,100','KDPT,C,100','KDPRODI,C,100');

$isi_table=array('UNHAN','prodi_id','S2','nim','nama_depan',
'tempat_lahir','tanggal_lahir','kelamin_kode','semester','tahun_masuk','batas_studi','alamat_rumah','kode_prop','tanggal_masuk','tanggal_lulus','status_aktivitas','status_awal','jumlah_sks');
$jumlah=count($isi_table);


?>
							
								<br>
<input type='hidden' name='nim'  value='<?php echo $this->nim; ?>'>
<input type='hidden' name='prodi'  value='<?php echo $this->prodi; ?>'>
<input type='hidden' name='cohort'  value='<?php echo $this->cohort; ?>'>
<div class="portlet box blue" >
	<div class="portlet-title">
		<div class="caption">
<!-- 			<i class="icon-home"></i> -->
		
			<div class="actions">
				<div class="btn-group">
					<a class="btn" href="#" data-toggle="dropdown">
					PILIHAN KOLOM
					<i class="icon-angle-down"></i>
					</a>
					
					<div id="sample_2_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
					<?php 
						// foreach($header_table as $row){
						// }
						$x=0;
						for($i=0;$i<$jumlah;$i++){
						  echo "<label><div class='checker'><span id='span".$x."' class='checked'><input type='checkbox' checked isi='1' data-column='".$x."'>".$header_table[$i]."</span></div></label>";
								$x++;
							
						}
					?>
					</div>
				</div>
			</div>
		
		</div>
		
		<div class="btn-group pull-right open">
			<button class="btn dropdown-toggle" data-toggle="dropdown">EXPORT DATA<i class="icon-angle-down"></i>
			</button>
			<ul class="dropdown-menu pull-right">
				<!--<li><a href="#">Print</a></li>
				<li><button class="btn red span12" type="submit" name="dbfMHS"><i class="icon-download-alt"></i> Export to PDF</button></li>-->
				<li><button class="btn green span12" type="submit" name="exMHS" value='export'><i class="icon-download-alt"></i> Export to Excel</button></li>
				<li><button class="btn purple span12" type="submit" name="dbfMHS" value="dbfMHS"><i class="icon-download-alt"></i> Export to DBF</button></li>
			</ul>
		</div>
	</div>
	<div class="portlet-body">

		<div style="overflow: auto; overflow-y: hidden;">
	<?php //var_dump($jumlah);die(); ?>
			<table id='search_mahasiswa' class="table table-striped table-bordered table-hover table-full-width dataTable">
				<thead>
					<tr align = "center">
					<?php 
					$i=0;
						foreach($header_table as $row){
							echo "<td><input type='hidden'  name='header[]' value='".$header_table[$i]."'>
									<input type='hidden' name='dbfHead[]'  value='".$dbfHead[$i]."'>
									<input type='hidden' name='isi_table[]' value='".$isi_table[$i]."'>".$row."</td>";	
						$i++;}
					?>
					</tr>
				</thead> 
				<tbody>
					<?php
					$x = 0;
					foreach ($this->siak_data as $key => $value) {
						echo "<tr class='active'>";
							for($i=0;$i<$jumlah;$i++){	
								echo "<td>".$value[$isi_table[$i]]."</td>";
							}
						echo "</tr>";
					}
					// $i = 0;
					// foreach ($this->siak_data as $key => $value) {
						// $i++;
						// echo "<tr class='active'>";
						// echo "<td>" . $i . " </td>";
						// echo "<td></td>";
						// echo "<td>" . $value['prodi_id'] . " </td>";
						// echo "<td></td>";
						// echo "<td>" . $value['nim'] . " </td>";
						// echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
						// echo "<td></td>";
						// echo "<td></td>";
						// echo "<td>" . $value['kelamin_kode'] . " </td>";
						// echo "<td>" . $value['semester'] . " </td>";
						// echo "<td>" . $value['tahun_masuk'] . " </td>";
						// echo "<td>-</td>";
						// echo "<td>" . $value['alamat_rumah'] . "</td>";
						// echo "<td>-</td>";
						// echo "<td>-</td>";
						// echo "<td>-</td>";
						// echo "<td>-</td>";
						// echo "<td>-</td>";
						// echo "<td>-</td>";
						// echo "<td>-</td>";
						// echo "<td>-</td>";
						// $keluarga = $this->db->siak_query("select", "select *from keluarga where nim='".$value['nim']."'");
								// if(sizeof($keluarga) > 0){
									// foreach($keluarga as $k =>$val){
										// echo "<td>" . $val['nama_ayah'] . "</td>";
										// echo "<td>" . $val['nama_ibu'] . "</td>";
									// }
								// }else{
									// echo "<td> - </td>";
									// echo "<td> - </td>";
								// }
					// }
					?>
				</tbody>
			</table>
		<input type='submit' value='submit'>
		</div>
	</div>
</div>
	</form>
	
	