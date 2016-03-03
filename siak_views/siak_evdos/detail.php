<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		
		<?php
		foreach($this->data_matkul as $bak => $up){
			
			$nim = $up['nim'];
			$prodi = $up['prodi_id'];
			$matkul_id = $up['matkul_id'];
		}
		?>
		
		<form id="detailSoal" method = "post" action="#" class="horizontal-form" disabled>
		
		<div class="row-fluid">
			<div class="span12">
		<?php
		$count = sizeof($this->soal);
		$i=0;
			foreach($this->soal as $row => $key){
			    //echo "<pre>";
			    //var_dump($row['soal']);
			    //echo "</pre>";
			    echo "
			    <div class='control-group'>
			    <div class='controls'>";
			    echo 
			    "<label><u>Soal ke ".($i+1)."</u></label>
			    <label>".($i+1).") ".$key['soal']."</label>
			    </div>
			    </div>
			    ";
			    if($i < ($count-1)){
			    echo "
			    <label>(Pilihan)</label>
			    <div class='control-group'>
			    <div class='controls'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			    <label class='radio'>
			    <input type='radio' name='poll".$key['soal_id']."' value='1'>Sangat Kurang JeLas&nbsp;&nbsp;</label>&nbsp;<label class='radio'>
			    <input type='radio' name='poll".$key['soal_id']."' value='2'>Kurang Jelas&nbsp;&nbsp;</label>&nbsp;<label class='radio'>
			    <input type='radio' name='poll".$key['soal_id']."' value='3'>Sangat Jelas&nbsp;&nbsp;</label>&nbsp;<label class='radio'>
			    <input type='radio' name='poll".$key['soal_id']."' value='4'>Jelas</label>
			    </div>
			    </div>";
			    }
			    echo "
			    <div class='control-group'>
			    <div class='controls'>
			    <input type='hidden' name='nim".$key['soal_id']."' value='".$nim."'>
			    <input type='hidden' name='prodi_id".$key['soal_id']."' value='".$prodi."'>
			    <input type='hidden' name='soal_id".$key['soal_id']."' value='".$key['soal_id']."'>
			    <input type='hidden' name='dosen_id".$key['soal_id']."' value='".$this->dosen."'>
			    <input type='hidden' name='matkul_id".$key['soal_id']."' value='".$matkul_id."'>
			    <textarea name='soal".$key['soal_id']."' rows='3' cols='100' style='width: 700px;'></textarea>
			    </div>
			    </div>";
			
			$i++;
			}
			echo "<hr>";
		?>
			</div>
		</div>
		
		</form>
		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
</div>

<script type="text/javascript">
$(document).ready(function(){
    dis(document.getElementById("detailSoal"));
});
 
/// disabled input element inside div id
function dis(el){
    try {
    el.disabled = el.disabled ? false : true;
    }catch(E){
     
    }
    if (el.childNodes && el.childNodes.length > 0){
    for (var x = 0; x < el.childNodes.length; x++) 
    {
        dis(el.childNodes[x]);
    }
    }
}
 
</script>