<div class="row-fluid">
  <div class="span12">
    <div class="portlet box blue">
      <div class="portlet-title">
        <div class="caption"><i class="icon-globe"></i>Detail Evaluasi Dosen</div>
      </div>

      <div class="portlet-body">
        <form class="horixontal-form" name="cari" method="post" action="">
        <div class="row-fluid">
        <div class="span6">
          <div class="control-group">
            <label class="control-label" for="lastName">Program Studi</label>
            <div class="controls">
              <select class="m-wrap span12" name = "prodi" onchange="ubah(this)" link="<?php echo URL.'siak_evdos/matkul';?>">
                <option >--Pilih--</option>
                <?php foreach($this->prodi as $row => $key){ ?>
                <option value="<?php echo $key['prodi_id']?>"><?php echo $key['prodi']?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        </div>
        <div class="row-fluid">
        <div class="span6">
          <div class="control-group">
            <label class="control-label" for="lastName">Matakuliah</label>
            <div class="controls" id="matkul">
              <select class="m-wrap span12" name = "matkul">
                <option value="">--Pilih--</option>
              </select>
            </div>
          </div>
        </div>
        </div>
        <div class="row-fluid">
        <div class="span6">
          <div class="control-group">
            <label class="control-label" for="lastName">Cari</label>
            <div class="controls">
              <input type="submit" class="btn blue" value="Cari">
            </div>
          </div>
        </div>
        </div>
      </form>
        <table class="table table-bordered table-striped table-hover table-contextual table-responsive">
          <thead>
            <tr>
              <td rowspan="3">No</td>
              <td rowspan="3">Kode Dosen</td>
              <td rowspan="3">Kode Matkul</td>
              <td rowspan="3">Nama</td>
              <td colspan="16" style="text-align:center">Pertanyaan</td>
            </tr>
            <tr>
              <td colspan="4">Soal 1</td>
              <td colspan="4">Soal 2</td>
              <td colspan="4">Soal 3</td>
              <!-- <td colspan="4">Soal 4</td> -->
            </tr>
            <tr>
              <td>SKJ</td>
              <td>KJ</td>
              <td>SJ</td>
              <td>J</td>
              <td>SKJ</td>
              <td>KJ</td>
              <td>SJ</td>
              <td>J</td>
              <td>SKJ</td>
              <td>KJ</td>
              <td>SJ</td>
              <td>J</td>
              <!-- <td colspan="4">J</td> -->
            </tr>
          </thead>
          <tbody>
            <?php $i=1;
            foreach($this->dos as $row => $val) {
              $data = $this->filter_data($val['no'], $val['kode_matkul']);
              foreach($data as $row => $value){
            ?>
            <tr>
              <td><?=$i?></td>
              <td><?=$val['no']?></td>
              <td><?=$val['kode_matkul']?></td>
              <td><?=$val['nama']?></td>
              <td><?=$value['pil1a']?></td>
              <td><?=$value['pil2a']?></td>
              <td><?=$value['pil3a']?></td>
              <td><?=$value['pil4a']?></td>
              <td><?=$value['pil1b']?></td>
              <td><?=$value['pil2b']?></td>
              <td><?=$value['pil3b']?></td>
              <td><?=$value['pil4b']?></td>
              <td><?=$value['pil1c']?></td>
              <td><?=$value['pil2c']?></td>
              <td><?=$value['pil3c']?></td>
              <td><?=$value['pil4c']?></td>
              <!-- <td colspan="4">J</td> -->
            </tr>
            <?php
            $a+=$value['pil1a'];
            $a2+=$value['pil2a'];
            $a3+=$value['pil3a'];
            $a4+=$value['pil4a'];
            $b+=$value['pil1b'];
            $b2+=$value['pil2b'];
            $b3+=$value['pil3b'];
            $b4+=$value['pil4b'];
            $c+=$value['pil1c'];
            $c2+=$value['pil2c'];
            $c3+=$value['pil3c'];
            $c4+=$value['pil4c'];
            
            } $i++; } ?>
            <tr>
              <td colspan="4" style="text-align:center;">&nbsp;Total</td>
              <td style="font-weight: bold;"><?=$a?></td>
              <td style="font-weight: bold;"><?=$a2?></td>
              <td style="font-weight: bold;"><?=$a3?></td>
              <td style="font-weight: bold;"><?=$a4?></td>
              <td style="font-weight: bold;"><?=$b?></td>
              <td style="font-weight: bold;"><?=$b2?></td>
              <td style="font-weight: bold;"><?=$b3?></td>
              <td style="font-weight: bold;"><?=$b4?></td>
              <td style="font-weight: bold;"><?=$c?></td>
              <td style="font-weight: bold;"><?=$c2?></td>
              <td style="font-weight: bold;"><?=$c3?></td>
              <td style="font-weight: bold;"><?=$c4?></td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<table class="table table-bordered table-striped table-hover table-contextual table-responsive">
  <thead>
    <tr>
      <th style="color:red;font-size: 18px;text-align:center" colspan="3">Keterangan</th>
    <tr>
    <tr>
      <td style="text-align:center" colspan="2">Jawaban</td>
      <td style="text-align:center">Pertanyaan/Soal<br>(klik untuk melihat detail)</td>
    <tr>
  </thead>
  <tbody>
    <tr>
      <td style="width:3%">SKJ</td>
      <td>SANGAT KURANG JELAS SEKALI</td>
      <td rowspan="4" style="vertical-align:middle;text-align:center"><a href="#detail" data-toggle="modal" link="<?php echo URL; ?>siak_evdos/detail" onclick="detail(this)">DETAIL SOAL</a></td>
    </tr>
    <tr>
      <td>KJ</td>
      <td>KURANG JELAS</td>
<!--       <td>SOAL 2</td> -->
    </tr>
    <tr>
      <td>J</td>
      <td>JELAS</td>
<!--       <td>SOAL 3</td> -->
    </tr>
    <tr>
      <td>SJ</td>
      <td>SANGAT JELAS</td>
<!--       <td>SOAL 4</td> -->
    </tr>
  </tbody>
</table>

<div id="detail" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Detail Soal Evaluasi</h3>
	</div>
	<div id="det_soal">
	
	</div>
</div>

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<br>
<!--Insert data from PHP-Cli
<form action="" method="post">
<input name="nama" value=""><br>
<input name="ket" value=""><br>
<input type="submit" name="Simpan"><br>
</form>-->
<?php
/*
if($_POST['Simpan']){
	$nama = $_POST['nama'];
	$ket = $_POST['ket'];
	
	shell_exec('C:\xampp\php\php.exe C:\xampp\htdocs\siakunhan\coba.php "'.$nama.'" "'.$ket.'" 2>&1');
}
*/
?>
<script>
  $(document).ready(function(){
    $('#daftarWisuda').DataTable();
    
    $(document).ajaxStart(function(){
      $("#wait").css("display","block");
    });

    $(document).ajaxComplete(function(){
      $("#wait").css("display","none");
    });
    
  });

  function ubah(value){
    var link = $(value).attr('link');
    var val = $(value).val();
    var url = link + "/" + val;
    $.ajax({
      url: url,
      success: function(data) {
        $('#matkul').html(data);
      }
    });
  }
  function detail(value){
    var link = $(value).attr('link');
    var url = link;
    $.ajax({
      url: url,
      success: function(data) {
        $('#det_soal').html(data);
      }
    });
  }
</script>
