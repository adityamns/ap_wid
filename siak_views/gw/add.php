<div class="modal-body">
<form action="<?=URL?>gw/tambah" method="post" class="horizontal-form" id="formTambah">
<!-- 	<div class="scroller" data-always-visible="1" data-rail-visible1="1"> -->
		<div class="portlet-body form" class="scroller" data-always-visible="1" data-rail-visible1="1">
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="group">GROUP</label>
						<div class="controls chzn-controls">
						      <select name="group_id" class="chosen span12">
						      <?php foreach ($this->siak_group as $key => $value) { ?>
							      <option value="<?php echo $value['id'];?>"><?php echo $value['nama'];?></option>	
						      <?php } ?>
						      </select>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="group">Modul</label>
						<div class="controls chzn-controls">
						      <select name="modul_id" id="dropdown_modul_add" class="chosen span12">
						      <?php foreach ($this->siak_modul as $key => $value) { ?>
							      <option value="<?php echo $value['id'];?>"><?php echo $value['nama_modul'];?></option>	
						      <?php } ?>
						      </select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="group">&nbsp;</label>
						<div class="controls">
						      <button type="button" class=" btn purple btn-large" onclick="add_modul();">Tambah</button>
						</div>
					</div>
				</div>
			</div>

			<table id="tabel_modul" class="table table-striped table-bordered table-hover table-full-width">
				<tr>
					<th>Kode</th>
					<th>Nama</th>
<!-- 					<th>Prodi</th> -->
					<th>Lihat</th>
					<th>Tambah</th>
					<th>Ubah</th>
					<th>Hapus</th>
					<th>Pribadi</th>
					<th>Aksi</th>
				</tr>
			</table>

		</div>
<!-- 	</div> -->
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formTambah').submit();">Simpan</button>
</div>
</form>