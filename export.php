<?php
ini_set("display_errors","On");
error_reporting(E_ALL);
require_once 'PHPExcel/PHPExcel.php';
require_once 'PHPExcel/PHPExcel/IOFactory.php';

//database connection (using mysqli)
$con = mysqli_connect("localhost","icsbinco_crawler_user","hawaiTripP@$$","icsbinco_crawler");
mysqli_set_charset($con,"utf8");
if(!$con){
	echo mysqli_error($con);
	exit;
}

//create PHPExcel object
$excel = new PHPExcel();

//selecting active sheet
$excel->setActiveSheetIndex(0);

//rename sheet
$excel->getActiveSheet()->setTitle('English Words');

//populate the data
$query = mysqli_query($con,"select * from english");
$row = 4;
while($data = mysqli_fetch_object($query)){
	$excel->getActiveSheet()
		->setCellValue('A'.$row , $data->en_id)
		->setCellValue('B'.$row , $data->word)
		->setCellValue('C'.$row , $data->char_len)
		->setCellValue('D'.$row , $data->weight);
	//increment the row
	$row++;
}

//set column width
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);

//make table headers
$excel->getActiveSheet()
	->setCellValue('A1' , 'English Words') //title
	->setCellValue('A3' , 'ID')
	->setCellValue('B3' , 'Word')
	->setCellValue('C3' , 'Length')
	->setCellValue('D3' , 'Weight')
	;

//merging the title
$excel->getActiveSheet()->mergeCells('A1:D1');

//aligning
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');

//styling
$excel->getActiveSheet()->getStyle('A1')->applyFromArray(
	array(
		'font'=>array(
			'size' => 24,
		)
	)
);
$excel->getActiveSheet()->getStyle('A3:D3')->applyFromArray(
	array(
		'font' => array(
			'bold'=>true
		),
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);
//give borders to data
$excel->getActiveSheet()->getStyle('A4:D'.($row-1))->applyFromArray(
	array(
		'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			),
			'vertical' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);

//$con->set_charset("utf8");

//create new work sheet
$excel->createSheet();

//set active
$excel->setActiveSheetIndex(1);

//rename sheet
$excel->getActiveSheet()->setTitle('Telugu Words');

$query = mysqli_query($con,"select * from telugu");
$row = 4;

//make table headers
$excel->getActiveSheet()
	->setCellValue('A1' , 'Telugu Words') //title
	->setCellValue('A3' , 'ID')
	->setCellValue('B3' , 'Word')
	->setCellValue('C3' , 'Length')
	->setCellValue('D3' , 'Strength')
	->setCellValue('E3' , 'Weight')
	;

while($data = mysqli_fetch_object($query)){
	$excel->getActiveSheet()
		->setCellValue('A'.$row , $data->tel_id)
		->setCellValue('B'.$row , $data->word)
		->setCellValue('C'.$row , $data->char_len)
		->setCellValue('D'.$row , $data->strength)
		->setCellValue('E'.$row , $data->weight);
	//increment the row
	$row++;
}

//merging the title
$excel->getActiveSheet()->mergeCells('A1:E1');

//aligning
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');

//styling
$excel->getActiveSheet()->getStyle('A1')->applyFromArray(
	array(
		'font'=>array(
			'size' => 24,
		)
	)
);
$excel->getActiveSheet()->getStyle('A3:E3')->applyFromArray(
	array(
		'font' => array(
			'bold'=>true
		),
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);
//give borders to data
$excel->getActiveSheet()->getStyle('A4:E'.($row-1))->applyFromArray(
	array(
		'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			),
			'vertical' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);

//create new work sheet
$excel->createSheet();

//set active
$excel->setActiveSheetIndex(2);

//rename sheet
$excel->getActiveSheet()->setTitle('Crawled URLs');

$query = mysqli_query($con,"select * from crawlurl");
$row = 4;

while($data = mysqli_fetch_object($query)){
	$excel->getActiveSheet()
		->setCellValue('A'.$row , $data->id)
		->setCellValue('B'.$row , $data->crawledurl)
		->setCellValue('C'.$row , $data->insert_date);
	//increment the row
	$row++;
}

//set column width
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);

//make table headers
$excel->getActiveSheet()
	->setCellValue('A1' , 'Crawled URLs') //this is a title
	->setCellValue('A3' , 'ID')
	->setCellValue('B3' , 'Crawled URL')
	->setCellValue('C3' , 'Date')
	;

//merging the title
$excel->getActiveSheet()->mergeCells('A1:D1');

//aligning
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');

//styling
$excel->getActiveSheet()->getStyle('A1')->applyFromArray(
	array(
		'font'=>array(
			'size' => 24,
		)
	)
);
$excel->getActiveSheet()->getStyle('A3:C3')->applyFromArray(
	array(
		'font' => array(
			'bold'=>true
		),
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);
//give borders to data
$excel->getActiveSheet()->getStyle('A4:C'.($row-1))->applyFromArray(
	array(
		'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			),
			'vertical' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);

$fileName = 'export'.'.xlsx';

header('Content-Transfer-Encoding: binary');
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
//header('Content-Disposition: attachment; filename="export.xls"');
header('Cache-Control: max-age=0');
header('Content-Encoding: UTF-8');

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=$fileName");
header("Content-Transfer-Encoding: binary ");

//write the result to a file
$file = PHPExcel_IOFactory::createWriter($excel,'Excel2007');
//output to php output instead of filename
$file->save('php://output');

?>