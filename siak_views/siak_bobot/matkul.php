<select class="large m-wrap" name="matkul_id" required>
	 <option value="">-- Mata Kuliah --</option>
	 	<?php foreach($this->siak_data as $key => $val){
	 		echo "<option value='$val[kode_matkul]'>$val[nama_matkul]</option>";
	 	} ?>
</select>
 				
 			