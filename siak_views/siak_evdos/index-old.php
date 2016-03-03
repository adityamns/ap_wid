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
        <table id = "daftarWisuda" class="table table-bordered table-striped table-hover table-contextual table-responsive">
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
            <?php } $i++; } ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<pre>
  <span style="color:red;font-size: 18px"><u>Keterangan</u> :</span>
  SKJ   = Sangat Kurang Jelas
  KJ    = Kurang Jelas
  J     = Jelas
  SJ    = Sangat Jelas
</pre>

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
</script>
