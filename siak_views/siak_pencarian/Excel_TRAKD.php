<?php
// echo "<pre>";
// var_dump($this->data);
// echo "</pre>";
// die();

error_reporting(E_ALL);
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("SIAK UNHAN")
->setLastModifiedBy("SIAK UNHAN")
->setTitle("Office 2007 XLSX Test Document")
->setSubject("Office 2007 XLSX Test Document")
->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
->setKeywords("office 2007 openxml php")
->setCategory("Test result file");

// Set Some width
$setWidth='setWidth';
$huruf='A';
	foreach($this->header_table as $row){	
		$objPHPExcel->getActiveSheet()->getColumnDimension($huruf)->setWidth(20);
		$akhirHuruf=$huruf;
	$huruf++;		
	};



// Set Some Style
$arrayStyle = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array(
            'rgb' => '999999'
        ),
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        ),
    ),
);
$judulStyle = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    ),
);
$akhir="A4:".$akhirHuruf."4";
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); // Font Bold
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle($akhir)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle($akhir)->applyFromArray($arrayStyle);

// Merge Cell
$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
$objPHPExcel->getActiveSheet()->mergeCells('A3:I3');
// $objPHPExcel->getActiveSheet()->mergeCells('J1:J4');
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($judulStyle);
$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($judulStyle);
$objPHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray($judulStyle);

// Judul
$judul = "REKAP DOSEN";
$judul1 = "UNIVESITAS PERTAHANAN";
$judul2 = "";

// Add some data
$fungsi=$objPHPExcel->setActiveSheetIndex(0);
$fungsi->setCellValue('A1', $judul);
$fungsi->setCellValue('A2', $judul1);
$fungsi->setCellValue('A3', $judul2);
	$alpabet='A';
	foreach($this->header_table as $row){
		$cell=$alpabet."4";
		$fungsi->setCellValue($cell, $row);
$alpabet++;		
	}
// ->setCellValue('B4', 'NIM')
// ->setCellValue('C4', 'NAMA')
// ->setCellValue('D4', 'COHORT')
// ->setCellValue('E4', 'PRODI_ID')
// ->setCellValue('F4', 'PREDIKAT')
// ->setCellValue('G4', 'KETERANGAN')
// ->setCellValue('H4', 'TAHUN MASUK')
// ->setCellValue('I4', 'TAHUN KELUAR');

// BGColor Style
$bgcolor = array(
    // border tabel
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        ),
    ),
    // bgcolor
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array(
            'rgb' => 'ACF3FD'
        ),
    ),
);
$bgcolor2 = array(
    // border tabel
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        ),
    ),
    // bgcolor
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array(
            'rgb' => 'FFFFFF'
        ),
    ),
);
 
$no = 0;
$rowNyaa = '5';
$jumlah=count($this->isi_table);
$urutanno=1;
foreach ($this->siak_dosen as $key => $row) {
// foreach($this->data as $key => $row){
    if ($no%2==1){
	    $bg = $bgcolor;
	} else {
	    $bg = $bgcolor2;
	}
    // endOF
$no=$no+1;
// Call bgcolor for Repeating
$cellakhir="A".$rowNyaa.":".$akhirHuruf.$rowNyaa."";
// $objPHPExcel->getActiveSheet()->getStyle($cellakhir)->applyFromArray($bg);
// endOF
$rowNya = 'A';
$fungsi=$objPHPExcel->setActiveSheetIndex(0);
$i=0;
				$query="select *from 
				(select a.*,'pendamping' as dosen from dosen_matakuliah b,matakuliah a 
					where a.kode_matkul=b.kode_matkul 
					".($this->prodi ? "AND a.prodi_id = '$this->prodi' " :"")."
					and b.dosen_utama='".$row['nip']."'
				union 
				select a.*,'utama' as dosen from dosen_matakuliah b,matakuliah a 
					where a.kode_matkul=b.kode_matkul 
					".($this->prodi ? "AND a.prodi_id = '$this->prodi' " :"")."
					and b.dosen_pendamping like '%".$row['nip']."%') as dosen 
				order by dosen desc";
				$siak_data = $this->db->siak_query("select", $query);
	foreach($siak_data as $k=>$value){
		//$cell=$rowNya.$rowNyaa;
		$fungsi->setCellValueExplicit("A$rowNyaa", $urutanno, PHPExcel_Cell_DataType::TYPE_STRING); //untuk data numerik yang panjang 
		$fungsi->setCellValueExplicit("B$rowNyaa", $value['semester'], PHPExcel_Cell_DataType::TYPE_STRING); //untuk data numerik yang panjang 
		$fungsi->setCellValueExplicit("C$rowNyaa", $value['semester'], PHPExcel_Cell_DataType::TYPE_STRING); //untuk data numerik yang panjang 
		$fungsi->setCellValueExplicit("D$rowNyaa", $value['prodi_id'], PHPExcel_Cell_DataType::TYPE_STRING); //untuk data numerik yang panjang 
		$fungsi->setCellValueExplicit("E$rowNyaa", $value['semester'], PHPExcel_Cell_DataType::TYPE_STRING); //untuk data numerik yang panjang 
		$fungsi->setCellValueExplicit("F$rowNyaa", $row['nama'], PHPExcel_Cell_DataType::TYPE_STRING); //untuk data numerik yang panjang 
		$fungsi->setCellValueExplicit("G$rowNyaa", $row['nip'], PHPExcel_Cell_DataType::TYPE_STRING); //untuk data numerik yang panjang 
		$fungsi->setCellValueExplicit("H$rowNyaa", $value['kode_matkul'], PHPExcel_Cell_DataType::TYPE_STRING); //untuk data numerik yang panjang 
		$fungsi->setCellValueExplicit("I$rowNyaa", $value['semester'], PHPExcel_Cell_DataType::TYPE_STRING); //untuk data numerik yang panjang 
		$fungsi->setCellValueExplicit("J$rowNyaa", $value['semester'], PHPExcel_Cell_DataType::TYPE_STRING); //untuk data numerik yang panjang 
		$fungsi->setCellValueExplicit("K$rowNyaa", $value['pertemuan'], PHPExcel_Cell_DataType::TYPE_STRING); //untuk data numerik yang panjang 
		//$fungsi->setCellValueExplicit($cell, $value['pertemuan'], PHPExcel_Cell_DataType::TYPE_STRING); //untuk data numerik yang panjang 
	$rowNyaa++;
	$rowNya++;
	$i++;
	$urutanno++;
	}


}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Transkrip Per Prodi');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Transkrip per Prodi.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;