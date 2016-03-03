<div class="modal-body">
     <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
	       <div class="portlet-body form">
	       <?php foreach ($this->siak_data as $key => $value) { ?>
	       <form id="formEditTopik" class="horizontal-form" action = "<?php echo URL;?>/siak_topik/siak_edit_save/<?php echo $value['id'];?>" method = "post">
		    <div class="row-fluid">
			 <div class="span6 ">
				 <div class="control-group">
					 <label class="control-label" for="firstName">Mata Kuliah</label>
					 <div class="controls">
						  <select id="combobox" class="m-wrap span12" name="kode_matkul">
						  <option value="">Ketikan Mata Kuliah</option>
						  <?php foreach($this->siak_data_matkul as $key => $val){
						  $selected = ($val[kode_matkul]==$value[kode_matkul])?"selected":"";
							  echo "<option value='$val[kode_matkul]' $selected>$val[kode_matkul] - $val[nama_matkul]</option>";
						  } ?>
						  </select>
					 </div>
				 </div>
			 </div>
			 <!--/span-->
			 <div class="span6 ">
				 <div class="control-group">
					 <label class="control-label" for="kode_topik">Kode Topik</label>
					 <div class="controls">
						 <input type="text" id="kode_topik" class="m-wrap span12" value="<?php echo $value[kode_topik];?>" name="kode_topik">
					 </div>
				 </div>
			 </div>
			 <!--/span-->
		    </div>
		    <div class="row-fluid">
			 <div class="span6 ">
				 <div class="control-group">
					 <label class="control-label" for="nama_topik">Nama Topik</label>
					 <div class="controls">
						 <input type="text" id="nama_topik" class="m-wrap span12" value="<?php echo $value[nama_topik];?>" name="nama_topik">
					 </div>
				 </div>
			 </div>
			 <!--/span-->
		    </div>
	       </form>
	       <?php } ?>
	       </div>
     </div>
</div>

<div class="modal-footer">
     <button type="button" data-dismiss="modal" class="btn">Close</button>
     <button type="submit" class="btn green" onclick="document.getElementById('formEditTopik').submit();">Save changes</button>
</div>

<script>
     autoCom();
</script>