<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-globe"></i>Pendaftaran Sidang Tesis</div>
	</div>
	<div class="portlet-body" >
    	<div class="container-fluid">
			<!-- <form class="form-horizontal" method = "post" action="<?php echo URL;?>siak_pendaftaran_sidang/siak_ok"> -->
			<div class="row-fluid">
                <div class="span6">
					<div class="form-group col-md-3"><label for="nim" class="control-label">Masukan NIM</label></div>
					<div class="form-group col-md-3"><input type="text" class="form-control" name="nim" id="nim" placeholder="Nim..." link="<?php echo URL;?>siak_pendaftaran_sidang_tesis/siak_cek" onchange="getKurikulum(this)"></div>
				</div>
            </div>
			<div id="statediv">
			</div>
			<!-- </form> -->
		</div>
	</div>
</div>
