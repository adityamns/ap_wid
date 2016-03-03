<?php 
// echo "<pre>";
// var_dump($this->data);
// echo "</pre>";
$prodiKap = $this->user;
?>

<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Isian Rencana Studi</div>
			</div>
			<div class="portlet-body">
			<form class="horizontal-form" method = "post" id="irsForm">
				<div class="row-fluid">
					<div class="span3">
						<div class="control-group">
							<label class="control-label" for="lastName">Nim</label>
							<div class="controls">
								<?php echo $mhs = (Siak_session::siak_get('level') != 16) ? 
								'<input type="text" class="m-wrap span12" name="nim" id="nim" placeholder="Nim...">':
								'<input type="text" class="m-wrap span12" name="nim" id="nim" value="'.Siak_session::siak_get('username').'" readonly>';
								?>
							</div>
						</div>
					</div>
					<div class="span3">
						<div class="control-group">
							<label class="control-label" for="lastName">Prodi</label>
							<div class="controls">
								<select class="m-wrap span12" name="prodi" id="prodi">
									<option value="">--Pilih Prodi--</option>
								<?php 
								foreach($this->prodi as $prodi_key => $prodi){
								$select = ($prodiKap == $prodi['prodi_id'])?"selected":"";
								?>
									<option value="<?=$prodi['prodi_id']?>" class="prodi_sel" <?=$select?>><?=$prodi['prodi']?></option>
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="span3">
						<div class="control-group">
							<label class="control-label" for="lastName">Tahun Akademik</label>
							<div class="controls">
								<select class="m-wrap span12" name="tahun_akademik" id="thn_ak">
									<?php 
// 									foreach($this->siak_tahun_akademik as $key => $value) {
// 										echo "<option value='$value[tahun_id]'>$value[nama_tahun]</option>";
// 									}
										echo "<option value='2012'>2012/2013</option>";
										echo "<option value='2013'>2013/2014</option>";
										echo "<option value='2014'>2014/2015</option>";
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="span3">
						<div class="control-group">
							<label class="control-label" for="lastName">Semester</label>
							<div class="controls">
								<select id="semester" name="semester" class="m-wrap span12">
									<option value="0">- Semester -</option>
									<!-- <option value="0">Semua</option> -->
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="perp1">Perpanjangan 1</option>
									<option value="perp2">Perpanjangan 2</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</form>
			
			<table id="notifikasi" class="table table-striped table-bordered table-hover table-full-width">
				<thead>
					<tr>
						<th>NIM</th>
						<th>SEMESTER</th>
						<th>ACTION</th>
					</tr>
				</thead> 
				<tbody>
				<?php
				$i=0;foreach($this->data as $row => $val){$i++;
				?>
					<tr>
						<td><input type="hidden" class="nim<?php echo $i; ?>" value="<?=$val['nim']?>"><?=$val['nim']?></td>
						<td><input type="hidden" class="smstr<?php echo $i; ?>" value="<?=$val['semester']?>"><?=$val['semester']?></td>
						<td>
						<input type="hidden" class="prodi<?php echo $i; ?>" value="<?=$val['prodi_id']?>">
						
						<input type="checkbox" class="cek" value="<?=$val['nim']?>" name="cek[]">
						</td>
					</tr>
				<?php 
				}
				?>
				</tbody>
			</table>
			<div class="row-fluid">				
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Tanggal lahir</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" placeholder="Tanggal Lahir" name="tgl_lahir" id="tgl_lahir" readonly value="<?php echo $value['tgl_lahir']; ?>">
					</div>
					</div>
				</div>
			</div>
			<div class="input-group">
				<button class=" btn purple btn-large" id="aktif" style="float:right" type="button">Aktifkan</button>
			</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	$('#notifikasi').DataTable();
	$('#tgl_lahir').datepicker({
	    dateFormat: 'dd-mm-yy',
	    changeMonth: true,
	    changeYear: true,
	    yearRange: "-100:+0"
	});
	
	$('#nim').on('change', function(){
		
		var nim = $('#nim').val();
// 		var prod = document.getElementById('prodi');
		var prod = $('#prodi')[0];
		
		$.ajax({
			url: '<?php echo URL."siak_irs/cek_mhs";?>',
			type: 'post',
			data: {nim: nim},
			success: function(data){
				setOptionByValue(prod, data);
			}
		})
		
	});
	
	$('#semester').on('change', function(){
		
		var url = '<?php echo URL."siak_irs/";?>';
		var nims = $('#nim').val();
		var thn_ak = $('#thn_ak').val();
		var prod = $('#prodi').val();
		var smstr = $('#semester').val();
		
		var form = $('#irsForm').serialize();
		
// 		alert(nims +' '+thn_ak+' '+prod+' '+smstr)
// 		
// 		$.post(url, form, function (response) {
// // 			alert (response);
// 			document.getElementById('irsForm').submit();
// 		});
		
		$.ajax({
			url: url,
			type: 'post',
			data: {
				nim: nims,
				tahun_akademik: thn_ak,
				prodi: prod,
				semester: smstr
			},
			success: function(data){
// 				alert(data);
				document.getElementById('irsForm').submit();
			}
		})
		
	});
	
	$('#aktif').on('click',function(){
		var arr_val = [];
		var val = $('.cek');
		var l = val.length;
		
		for(var i=0;i<l;i++){
			if(val[i].checked){
				arr_val.push(val[i].value)
	// 			console.log(val[i].value);
			}
		}
		
		var data = arr_val.join(',');
		alert("Value : " + data);
		var url = "";
// 		$.ajax({
// 			url: url,
// 			type:"post",
// 			data:{
// 				dataArr:data
// 			},
// 			async: false,
// 			success: function(res) {
// 			    alert("Berhasil mengaktifkan IRS Mahasiswa")
// 			    console.log(res)
// 			}
// 		});
	});
	
	function setOptionByValue(select, value){
		var options = select.options;
		for(var i = 0, len = options.length; i < len; i++){
			if(options[i].value === value){
				select.selectedIndex = i;
				return true;
			}
		}
		return false;
	}
});
</script>