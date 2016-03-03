<?php //if ($this->loads == "t") { ?>

<script>

$(document).ready(function(){
	$('#modul').DataTable();
	var strURL = '<?php echo URL; ?>siak_mahasiswa/data_pribadi/<?php echo $this->nim."/".$this->jenis;?>/edit';
	
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('tab1').innerHTML=req.responseText;            
				} else {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}       
		}     
		req.open("GET", strURL, true);
		req.send(null);
	}
	
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
			  <div class="caption"><i class="icon-reorder"></i>Portlet Tabs</div>
		  </div>
		  <div class="portlet-body">
			  <div class="tabbable tabbable-custom tabs-left">
				  <!-- Only required for left/right tabs -->
				  <ul class="nav nav-tabs tabs-left">
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_pribadi/<?php echo $this->nim."/".$this->jenis;?>" data-target="#tab1" data-toggle="tab">PRIBADI</a></li>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_keluarga/<?php echo $this->nim."/".$this->jenis;?>/edit" data-target="#tab2" data-toggle="tab">KELUARGA</a></li>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_pendidikan/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tab3" data-toggle="tab">PENDIDIKAN</a></li>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_bahasa_asing/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tab4" data-toggle="tab">BAHASA ASING</a></li>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_kursus_latihan/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tab5" data-toggle="tab">KURSUS/LATIHAN</a></li>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_karya_ilmiah/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tab6" data-toggle="tab">KARYA ILMIAH</a></li>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_seminar_ilmiah/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tab7" data-toggle="tab">SEMINAR ILMIAH</a></li>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_prestasi/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tab8" data-toggle="tab">PRESTASI</a></li>
					  <?php if ($this->jenis == "umum") { ?>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_pekerjaan/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tab9" data-toggle="tab">PEKERJAAN</a></li>
					  <?php } ?>
					  <?php if ($this->jenis == "pns") { ?>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_riwayat_pendidikan/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tab9" data-toggle="tab">RIWAYAT PENDIDIKAN</a></li>
					  <li><a href="<?php echo URL; ?>siak_mahasiswa/data_riwayat_pangkat/<?php echo $this->nim."/".$this->jenis;?>/data" data-target="#tab10" data-toggle="tab">RIWAYAT PANGKAT</a></li>
					  <?php } ?>
				  </ul>
				  <div class="tab-content">
					  <div class="tab-pane active" id="tab1">
						  
					  </div>
					  <div class="tab-pane" id="tab2">
						  
					  </div>
					  <div class="tab-pane" id="tab3">
						  
					  </div>
					  <div class="tab-pane" id="tab4">
						  
					  </div>
					  <div class="tab-pane" id="tab5">
						  
					  </div>
					  <div class="tab-pane" id="tab6">
						  
					  </div>
					  <div class="tab-pane" id="tab7">
						  
					  </div>
					  <div class="tab-pane" id="tab8">
						  
					  </div>
					  <div class="tab-pane" id="tab9">
						  
					  </div>
					  <div class="tab-pane" id="tab10">
						  
					  </div>
				  </div>
			  </div>
		  </div>
	  </div>
	  <!-- END TAB PORTLET-->
    </div>
</div>

<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>