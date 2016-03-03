<?php 

if ($this->rolePage['reades'] == "t") { ?>
<script type="text/javascript">
$(document).ready(function(){
      $('#modul').DataTable();
      
      $(document).ajaxStart(function(){
	$("#wait").css("display","block");
      });

      $(document).ajaxComplete(function(){
	$("#wait").css("display","none");
      });
      
      var link = '<?php echo URL; ?>siak_dosen/data_pribadi/<?php echo $this->nip;?>/data';
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#tab1").html(data);
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
              <div class="caption"><i class="icon-reorder"></i>Detail Dosen</div>
          </div>
          <div class="portlet-body">
                <div class="tabbable tabbable-custom tabs-left">
                    <ul class="nav nav-tabs tabs-left">
                        <li class=""><a href="<?php echo URL; ?>siak_dosen/data_pribadi/<?php echo $this->nip;?>/data" data-target="#tab1" data-toggle="tab">DATA PRIBADI</a></li>
                        <li><a href="<?php echo URL; ?>siak_dosen/data_alamat/<?php echo $this->nip;?>/data" data-target="#tab2" data-toggle="tab">ALAMAT </a></li>
                        <li><a href="<?php echo URL; ?>siak_dosen/data_akademik/<?php echo $this->nip;?>/data" data-target="#tab3" data-toggle="tab">AKADEMIK </a></li>
                        <li><a href="<?php echo URL; ?>siak_dosen/data_jabatan/<?php echo $this->nip;?>/data" data-target="#tab4" data-toggle="tab">JABATAN </a></li>
                        <li><a href="<?php echo URL; ?>siak_dosen/data_pendidikan/<?php echo $this->nip;?>/data" data-target="#tab5" data-toggle="tab">PENDIDIKAN </a></li>
                        <li><a href="<?php echo URL; ?>siak_dosen/data_pelatihan/<?php echo $this->nip;?>/data" data-target="#tab6" data-toggle="tab">PELATIHAN </a></li>
                        <li><a href="<?php echo URL; ?>siak_dosen/data_penelitian/<?php echo $this->nip;?>/data" data-target="#tab7" data-toggle="tab">PENELITIAN </a></li>
                        <li><a href="<?php echo URL; ?>siak_dosen/data_seminar/<?php echo $this->nip;?>/data" data-target="#tab8" data-toggle="tab">SEMINAR </a></li>
                        <li><a href="<?php echo URL; ?>siak_dosen/data_pengabdian/<?php echo $this->nip;?>/data" data-target="#tab9" data-toggle="tab">PENGABDIAN MASYARAKAT </a></li>
                        <li><a href="<?php echo URL; ?>siak_dosen/data_karyailmiah/<?php echo $this->nip;?>/data" data-target="#tab10" data-toggle="tab">KARYA ILMIAH </a></li>
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
    </div>
</div>

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>