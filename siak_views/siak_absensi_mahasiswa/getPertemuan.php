<?php 
	function check($urut,$data){
		foreach($data as $v =>$row){
		
			if($row['pertemuanke'] == $urut){
				
					return array(true,$row['waktu']);
				
			}
		}
		return array(false,'');	
	}
 ?>
	<div class="controls">
		<select id="topik" link='<?php echo URL;?>siak_absensi_mahasiswa/load_jadwal'  name="topik" class="large m-wrap" onchange='getjadwal(this)'>
			<option value="0">PILIH</option>
			<?php 
			$dt = new DateTime(); 
			$now = $dt->format('d-m-Y');
			for ($i=1; $i <= 16; $i++) { 
				$hasil=check($i,$this->pertemuan);
				
				if($hasil[0]){
					$t = substr($hasil[1], 0, -15);
					$bg=($t == $now)?"style='background-color: yellow'":"";
					
					echo "<option value='".$i."' ".$bg.">Ke <b>".$i."</b> - ".$hasil[1]." </option>";
				}
				else{
					echo "<option value='".$i."'>Ke ".$i." - belum tersedia</option>";
				}
			} ?>
		</select>
	</div>
