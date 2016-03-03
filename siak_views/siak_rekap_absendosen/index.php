<script>
	jQuery(document).ready(function() {
		jQuery.ajax({
			url: '<?php echo URL; ?>siak_rekap_absendosen/load_dosen',
			dataType: "json",
			success: function (list) {
				for (var i = 0; i < list.length; i++) {

					jQuery("#dosen").append("<option value='" + list[i].nip + "'>" + list[i].nama + "</option>");					
				}
			}
		});
	});
</script>
<?php
if ($this->rolePage['loads'] == "t") {
?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>REKAP ABSEN DOSEN</div>
	</div>
		<div class="portlet-body">
        <?php
		if ($this->rolePage['reades'] == "t") {
		?>
			<!--<div class="span12 booking-search">-->
				<div class="row-fluid">
					<div class='span4'>
                        <select id="dosen" name="dosen" class="m-wrap span12" link="<?php echo URL; ?>siak_rekap_absendosen/matkul" onchange='getKurikulum(this)'>
                            <option value="">- DOSEN -</option>
                        </select>
                    </div>
                    <div class='span4'>
                        <div id="statediv">
                            <select id="matkul" align='center' name="matkul" class="m-wrap span12" onchange="">
                                <option value="" >- MATA KULIAH -</option>
                            </select>
                        </div>
                    </div>
				</div>
			<!--</div>-->
            <?php
			}
			?>
		</div>
	</div>
    <?php
	}else{
	?>
	<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
	<?php
	}
	?>
				<div id='datarekap'>
				</div>
	
<script type="text/javascript">
	function getRekap(value) {
		var strURL = jQuery(value).attr('link');
		var dosen = document.getElementById('dosen').value;
		var matkul = document.getElementById('matkul').value;
		
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					if (req.status == 200) {
						document.getElementById('datarekap').innerHTML=req.responseText;
						fancy();
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}       
			}     
			req.open("GET", strURL + "/" + dosen + "/" + matkul, true);
			req.send(null);
		}
	}
</script>