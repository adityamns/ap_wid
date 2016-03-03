		<div class="portlet solid bordered light-grey">
			<div class="portlet-title">
				<div class="caption"><i class="icon-bar-chart"></i>Grafik</div>
			</div>
			<!--<select name="jenis_ruang" class="form-control" id='tahun1'>
				<option value='Pilih'>Pilih</option>
				<?php foreach ($this->siak_tahun as $key => $value) { ?>
				<option value='<?php echo $value['tahun_masuk']; ?>'><?php echo $value['tahun_masuk']; ?></option>	
				<?php } ?>
			</select>-->
            <select id="prodi_id" name="prodi_id" class="form-control">
            	<option value="Pilih">- Prodi -</option>
                <?php foreach($this->prodi as $pro => $di){ ?>
                <?php if($_GET['prodi']){ ?>
                <?php $decode_prodi = base64_decode($_GET['prodi']); ?>
                <option value="<?php echo base64_encode($di['prodi_id']); ?>" <?php echo $decode_prodi == $di['prodi_id']?'selected':''; ?>><?php echo $di['prodi']; ?></option>
                <?php }else{ ?>
                <option value="<?php echo base64_encode($di['prodi_id']); ?>"><?php echo $di['prodi']; ?></option>
                <?php } ?>
                <?php } ?>
            </select>
            
            <?php if($_GET['prodi']){ ?>
            <input type="hidden" id="prodi_hidden" value="<?php echo $_GET['prodi']; ?>">
            <?php } ?>
            
            <?php if($_GET['prodi']){ ?>
			<select id="matkul_id" name="matkul_id" class="form-control" link="<?php echo URL;?>siak_grafik/getbobot">
				<option value="0">- Matakuliah -</option>
                <?php if($this->matkul != NULL){
                foreach($this->matkul as $pro => $di){
				if($_GET['matkul']){ ?>
                <?php $decode_matkul = base64_decode($_GET['matkul']); ?>
                <option value="<?php echo base64_encode($di['kode_matkul']); ?>" <?php echo $decode_matkul == $di['kode_matkul']?'selected':''; ?>><?php echo $di['nama_matkul']; ?></option>
                <?php }else{ ?>
                <option value="<?php echo base64_encode($di['kode_matkul']); ?>"><?php echo $di['nama_matkul']; ?></option>
                <?php }
					}
				} ?>
			</select>
            <?php } ?>
			<!-- BEGIN PORTLET-->
			<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
			<!-- END PORTLET-->
		</div>
<?php if($_GET['prodi'] and $_GET['matkul']){ ?>
<script type="text/javascript">
jQuery(function () {
	jQuery('#container2').highcharts({
    	chart: {
        	type: 'column'
        },
        title: {
        	text: 'Grafik Mahasiswa Aktif Berdasarkan Prodi <?php echo $this->prodi_akhir; ?> dan Matakuliah <?php echo $this->matkul_akhir; ?>'
			//text: 'Grafik Mahasiswa Aktif Berdasarkan Prodi <?php echo $this->jtahun ?>'
        },
        subtitle: {
        	text: 'Sumber: Akademik Unhan'
        },
        xAxis: {
        	categories: [
            <?php  foreach ($this->data_akhir as $da => $ta) {
				echo "'".$ta['grade']."',";
			}  ?>
			<?php /* foreach ($this->siak_prodi as $key => $value) {
				echo "'".$value['prodi_id']."',";
			} */ ?>
            ]
        },
        yAxis: {
        	min: 0,
            title: {
            	text: 'Jumlah (orang)',
            }
        },
        tooltip: {
        	headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} orang</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
        	column: {
            pointPadding: 0.2,
            borderWidth: 0
        	}
        },
        series: [
		<?php  foreach ($this->data_akhir as $da => $ta) { ?>
			{
				name: '<?php echo $ta['grade']; ?>',
                data: [<?php echo $ta['jumlah']; ?>]
    
            },
		<?php }  ?>
		<?php /* foreach ($this->siak_prodi as $key => $value) { ?>
			{
                name: '<?php echo $value['prodi_id']; ?>',
                data: [<?php echo $value['jumlah']; ?>]
    
            },
		<?php } */ ?>
		]
    });
});
</script>
<?php } ?>
<script>
jQuery(document).ready(function() {
	jQuery('#prodi_id').change(function() {
		var prodi=jQuery('#prodi_id').val();
		window.location = "<?php echo URL; ?>siak_grafik?prodi="+prodi;
    });
});
jQuery(document).ready(function() {
	jQuery('#matkul_id').change(function() {
		var matkul=jQuery('#matkul_id').val();
		var prodi=jQuery('#prodi_hidden').val();
		window.location = "<?php echo URL; ?>siak_grafik?prodi="+prodi+"&&matkul="+matkul;
		//window.location = "<?php echo URL; ?>siak_grafik?matkul="+matkul;
    });
});
//jQuery(document).ready(function() {
	//jQuery('#matkul_id').change(function() {
	//jQuery('#tahun1').change(function() {
		//var prodi=jQuery('#prodi_id').val();
		//var matkul=jQuery('#matkul_id').val();
		//var tahun=jQuery('#tahun1').val();
		//var bulan=jQuery('#bln').val();
		//location.reload();
		//window.location = "<?php echo URL; ?>siak_grafik?prodi="+prodi+"&&matkul="+matkul;
		//window.location = "<?php echo URL; ?>siak_grafik?tahun1="+tahun;
   // });
//});
</script>
<!--<script type="text/javascript">
function getBobot(value) {
	var strURL = jQuery(value).attr('link');
	var prodi = document.getElementById('prodi_id').value;
	var matkul = document.getElementById('matkul_id').value;

	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('container2').innerHTML=req.responseText;
					fancy();
				} else {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}       
		}     
		req.open("GET", strURL + "/" + prodi + "/" + matkul, true);
		req.send(null);
	}
}
</script>-->