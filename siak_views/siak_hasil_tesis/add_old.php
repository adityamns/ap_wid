<?php //var_dump($this->penguji1);die(); ?>
<div class="panel panel-danger">
	<div class="panel-heading">
		<h3 class="panel-title">Form Nilai</h3>
	</div>
	<div class="panel-body" style="width:100%;">
		<div class="container-fluid">
			<form id="users" name="users" class="form-horizontal" method = "post" action = "<?php echo URL;?>siak_hasil_tesis/siak_create">
			<?php foreach ($this->siak_mhs as $key => $value) { ?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label">NIM </label></div>
					<div class="form-group col-md-8"><input type="text" name="nim" readonly class="form-control" value="<?php echo $value['nim'];?>"></div>
				</div>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label">Nama </label></div>
					<div class="form-group col-md-8"><input type="text" readonly class="form-control" value="<?php echo $value['nama_depan'].' '.$value['nama_belakang'];?>"></div>
				</div>
			<?php } ?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nilai" class="control-label">Nilai Pembimbing</label></div>
					<div class="form-group col-md-2">
						<input style="width:100px;" type="text" readonly class="form-control" name="nilaipembimbing" id="nilaipembimbing">
					</div>
					<div class="form-group col-md-3"><label for="nilai" class="control-label">Nilai Penguji</label></div>
					<div class="form-group col-md-2">
						<input style="width:100px;" type="text" readonly class="form-control" name="nilaipenguji" id="nilaipenguji">
					</div>
					<div class="form-group col-md-2">
						<input style="width:50px;" type="button" value = "Cek" class = "btn btn-medium btn-warning " onclick="pembimbing()">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-3"><label for="nilai" class="control-label">Nilai </label></div>
					<div class="form-group col-md-8"><input style="width:100px;" type="text" readonly class="form-control" name="nilai" id="nilai"></div>
				</div>
				<div class="row">
					<div class="form-group col-md-3"><label for="nilai" class="control-label">Keterangan </label></div>
					<div class="form-group col-md-8"><textarea name="keterangan" class="form-control"></textarea></div>
				</div>
				<div class="row">
					<div class="form-group col-md-3"><label for="nilai" class="control-label">Hasil </label></div>
					<div class="form-group col-md-8">
						<select name="hasil" class="form-control">
							<option value="1">Diterima</option>
							<option value="2">Tidak Diterima</option>
						</select>
					</div>
				</div>
				<br />
