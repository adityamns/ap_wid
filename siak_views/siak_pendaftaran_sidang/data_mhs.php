<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-globe"></i>Pendaftaran Sidang Proposal Tesis</div>
	</div>
	<div class="portlet-body" >
		<div class="container-fluid">
			<!-- <form class="form-horizontal" method = "post" action="<?php echo URL;?>siak_pendaftaran_sidang/siak_ok"> -->
			<?php foreach (Siak_session::siak_get('profil') as $v=>$row){ ?>
				<div class="row-fluid">
					<div class="span6">
						<div class="form-group col-md-3"><label for="nim" class="control-label">NIM Anda</label></div>
						<div class="form-group col-md-3"><input type="text" class="form-control" name="nim" value='<?php echo $row['nim']; ?>' id="nim" placeholder="Nim..." readonly ></div>
						<div class="form-group col-md-3">
								<input type = "button" value = "CEK" link="<?php echo URL;?>siak_pendaftaran_sidang/siak_cek" onclick="getKurikulum(this)" class = "btn green "/>
								<!-- <input type = "button" value = "BATAL" class = "btn btn-medium btn-warning "/> -->
						</div>
					</div>
				</div>
			<?php } ?>
            <label class="control-label">&nbsp;</label>
			<div id="statediv">
			</div>
			<!-- </form> -->
		</div>
	</div>
</div>
<script>
function getKurikulum(value) {
				var strURL = jQuery(value).attr('link');
				var nim = jQuery('#nim').val();
				
				var req = getXMLHTTP();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							if (req.status == 200) {
								document.getElementById('statediv').innerHTML=req.responseText;            
							} else {
								alert("There was a problem while using XMLHTTP:\n" + req.statusText);
							}
						}       
					}     
					req.open("GET", strURL+ "/" + nim, true);
					req.send(null);
				}
			}
</script>