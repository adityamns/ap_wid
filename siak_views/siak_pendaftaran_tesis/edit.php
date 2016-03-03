<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
		<form id="formEKonf" method = "post" action = "<?php echo URL;?>siak_pendaftaran_tesis/siak_edit_save/<?php echo $value['id'];?>">
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">NIM</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nim" id="nim" value="<?php echo $value['nim'];?>" readonly>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Nama</label>
						<div class="controls">
							<?php foreach($this->siak_nama as $key => $vnama) { ?>
								<input type="text" readonly class="m-wrap span12" value="<?php echo $vnama['nama_depan']." ".$vnama['nama_blkng']; ?>">
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Program Studi</label>
						<div class="controls">
							<?php foreach($this->siak_prodi as $key => $vprodi) { ?>
								<input type="hidden" value="<?php echo $vprodi['prodi_id']; ?>" name="prodi_id" id="PRODI_ID" />
								<input type="text" readonly class="m-wrap span12" value="<?php echo $vprodi['prodi']; ?>" id="PRODI" />
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Judul Tesis</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="judul" id="judul" value="<?php echo $value['judul'];?>">
						</div>
					</div>
				</div>
			</div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Metodelogi</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="metodelogi" id="metodelogi" value="<?php echo $value['metodelogi'];?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Tujuan</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tujuan" id="tujuan" value="<?php echo $value['tujuan'];?>">
						</div>
					</div>
				</div>
			</div>
            <div class="row-fluid">
            	<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Referensi</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="referensi" id="referensi" value="<?php echo $value['referensi'];?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Tanggal Pengajuan Judul</label>
						<div class="controls">
							<input type="text" readonly class="m-wrap span12" value="<?php
                            $x = explode("-",$value['tanggal_pengajuan']);
							echo $x[2]."-".$x[1]."-".$x[0];
							?>">
						</div>
					</div>
				</div>
			</div>
            <div class="row-fluid">
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label" for="tanggal_pengajuan">Dosen Pembimbing I</label>
                        <div class="controls ">
                        <select name="dosen_pembimbing1" class="m-wrap span12">
                        <option value="">-- Dosen Pembimbing I --</option>
                        <?php foreach($this->jenis_dosen as $jenis => $dosena){ ?>
                        <?php foreach($this->dosen_pembimbing as $dosen => $pembimbing){ ?>
                        <?php if($dosena['nip'] == $pembimbing['kode']){ ?>
                        <option value="<?php echo $pembimbing['kode'] ?>" <?php echo $pembimbing['kode']==$value['dosen_pembimbing1']?"selected":"";?>><?php echo $pembimbing['nama']; ?></option>
                        <?php }}} ?>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
		</form>
		<?php } ?>
		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formEKonf').submit();">Simpan</button>
</div>

<script type="text/javascript">
 /* jQuery(function() {
 	jQuery( "#tanggal_pengajuan" ).datepicker(option);
 });
 
  function showMhs(nim){
	jQuery.ajax({
		type:"post",
		data:{NIM:nim},
		async: false,
		url:'<?php echo URL;?>siak_pendaftaran_judul/siak_create_ajax',
		success:function(data){
			data = JSON.parse(data);				
			jQuery.each(data['nama'],function(k,v){
				jQuery('#NAMA').val(v.nama_depan+' '+v.nama_belakang);
			});
			jQuery.each(data['prodi'],function(k,v){
				jQuery('#PRODI_ID').val(v.prodi_id);
				jQuery('#PRODI').val(v.prodi);
			});
		},
	});
	return false;
 }; */
 </script>