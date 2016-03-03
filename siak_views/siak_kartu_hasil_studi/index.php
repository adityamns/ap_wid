<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Kartu Hasil Studi</div>
			</div>
			<div class="portlet-body">
			<form class="horizontal-form" method = "post" action="<?php echo URL;?>siak_kartu_hasil_studi/siak_ok">
			
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama">NAMA</label>
						<div class="controls">
							<?php echo $mhs = (Siak_session::siak_get('level') != 16) ? 
							'<input type="text" link="'.URL.'siak_kartu_hasil_studi/siak_cek" class="m-wrap span12" name="nim" id="nim" placeholder="Nim..." onchange="ikhs(this)" >':
							'<input type="text" class="form-control" name="nim" id="nim" value="'.Siak_session::siak_get('username').'" readonly>';
							?>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="peranan">Semester</label>
						<div class="controls">
							<select id="semester" class="m-wrap span12" link="<?php echo URL;?>siak_kartu_hasil_studi/siak_cek" name="semester" class="form-control" onchange="ikhs(this)">
								<option value="0">- Semester -</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			
			</form>
			
			<div id="ikhs">
		
			</div>
			
			</div>
		</div>
	</div>
</div>

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<script>
$(function(){
	$(document).ajaxStart(function(){
      $("#wait").css("display","block");
    });

    $(document).ajaxComplete(function(){
      $("#wait").css("display","none");
    });
})


function ikhs(value){
      var nim = document.getElementById('nim').value;
      var semester = document.getElementById('semester').value;
      var url = $(value).attr('link');
      var strURL = url+"/"+nim+"/"+semester;
      $.ajax({
	  url: strURL,
	  success: function(data) {
	      $("#ikhs").html(data);
	  }
      });
}
</script>