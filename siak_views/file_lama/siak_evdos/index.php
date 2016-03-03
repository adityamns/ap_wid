<div class="row-fluid">
  <div class="span12">
    <div class="portlet box blue">
      <div class="portlet-title">
        <div class="caption"><i class="icon-globe"></i>Detail Evaluasi Dosen</div>
      </div>

      <div class="portlet-body">

        <div class="input-group">
          <a class=" btn purple btn-large" href="#addM" data-toggle="modal" link="<?php echo URL; ?>siak_pendaftaran_wisuda/siak_add/" onclick="add(this)">Tambah</a>
        </div>
        <hr>

        <table id = "daftarWisuda" class="table table-bordered table-striped table-hover table-contextual table-responsive">
          <thead>
            <tr>
              <td rowspan="3">No</td>
              <td rowspan="3">Kode Dosen</td>
              <td rowspan="3">Nama</td>
              <td colspan="16" style="text-align:center">Hasil Evaluasi Dosen</td>
            </tr>
            <tr>
              <td colspan="4">Pilihan 1</td>
              <td colspan="4">Pilihan 2</td>
              <td colspan="4">Pilihan 3</td>
              <td colspan="4">Pilihan 4</td>
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
              <td colspan="4">J</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td >No</td>
              <td >Kode Dosen</td>
              <td >Nama</td>
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
              <td colspan="4">J</td>
            </tr>
            <tr>
              <td >No</td>
              <td >Kode Dosen</td>
              <td >Nama</td>
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
              <td colspan="4">J</td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
<pre>
<label style="color:red;">Keterangan</label>
SKJ	= Sangat Kurang Jelas
KJ	= Kurang Jelas
J	= Jelas
SJ	= Sangat Jelas
</pre>

<div id="addM" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h3>Tambah Data</h3>
  </div>
  <div id="add">

  </div>
</div>

<div id="editM" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h3>Edit Data</h3>
  </div>
  <div id="edit">

  </div>
</div>

<div id="hapusM" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h3>Hapus Data</h3>
  </div>
  <div class="modal-body">
    <span id="dataHapus"></span>
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn">Batal</button>
    <a type="button" class="btn green" id="hapusD" href="#">Hapus</a>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('#daftarWisuda').DataTable();
  });


  function kirim_id(id,nama){
    document.getElementById('dataHapus').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
    $("#hapusD").attr("href","<?php echo URL; ?>siak_pendaftaran_wisuda/siak_delete/"+id);
  }
</script>
