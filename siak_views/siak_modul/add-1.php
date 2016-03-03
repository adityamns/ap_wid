<div class="panel panel-danger" style="width:700px;">
	<div class="panel-heading">
		<h3 class="panel-title">Add Modul</h3>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<form id="users" name="users" class="form-horizontal" method = "post" action = "<?php echo URL;?>/siak_modul/siak_create">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kode" class="control-label">KODE</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="kode" id="kode" class="form-control" placeholder="Kode...">
 				</div>
 			</div>
 			
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nama_groups" class="control-label">PARENT MODUL</label></div>
 				<div class="form-group col-md-8">
 					<select class="form-control" id="parent">
						<option >--Pilih Parent--</option>
						<option value="Yes">Ya</option>
						<option value="No">Tidak</option>
					</select>
 				</div>
 			</div>
 			
 			<div class="row" id="child1">
 				<div class="form-group col-md-4"><label for="groups" class="control-label">GROUP MODUL</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="groups" id="groups" class="form-control" placeholder="Group Modul...">
 				</div>
 			</div>
 			
 			<div class="row" id="child2">
 				<div class="form-group col-md-4"><label for="groups" class="control-label">PARENT NAME</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="parent" id="parent_name" class="form-control" placeholder="Parent Name...">
 				</div>
 			</div>
 			
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nama_groups" class="control-label">GROUP NAMA</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="nama_groups" id="nama_groups" class="form-control" placeholder="Nama Group...">
 				</div>
 			</div>
 			
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nama" class="control-label">NAMA</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama...">
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="urutan" class="control-label">URUTAN</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="urutan" id="urutan" class="form-control" placeholder="Urutan...">
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-5"><label for="url" class="control-label"><?php echo URL; ?></label></div>
 				<div class="form-group col-md-7">
 					<input type="text" name="url" id="url" class="form-control" placeholder="Url...">
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nama" class="control-label">STATUS</label></div>
 				<div class="form-group col-md-8">
					<select class="form-control" name = "status">
						<?php foreach ($this->status_modul as $key => $val) { 
							$untuk = explode(',', $val['untuk']); if(in_array("modul", $untuk)){ ?>
						<option name="status" id="status" value="<?php echo $val['nilai']; ?>"><?php echo $val['nama']; ?></option>
						<?php } } ?>
					</select>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="ada_submenu" class="control-label">SUBMENU?</label></div>
 				<div class="form-group col-md-8"><input type='checkbox' onClick='if(this.checked==true) document.getElementById("ada_submenu").value = "2"; else document.getElementById("ada_submenu").value = "1";' name='' value=''><input type='hidden' name='ada_submenu' id='ada_submenu' value='1'></div>
 			</div>
 			<div class="control-group">
 				<label class="control-label">&nbsp</label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "INSERT" class = "btn btn-medium btn-primary "/>
	 					<input type = "button" value = "BATAL" class = "btn btn-medium btn-warning " onclick="fancyClose()"/>
 					</div>
 				</div>
 			</div>
			</form>
 	</div>
 </div>
 </div>
 <script>
 
jQuery(document).ready(function()
{
 jQuery("#parent").change(function()
 {
  if(jQuery(this).val() == "No")
  {
   jQuery("#child1").show();
   jQuery("#child2").hide();
   jQuery("#parent_name").prop('disabled', true);
   jQuery("#groups").prop('disabled', false);
  }
  else
  {
    jQuery("#child2").show();
   jQuery("#child1").hide();
   jQuery("#parent_name").prop('disabled', false);
   jQuery("#groups").prop('disabled', true);
  }
 });
 jQuery("#child1").hide();
 jQuery("#child2").hide();
});
 
 </script>