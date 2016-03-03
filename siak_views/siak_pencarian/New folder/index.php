<script>
	$(document).ready(function() {
		$('[data-toggle="form"]').click(function() {
			var url=$(this).attr('url');
			var jenis=$(this).attr('jenis');
			var pilihan=$('#pilihandata').val();
			$.ajax({
					 url: url,
					 type: "POST",
					 success: function(data) {
						$('#form_searching').html(data);
						$('#pilihandata').val(jenis);
						$('#content').html('');
						$('#alert_tentang').hide();
					}
				});
		});
		$('#search').click(function() {
			var tentang=$('#tentang').val();
			 if(tentang==''){
				$('#alert_tentang').show();
			}else{
			var form=jQuery("#form-search").serialize();
						$('#alert_tentang').hide();
			$.ajax({
					 url: "<?php echo URL;?>siak_pencarian/"+tentang,
					 data: form,
					 type: "POST",
					 success: function(data) {
						$('#content').html(data);
						
					}
				});
			}
		});
		
	});
	
</script>
<input id='pilihandata' type='hidden'>
<div class="portlet box blue" >
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Pencarian</div>
		<div class="actions">
									<div class="btn-group">
										
										<button class="btn dropdown-toggle" data-toggle="dropdown">PILIHAN DATA <i class="icon-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right">
							<li><a data-toggle='form' url="<?php echo URL;?>siak_pencarian/form_search/mahasiswa" jenis='filter_mahasiswa' >MAHASISWA</a></li>
							<li><a data-toggle='form' url="<?php echo URL;?>siak_pencarian/form_search/dosen" jenis='filter_dosen'  >DOSEN</a></li>
						</ul>
									</div>
								</div>
	</div>
	<div class="portlet-body">
			<div class="row-fluid">
									<div class="span8 booking-search">
										<form id='form-search'>
											<div id='form_searching'></div>
											
 										</form>
											<button id='search' class="btn blue btn-block">CARI<i class="m-icon-swapright m-icon-white"></i></button>
									</div>
									<!--end booking-search-->
									
		</div>
						
							<div id='content'></div>
		
		
	</div>
