<?php //var_dump($this->siak_data);die(); 
foreach ($this->siak_data as $key => $value) { ?>
<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		
			<form id="formEditUsers" name="users" class="horizontal-form" method = "post" action = "<?=URL?>/siak_users/siak_edit_save/<?php echo $value['id'];?>">
			
				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="username">USERNAME</label>
							<div class="controls">
								<input type="text" name="username" id="username" class="m-wrap span12" value="<?php echo $value['username'];?>">
	      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="password">PASSWORD</label>
							<div class="controls">
								<input type="text" name="password" id="password" class="m-wrap span12" value="<?php echo $value['password'];?>">
	      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="lastName">GROUP</label>
							<div class="controls">
								<select name="group_id" class="m-wrap span12">
								<?php foreach ($this->siak_group as $key => $val) { 
								      $selected = ($value['group_id']==$val['id']) ? "selected":"";
								?>
									<option value="<?php echo $val['id'];?>" <?=$selected?>><?php echo $val['nama'];?></option>	
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="lastName">PRODI</label>
							<div class="controls">
								<select name="prodi_id" class="m-wrap span12">
									<option value=""></option>
								<?php foreach ($this->prodi as $key => $vals) { 
								      $selected = ($vals['prodi_id'] == $value['prodi_id']) ? "selected":"";
								?>
									<option value="<?php echo $vals['prodi_id'];?>" <?=$selected?>><?php echo $vals['prodi'];?></option>	
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="lastName">STATUS</label>
							<div class="controls">
								<select name="status" class="m-wrap span12">
								<?php foreach ($this->siak_status as $key => $val) { 
									$untuk = explode(',', $val['untuk']); if(in_array("users", $untuk)){ ?>
								<option name="status" id="status" value="<?php echo $val['nilai']; ?>" "<?php echo $value['status']==$val['nilai']?"selected":"";?>"><?php echo $val['nama']; ?></option>
								<?php } } ?>
								</select>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
 			
			</form>
			
		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formEditUsers').submit();">Save changes</button>
</div>

<?php } ?>