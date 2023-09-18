<?
  include "../lib/seto.php";
  include "../lib/PHPExcel/Classes/PHPExcel.php";

  $arr_sum = explode("|",$sums);
  
  $fname = "생산성_합산결과";
  $re = sql_query($sql);
  
  
  $phpExcel = new PHPExcel();
  $phpExcel->setActiveSheetIndex(0);
  $phpExcel->getActiveSheet()
  ->setCellValue("A1","{$toyear}년")
  ->setCellValue("A2","1월")
  ->setCellValue("B2","2월")
  ->setCellValue("C2","3월")
  ->setCellValue("D2","4월")
  ->setCellValue("E2","5월")
  ->setCellValue("F2","6월")
  ->setCellValue("G2","7월")
  ->setCellValue("H2","8월")
  ->setCellValue("I2","9월")
  ->setCellValue("J2","10월")
  ->setCellValue("K2","11월")
  ->setCellValue("L2","12월")
  ->setCellValue("A3",$arr_sum[0])
  ->setCellValue("B3",$arr_sum[1])
  ->setCellValue("C3",$arr_sum[2])
  ->setCellValue("D3",$arr_sum[3])
  ->setCellValue("E3",$arr_sum[4])
  ->setCellValue("F3",$arr_sum[5])
  ->setCellValue("G3",$arr_sum[6])
  ->setCellValue("H3",$arr_sum[7])
  ->setCellValue("I3",$arr_sum[8])
  ->setCellValue("J3",$arr_sum[9])
  ->setCellValue("K3",$arr_sum[10])
  ->setCellValue("L3",$arr_sum[11]);

  

  
  
  $fname = iconv("UTF-8","EUC-KR",$fname);
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename='.$fname.'.xlsx');
  header('Cache-Control: max-age=0');

  $ww = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
  ob_end_clean();
  $ww->save('php://output');
  exit;

  


?>