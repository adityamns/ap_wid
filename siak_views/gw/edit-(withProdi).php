<div class="modal-body">
<?php
// echo "<pre>";
// var_dump($this->siak_data);
// echo "</pre>";
?>
<form action="<?=URL?>gw/gw_update" method="post" id="formEdit" name="User" class="horizontal-form">

<!-- 	<div class="scroller" data-always-visible="1" data-rail-visible1="1"> -->
		<div class="portlet-body form" class="scroller" data-always-visible="1" data-rail-visible1="1">
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="group">GROUP</label>
						<div class="controls">
						      <select name="group_id" class="m-wrap span12" disabled>
						      <?php foreach ($this->siak_group as $key => $value) { ?>
						      <?php 
						      $selected = ($value['id'] == $this->id) ? "selected":"";
						      ?>
						      <option value="<?php echo $value['id'];?>" <?=$selected?>><?php echo $value['nama'];?></option>	
						      <?php } ?>
						      </select>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="grup_id" value="<?=$this->id?>">
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="group">Modul</label>
						<div class="controls chzn-controls">
						      <select name="modul_id" id="dropdown_modul" class="chosen span12">
						      <?php foreach ($this->siak_modul as $key => $value) { ?>
							      <option value="<?php echo $value['id'];?>"><?php echo $value['nama_modul'];?></option>	
						      <?php } ?>
						      </select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="group">&nbsp;</label>
						<div class="controls">
						      <button type="button" class=" btn purple btn-large" onclick="add_modul_edit();">Tambah</button>
						</div>
					</div>
				</div>
			</div>

			<table id="tabel_modul_edit" class="table table-striped table-bordered table-hover table-full-width">
				<tr>
					<th>Kode</th>
					<th>Nama</th>
					<th>Prodi</th>
					<th>Lihat</th>
					<th>Tambah</th>
					<th>Ubah</th>
					<th>Hapus</th>
					<th>Loads</th>
					<th>Aksi</th>
				</tr>
				
				<?php 
				$x = 0;
				foreach($this->siak_data as $row => $rec){
				$loads = ($rec['loads'] == 't') ? "checked":"";
				$creates = ($rec['creates'] == 't') ? "checked":"";
				$reades = ($rec['reades'] == 't') ? "checked":"";
				$updates = ($rec['updates'] == 't') ? "checked":"";
				$deletes = ($rec['deletes'] == 't') ? "checked":"";
				$prodi = explode(",",$rec['prodi_id']);
				?>

				<tr>
					<td><?=$rec['modul_id']?><input type="hidden" name="role_id[]" value="<?=$rec['id']?>"></td>
					<td><?=$rec['nama_modul']?></td>
					<td>
					<?php
					
					if($prodi[0] != ''){
					$count = count($prodi); for($i=0;$i<$count;$i++){ ?>
					<div class="input-group" id="asd<?=$i?>">
					<select name = "prodi_idX<?=$x?>[]">
					<?php 
					      foreach($this->prodi as $key => $val) { 
					      $selected = ($val['prodi_id'] == $prodi[$i]) ? "selected":"";
					      echo $selected;
					?>
					      <option value="<?php echo $val['prodi_id']; ?>" <?=$selected?> ><?php echo $val['prodi']; ?></option>
					<?php } ?> 
					</select>
					
					<button class="btn red mini" type="button" onClick="deleteThisVar(this);">Hapus</button>
					
					</div>
					<?php } } ?>
					<div id="variablegroup<?=$x?>"></div>
					
					<button class="btn purple mini" type="button" id="fuck<?=$x?>" onclick="damnt(<?=$x?>)">Tambah Prodi</button>
					
					</td>
					<input type="hidden" name="idx[]" value="<?=$this->id?>">
					<input type="hidden" name="modul_id[]" value="<?=$rec['modul_id']?>"/>
					<td>
					  <input type="hidden" name="allow_read_i[]" value="<?=$rec['reades']?>"/>
					  <input type="checkbox" value="<?=$rec['reades']?>" <?=$reades?> onclick="click_checkbox(this,3)"/></td>
					<td>
					  <input type="hidden" name="allow_create_i[]" value="<?=$rec['creates']?>"/>
					  <input type="checkbox" value="<?=$rec['creates']?>" <?=$creates?> onclick="click_checkbox(this,4)"/>
					</td>
					<td>
					  <input type="hidden" name="allow_update_i[]" value="<?=$rec['updates']?>"/>
					  <input type="checkbox" value="<?=$rec['updates']?>" <?=$updates?> onclick="click_checkbox(this,5)"/>
					</td>
					<td>
					  <input type="hidden" name="allow_delete_i[]" value="<?=$rec['deletes']?>"/>
					  <input type="checkbox" value="<?=$rec['deletes']?>" <?=$deletes?> onclick="click_checkbox(this,6)"/>
					</td>
					<td>
					  <input type="hidden" name="pribadi_i[]" value="<?=$rec['loads']?>"/>
					  <input type="checkbox" value="<?=$rec['loads']?>" <?=$loads?> onclick="click_checkbox(this,7)"/>
					</td>
					<td>
					  <button type="button" style="cursor:pointer;" class="btn red mini" title="Hapus" id="hapus_modul<?=$x?>" name="asd" onclick="Delete2(<?=$x?>)" value="<?=$rec['id']?>"><i class="icon-trash"></i> Hapus</button>
					</td>
				</tr>
				<?php $x++; } ?>
			</table>

		</div>
<!-- 	</div> -->
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formEdit').submit();">Update</button>
</div>
</form>
