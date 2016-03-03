        <div class="row-fluid">
	<div class="span12">
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-globe"></i>Form Nilai</div>
	</div>
	<div class="portlet-body" >
        <?php foreach ($this->siak_mhs as $key => $value) { ?>
			<form id="users" name="users" class="form-horizontal" method = "post" action = "<?php echo URL;?><?php if($this->proto_sidang != NULL){ ?>siak_hasil_sidang/siak_edit_save/<?php echo $value['nim'];?><?php }else{ ?>siak_hasil_sidang/siak_create_sidang/<?php echo $value['nim'];?><?php } ?>">
            <?php } ?>
            <?php foreach ($this->siak_mhs as $key => $value) { ?>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">NIM</label>
						<div class="controls">
							<input type="text" class="m-wrap span6" name="nim" id="nim" value="<?php echo $value['nim'];?>" readonly>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Nama</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nim" id="nim" value="<?php echo $value['nama_depan']." ".$value['nama_belakang'];?>" readonly>
						</div>
					</div>
				</div>
            </div>
            <?php } ?>
            <?php if($this->proto_sidang != NULL){
				foreach($this->proto_sidang as $a => $b ){?>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nilai">Nilai Pembimbing</label>
						<div class="controls">
							<input type="text" class="m-wrap span3" name="nilaipembimbing" id="nilaipembimbing" value="<?php echo $b['pembimbing'];?>" readonly>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nilai">Nilai Penguji</label>
						<div class="controls">
							<input type="text" class="m-wrap span3" name="nilaipenguji" id="nilaipenguji" value="<?php echo $b['penguji'];?>" readonly>
						</div>
					</div>
				</div>
            </div>
            <?php if(Siak_session::siak_get('level') != "16"){ ?>
            <div class="row-fluid">
                <div class="span6">
					<div class="control-group">
						<div class="controls">
							<input type="button" class="btn green" value="CEK" onclick="pembimbing()">
						</div>
					</div>
				</div>
            </div>
            <?php } ?>
            <div class="row-fluid">
                <div class="span6">
					<div class="control-group">
						<label class="control-label" for="nilai">Nilai</label>
						<div class="controls">
							<input type="text" class="m-wrap span3" name="nilai" id="nilai" value="<?php echo $b['total']; ?>" readonly>
						</div>
					</div>
				</div>
            </div>
            <?php } ?>
            <?php }else{ ?>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nilai">Nilai Pembimbing</label>
						<div class="controls">
							<input type="text" class="m-wrap span3" name="nilaipembimbing" id="nilaipembimbing" readonly>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nilai">Nilai Penguji</label>
						<div class="controls">
							<input type="text" class="m-wrap span3" name="nilaipenguji" id="nilaipenguji" readonly>
						</div>
					</div>
				</div>
            </div>
            <?php if(Siak_session::siak_get('level') != "16"){ ?>
            <div class="row-fluid">
                <div class="span6">
					<div class="control-group">
						<div class="controls">
							<input type="button" class="btn green" value="CEK" onclick="pembimbing()">
						</div>
					</div>
				</div>
            </div>
            <?php } ?>
            <div class="row-fluid">
                <div class="span6">
					<div class="control-group">
						<label class="control-label" for="nilai">Nilai</label>
						<div class="controls">
							<input type="text" class="m-wrap span3" name="nilai" id="nilai" readonly>
						</div>
					</div>
				</div>
            </div>
            <?php } ?>
            <?php if(Siak_session::siak_get('level') != "16"){ ?>
            <div class="row-fluid">
                <div class="span6">
					<div class="control-group">
						<label class="control-label" for="nilai">Keterangan</label>
						<div class="controls">
                        <?php if($this->proto_sidang != NULL){
						foreach($this->proto_sidang as $a => $b ){?>
						<textarea name="keterangan"><?php echo $b['ket']; ?></textarea>
                        <?php }}else{ ?>
                        <textarea name="keterangan"></textarea>
                        <?php } ?>
						</div>
					</div>
				</div>
            </div>
            <?php }else{ ?>
            <div class="row-fluid">
                <div class="span6">
					<div class="control-group">
						<label class="control-label" for="nilai">Keterangan</label>
						<div class="controls">
                        <?php if($this->proto_sidang != NULL){
						foreach($this->proto_sidang as $a => $b ){?>
						<textarea name="keterangan" disabled><?php echo $b['ket']; ?></textarea>
                        <?php }}else{ ?>
                        <textarea name="keterangan" disabled></textarea>
                        <?php } ?>
						</div>
					</div>
				</div>
            </div>
            <?php } ?>
            	<?php if(Siak_session::siak_get('level') != "16"){ ?>
                <div class="row-fluid">
                	<div class='span4'>
                    <div class="control-group">
						<label class="control-label" for="nilai">Hasil</label>
                        <div class="controls">
                    	<select name="hasil" class="m-wrap span12">
							<?php if($this->proto_sidang != NULL){
							foreach($this->proto_sidang as $a => $b ){?>
                            <option value="TRUE" <?php echo $b['hasil_lulus'] == TRUE?'selected':''; ?>>Diterima</option>
                            <option value="FALSE" <?php echo $b['hasil_lulus'] == FALSE?'selected':''; ?>>Tidak Diterima</option>
                            <?php }
                            }else{ ?>
                            <option value="TRUE">Diterima</option>
							<option value="FALSE">Tidak Diterima</option>
                            <?php } ?>
						</select>
                        </div>
                    </div>
                    </div>
                </div>
                <?php }else{ ?>
                <div class="row-fluid">
                	<div class='span4'>
                    <div class="control-group">
						<label class="control-label" for="nilai">Hasil</label>
                        <div class="controls">
                    	<select name="hasil" class="m-wrap span12" disabled>
							<?php if($this->proto_sidang != NULL){
							foreach($this->proto_sidang as $a => $b ){?>
                            <option value="TRUE" <?php echo $b['hasil_lulus'] == TRUE?'selected':''; ?>>Diterima</option>
                            <option value="FALSE" <?php echo $b['hasil_lulus'] == FALSE?'selected':''; ?>>Tidak Diterima</option>
                            <?php }
                            }else{ ?>
                            <option value="TRUE">Diterima</option>
							<option value="FALSE">Tidak Diterima</option>
                            <?php } ?>
						</select>
                        </div>
                    </div>
                    </div>
                </div>
                <?php } ?>
                <?php foreach($this->judultesis_id as $judul => $tesis){ ?>
                <input type="hidden" name="judultesis_id" value="<?php echo $tesis['judultesis_id']; ?>">
                <?php } ?>
				<br />
