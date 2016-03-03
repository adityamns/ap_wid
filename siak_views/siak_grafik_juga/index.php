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
		window.location = "<?php echo URL; ?>siak_grafik_juga?tahun1="+tahun;
    });
});
</script>
<script type="text/javascript">
$(function () {
	$('#container2').highcharts({
    	chart: {
        	zoomType: 'xy'
        },
        title: {
        	text: 'Jumlah Mahasiswa Aktif dan Alumni <?php echo $this->tahun ?>'
        },
        subtitle: {
        	text: 'Sumber: Akademik Unhan'
        },
        xAxis: [{
        	//categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
			categories: [
			<?php  foreach($this->prodi as $pro => $di){
			echo "'".$di['prodi_id']."',"; ?>
			<?php }  ?>
			]
        }],
        yAxis: [{ // Primary yAxis
        	labels: {
            	format: '{value} orang',
                style: {
                	color: Highcharts.getOptions().colors[1]
                }
            },
            title: {
            	// text: 'Alumni', DIKOSONGIN
				text: '',
                style: {
                	color: Highcharts.getOptions().colors[1]
                }
            }
        },{ // Secondary yAxis
        	title: {
            	// text: 'Mahasiswa Aktif', DIKOSONGIN
				text: '',
                style: {
                	color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
            	format: '{value} orang',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            opposite: true
        }],
        tooltip: {
            shared: true
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            x: 0,
            verticalAlign: 'top',
            y: 0,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        series: [{
            name: 'Mahasiswa Aktif',
            type: 'column',
			yAxis: 1,
            //data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6],
			data: [<?php echo $this->aktif ?>],
            tooltip: {
                valueSuffix: ' orang'
            }
    
        },{
            name: 'Alumni',
            type: 'spline',
			// TAMBAHIN
			yAxis: 1,
            //data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9],
			data: [<?php echo $this->alumni ?>],
            tooltip: {
                valueSuffix: ' orang'
            }
        }]
    });
});
    

		</script>