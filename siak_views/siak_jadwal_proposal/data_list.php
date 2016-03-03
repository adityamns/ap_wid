<?php // if ($this->reades == "t") { ?>
<div class="row-fluid">
	<div class="span12">
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-globe"></i>Jadwal Sidang Proposal</div>
	</div>
	<div class="portlet-body" >
	<?php //if ($this->creates == "t") { ?>
    <?php if(Siak_session::siak_get('level')!=16){ ?>
		<div class="input-group">
			<!--<a href="<?php echo URL; ?>siak_jadwal_proposal/siak_add/" id='variousJ0'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span>Tambah</button></a>-->
            <a class=" btn purple btn-large" href="#addDos" data-toggle="modal" link="<?php echo URL; ?>siak_jadwal_proposal/siak_add/" onclick="add(this)">Tambah</a>
		</div>
        <?php } ?>
		<hr>
	<?php //} ?>
		<table id = "prodi_proposal" class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
		<tr align = "center">
			<td>NO</td>
			<td>TAHUN AKADEMIK</td>
			<td>PRODI</td>
			<td>AKSI</td>
		</tr>
		</thead>
		<tbody>
		<?php
			$i = 0;
			foreach ($this->siak_data as $key => $value) {

				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				echo "<td align = 'center'>" . $value['nama_tahun'] . "</td>";
				echo "<td align = 'center'>" .$value['prodi']. "</td><td align = 'center'>";
				if(Siak_session::siak_get('level')==16){
					echo //$this->view=="t"?
				"<a  href = '".URL."siak_jadwal_proposal/detail_list/".$value['tahun_id']."/".$value['prodi_id']."'> DETAIL </a>"
				//:""
				;
				}else{
					echo //$this->view=="t"?
				"<a  href = '".URL."siak_jadwal_proposal/detail_list/".$value['tahun_id']."/".$value['prodi_id']."'> DETAIL </a>"
				//:""
				;echo //$this->updates=="t"?
				" || <button><a  href = '".URL."siak_jadwal_proposal/create/".$value['tahun']."/".$value['tahun_id']."/".$value['prodi_id']."'><strong>BUKA</strong></a>"
				//:""
				;
				}
				// echo //$this->deletes=="t"?
				// "&nbsp <a href = '".URL."siak_jadwal_sidang/siak_delete/".$value['id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>"
				//:""
				// ;
			echo "</td></tr>";
		}
		?>
		</tbody>
	</table>
	</div>
	</div>
    </div>
	</div>
    
    <div id="addDos" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="add">
	
	</div>
</div>
<script>
	$('#prodi_proposal').DataTable();
</script>
<?php// }else{ ?>
<!--<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>-->
<?php //} ?>