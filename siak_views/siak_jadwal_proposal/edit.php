<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="panel panel-danger" style="width:500px;">
	<div class="panel-heading">
		<h3 class="panel-title">Edit Users</h3>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
		<form id="users" name="users" method = "post" class="form-horizontal" action = "<?php echo URL;?>/siak_users/siak_edit_save/<?php echo $value['id'];?>">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="username" class="control-label">USERNAME</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="username" id="username" value="<?php echo $value['username'];?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="password" class="control-label">PASSWORD</label></div>
 				<div class="form-group col-md-8"><input type="password" class="form-control" name="password" id="password" value="<?php echo $value['password'];?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="group_id" class="control-label">GROUP</label></div>
 				<div class="form-group col-md-8">
 					<select name="group_id" class="form-control">
 					<?php foreach ($this->siak_group as $key => $val) { ?>
 						<option value="<?php echo $val['id'];?>" "<?php echo $value['group_id']==$val['id']?"selected":"";?>"><?php echo $val['nama'];?></option>	
 					<?php } ?>
 					</select>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="status" class="control-label">STATUS</label></div>
 				<div class="form-group col-md-8">
					<select class="form-control" name = "status">
						<?php foreach ($this->siak_status as $key => $val) { 
							$untuk = explode(',', $val['untuk']); if(in_array("users", $untuk)){ ?>
						<option name="status" id="status" value="<?php echo $val['nilai']; ?>" "<?php echo $value['status']==$val['nilai']?"selected":"";?>"><?php echo $val['nama']; ?></option>
						<?php } } ?>
					</select>
 				</div>
 			</div>
 			<div class="control-group">
 				<label class="control-label">&nbsp</label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "UPDATE" class = "btn btn-medium btn-primary "/>
 					</div>
 				</div>
 			</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>