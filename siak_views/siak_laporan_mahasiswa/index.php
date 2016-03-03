<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Rekap Mahasiswa</div>
			</div>
			<div class="portlet-body">
				<div class="row-fluid">
					<div class='span4'>
					<select id="status" link="<?php echo URL;?>siak_laporan_mahasiswa/siak_datalist" class="m-wrap span12" onchange="getBobot(this)">
						<option value="0">- Status -</option>
                        <option value="1">Aktif</option>
                        <option value="2">Tidak Aktif</option>
					</select>
				</div>
                <div id="bobotnilai"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function getBobot(value) {
		var strURL = jQuery(value).attr('link');
		var status = document.getElementById('status').value;

		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					if (req.status == 200) {
						document.getElementById('bobotnilai').innerHTML=req.responseText;
						fancy();
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}       
			}     
			req.open("GET", strURL + "/" + status, true);
			req.send(null);
		}
	}
</script>