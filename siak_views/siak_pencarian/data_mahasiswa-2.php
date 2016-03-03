<script>
	$(document).ready(function(){
		
		 var table = $('#search_mahasiswa').DataTable();
		$('input[type=checkbox]').on( 'click', function (e) {
			var ok=$(this).attr('isi');
			var urut=$(this).attr('data-column');
			
			if(ok=='1'){
				$(this).attr('isi','2');
				$('#span'+urut).removeAttr("class");
			}
			else{
				$(this).attr('isi','1');
				$('#span'+urut).attr("class",'checked');
				
			}
        e.preventDefault();
 
        // Get the column API object
       var column = table.column( $(this).attr('data-column') );
 
        // Toggle the visibility
       column.visible( ! column.visible() );
    } );
	});
	</script>
		<form method='POST' action='<?php echo URL;?>siak_pencarian/MSHS_EXCEL/<?php echo $this->nim; ?>/<?php echo $this->prodi; ?>/<?php echo $this->cohort; ?>' >
<?php $header_table= array('KODE PT','PRODI','JENJANG STUDI','NIM','NAMA',
'TEMPAT LAHIR','TANGGAL LAHIR','JENIS KELAMIN','SEMESTER','TAHUN MASUK','BATAS STUDI','ALAMAT','KODE PROPINSI','TANGGAL MASUK','TANGGAL LULUS','STATUS AKTIVITAS','STATUS AWAL','JUMLAH SKS','KODE PT','KODE PRODI'
); 
$isi_table=array('UNHAN','prodi_id','S2','nim','nama_depan',
'tempat_lahir','tanggal_lahir','kelamin_kode','semester','tahun_masuk','batas_studi','alamat_rumah','kode_prop','tanggal_masuk','tanggal_lulus','status_aktivitas','status_awal','jumlah_sks','kode_pt','prodi_id');
$jumlah=count($isi_table);


?>
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
										  echo "<label><div class='checker'><span id='span".$x."' class='checked'><input type='checkbox' checked isi='1' data-column='".$x."'><input type='hidden' name='header[]' value='".$header_table[$i]."'>".$header_table[$i]."</span></div></label>";
												$x++;
											
										}
									?>
									</div>
								</div>
							</div>
							
							<div class="btn-group">
								<button type="submit" class=" btn purple btn-large" id="dbfMHS"><i class="icon-download-alt"></i> Export DBF</button>
							</div>
								<br>
<div style="overflow: auto; overflow-y: hidden;">
<?php //var_dump($jumlah);die(); ?>
<table id='search_mahasiswa' class="table table-striped table-bordered table-hover table-full-width dataTable">
		<thead>
			<tr align = "center">
			<?php 
				foreach($header_table as $row){
					echo "<td>".$row."</td>";	
				}
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
	</form>
	
	