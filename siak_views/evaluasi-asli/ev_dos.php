<?php //if ($this->loads == "t") { ?>

<script type="text/javascript">

var array_nilai = <?php echo json_encode($this->data_nilai); ?>;
var matkul_id = array_nilai[0].matkul_id;


$(document).ready(function(){
      
      $(document).ajaxStart(function(){
	$("#wait").css("display","block");
      });

      $(document).ajaxComplete(function(){
	$("#wait").css("display","none");
      });
      
      var link = "<?php echo URL.'siak_kartu_hasil_studi/isi_evaluasi/'.$this->nim_mhs;?>"+"/"+matkul_id+"/"+"<?php echo $this->smstr_mhs; ?>"+"/A";
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#tabs1A").html(data);
	  }
      });
});

$(function() {

  $('[data-toggle="tab"]').click(function(e) {
      e.preventDefault();
      var loadurl = $(this).attr('href');
      var targ = $(this).attr('data-target');
      
      $(targ).load(loadurl, function() {
	      $(targ).tab(); //initialize tabs
	      
      });

  });
});
</script>
<div class="row-fluid ">
    <div class="span12">
	  <!-- BEGIN TAB PORTLET-->   
	  <div class="portlet box blue tabbable">
		  <div class="portlet-title">
			  <div class="caption"><i class="icon-reorder"></i>Data Mahasiswa</div>
		  </div>
		  <div class="portlet-body">
			  <div class="tabbable tabbable-custom tabs-left">
				  <!-- Only required for left/right tabs -->
				  <ul class="nav nav-tabs tabs-left">
				  
				  <?php
				      $char = array('Z','A','B','C','D','E','F','G','H','I','J');
				      $i=1;
				      foreach($this->data_nilai as $row => $x){
				      if($x['matkul_id'] != NULL && $x['jawaban'] != NULL){
				      ?>
					  <li><?=$x['matkul_id']?></li>
					  
				  <?php } else { //echo $this->smstr_mhs;?>
				  
					  <li><a href="<?php echo URL.'siak_kartu_hasil_studi/isi_evaluasi/'.$this->nim_mhs.'/'.$x['matkul_id'].'/'.$this->smstr_mhs.'/'.$char[$i]; ?>" data-target="#tabs<?php echo $i.$char[$i]?>" data-toggle="tab"><?=$x['matkul_id']?></a></li>
				  <?php
				  }
				  $i++; }
				  ?>
				  </ul>
				  <div class="tab-content">
				  <?php
				  $char = array('Z','A','B','C','D','E','F','G','H','I','J');
				      $i=1;
				  foreach($this->data_nilai as $row => $x){ ?>
					  <div class="tab-pane active" id="tabs<?php echo $i.$char[$i]?>">
						  
					  </div>
				  <?php $i++; } ?>
				  </div>
			  </div>
		  </div>
	  </div>
	  <!-- END TAB PORTLET-->
    </div>
</div>

<!-- Loader -->
<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>