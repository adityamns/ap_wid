<div class="modal-body">
	<div class="portlet-body form">
	
	      <form id="formAN" class="horizontal-form" action = "<?php echo URL;?>siak_aturan_nilai/siak_create" method = "post">
	      <div class="row-fluid">
		      <div class="span6">
			      <div class="control-group">
				      <label class="control-label" for="aktif">Jenis Penilaian</label>
				      <div class="controls">
				      <select name="jenis_nilai" class="m-wrap span12">
					      <option value="1">Normal</option>
					      <option value="2">Perbaikan</option>
				      </select>
				      </div>
			      </div>
		      </div>
		      <div class="span6">
			      <div class="control-group">
				      <label class="control-label" for="aktif">Program Studi</label>
				      <div class="controls">
				      <select name="prodi_id" class="m-wrap span12">
				      <?php foreach($this->siak_data_list as $key => $value)
					      {
						      echo "<option value='$value[prodi_id]'>$value[prodi]</option>";
					      }
				      ?>
				      </select>
				      </div>
			      </div>
		      </div>
		      <!--/span-->
	      </div>
	      <div class="row-fluid">
		      <div class="span4">
			      <div class="control-group">
				      <label class="control-label" for="bahasa">Grade Nilai</label>
				      <div class="controls">
					      <input type="text" class="m-wrap span12" name="nama" id="nama" placeholder="Grade Nilai...">
				      </div>
			      </div>
		      </div>
		      <div class="span4">
			      <div class="control-group">
				      <label class="control-label" for="bahasa">Bobot</label>
				      <div class="controls">
					      <input type="text" class="m-wrap span12" name="bobot" id="bobot" placeholder="Bobot...(1 s/d 4)">
				      </div>
			      </div>
		      </div>
		      <div class="span4">
			      <div class="control-group">
				      <label class="control-label" for="bahasa">Lulus ? </label>
				      <div class="controls">
					      <input type='checkbox' onClick='if(this.checked==true){document.getElementById("lulus").value = "Y";$("#lbl").text("Ya");} else {document.getElementById("lulus").value = "N";$("#lbl").text("Tidak");}' value=''>
					      <span id="lbl">
					      Tidak
					      </span>
					      <input type='hidden' name='lulus' id='lulus' value='N'>
				      </div>
			      </div>
		      </div>
	      </div>
	      <div class="row-fluid">
		      <div class="span4">
			      <div class="control-group">
				      <label class="control-label" for="bahasa">Batas Bawah</label>
				      <div class="controls">
					      <input type="text" class="m-wrap span12" name="nilaimin" id="nilaimin" placeholder="Nilai Max...">
				      </div>
			      </div>
		      </div>
		      <div class="span4">
			      <div class="control-group">
				      <label class="control-label" for="bahasa">Batas Atas</label>
				      <div class="controls">
					      <input type="text" class="m-wrap span12" name="nilaimax" id="nilaimax" placeholder="Nilai Min...">
				      </div>
			      </div>
		      </div>
		      <div class="span4">
			      <div class="control-group">
				      <label class="control-label" for="bahasa">Hitung dalam IPK</label>
				      <div class="controls">
					      <input type='checkbox' onClick='if(this.checked==true){document.getElementById("hitung").value = "Y";$("#lbl2").text("Ya");} else {document.getElementById("hitung").value = "N";$("#lbl2").text("Tidak");}' value=''>
					      <span id="lbl2">
					      Tidak
					      </span>
					      <input type='hidden' name='hitungipk' id='hitung' value='N'>
				      </div>
			      </div>
		      </div>
	      </div>
	      </form>
		
 	</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" data-dismiss="modal" class="btn green" onclick="document.getElementById('formAN').submit();">Simpan</button>
</div>