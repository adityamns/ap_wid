
<script>
jQuery(document).ready(function() {
	jQuery('#tahun1').change(function() {
		var tahun=jQuery('#tahun1').val();
		//var bulan=jQuery('#bln').val();
		//location.reload();
			window.location = "<?php echo URL; ?>siak_grafik_alumni?tahun1="+tahun;
        });
        });
$(document).ready(function() {
	$('#jadwal').DataTable();
    $('#example').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo URL; ?>server_processing.php"
    } );
});
$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			
			
			editable: false,
			events: '<?php echo URL; ?>siak_kalender/load_event/2/NONSPS',
			/*RENDER WARNA EVENT*/
			eventRender: function(event, element) {   
                    element.css('background-color', event.warna);
            }
		});
		
	});



</script>
<script type="text/javascript">
				jQuery(function () {
						jQuery('#container2').highcharts({
             chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Alumni Berdasarkan Prodi <?php echo $this->jtahun; ?>'
            },
            subtitle: {
                text: 'Sumber: Akademik Unhan'
            },
            xAxis: {
                categories: [
                   <?php  foreach ($this->siak_prodi as $key => $value) {
					echo "'".$value['prodi_id']."',";
		
						
	
					} ?>
				   
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah'
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
			<?php foreach ($this->siak_prodi as $key => $value) { ?>
			{
                name: '<?php echo $value['prodi_id']; ?>',
                data: [<?php echo $value['jumlah']; ?>]
    
            },
			<?php } ?>
			]
        });
    });

		</script>


	
					<div class="span6">
					<div class="portlet solid bordered light-grey">
						<div class="portlet-title">
							<div class="caption"><i class="icon-bar-chart"></i>Grafik Alumni</div>
						</div>
								<select name="jenis_ruang" class="form-control" id='tahun1'>
									<option value='Pilih'>Pilih</option>
										<?php foreach ($this->siak_tahun as $key => $value) { ?>
											<option value='<?php echo $value['tahun_masuk']; ?>'><?php echo $value['tahun_masuk']; ?></option>	
										<?php } ?>
								</select>
							<!-- BEGIN PORTLET-->
								<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
							<!-- END PORTLET-->
					</div>	
	</div>				
	
	
</div>				
