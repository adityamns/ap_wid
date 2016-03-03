<!-- <div class="row-fluid"> -->
	<!--<div class="span6">
		<div class="control-group">-->
			<label class="control-label" for="firstName">Kapasitas</label>
			<div class="controls chzn-controls">
				<?php foreach($this->siak_data as $key => $val){ ?>
					<input type='text' name="jumlah_max" id="jumlah_max" value='<?php echo $val['kapasitas'];?>' class="m-wrap span12" readonly>
				<?php } ?>
			</div>
		<!--</div>
	</div>-->
<!-- </div> -->