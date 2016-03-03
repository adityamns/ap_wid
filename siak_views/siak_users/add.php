<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		
			<form id="formUsers" name="users" class="horizontal-form" method = "post" action = "<?php echo URL;?>/siak_users/siak_create">
			
				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="username">USERNAME</label>
							<div class="controls">
								<input type="text" name="username" id="username" class="m-wrap span12" placeholder="Masukkan Username">
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
								<input type="text" name="password" id="password" class="m-wrap span12" placeholder="Masukkan Password">
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
								<?php foreach ($this->siak_group as $key => $value) { ?>
									<option value="<?php echo $value['id'];?>"><?php echo $value['nama'];?></option>	
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
							<label class="control-label" for="kategori_id">TAMBAH</label>
							<div class="controls">
								<button class="btn blue mini" type="button" onClick="addVariables();">Tambah Dosen</button>
							</div>
						</div>
					</div>
					<div class="span8">
						<div class="control-group">
							<label class="control-label" for="lastName">PRODI</label>
							<div class="controls">
<!-- 								<select name="prodi_id" class="m-wrap span12"> -->
<!-- 									<option value=""></option> -->
								<?php //foreach ($this->prodi as $key => $val) { ?>
<!-- 									<option value="<?php //echo $val['prodi_id'];?>"><?php //echo $val['prodi'];?></option>	 -->
								<?php //} ?>
<!-- 								</select> -->
								<div id="variablegroups">
								</div>
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
								<option name="status" id="status" value="<?php echo $val['nilai']; ?>"><?php echo $val['nama']; ?></option>
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
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formUsers').submit();">Simpan</button>
</div>

<script >

function addVariables(){
	var varGroups = document.getElementById("variablegroups");
	var rnumber=Math.random();
	var htmls = "<select name = 'prodi_id[]' class='chosen span12'>"+
		      <?php foreach ($this->prodi as $key => $val) { ?>
		      "<option value='<?php echo $val['prodi_id'];?>'>"+
		      "<?php echo $val['prodi']; ?>"+
		      "</option>"+
		      <?php /*}*/ } ?> 
		      "</select>"+
		      "<button class='btn red mini' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	$("#variablegroups").append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ htmls +"<br><br></div>"));	
}
</script>