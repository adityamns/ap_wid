<div class="modal-body">
<!-- 	<div class="scroller" data-always-visible="1" data-rail-visible1="1"> -->
		<div class="portlet-body form">
		
 		<form id="formAddKeg" class="horizontal-form" action = "<?php echo URL;?>siak_input_ijazah/siak_create" method = "post">
			
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="judul">PROGRAM STUDI</label>
							<?php 
							if($this->prodi == ''){ 
							?>
						<div class="controls chzn-controls">
							  <select class="chosen span12" id="prodi_id" name="prodi_id" >
							  <option value="">-- Pilih Prodi --</option>
								  <?php foreach($this->siak_data_list as $key => $value) {
									  echo "<option value='$value[prodi_id]' >$value[prodi]</option>";
								  } ?>
							  </select>
						</div>
							<?php 
							}else{
							  foreach($this->siak_data_list as $key => $value) {
								  echo $prodi = ($value['prodi_id'] == $this->prodi) ? "<div class='controls'><input type='text' class='m-wrap span12' readonly value='".$value[prodi]."'></div>":"";
							  } 
							?>
							<input type="hidden" id="prodi_id" name="prodi_id" value="<?=$this->prodi?>">
							<?php }?>
					</div>
				</div>
				
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kategori_id">COHORT</label>
						<div class="controls chzn-controls">
							<select class="chosen span12" id='cohort' onchange="ubahSem(this)" link="<?php echo URL;?>siak_input_ijazah/matkul">
								<option value="">-- Cohort --</option>
							 <?php foreach($this->cohort as $key => $value) {
									  echo "<option value='$value[cohort]' >$value[cohort]</option>";
								  } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			
 			<div id='getmatkul'>
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="kategori_id"></label>
						<div class="controls chzn-controls">
							
						</div>
					</div>
				</div>
			</div>
 			</div>
 			<br><div><label class="control-label" for="lastName">NO URUT IJAZAH</label></div>
 			<div class="row-fluid">

					<div class="span4">

						<div class="control-group">
							
							<label class="control-label" for="lastName">DARI</label>
 				<div class="controls"><input type="text" class="m-wrap span12" name="no_urut" id="no_urut" ></div>

 			
						</div>
					</div>
				<div class="span4">
						<div class="control-group">
							
							<label class="control-label" for="lastName">SAMPAI</label>
 				<div class="controls"><input type="text" class="m-wrap span12" name="sampai_urut" id="sampai_urut" ></div>

 			
						</div>
					</div>
 			</div>
 		</form>
 		
 		</div>
<!-- 	</div> -->
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formAddKeg').submit();">Simpan</button>
</div>
 
<script type="text/javascript">
// $('#semester').on('change', function(e){
// 	var strURL = $(this).attr('link');
// 	var cohort = $(this).attr('value');
// 	var prodi = document.getElementById('prodi_id').value;
// 	jQuery.ajax({
// 		url: strURL + '/' + prodi + '/' + cohort ,
// 		success: function(res){
// 			$('#getmatkul').html(res);
// 		}
// 	});
// });




function mahasiswa(value){
	var strURL = jQuery(value).attr("link");
	var prodi = document.getElementById("prodi").value;
	var status = document.getElementById("cohort").value;
	console.log(prodi);
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {            
					document.getElementById('statediv').innerHTML=req.responseText;
					askDelete();
					fancy();
				} else {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}       
		}     
		req.open("GET", strURL + "/" + prodi + "/" + cohort, true);
		req.send(null);
	}
}
</script>