<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
 		<form id="formTahun" class="horizontal-form" action = "<?php echo URL;?>siak_tahun_akademik/siak_create" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Nama Tahun</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama_tahun" id="nama_tahun" placeholder="Nama Tahun...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Keterangan</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="keterangan" id="keterangan" placeholder="Keterangan...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Status</label>
						<div class="controls">
							<input type='checkbox' onClick='if(this.checked==true) document.getElementById("status").value = "Ya"; else document.getElementById("status").value = "No";' name='' value=''><input type='hidden' name='status' id='status' value='No'></div>
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>
 			
 			<!--<div class="row">
 				<div class="form-group col-md-2"><label for="semester" class="control-label">Semester</label></div>
 				<div class="form-group col-md-3">
 				<select name="semester">
 					<option value="null">Pilih</option>
 					<option value="ganjil">Ganjil</option>
 					<option value="genap">Genap</option>
 				</select>	
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="bulan" class="control-label">Bulan</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="bulan" id="bulan" placeholder="Bulan mulai semester"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="prodi_id" class="control-label">Program Studi</label></div>
 				<div class="form-group col-md-3">
 				<select name="prodi_id">
 				<?php
				// foreach($this->siak_data_list as $key => $value)
							// {
								 // echo "<option value='$value[prodi_id]'>$value[prodi]</option>";
							// }
				// ?>
				</select>	
				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="krsMulai" class="control-label">Mulai KRS</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="krsMulai" id="krsMulai" placeholder="Tanggal Mulai KRS"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="krsSelesai" class="control-label">Selesai KRS</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="krsSelesai" id="krsSelesai" placeholder="Tanggal Selesai KRS..."></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="kuliahMulai" class="control-label">Mulai Kuliah</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kuliahMulai" id="kuliahMulai" placeholder="Tanggal Mulai KULIAH"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="kuliahSelesai" class="control-label">Selesai Kuliah</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kuliahSelesai" id="kuliahSelesai" placeholder="Tanggal Selesai KULIAH..."></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="utsMulai" class="control-label">Mulai UTS</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="utsMulai" id="utsMulai" placeholder="Tanggal Mulai UTS"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="utsSelesai" class="control-label">Selesai UTS</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="utsSelesai" id="utsSelesai" placeholder="Tanggal Selesai UTS..."></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="uasMulai" class="control-label">Mulai UAS</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="uasMulai" id="uasMulai" placeholder="Tanggal Mulai UAS"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="utsSelesai" class="control-label">Selesai UTS</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="uasSelesai" id="uasSelesai" placeholder="Tanggal Selesai UAS..."></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="nilaiMulai" class="control-label">Mulai Penilaian</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="nilaiMulai" id="nilaiMulai" placeholder="Tanggal Mulai PENILAIAN"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="nilaiSelesai" class="control-label">Selesai Penilaian</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="nilaiSelesai" id="nilaiSelesai" placeholder="Tanggal Selesai PENILAIAN..."></div>
 			</div>-->
 		</form>
 	</div>
 </div>
 <div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formTahun').submit();">Simpan</button>
</div>
<!--
 <script type="text/javascript">
 // jQuery(function() {
 	// jQuery( "#krsMulai" ).datepicker(option);
 	// jQuery( "#krsSelesai" ).datepicker(option);
 	// jQuery( "#kuliahMulai" ).datepicker(option);
 	// jQuery( "#kuliahSelesai" ).datepicker(option);
 	// jQuery( "#utsMulai" ).datepicker(option);
 	// jQuery( "#utsSelesai" ).datepicker(option);
 	// jQuery( "#uasMulai" ).datepicker(option);
 	// jQuery( "#uasSelesai" ).datepicker(option);
 	// jQuery( "#nilaiMulai" ).datepicker(option);
 	// jQuery( "#nilaiSelesai" ).datepicker(option);

 // });
 fancy();
 </script>-->