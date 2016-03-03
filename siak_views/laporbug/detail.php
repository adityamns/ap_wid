<style>
.zoomContainer{ z-index: 9999;}
.zoomWindow{ z-index: 9999;}
</style>
<div class="modal-body" id="detailBugs">
	<div class="portlet-body form">
	<?php foreach($this->data as $row => $key){ ?>
		<div class="row-fluid">
			<div class="span12 ">
				<div class="control-group">
					<label class="control-label" for="masalah">Judul</label>
					<div class="controls">
						<input type="text" class="span12 m-wrap" name="judul" value="<?=$key['judul']?>">
					</div>
				</div>
			</div>
			<!--/span-->
		</div>
		<div class="row-fluid">
			<div class="span12 ">
				<div class="control-group">
					<label class="control-label" for="masalah">URL</label>
					<div class="controls">
						<input type="text" class="span12 m-wrap" value="<?=$key['url']?>">
					</div>
				</div>
			</div>
			<!--/span-->
		</div>
		<div class="row-fluid">
			<div class="span12 ">
				<div class="control-group">
					<label class="control-label" for="masalah">Masalah</label>
					<div class="controls">
						<textarea name="masalah" class="span12 m-wrap" disabled rows="6"><?=$key['masalah']?></textarea>
					</div>
				</div>
			</div>
			<!--/span-->
		</div>
		<?php 
		if($key['foto'] != NULL || $key['foto'] == TRUE){
		?>
		<div class="row-fluid">
		<div class="item">
			<a class="fancybox-button" data-rel="fancybox-button" title="Photo" href="<?php echo URL;?>siak_public/siak_images/laporbug/<?php echo $key['foto'];?>">
				<div class="zoom">
					<img style="width: 200px; height: 150px;" src="<?php echo URL;?>siak_public/siak_images/laporbug/<?php echo $key['foto'];?>" alt="Photo" />                    
					<div class="zoom-icon"></div>
				</div>
			</a>
		</div>
		</div>
		<?php } ?>
		<br>
		<table id="univ" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
				<tr align = "center">
					<td>Pengirim</td>
					<td>IP Address</td>
					<td>Menggunakan</td>
					<td>Dibuat Pada</td>
				</tr>
			</thead>
			<?php
			$detail = json_decode($key['detail_user']);
			?>
			<tbody>
				<tr align = "center">
					<td><?php echo $detail->user;?></td>
					<td><?php echo $detail->from_ip;?></td>
					<td><?php echo $detail->using_browser;?></td>
					<td><?php echo $detail->created_at;?></td>
				</tr>
			</tbody>
		</table>
	<?php } ?>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Tutup</button>
</div>
<script>
$(document).ready(function(){
	$("#detailBugs input").prop("disabled", true);
})
</script>