<!--===================================================================================-->
<!--=============================PEMBIMBING=========================================-->
<!--===================================================================================-->
				<div id="tabs">
					<ul>
						<?php
						$urut_pembimbing = 1; $tabs = 1;
						for($a=1;$a<=2;$a++){
							echo "<li><a href='#tabs-".$tabs."'>Pembimbing ".$urut_pembimbing."</a></li>";
							$urut_pembimbing++;
							$tabs++;
						}
						
						$urut=1;$xx=4;
						foreach($this->all_penguji as $pe =>$row){
								echo "<li><a href='#tabs-".$xx."'>Penguji ".$urut."</a></li>";
							$urut++;
							$xx++;
						}
						?>
					</ul>
				<hr />

			<?php
			$pt = 0;
			for($a=1;$a<=2;$a++){
			?>
            <div id="tabs-<?php echo $a; ?>" style="margin:30px;">
            <?php
				if($this->siak_pembimbing[$a] != NULL){ 
					foreach($this->siak_pembimbing[$a] as $key => $value){
			?>
            <input type="hidden" name="siak_pembimbing<?php echo $a; ?>_create">
            	<div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="nim">Dosen Pembimbing <?php echo $a; ?></label>
                            <div class="controls">
                            	<label class="control-label">: <?php echo $value['nama'];?></label>
                                <input type="hidden" value="<?php echo $value['nip'];?>">
                            </div>
                        </div>
                    </div>
                </div>
			<?php 
					} 
					$i = 1;
					$k = 1;
					foreach($this->siak_komponen as $key => $valu){
			?>
            	<div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="nim">Komponen</label>
                            <div class="controls">
                            	<label class="control-label">: <?php echo $valu['komponen'];?></label>&nbsp;
                                <input readonly type="text" id="komp<?php echo $a.$i; ?>" class="m-wrap span3" value="<?php echo $valu['persentase'];?>" />
                                <input type="hidden" name="hidden_persentase<?php echo $a.$i; ?>" value="<?php echo $valu['persentase'];?>">
                                <input type="hidden" id="hasilkomponen<?php echo $a.$i; ?>" class="hasilkomponen<?php echo $a; ?> form-control" />
                            </div>
                        </div>
                    </div>
                </div>
			<?php
					foreach($this->siak_sub_komponen[$i] as $key => $val){
						if($this->proto_sidang != NULL){
							foreach($this->proto_sidang as $pro => $to){
								$explode = explode(",",$to['pembimbing'.$a]);
			?>
            	<div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="nim">- <?php echo $val['sub_komponen'];?></label>
                            <div class="controls">
                            	<label class="control-label">: </label>&nbsp;
                                <?php if(Siak_session::siak_get('level') != "16"){ ?>
                                <input type="text" id="sub_komponen<?php echo $a.$i; ?>" class="sub_komponen<?php echo $a.$i; ?> m-wrap span3" onchange="updateSubKomponen<?php echo $a; ?>();" name="nilai_komponen<?php echo $a.$k; ?>" value="<?php echo $explode[$k-1]; ?>" />
                                <?php }else{ ?>
                                <input type="text" id="sub_komponen<?php echo $a.$i; ?>" class="sub_komponen<?php echo $a.$i; ?> m-wrap span3" onchange="updateSubKomponen<?php echo $a; ?>();" name="nilai_komponen<?php echo $a.$k; ?>" value="<?php echo $explode[$k-1]; ?>" readonly />
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php
							}
					$k++;
					}else{
					?>
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label" for="nim">- <?php echo $val['sub_komponen'];?></label>
                                <div class="controls">
                                    <label class="control-label">: </label>&nbsp;
                                    <?php if(Siak_session::siak_get('level') != "16"){ ?>
                                    <input type="text" id="sub_komponen<?php echo $a.$i; ?>" class="sub_komponen<?php echo $a.$i; ?> m-wrap span3" onchange="updateSubKomponen<?php echo $a; ?>();" name="nilai_komponen<?php echo $a.$k; ?>">
                                    <?php }else{ ?>
                                    <input type="text" id="sub_komponen<?php echo $a.$i; ?>" class="sub_komponen<?php echo $a.$i; ?> m-wrap span3" onchange="updateSubKomponen<?php echo $a; ?>();" name="nilai_komponen<?php echo $a.$k; ?>" readonly>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
					$k++;
					}}
					$i++;
					}
			?>
            	<div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="nim">HASIL</label>
                            <div class="controls">
                            	<label class="control-label">: </label>&nbsp;
                                <?php
					if($this->proto_sidang != NULL){
							foreach($this->proto_sidang as $pro => $to){
								$ex_pro = explode(",",$to['hasil']);
					?>
                                <input type="text" id="semua<?php echo $a; ?>" class="semuapembimbing m-wrap span3" name="hasil_pembimbing<?php echo $a; ?>" value="<?php echo $ex_pro[$pt];$pt++; ?>" readonly />
                                <?php
					}}else{
					?>
                    <input type="text" id="semua<?php echo $a; ?>" class="semuapembimbing m-wrap span3" name="hasil_pembimbing<?php echo $a; ?>" readonly />
                    <?php	
					}
					?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php
				}
			?>
            </div>
            <?php
			}
				
				$z = 1;
				$tabsurut=4; for($X=0;$X<$this->JP;$X++){ ?>
				<div id="tabs-<?php echo $tabsurut;?>" style="margin:30px;">
				<?php  ?>
					<div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="nim">Dosen Penguji <?php echo $X+1; ?></label>
                            <div class="controls">
                            	<label class="control-label">: <?php echo $this->pengujinya[$X];?></label>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php
					$i = 1;
					$k = 1;
					foreach($this->siak_komponen as $key => $valu){
			?>
            <input type="hidden" name="siak_penguji<?php echo $X + 1; ?>_create">
            	<div class="row-fluid">
                	<div class="span6">
                    	<div class="control-group">
                        	<label class="control-label" for="nim">Komponen</label>
                            <div class="controls">
                            	<label class="control-label">: <?php echo $valu['komponen'];?></label>&nbsp;
                                <input type="text" id="komp<?php echo $tabsurut.$i; ?>" class="m-wrap span3" value="<?php echo $valu['persentase'];?>" readonly>
                                <input type="hidden" name="hidden_persentase<?php echo $tabsurut.$i; ?>" value="<?php echo $valu['persentase'];?>">
                                <input readonly type="hidden" id="hasilkomponen<?php echo $tabsurut.$i; ?>" class="hasilkomponen<?php echo $tabsurut; ?> form-control" />
                            </div>
                        </div>
                    </div>
                </div>
			<?php
					foreach($this->siak_sub_komponen[$i] as $key => $val){
						if($this->proto_sidang != NULL){
							foreach($this->proto_sidang as $pro => $to){
								$explode = explode(",",$to['penguji'.$z]);
			?>
            	<div class="row-fluid">
                	<div class="span6">
                    	<div class="control-group">
                        	<label class="control-label" for="nim">- <?php echo $val['sub_komponen'];?></label>
                            <div class="controls">
                            	<label class="control-label">: </label>&nbsp;
                                <?php if(Siak_session::siak_get('level') != "16"){ ?>
                                <input type="text" id="sub_komponen<?php echo $tabsurut.$i; ?>" class="sub_komponen<?php echo $tabsurut.$i; ?> m-wrap span3" onchange="updateSubKomponen(<?php echo $tabsurut; ?>);" name="nilai_komponen<?php echo $tabsurut.$k; ?>" value="<?php echo $explode[$k-1]; ?>">
                                <?php }else{ ?>
                                <input type="text" id="sub_komponen<?php echo $tabsurut.$i; ?>" class="sub_komponen<?php echo $tabsurut.$i; ?> m-wrap span3" onchange="updateSubKomponen(<?php echo $tabsurut; ?>);" name="nilai_komponen<?php echo $tabsurut.$k; ?>" value="<?php echo $explode[$k-1]; ?>" readonly>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php
							}
					$k++;
					}else{
			?>
            	<div class="row-fluid">
                	<div class="span6">
                    	<div class="control-group">
                        	<label class="control-label" for="nim">- <?php echo $val['sub_komponen'];?></label>
                            <div class="controls">
                            	<label class="control-label">: </label>&nbsp;
                                <?php if(Siak_session::siak_get('level') != "16"){ ?>
                                <input type="text" id="sub_komponen<?php echo $tabsurut.$i; ?>" class="sub_komponen<?php echo $tabsurut.$i; ?> m-wrap span3" onchange="updateSubKomponen(<?php echo $tabsurut; ?>);" name="nilai_komponen<?php echo $tabsurut.$k; ?>">
                                <?php }else{ ?>
                                <input type="text" id="sub_komponen<?php echo $tabsurut.$i; ?>" class="sub_komponen<?php echo $tabsurut.$i; ?> m-wrap span3" onchange="updateSubKomponen(<?php echo $tabsurut; ?>);" name="nilai_komponen<?php echo $tabsurut.$k; ?>" readonly>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php 
					$k++;
					}}
					$i++;
					}
					$x++;
			?>
            	<div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="nim">HASIL</label>
                            <div class="controls">
                            	<label class="control-label">: </label>&nbsp;
                                <?php
					if($this->proto_sidang != NULL){
							foreach($this->proto_sidang as $pro => $to){
								$ex_pro = explode(",",$to['hasil']);
					?>
                                <input type="text" id="semua<?php echo $tabsurut; ?>" class="semuapenguji m-wrap span3" name="hasil_penguji<?php echo $z; ?>" value="<?php echo $ex_pro[$pt];$pt++; ?>" readonly />
                                <?php
					}}else{
					?>
                    <input type="text" id="semua<?php echo $tabsurut; ?>" class="semuapenguji m-wrap span3" name="hasil_penguji<?php echo $z; ?>" readonly />
                    <?php	
					}
					?>
                            </div>
                        </div>
                    </div>
                </div>
				</div>
				<?php $tabsurut++;$z++;}?>
				</div>
				<hr />
                <?php if(Siak_session::siak_get('level') != "16"){ ?>
                <div class="row-fluid">
                	<div class="span6">
                    	<div class="control-group">
                            <div class="controls">
                                <input type = "submit" value = "Simpan" class = "btn green"/>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
			</form>
</div>
</div>
</div>
</div>

<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
	
	function updateSubKomponen1() {
		var total = 0;
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
		var total1 = 0;
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
		var total = 0;
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
		var total1 = 0;
		var list1 = document.getElementsByClassName("hasilkomponen2");
		var values1 = [];
		for(var i = 0; i < list1.length; ++i) {
			values1.push(parseFloat(list1[i].value));
		}
		total1 = values1.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		hasil=total1.toFixed(2);
		document.getElementById("semua2").value = hasil;
	};
	
	function updateSubKomponen3() {
		var total = 0;
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
		var total1 = 0;
		var list1 = document.getElementsByClassName("hasilkomponen3");
		var values1 = [];
		for(var i = 0; i < list1.length; ++i) {
			values1.push(parseFloat(list1[i].value));
		}
		total1 = values1.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		hasil=total1.toFixed(2);
		document.getElementById("semua3").value = hasil;
	};
	
	function updateSubKomponen(nourut) {
		var total = 0;
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
		var total1 = 0;
		var list1 = document.getElementsByClassName("hasilkomponen"+nourut);
		var values1 = [];
		for(var i = 0; i < list1.length; ++i) {
			values1.push(parseFloat(list1[i].value));
		}
		total1 = values1.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		hasil=total1.toFixed(2);
		document.getElementById("semua"+nourut).value = hasil;
	};
	
	
	function pembimbing() {
		var totalpembimbing = 0;
		var coba = [];
		<?php for($a=1;$a<=2;$a++){ ?>
			var z = document.getElementById("semua<?php echo $a; ?>");
			if(z.value != "" && z.value != "NaN"){
				coba.push(parseFloat(z.value));
			}
		<?php } ?>
		totalpembimbing = coba.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		var jumlahpembimbing = coba.length;
		var decimalpembimbing = totalpembimbing/jumlahpembimbing;
		<?php $persen = $this->pembimbing; ?>
		var persenpembimbing = decimalpembimbing*<?php echo $persen; ?>/100;
		var numpembimbing = persenpembimbing;
		var nilaipembimbing = numpembimbing.toFixed(2);
		
		
		//PENGUJI
		var totalpenguji = 0;
		var cobaz = [];
		<?php for($a=4;$a<=6;$a++){ ?>
			var z = document.getElementById("semua<?php echo $a; ?>");
			if(z.value != "" && z.value != "NaN"){
				cobaz.push(parseFloat(z.value));
			}
		<?php } ?>
		totalpenguji = cobaz.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		var jumlahpenguji = cobaz.length;
		var decimalpenguji = totalpenguji/jumlahpenguji;
		<?php $persenpenguji = $this->penguji; ?>
		var persenpenguji = decimalpenguji*<?php echo $persenpenguji; ?>/100;
		var numpenguji = persenpenguji;
		var nilaipenguji = numpenguji.toFixed(2);
		var totalnilai=parseFloat(nilaipenguji) + parseFloat(nilaipembimbing);
		var totalnilai = totalnilai.toFixed(2);
		alert(totalnilai);
		if(nilaipembimbing == 'NaN' || nilaipenguji == 'NaN'){
			alert('Nilai pembimbing belum diisi');
		} else {
			document.getElementById("nilaipembimbing").value = nilaipembimbing;
			document.getElementById("nilaipenguji").value = nilaipenguji;
			document.getElementById("nilai").value = totalnilai;
			
		}
	};
</script>