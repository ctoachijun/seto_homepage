<?
  include "../lib/seto.php";
  include "../lib/PHPExcel/Classes/PHPExcel.php";

  $arr_cnt_sum = explode("|",$sums_cnt);
  $arr_amt_sum = explode("|",$sums_amt);
  
  $fname = "합산결과";
   
  $box = explode("#",$arr_sum);
  
  
  $head = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
  $borderStyle = array(
    'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
      )
    )
  );
  
  $phpExcel = new PHPExcel();
  $phpExcel->setActiveSheetIndex(0);
  $phpExcel->getActiveSheet()
  ->setCellValue("A1","날짜 범위 검색 결과")
  ->setCellValue("A3","건수")
  ->setCellValue("A4","금액");
  
  $phpExcel->getActiveSheet()->getStyle("A2:A4")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB("FFCCCCCC");
  $phpExcel->getActiveSheet()->getStyle("A2:A4")->applyFromArray($borderStyle);
  
  for($a=2; $a<5; $a++){
    for($i=1; $i<=count($box); $i++){
      
      if(!empty($box[$i])){
        $head_txt = $head[$i];
        $box2 = explode("/",$box[$i]);
        $title = $box2[0];
        
        $box3 = explode("|",$box2[1]);
        $count = $box3[0];
        $amount = $box3[1];
        
        if($a == 2){
          $value = $title;
          
          $phpExcel->getActiveSheet()->getStyle("{$head_txt}{$a}")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB("FFd6f4e6");
          
          
        }else if($a == 3){
          $value = $count;
        }else if($a == 4){
          $value = $amount;
        }
        
        $phpExcel->getActiveSheet()->getStyle("{$head_txt}{$a}")->applyFromArray($borderStyle);
        $phpExcel->getActiveSheet()
          ->setCellValue("{$head_txt}{$a}",$value);
          
      }
    }
  }
  
  
  
  $fname = iconv("UTF-8","EUC-KR",$fname);
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename='.$fname.'.xlsx');
  header('Cache-Control: max-age=0');

  $ww = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
  ob_end_clean();
  $ww->save('php://output');
  exit;

  


?>