<?php
// echo "<pre>";
// var_dump($this->rolePage);
// echo "</pre>";
// echo $this->rolePage['loads'];
if ($this->rolePage['reades'] == "t") { ?>

<script type="text/javascript">
$(document).ready(function(){
    
    var hash = window.location.hash;
    if(hash != ""){
      var tabhash = $(hash);
      var loadurl = tabhash.attr('href');
      var targ = tabhash.attr('data-target');
      $.ajax({
	  url: loadurl,
	  success: function(data) {
	      $(targ).attr('class',$(targ).attr('class') + ' active');
	      $(targ).html(data);
	  }
      });
    } else {
            
      $(document).ajaxStart(function(){
	$("#wait").css("display","block");
      });

      $(document).ajaxComplete(function(){
	$("#wait").css("display","none");
      });
      
      var link = '<?php echo URL; ?>siak_mahasiswa/data_pribadi/<?php echo $this->nim."/".$this->jenis;?>/edit';
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#tabs1").attr('class',$("#tabs1").attr('class') + ' active');
	      $("#tabs1").html(data);
	  }
      });
      
    }


  $('[data-toggle="tab"]').click(function(e) {
      e.preventDefault();
      var loadurl = $(this).attr('href');
      var targ = $(this).attr('data-target');
      
      $(targ).load(loadurl, function() {
	      $(targ).tab(); //initialize tabs
	      $('#data_bhs').DataTable();
	      $('#data_karya').DataTable();
	      $('#data_kursus').DataTable();
	      $('#data_prestasi').DataTable();
	      $('#data_seminar').DataTable();
	      
// 	      loadData();
	      
      });	
      

  });
});
</script>
<div class="row-fluid ">
    <div class="span12">
	  <!-- BEGIN TAB PORTLET-->   
	  <div class="portlet box blue tabbable">
		  <div class="portlet-title">
			  <div class="caption"><i class="icon-reorder"></i>Detail Mahasiswa</div>
		  </div>
		  <div class="portlet-body">
			  <div class="tabbable tabbable-custom tabs-left">
				  <!-- Only required for left/right tabs -->
				  <ul class="nav nav-tabs tabs-left">
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_pribadi/<?php echo $this->nim."/".$this->jenis;?>/edit" data-target="#tabs1" id="tab-pribadi" data-toggle="tab">PRIBADI</a></li>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_keluarga/<?php echo $this->nim."/".$this->jenis;?>/edit" data-target="#tabs2" id="tab-keluarga" data-toggle="tab">KELUARGA</a></li>
					  
					  <?php if ($this->jenis == "umum" || $this->jenis == "Umum") { ?>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_pendidikan/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tabs3" id="tab-riwayat-pen" data-toggle="tab">PENDIDIKAN</a></li>
					  <?php } ?>
					  <?php if ($this->jenis == "pns") { ?>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_riwayat_pendidikan/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tabs3" id="tab-riwayat-pen" data-toggle="tab">PENDIDIKAN</a></li>
					  <?php } ?>
					  
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_bahasa_asing/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tabs4" id="tab-bahasa-asing" data-toggle="tab">BAHASA ASING</a></li>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_kursus_latihan/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tabs5" id="tab-kursus" data-toggle="tab">KURSUS/LATIHAN</a></li>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_karya_ilmiah/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tabs6" id="tab-karya" data-toggle="tab">KARYA ILMIAH</a></li>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_seminar_ilmiah/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tabs7" id="tab-seminar" data-toggle="tab">SEMINAR ILMIAH</a></li>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_prestasi/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tabs8" id="tab-prestasi" data-toggle="tab">PRESTASI</a></li>
					  <?php if ($this->jenis == "umum") { ?>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_pekerjaan/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tabs9" id="tab-prestasi" data-toggle="tab">PEKERJAAN</a></li>
					  <?php } ?>
					  <?php if ($this->jenis == "pns") { ?>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_riwayat_pangkat/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tabs10" id="tab-riwayat-pang" data-toggle="tab">RIWAYAT PANGKAT</a></li>
					  <?php } ?>
				  </ul>
				  <div class="tab-content">
					  <div class="tab-pane" id="tabs1">
						  
					  </div>
					  <div class="tab-pane" id="tabs2">
						  
					  </div>
					  <div class="tab-pane" id="tabs3">
						  
					  </div>
					  <div class="tab-pane" id="tabs4">
						  
					  </div>
					  <div class="tab-pane" id="tabs5">
						  
					  </div>
					  <div class="tab-pane" id="tabs6">
						  
					  </div>
					  <div class="tab-pane" id="tabs7">
						  
					  </div>
					  <div class="tab-pane" id="tabs8">
						  
					  </div>
					  <div class="tab-pane" id="tabs9">
						  
					  </div>
					  <div class="tab-pane" id="tabs10">
						  
					  </div>
				  </div>
			  </div>
		  </div>
	  </div>
	  <!-- END TAB PORTLET-->
    </div>
</div>
<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>