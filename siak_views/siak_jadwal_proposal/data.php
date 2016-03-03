<?php /* echo '<pre>'; print_r($this->siak_data);echo '</pre>';die(); */
foreach ($this->siak_data as $key => $value) { ?>
		
 			<div class="row-fluid">
 				<div class="span6 ">
						<div class="control-group">
							<CENTER><label class="control-label" for="firstName">PROGRAM STUDI</label>
								<div class="controls">
									<input type="hidden" readonly class="m-wrap span12" id="PRODI_ID" value='<?php echo $value['kode_topik'];?>'/>
									<input type="text" readonly class="form-control" value='<?php echo $value['prodi'];?>' id="PRODI" />
								</div>
						</div>
				</div>
			</div>
			<div class="row-fluid">
 				<div class="span6 ">
						<div class="control-group">
							<CENTER><label class="control-label" for="firstName">JUDUL PROPOSAL</label>
								<div class="controls">
									<input type="text" readonly class="m-wrap span12" id="judul"   value='<?php echo $value['judul'];?>'/></div>
									<input type="hidden" value='<?php echo $value['judul_id'];?>' name="judultesis_id" id="judul_id" />
							</div>
						</div>
					</div>
				<?php foreach ($this->siak_dosen as $nilai => $val) { 
					if($val['nip']==$value['dosen_pembimbing1']){
				?>
				
					<div class="row">
 				<div class="form-group col-md-4"><label for="nama" class="control-label">Pembimbing 1</label></div>
 				<div class="form-group col-md-8"><input type="text" readonly class="form-control" id="judul"   value='<?php echo $val['nama'];?>'/></div>
				<?php	}
					elseif($val['nip']==$value['dosen_pembimbing2']){
				?>
 			</div>
					<div class="row">
 				<div class="form-group col-md-4"><label for="nama" class="control-label">Pembimbing 2</label></div>
 				<div class="form-group col-md-8"><input type="text" readonly class="form-control" id="judul"   value='<?php echo $val['nama'];?>'/></div>
				
 			</div>
					 
<?php }}} ?>


			