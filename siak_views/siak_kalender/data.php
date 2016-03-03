<?php //if ($this->reades == "t") { ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Kalender Akademik Universitas</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body">
		<br>
		
		<div class="row-fluid">
            
	<?php //if ($this->creates == "t") { ?>
		<div class="input-group">
			<a data-toggle='modal' class='btn blue icn-only' link="<?php echo URL; ?>siak_kalender/create/" href='#formADD' onclick='add(this)' > Tambah</a>
		</div>
		<hr>
	<?php //} ?>
		<table id = "LIST_KALENDER" class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
		<tr align = "center">
			<td>NO</td>
			<td>TAHUN AKADEMIK</td>
			<td>JENIS</td>
			<td>ACTION</td>
		</tr>
		</thead>
		<tbody>
		<?php
			$i = 0;
			foreach ($this->siak_data as $key => $value) {

				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				echo "<td align = 'center'><b>" . $value['nama_tahun'] . "</td>";
				echo "<td align = 'center'><b>" . $value['jenis'] . "</td><td align = 'center'>";
				echo //$this->updates=="t"?
				"<a  href = '".URL."siak_kalender/index/".$value['tahun_id']."/".$value['jenis']."/".$value['tahun']."' class='btn red mini'>Ubah</a>"
				//:""
				;
				echo //$this->deletes=="t"?
				"&nbsp <a href = '".URL."siak_kalender/siak_delete/".$value['id']."' class='btn yellow mini'>Hapus</a>"
				//:""
				;
			echo "</td></tr>";
		}
		?>
		</tbody>
	</table>
	
<?php //}else{ ?>
<!--<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>-->
<?php //} ?>
</div></div>
<div id="formADD" class="modal  hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>FORM KALENDER</h3>
	</div>
	<div id="add"></div>
</div>

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<script>
jQuery(document).ready(function() {
	$('#LIST_KALENDER').DataTable();
	
	$(document).ajaxStart(function(){
	  $("#wait").css("display","block");
	});

	$(document).ajaxComplete(function(){
	  $("#wait").css("display","none");
	});
	
	jQuery.ajax({
            url: '<?php echo URL; ?>siak_kalender/getTahun_akademik',
            dataType: "json",
            success: function (list) {
                for (var i = 0; i < list.length; i++) {
				jQuery("#tahun_ak").append("<option value='" + list[i].tahun + "'>" + list[i].nama_tahun + "</option>");	
                }
                 
				
			}
		});
		
});
	function onchange_tahun() {
		var tahun_ak=jQuery('#tahun_ak').val();
		jQuery.ajax({
				url: '<?php echo URL; ?>siak_kalender/getTahun_ID/'+tahun_ak,
				dataType: "html",
				success: function (data) {
					jQuery('#tahun_id').val(data);
						
					}
			});
	}
	function onchange_jenis() {
		var jenis=jQuery('#jenis').val();
		var id=jQuery('#tahun_id').val();
		jQuery.ajax({
				url: '<?php echo URL; ?>siak_kalender/cek_kalender/'+id+'/'+jenis,
				dataType: "html",
				success: function (data) {
						if(data=='KOSONG'){
							jQuery("#konfim").html('<div style="color:green" class="alert alert-success" role="alert"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only"><b>Kalender:</b> </span>Belum Tersedia</div>');
						}
						else{
							jQuery("#konfim").html('<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Kalender:</span>Sudah Tersedia</div>');
						}
						
					}
			});
	}
		
</script>
