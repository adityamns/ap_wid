<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset = "utf-8">
	<title>Belum ada judul</title>
	<link rel="icon" type="image/png" href="<?=URL?>siak_public/siak_images/unhan.png" />
	<?php
	
	
	$css = explode(',', CSS);
	foreach ($css as $key) { 
	  echo '<link rel="stylesheet" type="text/css" href="'.URL.''.$key.'">'."\n";
	}
	
	$js = explode(',', JS);
	foreach ($js as $key) { 
	  echo '<script type="text/javascript" src="'.URL.''.$key.'"></script>'."\n"; 
	}
	
	
	if (isset($this->siak_css)) foreach ($this->siak_css as $key) { 
	    echo '<link rel="stylesheet" type="text/css" href="'.URL.''.$key.'">'."\n"; 
	}
	if (isset($this->siak_js)) foreach ($this->siak_js as $key) { 
	    echo '<script type="text/javascript" src="'.URL.''.$key.'"></script>'."\n"; 
	}
	?>
	<style >
	body {
	  background-color: #FFFFFF !important;
	}
	</style >
	
</head>
<body>
<div class="span4">
	<div class="control-group">
		<label class="control-label" for="lastName">Semester</label>
		<div class="controls">
			<select id="semester" link="<?php echo URL;?>siak_rencana_studi/siak_cek" name="semester" class="m-wrap span12" onchange="irs(this)">
				<option value="0">- Semester -</option>
				<!-- <option value="0">Semua</option> -->
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
			<option value="perp1">Perpanjangan 1</option>
			<option value="perp2">Perpanjangan 2</option>
			</select>
		</div>
	</div>
</div>
</body>
</html>