<!--===================================================================================-->
<!--=========================================================================================-->
<!--===================================================================================-->
				<div id="tabs">
					<ul>
						<?php if($this->siak_pembimbing1 != NULL){ ?>
							<li><a href="#tabs-1">Pembimbing 1</a></li>
						<?php } ?>
						<?php if($this->siak_pembimbing2 != NULL){ ?>
							<li><a href="#tabs-2">Pembimbing 2</a></li>
						<?php } ?>
						<?php if($this->siak_pembimbing3 != NULL){ ?>
							<li><a href="#tabs-3">Pembimbing 3</a></li>
						<?php } 
						$urut=1;$xx=4;
						foreach($this->all_penguji as $pe =>$row){
								echo "<li><a href='#tabs-".$xx."'>Penguji ".$urut."</a></li>";
							$urut++;
							$xx++;
						}
						?>
					</ul>
				<hr />
				<div id="tabs-1" style="margin:30px;">
			<?php 
				if($this->siak_pembimbing1 != NULL){ 
					foreach($this->siak_pembimbing1 as $key => $value){
			?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label">Dosen Pembimbing 1 </label></div>
					<div class="form-group col-md-8">
						<label class="control-label">: <?php echo $value['nama'];?></label>
						<input type="hidden" readonly class="form-control" value="<?php echo $value['nip'];?>">
					</div>
				</div>
			<?php 
					} 
					$i = 1;
					foreach($this->siak_komponen as $key => $valu){
			?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label">Komponen</label></div>
					<div class="form-group col-md-8">
						<label class="control-label">: <?php echo $valu['komponen'];?></label>
					</div>
					<div class="form-group col-md-2">
						<input readonly type="text" id="komp1<?php echo $i; ?>" class="form-control" value="<?php echo $valu['persentase'];?>" />
						<?php echo $valu['persentase'];?> %
					</div>
					<div class="form-group col-md-2">
						<input readonly type="hidden" id="hasilkomponen1<?php echo $i; ?>" class="hasilkomponen1 form-control" />
					</div>
				</div>
			<?php
					foreach($this->siak_sub_komponen[$i] as $key => $val){
			?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label"></label></div>
					<div class="form-group col-md-8">
						- <?php echo $val['sub_komponen'];?>
					</div>
					<div class="form-group col-md-2">
						<input id="sub_komponen1<?php echo $i; ?>" type="text" class="sub_komponen1<?php echo $i; ?> form-control" onchange="updateSubKomponen1();" />
					</div>
				</div>
			<?php 
					}
					$i++;
					}
			?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label"></label></div>
					<div style="padding-top:10px;" class="form-group col-md-8" align="right">
					<label>HASIL : </label>
					</div>
					<div class="form-group col-md-2">
						<input id="semua1" type="text" class="semuapembimbing form-control" readonly />
					</div>
				</div>
			<?php
				}
			?>
				</div>
				<div id="tabs-2" style="margin:30px;">
			<?php 
				if($this->siak_pembimbing2 != NULL){ 
					foreach($this->siak_pembimbing2 as $key => $value){
			?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label">Dosen Pembimbing 2 </label></div>
					<div class="form-group col-md-8">
						<label class="control-label">: <?php echo $value['nama'];?></label>
						<input type="hidden" readonly class="form-control" value="<?php echo $value['nip'];?>">
					</div>
				</div>
			<?php 
					} 
					$i = 1;
					foreach($this->siak_komponen as $key => $valu){
			?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label">Komponen</label></div>
					<div class="form-group col-md-8">
						<label class="control-label">: <?php echo $valu['komponen'];?></label>
					</div>
					<div class="form-group col-md-2">
						<input readonly type="text" id="komp2<?php echo $i; ?>" class="form-control" value="<?php echo $valu['persentase'];?>" />
					</div>
					<div class="form-group col-md-2">
						<input readonly type="hidden" id="hasilkomponen2<?php echo $i; ?>" class="hasilkomponen2 form-control" />
					</div>
				</div>
			<?php
					foreach($this->siak_sub_komponen[$i] as $key => $val){
			?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label"></label></div>
					<div class="form-group col-md-8">
						- <?php echo $val['sub_komponen'];?>
					</div>
					<div class="form-group col-md-2">
						<input id="sub_komponen2<?php echo $i; ?>" type="text" class="sub_komponen2<?php echo $i; ?> form-control" onchange="updateSubKomponen2();" />
					</div>
				</div>
			<?php 
					}
					$i++;
					}
			?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label"></label></div>
					<div style="padding-top:10px;" class="form-group col-md-8" align="right">
					<label>HASIL : </label>
					</div>
					<div class="form-group col-md-2">
						<input id="semua2" type="text" class="semuapembimbing form-control" readonly />
					</div>
				</div>
			<?php
				}
			?>
				</div>
				<div id="tabs-3" style="margin:30px;">
			<?php 
				if($this->siak_pembimbing3 != NULL){ 
					foreach($this->siak_pembimbing3 as $key => $value){
			?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label">Dosen Pembimbing 3 </label></div>
					<div class="form-group col-md-8">
						<label class="control-label">: <?php echo $value['nama'];?></label>
						<input type="hidden" readonly class="form-control" value="<?php echo $value['nip'];?>">
					</div>
				</div>
			<?php 
					} 
					$i = 1;
					foreach($this->siak_komponen as $key => $valu){
			?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label">Komponen</label></div>
					<div class="form-group col-md-8">
						<label class="control-label">: <?php echo $valu['komponen'];?></label>
					</div>
					<div class="form-group col-md-2">
						<input readonly type="text" id="komp3<?php echo $i; ?>" class="form-control" value="<?php echo $valu['persentase'];?>" />
					</div>
					<div class="form-group col-md-2">
						<input readonly type="hidden" id="hasilkomponen3<?php echo $i; ?>" class="hasilkomponen3 form-control" />
					</div>
				</div>
			<?php
					foreach($this->siak_sub_komponen[$i] as $key => $val){
			?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label"></label></div>
					<div class="form-group col-md-8">
						- <?php echo $val['sub_komponen'];?>
					</div>
					<div class="form-group col-md-2">
						<input id="sub_komponen3<?php echo $i; ?>" type="text" class="sub_komponen3<?php echo $i; ?> form-control" onchange="updateSubKomponen3();" />
					</div>
				</div>
			<?php 
					}
					$i++;
					}
			?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label"></label></div>
					<div style="padding-top:10px;" class="form-group col-md-8" align="right">
					<label>HASIL : </label>
					</div>
					<div class="form-group col-md-2">
						<input id="semua3" type="text" class="semuapembimbing form-control" readonly />
					</div>
				</div>
			<?php
				}
			?>
				</div>
				
				<?php   $tabsurut=4; for($X=0;$X<$this->JP;$X++){ ?>
				<div id="tabs-<?php echo $tabsurut;?>" style="margin:30px;">
				<?php 
					
					$i = 1;
					foreach($this->siak_komponen as $key => $valu){
			?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label">Komponen</label></div>
					<div class="form-group col-md-8">
						<label class="control-label">: <?php echo $valu['komponen'];?></label>
					</div>
					<div class="form-group col-md-2">
						<input readonly type="text" id="komp<?php echo $tabsurut.$i; ?>" class="form-control" value="<?php echo $valu['persentase'];?>" />
					</div>
					<div class="form-group col-md-2">
						<input readonly type="hidden" id="hasilkomponen<?php echo $tabsurut.$i; ?>" class="hasilkomponen<?php echo $tabsurut; ?> form-control" />
					</div>
				</div>
			<?php
					foreach($this->siak_sub_komponen[$i] as $key => $val){
			?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label"></label></div>
					<div class="form-group col-md-8">
						- <?php echo $val['sub_komponen'];?>
					</div>
					<div class="form-group col-md-2">
						<input id="sub_komponen<?php echo $tabsurut.$i; ?>" type="text" class="sub_komponen<?php echo $tabsurut.$i; ?> form-control" onchange="updateSubKomponen(<?php echo $tabsurut; ?>);" />
					</div>
				</div>
			<?php 
					}
					$i++;
					}
			?>
				<div class="row">
					<div class="form-group col-md-3"><label for="nim" class="control-label"></label></div>
					<div style="padding-top:10px;" class="form-group col-md-8" align="right">
					<label>HASIL : </label>
					</div>
					<div class="form-group col-md-2">
						<input id="semua<?php echo $tabsurut; ?>" type="text" class="semuapenguji form-control" readonly />
					</div>
				</div>
				</div>
				<?php $tabsurut++;}?>
				</div>
				<hr />
				<div class="row">
					<div class="form-group col-md-8"><input type = "submit" value = "Insert" class = "btn btn-medium btn-primary"/></div>
					<div class="form-group col-md-3"></div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
	
	function updateSubKomponen1() {
		var total = 0;//
		<?php for($i = 1;$i <= $this->jml; $i++){ ?>
		var list = document.getElementsByClassName("sub_komponen1<?php echo $i ?>");
		var komp = jQuery("#komp1<?php echo $i ?>").val();
		var values = [];
		for(var i = 0; i < list.length; ++i) {
			values.push(parseFloat(list[i].value));
		}
		total = values.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		var jumlah = values.length;
		var decimal = total/jumlah;
		var persen = decimal*komp/100;
		var num = persen;
		var nilai = num.toFixed(2);
		document.getElementById("hasilkomponen1<?php echo $i ?>").value = nilai;
		<?php } ?>
		var total1 = 0;//
		var list1 = document.getElementsByClassName("hasilkomponen1");
		var values1 = [];
		for(var i = 0; i < list1.length; ++i) {
			values1.push(parseFloat(list1[i].value));
		}
		total1 = values1.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		hasil=total1.toFixed(2);
		document.getElementById("semua1").value = hasil;
	};
	
	function updateSubKomponen2() {
		var total = 0;//
		<?php for($i = 1;$i <= $this->jml; $i++){ ?>
		var list = document.getElementsByClassName("sub_komponen2<?php echo $i ?>");
		var komp = jQuery("#komp2<?php echo $i ?>").val();
		var values = [];
		for(var i = 0; i < list.length; ++i) {
			values.push(parseFloat(list[i].value));
		}
		total = values.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		var jumlah = values.length;
		var decimal = total/jumlah;
		var persen = decimal*komp/100;
		var num = persen;
		var nilai = num.toFixed(2);
		document.getElementById("hasilkomponen2<?php echo $i ?>").value = nilai;
		<?php } ?>
		var total1 = 0;//
		var list1 = document.getElementsByClassName("hasilkomponen2");
		var values1 = [];
		for(var i = 0; i < list1.length; ++i) {
			values1.push(parseFloat(list1[i].value));
		}
		total1 = values1.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		document.getElementById("semua2").value = total1;
	};
	
	function updateSubKomponen3() {
		var total = 0;//
		<?php for($i = 1;$i <= $this->jml; $i++){ ?>
		var list = document.getElementsByClassName("sub_komponen3<?php echo $i ?>");
		var komp = jQuery("#komp3<?php echo $i ?>").val();
		var values = [];
		for(var i = 0; i < list.length; ++i) {
			values.push(parseFloat(list[i].value));
		}
		total = values.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		var jumlah = values.length;
		var decimal = total/jumlah;
		var persen = decimal*komp/100;
		var num = persen;
		var nilai = num.toFixed(2);
		document.getElementById("hasilkomponen3<?php echo $i ?>").value = nilai;
		<?php } ?>
		var total1 = 0;//
		var list1 = document.getElementsByClassName("hasilkomponen3");
		var values1 = [];
		for(var i = 0; i < list1.length; ++i) {
			values1.push(parseFloat(list1[i].value));
		}
		total1 = values1.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		document.getElementById("semua3").value = total1;
	};
	
	function updateSubKomponen(nourut) {
		var total = 0;//
		<?php for($i = 1;$i <= $this->jml; $i++){ ?>
		var list = document.getElementsByClassName("sub_komponen"+nourut+"<?php echo $i ?>");
		var komp = jQuery("#komp"+nourut+"<?php echo $i ?>").val();
		var values = [];
		for(var i = 0; i < list.length; ++i) {
			values.push(parseFloat(list[i].value));
		}
		total = values.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		var jumlah = values.length;
		var decimal = total/jumlah;
		var persen = decimal*komp/100;
		var num = persen;
		var nilai = num.toFixed(2);
		document.getElementById("hasilkomponen"+nourut+"<?php echo $i ?>").value = nilai;
		<?php } ?>
		var total1 = 0;//
		var list1 = document.getElementsByClassName("hasilkomponen"+nourut);
		var values1 = [];
		for(var i = 0; i < list1.length; ++i) {
			values1.push(parseFloat(list1[i].value));
		}
		total1 = values1.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		document.getElementById("semua"+nourut).value = total1;
	};
	
	
	function pembimbing() {
		var totalpembimbing = 0;//
		var listpembimbing = document.getElementsByClassName("semuapembimbing");
		var valuespembimbing = [];
		for(var i = 0; i < listpembimbing.length; ++i) {
			valuespembimbing.push(parseFloat(listpembimbing[i].value));
		}
		totalpembimbing = valuespembimbing.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		var jumlahpembimbing = valuespembimbing.length;
		var decimalpembimbing = totalpembimbing/jumlahpembimbing;
		<?php $persen = $this->pembimbing; ?>
		var persenpembimbing = decimalpembimbing*<?php echo $persen; ?>/100;
		var numpembimbing = persenpembimbing;
		var nilaipembimbing = numpembimbing.toFixed(2);
		
		
		//PENGUJI
		var totalpenguji = 0;//
		var listpenguji = document.getElementsByClassName("semuapenguji");
		var valuespenguji = [];
		for(var i = 0; i < listpenguji.length; ++i) {
			valuespenguji.push(parseFloat(listpenguji[i].value));
		}
		totalpenguji = valuespenguji.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		var jumlahpenguji = valuespenguji.length;
		var decimalpenguji = totalpenguji/jumlahpenguji;
		<?php $persenpenguji = $this->penguji; ?>
		var persenpenguji = decimalpenguji*<?php echo $persenpenguji; ?>/100;
		var numpenguji = persenpenguji;
		var nilaipenguji = numpenguji.toFixed(2);
		var totalnilai=parseFloat(nilaipenguji) + parseFloat(nilaipembimbing);
		alert(totalnilai);
		if(nilaipembimbing == 'NaN' || nilaipenguji == 'NaN'){
			alert('Nilai pembimbing belum diisi');
			//document.getElementById("nilaipembimbing").value = nilaipembimbing;
		} else {
			document.getElementById("nilaipembimbing").value = nilaipembimbing;
			document.getElementById("nilaipenguji").value = nilaipenguji;
			document.getElementById("nilai").value = totalnilai;
			
		}
	};
</script>