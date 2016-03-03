			<div class="row">
				<div class="form-group col-md-4"><label for="jumlah_max" class="control-label">KAPASITAS</label></div>
				<div class="form-group col-md-8">
					<?php foreach($this->siak_data as $key => $val){ ?>
						<input type='text' name="jumlah_max" value='<?php echo $val['kapasitas'];?>' class="form-control">
					<?php } ?>
				</div>
			</div>