<style>
     .ui-autocomplete.ui-front.ui-menu.ui-widget.ui-widget-content.ui-corner-all {
         z-index: 10000 !important;
     }
</style>
<select name='nip_pengganti' id='combobox'>
	<?php foreach ($this->dosen as $key => $value) {?>
	<option value='<?php echo $value['nip'];?>'><?php echo $value['gelar_depan']." ".$value['nama']." ".$value['gelar_blkng'];?></option>
	<?php }?>
</select>
 <script>
autoCom();
 </script>