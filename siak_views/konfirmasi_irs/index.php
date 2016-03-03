<?php 
// echo "<pre>";
// var_dump($this->data);
// echo "</pre>";
?>
<div class="row-fluid">
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Konfirmasi Isian Rencana Studi</div>
			</div>
			<div class="portlet-body">
			<form class="horixontal-form" name="cari" method="post" action="">
				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="bahasa">NIM</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" name="nim">
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="bahasa">Cari</label>
							<div class="controls">
								<input type="submit" class="btn blue" value="Cari">
							</div>
						</div>
					</div>
				</div>
			</form>
			<table id="notifikasi" class="table table-striped table-bordered table-hover table-full-width">
				<thead>
					<tr>
						<th>NIM</th>
						<th>SEMESTER</th>
						<th>ACTION</th>
					</tr>
				</thead> 
				<tbody>
				<?php
				$i=0;foreach($this->data as $row => $val){$i++;
				?>
					<tr>
						<td><input type="hidden" class="nim<?php echo $i; ?>" value="<?=$val['nim']?>"><?=$val['nim']?></td>
						<td><input type="hidden" class="smstr<?php echo $i; ?>" value="<?=$val['semester']?>"><?=$val['semester']?></td>
						<td><input type="hidden" class="prodi<?php echo $i; ?>" value="<?=$val['prodi_id']?>">
						<?php
						if($val['edit_id'] == '1'){
						?>
						<button class="btn red mini" id="update<?php echo $i; ?>" link="<?=URL?>siak_rencana_studi/konfirmasi_irs" onclick="update('<?php echo $i; ?>')"><i class="icon-ok"></i> Sahkan</button>
						<?php
						}else{
						?>
						<a class="btn green mini disabled" ><i class="icon-ok"></i>Sudah DiSahkan</a>
						<?php } ?>
						</td>
					</tr>
				<?php 
				}
				?>
				</tbody>
			</table>
		
			</div>
		</div>
	</div>
</div>

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<script>
$(document).ready(function(){
	$('#notifikasi').DataTable();
	
	$(document).ajaxStart(function(){
	  $("#wait").css("display","block");
	});

	$(document).ajaxComplete(function(){
	  $("#wait").css("display","none");
	});
	
});

function update(id){
	var url = $('#update'+id).attr('link');
	var nim = $('.nim'+id);
	var prodi = $('.prodi'+id);
	var smstr = $('.smstr'+id);
	var id = $('#update'+id);
	
	$.ajax({
	    url: url,
	    type:'post',
	    data:{nim:nim.val(), prodi:prodi.val(), smstr:smstr.val()},
	    success: function(data) {
			id.removeAttr("link");
			id.removeAttr("onclick");
			id.removeClass('btn green mini').addClass('btn red mini disabled');
			id.html('<i class="icon-ok"></i>Sudah DiSahkan');
	    }
	});
}
</script>