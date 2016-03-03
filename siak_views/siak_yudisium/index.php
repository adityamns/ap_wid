<script>
	jQuery(document).ready(function() {	
		jQuery.ajax({
			url: '<?php echo URL; ?>siak_jadwal/load_prodi',
			dataType: "json",
			success: function (list) {
				for (var i = 0; i < list.length; i++) {

					jQuery("#prodi").append("<option value='" + list[i].prodi_id + "'>" + list[i].prodi + "</option>");					
				}
			}
		});
	});
</script>
<div class="portlet box blue" >
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Generate Transkrip</div>
	</div>
	<div class="portlet-body">
				<div class="row-fluid">
			<form class="form-horizontal" method = "post" action="<?php echo URL;?>siak_yudisium">
				
					<div class="span3" >
					<select class="m-wrap span12" id="tahunid" name="tahun">
						<option value="">-- TAHUN ANGKATAN --</option>
		                <?php for ($i=2009; $i <= date('Y'); $i++) { ?>
		                <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
		                <?php } ?>
					</select>
					</div>
					<div class="span4"><select link="<?php echo URL;?>siak_yudisium/Data_IPK"  onchange='getBobot(this)' id="prodi" name="prodi" class="m-wrap span12"><option value="">- PRODI -</option></select></div>
					
				</div>
			</form>
				<div id='bobotnilai'>
				</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	jQuery(document).ready(function(){
				
	});
	// function hasil(id){
		
	// }
	function getBobot(value) {
		var strURL = jQuery(value).attr('link');
		var prodi = document.getElementById('prodi').value;
		var tahunid = document.getElementById('tahunid').value;
		
		;

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
			req.open("GET", strURL+ "/" + prodi + "/" + tahunid, true);
			req.send(null);
		}
	}
</script>