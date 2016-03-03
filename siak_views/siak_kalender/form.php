				<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h3><?php echo $this->judul; ?></h3>
				</div>
				<div class="modal-body">
						
								<fieldset>
										<label for="name">KEGIATAN</label>
										<div class="controls">
											<select class="m-wrap span12" name = "jk_mahasiswa" id="title">
												<option value = "">Pilih</option>
													<?php foreach ($this->siak_data as $kunci => $nilai) { ?>		
														<option value= "<?php echo $nilai['id'];?>" <?php if($this->id == $nilai['id']){ echo 'selected = "selected"'; }?>><?php echo $nilai['event'];?></option>	
													<?php } ?>
											</select>
										</div>		
								</fieldset>
								
						
					</div>
				<?php if($this->jenis=='add'){ ?>
						<div class="modal-footer">
							<button type="button" data-dismiss="modal" class="btn">Close</button>
							<button type="button" onclick='simpan()' id="save" class="btn green">SIMPAN</button>
						</div>
				<?php }else{ ?>
						<div class="modal-footer">
							<button type="button" data-dismiss="modal" class="btn">Close</button>
							<button type="button" onclick='hapus()' id="save" class="btn red">DELETE</button>
							<button type="button" onclick='update_event()' id="save" class="btn green">SIMPAN</button>
						</div>
				<?php } ?>