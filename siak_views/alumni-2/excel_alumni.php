<?php
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
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);


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
$objPHPExcel->getActiveSheet()->getStyle('A4:D4')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A4:D4')->applyFromArray($arrayStyle);

// Merge Cell
$objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:D2');
$objPHPExcel->getActiveSheet()->mergeCells('A3:D3');
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($judulStyle);
$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($judulStyle);
$objPHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray($judulStyle);

// Judul
$judul = "LAPORAN ALUMNI";
$judul1 = "MAHASISWA UNHAN";
$judul2 = "";

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', $judul)
->setCellValue('A2', $judul1)
->setCellValue('A3', $judul2)
->setCellValue('A4', 'NO')
->setCellValue('B4', 'NIM')
->setCellValue('C4', 'NAMA')
->setCellValue('D4', 'IPK');

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
$objPHPExcel->getActiveSheet()->getStyle("A$rowNya:D$rowNya")->applyFromArray($bg);
// endOF
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("A$rowNya", $no)
->setCellValueExplicit("B$rowNya", $row['nim'], PHPExcel_Cell_DataType::TYPE_STRING) //untuk data numerik yang panjang 
->setCellValue("C$rowNya", $row['nama_depan'].' '.$row['nama_belakang'])
->setCellValue("D$rowNya", $row['ipk']);
$rowNya = $rowNya + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Laporan Alumni');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Laporan Alumni.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;