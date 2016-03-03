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
$setWidth='A';
for($a=0;$a<9;$a++){
$objPHPExcel->getActiveSheet()->getColumnDimension($setWidth)->setWidth(15);
$setWidth++;
}


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
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); // Font Bold
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->applyFromArray($arrayStyle);

// Merge Cell
$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
$objPHPExcel->getActiveSheet()->mergeCells('A3:I3');
$objPHPExcel->getActiveSheet()->mergeCells('J1:J4');
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($judulStyle);
$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($judulStyle);
$objPHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray($judulStyle);

// Judul
$judul = "Transkrip Per Prodi";
$judul1 = "MAHASISWA UNHAN";
$judul2 = "";
$header=array('no','nim','nama','cohort','prodi_id','predikat','keterangan','tahun masuk','tahun keluar');
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', $judul)
->setCellValue('A2', $judul1)
->setCellValue('A3', $judul2)
	$alpabet='A';
	foreach($header as $row){
		$cell=$alpabet."4";
		->setCellValue($cell, $row)
$alpabet++;		
	};

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
 
$rowNya = 5;
$no = 0;
foreach($this->data as $key => $row){
    if ($no%2==1){
	    $bg = $bgcolor;
	} else {
	    $bg = $bgcolor2;
	}
    //endOF
$no = $no +1;
// Call bgcolor for Repeating
$objPHPExcel->getActiveSheet()->getStyle("A$rowNya:I$rowNya")->applyFromArray($bg);
// endOF
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("A$rowNya", $no)
->setCellValueExplicit("B$rowNya", $row['nim'], PHPExcel_Cell_DataType::TYPE_STRING) //untuk data numerik yang panjang 
->setCellValue("C$rowNya", $row['nama_depan'].' '.$row['nama_belakang'])
->setCellValue("D$rowNya", $row['ipk'])
->setCellValue("E$rowNya", $row['prodi_id'])
->setCellValue("F$rowNya", $row['predikat'])
->setCellValue("G$rowNya", $row['ket'])
->setCellValue("H$rowNya", $row['tahun_lulus'])
->setCellValue("I$rowNya", $row['tahun_masuk'])
;
$rowNya = $rowNya + 1;
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