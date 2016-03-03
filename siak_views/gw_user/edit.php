<div class="modal-body">
	<div class="portlet-body form">
	<form action="<?=URL?>siak_dashboard/update" method="post" id="formEditProf">
	<?php foreach($this->edit as $row => $key){ ?>
		<div class="row-fluid">
		      <div class="span6">
			      <div class="control-group">
				      <label class="control-label" for="bahasa">Username</label>
				      <div class="controls">
					      <input type="text" class="m-wrap span12" name="user" value="<?=$key['username'];?>" disabled>
					      <input type="hidden" name="id" value="<?=$key['id'];?>">
				      </div>
			      </div>
		      </div>
		      <div class="span6">
			      <div class="control-group">
				      <label class="control-label" for="aktif">Password Lama</label>
				      <div class="controls">
					      <input type="password" class="m-wrap span12" name="pass" value="<?=$key['password'];?>" disabled>
					      
				      </div>
			      </div>
		      </div>
		      <!--/span-->
		</div>
		<div class="row-fluid">
		      <div class="span6">
			      <div class="control-group">
				      <label class="control-label" for="bahasa">Pasword Baru</label>
				      <div class="controls">
					      <input class="m-wrap span12" type="password" name="new_pass" value="">
				      </div>
			      </div>
		      </div>
		      <div class="span6">
			      <div class="control-group">
				      <label class="control-label" for="aktif">Status</label>
				      <div class="controls">
					      <input type="text" class="m-wrap span12" name="status" value="<?=$status = ($key['status'] == 1) ? "Aktif":"Tidak Aktif"?>" disabled>
					      
				      </div>
			      </div>
		      </div>
		      <!--/span-->
		</div>
	<?php } ?>
	</form>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" data-dismiss="modal" class="btn green" onclick="document.getElementById('formEditProf').submit();">Simpan</button>
</div>