<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
			<form id="formLaporBug" name="users" class="horizontal-form" method = "post" action = "<?php echo URL;?>/siak_dashboard/laporBug" enctype="multipart/form-data">
			
				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="masalah">Judul</label>
							<div class="controls">
								<input type="text" class="span12 m-wrap" name="judul" maxlenght="10">
<!-- 								<span class="help-block">Copy Paste URL yang ada pada address bar Browser anda</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="masalah">URL</label>
							<div class="controls">
								<input type="text" class="span12 m-wrap" name="url">
								<span class="help-block">Copy Paste URL yang ada pada address bar Browser anda</span>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="masalah">Masalah</label>
							<div class="controls">
								<textarea name="masalah" class="span12 m-wrap" rows="6"></textarea>
								<span class="help-block">Terangkan secara detail masalah yang dialami</span>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				
				<!--<div class="row-fluid">
				</div>
				-->
				<div class="controls">
					<div data-provides="fileupload" class="fileupload fileupload-new">
						<div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
							<img alt="" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
						</div>
						<div style="max-width: 200px; max-height: 150px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
						<div>
							<span class="btn btn-file"><span class="fileupload-new">Pilih Gambar</span>
							<span class="fileupload-exists">Ganti</span>
							<input type="file" class="default" name="foto"></span>
							<a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Hapus</a>
						</div>
					</div>
					<span class="label label-important">Optional!</span>
					<span>
					Anda bisa melampirkan gambar dengan membuat screenshot pada masalah yang terjadi
					</span>
				</div>
				
				<div id="json">
				</div>
				
			</form>
			
		</div>
	</div>
</div>



<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" data-dismiss="modal" class="btn green" onclick="s_laporan()">Laporkan</button>
</div>

<script>
function s_laporan(){
// 	alert('helloooo')
    $("#formLaporBug").submit(function(e)
    {
// 	var postData = $(this).serializeArray();
	var postData = new FormData(this);
	var formURL = $(this).attr("action");
	$.ajax(
	{
	    url : formURL,
	    type: "POST",
	    data: postData,
	    contentType: false,
	    cache: false,
	    processData:false,
	    success:function(res, textStatus, jqXHR)
	    {
// 		  console.log(res);
		  alert(res)
	    },
	    error: function(jqXHR, textStatus, errorThrown)
	    {
		//if fails     
	    }
	});
	e.preventDefault();
    });
 
    $("#formLaporBug").submit();
}
</script>