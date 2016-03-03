<?php 


	/**	DATA MAHASISWA AKTIF default **/
	$data=array();
	$series=array();
	$xAxix=array();
	foreach ($this->siak_data as $key => $value) {
		$data['name']=$value['fakultas'];
		$data['data']=$value['jumlah'];
			if($value['fakultas_kd']=='S'){
				$data['color']='red';
			}
			elseif($value['fakultas_kd']=='M'){
				$data['color']='blue';
			}
			elseif($value['fakultas_kd']=='K'){
				$data['color']='green';
			}
		$xAxix=$value['fakultas'];
		array_push($series,$data);
			
	}
	

		$json = json_encode($series);
		$json = str_replace('"'.$value['jumlah'].'"','['.$value['jumlah'].']',$json);
		
		
		
			
?>

<script>
jQuery(document).ready(function() {
	jQuery('#tahun1').change(function() {
		var tahun=jQuery('#tahun1').val();
		//var bulan=jQuery('#bln').val();
		//location.reload();
			window.location = "<?php echo URL; ?>siak_dashboard?tahun1="+tahun;
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
                text: 'Grafik Mahasiswa Aktif Berdasarkan Prodi <?php echo $this->jtahun; ?>'
            },
            subtitle: {
                text: 'Sumber: Akademik Widyatama'
            },
            xAxis: {
                categories: ['Progam Studi']
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
<?php 
function hari($b){
		
					if($b==1)
					{$hari="SENIN";}
					elseif($b==2)
					{$hari="SELASA";}
					elseif($b==3)
					{$hari="RABU";}
					elseif($b==4)
					{$hari="KAMIS";}
					elseif($b==5)
					{$hari="JUMAT";}
					elseif($b==6)
					{$hari="SABTU";}
					elseif($b==7)
					{$hari="MINGGU";}
				return $hari;
		}
 ?>
<div class="row-fluid">
<!--div class='span6'>
					<div class="portlet box blue calendar">
						<div class="portlet-title">
							<div class="caption"><i class="icon-reorder"></i>KALENDER UNIVERSITAS NON-SPS</div>
						</div>
						<div class="portlet-body light-grey">
							<div class="row-fluid">
								<div class="span12">
									<div id="calendar" ></div>
								</div>
							</div>
							<!-- END CALENDAR PORTLET>
						</div>
					</div>
	</div-->		
	
	<!--div class="span6">
		<div class="portlet solid bordered light-grey">
			<div class="portlet-title">
				<div class="caption"><i class="icon-bar-chart"></i>Grafik</div>
			</div>
					<select name="jenis_ruang" class="form-control" id='tahun1'>
						<option value='Pilih'>Pilih</option>
							<?php foreach ($this->siak_tahun as $key => $value) { ?>
								<option value='<?php echo $value['tahun_masuk']; ?>'><?php echo $value['tahun_masuk']; ?></option>	
							<?php } ?>
					</select>
				
					<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
				
		</div>	
	</div-->				
	
	
</div>				
