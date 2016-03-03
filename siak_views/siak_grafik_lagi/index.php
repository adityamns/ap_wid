<div class="portlet solid bordered light-grey">
	<div class="portlet-title">
		<div class="caption"><i class="icon-bar-chart"></i>Grafik</div>
	</div>
	<select name="jenis_ruang" class="form-control" id='tahun1'>
		<option value='Pilih'>Pilih</option>
		<?php
		$date = date('Y');
		for($a=2009;$a<=$date;$a++){
		?>
        <option value='<?php echo $a; ?>'><?php echo $a; ?></option>
        <?php
		}
		?>
	</select>
	<!-- BEGIN PORTLET-->
	<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<!-- END PORTLET-->
</div>
<script>
jQuery(document).ready(function() {
	jQuery('#tahun1').change(function() {
		var tahun=jQuery('#tahun1').val();
		//var bulan=jQuery('#bln').val();
		//location.reload();
		window.location = "<?php echo URL; ?>siak_grafik_lagi?tahun1="+tahun;
    });
});
</script>
<script type="text/javascript">
$(function () {
        $('#container2').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah Mahasiswa Lulus PMB, Aktif, dan Alumni di Tahun Masuk <?php echo $this->tahun ?>'
            },
            subtitle: {
                text: 'Sumber: Akademik Unhan'
            },
            xAxis: {
                categories: [
                <?php  foreach($this->prodi as $pro => $di){
				echo "'".$di['prodi_id']."',"; ?>
				<?php }  ?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah (orang)'
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
            series: [{
                name: 'Lulus',
                data: [<?php echo $this->pmb; ?>]
    
            }, {
                name: 'Alumni',
                data: [<?php echo $this->alumni; ?>]
    
            }, {
                name: 'Aktif',
                data: [<?php echo $this->aktif; ?>]
    
            }]
        });
    });
    

		</script>