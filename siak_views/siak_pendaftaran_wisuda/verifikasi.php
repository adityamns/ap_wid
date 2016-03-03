<div class="row-fluid">
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Verifikasi Kelengkapan Administrasi</div>
			</div>

			<div class="portlet-body">
				<form class="form-horizontal" id="formSyarat" action = "<?php echo URL;?>siak_pendaftaran_wisuda/verifikasi_insert" method = "post">
				<table id = "syarat" class="table table-bordered table-striped table-hover table-contextual">
					<thead>
						<tr align = "center">
							<td>
								<label for="nim" class="control-label">NIM</label>
							</td>
							<td colspan="4">
								<input type="text" class="form-control" name="nim" id="nim" placeholder="MASUKKAN NIM..." required>
							</td>
						</tr>
						<tr align = "center">
							<td>NO</td>
							<td>URAIAN</td>
							<td>TANGGAL</td>
							<td>KETERANGAN</td>
							<td>VERIFIKASI</td>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						foreach($this->syarat as $row => $rec){ ?>
							<tr align = "center">
								<td><?=$i?></td>
								<td><?=$rec['nama']?></td>
								<td>
									<input type="hidden" name="count[]" value="">
									<input type="hidden" name="id[]" value="<?=$rec['id']?>">
									<input type="text" name="tgl_kumpul[]" class="tgl_kumpul" required></td>
									<td><textarea name="keterangan[]"></textarea></td>
									<td>
										<input type="hidden" name="cek_syarat[]" value="false">
										<input type="checkbox" onclick="click_checkbox(this,4)" name="cek[]" class="cek" required>
									</td>
								</tr>
								<?php $i++;} ?>
							</tbody>
						</table>
						<div class="control-group">
							<label class="control-label">&nbsp</label>
							<div class="controls">
								<div>
									<div id="alert"></div>
									<input type = "submit" value = "SIMPAN" class = "btn blue " id="in"/>
									<input type = "reset" value = "ULANG" class = "btn "/>
								</div>
							</div>
						</div>
					</form>
			</div>
	</div>
</div>
<script type="text/javascript">

jQuery(document).on('keyup keypress', function(e) {
	if(e.which == 13) {
		e.preventDefault();
		return false;
	}
});

/* jQuery(function() {
	jQuery( ".tgl_kumpul").datepicker(option);
}); */

$('.tgl_kumpul').datepicker({
	dateFormat: 'dd-mm-yy',
	inline: true,
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0",
	onSelect: function(dateText, inst) { 
		  var day = $(this).datepicker('getDate').getDate();  
		  var month = $(this).datepicker('getDate').getMonth();  
		  var year = $(this).datepicker('getDate').getFullYear();  
					
		  /* var h = "<input type='hidden' name='tgl_kumpul' id='tgl_kumpul_send'>";
		  jQuery("#penwissel").append(jQuery(h)); */
		  $('#tgl_kumpul_send').val(year+"-"+(month+1)+"-"+day);
	}
});


function click_checkbox(tr, index)
{
	if(jQuery(tr).is(':checked'))
		{
			jQuery(tr).parents('tr').find('td:eq('+index+') input').val('true');
		}
		else
			{
				jQuery(tr).parents('tr').find('td:eq('+index+') input').val('false');
			}

			var chk = document.getElementsByName('cek_syarat[]');
			var len = chk.length;

			if (jQuery(".cek:checked").length < len){
				document.getElementById('alert').innerHTML = "<div class='alert alert-danger'>Mohon untuk melengkapi Semua Persyaratan.</div>";
				jQuery("#in").css('display','none');
				jQuery(":submit").removeAttr("disabled");
			}else{
				document.getElementById('alert').innerHTML = "";
				jQuery("#in").css('display','inline-block');
				jQuery(":submit").attr("disabled");
			}

		}

		jQuery("#formSyarat").validate();
		</script>
