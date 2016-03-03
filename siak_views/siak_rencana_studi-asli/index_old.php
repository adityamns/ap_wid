<script type="text/javascript">
$(document).ready(function(){

      $(document).ajaxStart(function(){
	$("#wait").css("display","block");
      });
      $(document).ajaxComplete(function(){
	$("#wait").css("display","none");
      });

});

function irs(value){
      var nim = document.getElementById('nim').value;
      var semester = document.getElementById('semester').value;
      var url = $(value).attr('link');
      var strURL = url+"/"+nim+"/"+semester;
      $.ajax({
	  url: strURL,
	  success: function(data) {
	      $("#irs").html(data);
	  }
      });
}

function addRow(obj){
  var rencana_studi = jQuery("#rencana_studi");
  var l = obj.length;
  var tbl_length = jQuery("#rencana_studi tr").length;
  for(i=0;i<l;i++){
    rencana_studi.append(
      "<tr>"+
      "<td>" + tbl_length + "</td>"+
      "<td><!--<input type='hidden' name='semester[]' value='" + obj[i].semester + "'>-->" + obj[i].semester + "</td>"+
      "<td><input type='hidden' name='kode_matkul[]' value='" + obj[i].kode_matkul + "'>" + obj[i].kode_matkul + "</td>"+
      "<td><input type='hidden' name='nama_matkul[]' value='" + obj[i].nama_matkul + "'>" + obj[i].nama_matkul + "</td>"+
      "<td><input type='hidden' name='sks[]' value='" + obj[i].sks + "'>" + obj[i].sks + "</td>"+
      "<td><input type='hidden' name='pertemuan[]' value='" + obj[i].pertemuan + "'>" + obj[i].pertemuan + "</td>"+
      "</tr>"
    );
    tbl_length++;
  }
}
</script>

<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Isian Rencana Studi</div>
			</div>
			<div class="portlet-body">
			<form class="horizontal-form" method = "post" action="<?php echo URL;?>siak_rencana_studi/siak_ok">
			
			<div class="row-fluid">
				<div class="span4">
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
				<!--/span-->
				<div class="span4">
					<div class="control-group">
						<label class="control-label" for="firstName">Tahun Akademik</label>
						<div class="controls">
							<select class="m-wrap span12" name="tahun_akademik">
								<option value="">-- Thn Akademik --</option>
								<?php foreach($this->siak_tahun_akademik as $key => $value) {
									echo "<option value='$value[tahun_id]'>$value[nama_tahun]</option>";
								} ?>
							</select>
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span2">
					<div class="control-group">
						<label class="control-label" for="firstName">Semester</label>
						<div class="controls">
							<select id="semester" link="<?php echo URL;?>siak_rencana_studi/siak_cek" name="semester" class="m-wrap span12" onchange="irs(this)">
								<option value="0">- Semester -</option>
								<!-- <option value="0">Semua</option> -->
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			
			<div id="irs">
			
			
			</div>
			
			</form>
			</div>
		</div>
	</div>
</div>

<!-- Loader -->
<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
	<img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>
