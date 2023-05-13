<?php
set_time_limit(0); 
header('Content-Type: text/html; charset=utf-8');

//Connect DB
// $servername = "localhost";
// $username = "cloudwor_kb";
// $password = "Nxg*z5Q5Gu3O:6";
// $db = "cloudwor_kb";
$mysqli = new mysqli('localhost','cloudwor_kb','Nxg*z5Q5Gu3O:6','cloudwor_kb');
if ($mysqli->connect_errno) {
    die( "Failed to connect to MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");

//File สำหรับ Import
$inputFileName="xxx.xlsx";

/** PHPExcel */
require_once 'PHPExcel/Classes/PHPExcel.php';

/** PHPExcel_IOFactory - Reader */
include 'PHPExcel/Classes/PHPExcel/IOFactory.php';


$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
$objReader->setReadDataOnly(true);  
$objPHPExcel = $objReader->load($inputFileName);  

$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
$headingsArray = $headingsArray[1];

$r = -1;
$namedDataArray = array();
for ($row = 2; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        foreach($headingsArray as $columnKey => $columnHeading) {
            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
        }
    }
}
$date = date("Y-m-d");
foreach ($namedDataArray as $resx) {
    echo $resx['BR_CODE'].' - '.$resx['BR_NAME'].'<br>';
    $sql = mysqli_query($mysqli,"SELECT br_code FROM kb_branch Where br_code = '".$resx['BR_CODE']."'"); 
    $rs = mysqli_fetch_assoc($sql);
    if($rs['br_code']==$resx['BR_CODE']){
        $sql = mysqli_query($mysqli,"UPDATE kb_branch SET  
            br_name='".$resx['BR_NAME']."',
            br_date='$date' 
            Where br_code = '".$resx['BR_CODE']."' ");
    }else{
        $query = " INSERT INTO kb_branch (br_code,br_name,br_date)
        VALUES('".$resx['BR_CODE']."','".$resx['BR_NAME']."','$date')";
        $res_i = $mysqli->query($query);
    }
}


?>