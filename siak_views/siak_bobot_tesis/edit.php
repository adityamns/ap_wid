<?php 
//var_dump($this->siak_sub_komponen);die();
foreach ($this->siak_data as $key => $value) { ?>
<!--<div class="panel panel-danger" style="width:750px;">
	<div class="panel-heading">
		<h3 class="panel-title">Edit Bobot Tesis</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_bobot_tesis/siak_edit_save/<?php echo $value['id']; ?>" method = "post">-->
<div class="modal-body">
		<div class="portlet-body form">
        <form id="formAddKeg" class="horizontal-form" action = "<?php echo URL;?>siak_bobot_tesis/siak_edit_save/<?php echo $value['id']; ?>" method = "post">
        	<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tahun_id">TAHUN ANGKATAN</label>
						<div class="controls">
						<select class="m-wrap span12" name="tahun_id">
                            <option value="">-- Tahun Masuk --</option>
                            <?php for ($i=2009; $i <= date('Y'); $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php echo $i==$value['tahun_id']?"selected":"";?>><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="prodi_id">PRODI</label>
						<div class="controls">
						<select class="m-wrap span12" name="prodi_id" disabled>
                            <?php foreach($this->siak_prodi as $key => $valu) { ?>
                            <?php if($value['prodi_id'] == $valu['prodi_id']){ ?>
                            <option><?php echo $valu['prodi']; ?></option>
                            <?php }} ?>
                        </select>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nim">MATA KULIAH</label>
						<div class="controls">
						<input type="text" class="m-wrap span12" value="Tesis" disabled>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="prodi_id">PERSENTASE PEMBIMBING</label>
						<div class="controls">
						<input type="text" class="m-wrap span3" name="pembimbing" value="<?php echo $value['pembimbing'];?>">&nbsp; %
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="prodi_id">PERSENTASE PENGUJI</label>
						<div class="controls">
						<input type="text" class="m-wrap span3" name="penguji" value="<?php echo $value['penguji'];?>">&nbsp; %
						</div>
					</div>
				</div>
            </div>
 			
 			<?php if($this->siak_komponen_tesis != NULL){ ?>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nilai">KOMPONEN</label>
					</div>
				</div>
            </div>
 			<?php $i=0;foreach ($this->siak_komponen_tesis as $key => $vals) { $i++; ?>
 			
                <div class="row-fluid">
                    <div class="span10">
                        <div class="control-group">
                            <div class="controls">
                            <?php echo $i; ?>.&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="m-wrap span6" name="komponen[]" value="<?php echo $vals['komponen'];?>">&nbsp;&nbsp;&nbsp;
                            <input type="hidden" name="id[]" value=<?php echo $vals['id']; ?>>
                            <input type="text" class="m-wrap span1" name="persentase[]" value="<?php echo $vals['persentase']; ?>">&nbsp;%
                            </div>
                        </div>
                    </div>
                </div>
                <div id="form-subkomp<?php echo $i; ?>"></div>
 			<?php foreach ($this->sub_komponen as $key => $valus){
 				$id = $vals['id'];
 				$id_komponen = $valus['id_komponen_tesis'];
 				
 				if($id == $id_komponen){
 			?>
            <div class="row-fluid" id="rows<?php echo $i; ?>">
                <div class="span10">
                    <div class="control-group">
                        <div class="controls">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="m-wrap span6" name="sub_komponen[]" value="<?php echo $valus['sub_komponen'];?>">
                        <input type="hidden" name="id_sub[]" value=<?php echo $valus['id']; ?>>
                        </div>
                    </div>
                </div>
            </div>
 			<?php } } ?>
 			<?php } }else {  ?>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nilai">KOMPONEN</label>
						<div class="controls">
                        <button class="btn green" type="button" onClick="addVariable();">Tambah</button>
                        <input type="hidden" name="id_tambah" value="<?php echo $value['id']; ?>">
						</div>
					</div>
				</div>
            </div>
			<?php } ?>
 			<div id="variablegroup"></div>
 		</form>
 	<!--</div>
 </div>
 </div>-->
 </div>
 </div>
 <div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" id="kekirim" class="btn green" onclick="document.getElementById('formAddKeg').submit();">Simpan</button>
 </div>
<?php } ?>
<script type="text/javascript">
var i = 0;
var no = 1;
function addVariable(){
	var varGroup = document.getElementById("variablegroup");
	var rnumber=Math.random();
	var html = "<div id='row"+i+"'><div class='row-fluid'><div class='span10'><div class='control-group'><div class='controls'>"+no+".&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' class='m-wrap span6' name='komponene[]' placeholder='Komponen...'><input type='hidden' name='numbere[]' value='"+i+"'>&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' class='m-wrap span1' name='persentasee[]' >&nbsp;%&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' class='btn green mini' onclick='addSub("+i+");'>Tambah</button><button class='btn red mini' type='button' onclick='delet("+i+")'>Hapus</button></div></div></div></div><div id='form-subkomp"+i+"'></div></div>";
	jQuery("#variablegroup").append(jQuery(html));
	i++;no++;
}
		
function addSub(i){
	var varGroups = document.getElementById("form-subkomp"+i+"");
	var rnumbers=Math.random();
	var htmls = "<div class='row-fluid' id='rows"+i+"'><div class='span10'><div class='control-group'><div class='controls'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' class='m-wrap span6' name='sub_komponene"+i+"[]' placeholder='Sub Komponen...'>&nbsp;&nbsp;&nbsp;&nbsp;<button class='btn red icn-only' type='button' onclick='delets("+i+")'><i class='icon-remove icon-white'></i></button></div></div></div></div>";
	jQuery("#form-subkomp"+i+"").append(jQuery(htmls));
}
		
function delet(i){
	 jQuery("#row"+i+"").remove();
}
		
function delets(i){
	 jQuery("#rows"+i+"").remove();
}
</script>
 