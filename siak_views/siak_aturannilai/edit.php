<div class="modal-body">
	<div class="portlet-body form">
	<?php foreach ($this->siak_data as $key => $value) { ?>
	      <form id="formEAN" class="horizontal-form" action = "<?php echo URL;?>/siak_aturan_nilai/siak_edit_save/<?php echo $value['nilai_id'];?>" method = "post">
	      <div class="row-fluid">
		      <div class="span6">
			      <div class="control-group">
				      <label class="control-label" for="aktif">Jenis Penilaian</label>
				      <div class="controls">
				      <select name="jenis_nilai" class="m-wrap span12">
				      <?php $selected=($value['jenis_nilai'] == 1)?"selected":""; 
					    $selected2=($value['jenis_nilai'] == 2)?"selected":""; ?>
					      <option value="1" <?=$selected?>>Normal</option>
					      <option value="2" <?=$selected2?>>Perbaikan</option>
				      </select>
				      </div>
			      </div>
		      </div>
		      <div class="span6">
			      <div class="control-group">
				      <label class="control-label" for="aktif">Program Studi</label>
				      <div class="controls">
				      <select name="prodi_id" class="m-wrap span12">
						<?php foreach($this->siak_data_list as $key => $val) { ?>
							  <option value='<?php echo $val[prodi_id]; ?>' <?php echo $val[prodi_id]==$value[prodi_id]?"selected":"";?>><?php echo $val[prodi]; ?></option>
						<?php } ?>
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
					      <input type="text" class="m-wrap span12" name="nama" id="nama" value="<?php echo $value['nama'];?>">
				      </div>
			      </div>
		      </div>
		      <div class="span4">
			      <div class="control-group">
				      <label class="control-label" for="bahasa">Bobot</label>
				      <div class="controls">
					      <input type="text" class="m-wrap span12" name="bobot" id="bobot" value="<?php echo $value['bobot'];?>">
				      </div>
			      </div>
		      </div>
		      <div class="span4">
			      <div class="control-group">
				      <label class="control-label" for="bahasa">Lulus ? </label>
				      <div class="controls">
				      <?php
				      if($value['lulus']=='Y'){
				      ?>
					      <input type='checkbox' checked onClick='if(this.checked==true){document.getElementById("lulus").value = "Y";$("#lbl").text("Ya");} else {document.getElementById("lulus").value = "N";$("#lbl").text("Tidak");}' value=''>
					      <span id="lbl">
					      Ya
					      </span>
					      <input type='hidden' name='lulus' id='lulus' value='Y'>
				      <?php 
				      }else{
				      ?>
					      <input type='checkbox' onClick='if(this.checked==true){document.getElementById("lulus").value = "Y";$("#lbl").text("Ya");} else {document.getElementById("lulus").value = "N";$("#lbl").text("Tidak");}' value=''>
					      <span id="lbl">
					      Tidak
					      </span>
					      <input type='hidden' name='lulus' id='lulus' value='N'>
				      
				      <?php } ?>
				      </div>
			      </div>
		      </div>
	      </div>
	      <div class="row-fluid">
		      <div class="span4">
			      <div class="control-group">
				      <label class="control-label" for="bahasa">Batas Bawah</label>
				      <div class="controls">
					      <input type="text" class="m-wrap span12" name="nilaimin" id="nilaimin" value="<?php echo $value['nilaimin'];?>">
				      </div>
			      </div>
		      </div>
		      <div class="span4">
			      <div class="control-group">
				      <label class="control-label" for="bahasa">Batas Atas</label>
				      <div class="controls">
					      <input type="text" class="m-wrap span12" name="nilaimax" id="nilaimax" value="<?php echo $value['nilaimax'];?>">
				      </div>
			      </div>
		      </div>
		      <div class="span4">
			      <div class="control-group">
				      <label class="control-label" for="bahasa">Hitung dalam IPK</label>
				      <div class="controls">
				      <?php
					if($value['hitungipk']=='Y'){
				      ?>
					      <input type='checkbox' checked onClick='if(this.checked==true){document.getElementById("hitung").value = "Y";$("#lbl2").text("Ya");} else {document.getElementById("hitung").value = "N";$("#lbl2").text("Tidak");}' value=''>
					      <span id="lbl2">
					      Ya
					      </span>
					      <input type='hidden' name='hitungipk' id='hitung' value='Y'>
				      <?php
				      }else{
				      ?>
					      <input type='checkbox' onClick='if(this.checked==true){document.getElementById("hitung").value = "Y";$("#lbl2").text("Ya");} else {document.getElementById("hitung").value = "N";$("#lbl2").text("Tidak");}' value=''>
					      <span id="lbl2">
					      Tidak
					      </span>
					      <input type='hidden' name='hitungipk' id='hitung' value='N'>
				      <?php } ?>
				      </div>
			      </div>
		      </div>
	      </div>
	      </form>
	<?php } ?>
 	</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" data-dismiss="modal" class="btn green" onclick="document.getElementById('formEAN').submit();">Save changes</button>
</div>