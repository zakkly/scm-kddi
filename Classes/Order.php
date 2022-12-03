<?php
namespace Order;
require_once(__DIR__."/manage.php");
use Manage\manage;



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Spreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls as XlsReader;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as Reader;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment as Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border as Border;
use PhpOffice\PhpSpreadsheet\Style\Fill as Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\Cell as Cell;

class Order extends manage{
  function __construct(){
    parent::__construct();
  }
  
  //住所検索系
  function SerachAdress($table="",$detailTabel="",$r=""){
    $query = [];
    #print_r($_POST);
    foreach($_POST as $k => $v){
      switch($k){
        case "mode":
        case "target":
        case "num_rows":
        case "count":
        case "start":
        case "action":
        case "templ":
          break;
        default:
          if(!empty($v)){
            if(is_array($v)){
              $query[] = "(address.$k='".implode("' OR address.$k='",$v)."')";
            }else{
              $query[] = "address.$k='$v'";
            }
          }
      }
    }
    if(!empty($query)){
      $query = " AND ".implode(" AND ", $query);
    }else{
      $query = "";
    }
    
    if(!empty($_POST["count"])){
      $sql = "select T.user_id from $table as U,$detailTabel as T,Company as C where U.id=T.user_id AND C.code=T.GroupIdList$query";
    }else{
      $limit = (!empty($_POST["start"]) && $_POST["num_rows"]) ? " LIMIT {$_POST['start']},{$_POST['num_rows']}" : "";
      $sql = "select address.*,c.name as CompanyName from $table as address,Company as c WHERE c.code=address.Company $query order by address.code DESC$limit ";
    }
    #echo $sql;
    $data = $this->GetResult($sql);
    if($data){
      if(!empty($_POST["count"])){
        $data = $this->DecodeData($data);
        $data = ["count" => count($data)];
      }else{
        $data = $this->DecodeData($data);
      }
      
      if(empty($r)){
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($data);
      }else{
        return $data;
      }
    }

  }

  function MakeOrderDataValue($OrderTable="",$data=""){
    if(empty($data)){
      return false;
    }
    
    #print_r($data);
    #return false;
    foreach($data as $key => $val){
      foreach($OrderTable as $k => $v){
        $add = "";
        switch($v["type"]){
          case "adress":
            if(!is_numeric($data[$key][$v['type']])){
              break;
            }
            $sql = "select a.*,p.pname as pref from Adress as a,Pref as p WHERE code={$data[$key][$v['type']]} AND p.pcode=a.pref";
            #echo $sql."\n";
            #exit;
            if(empty($add)){
              $add = $this->GetResult($sql);
              if(!empty($add->num_rows)){
                $add = $this->DecodeData($add);
                #print_r($add);
              }
            }
            if(!is_array($v["target"])){
              $data[$key][$k] = $add[0][$v["target"]];
            }else{
              foreach($v["target"] as $ks => $vs){
                $data[$key][$k] .= $add[0][$vs];
              }
            }
            #print_r($add);
            #exit;
            $data[$key]["zip"] = $add[0]["zip"];
            $data[$key]["adress"] = $add[0]["pref"].$add[0]["add1"].$add[0]["add2"];
            $data[$key]["tel"] = $add[0]["tel1"]."-".$add[0]["tel2"]."-".$add[0]["tel3"];
            break;
            
          case "GroupIdList":
            $sql = "select * from Company WHERE code={$data[$key][$v['type']]}";
            #echo $sql."\n";
            $com = $this->GetResult($sql);
            if($com){
              $com = $this->DecodeData($com);
              $data[$key][$k] = $com[0]["name"];
            }
            break;
            
          case "user":
            $sql = "select * from users WHERE email={$data[$key][$v['type']]}";
            $com = $this->GetResult($sql);
            if($com){
              $com = $this->DecodeData($com);
              $data[$key][$k] = $com[0]["first_name"]." ".$com[0]["last_name"];
            }
            break;
            
          case "select":
            $data[$key][$k."_type"] = $data[$key][$k];
            $data[$key][$k] = $v["item"][$data[$key][$k]];
            break;
            
          default:
            $data[$key][$k] = $data[$key][$k];
        }
      }

    }
    if(count($data) == 1){
      $data = $data[0];
    }
    #print_r($data);
    return $data;
    
  }
  
  function DeleteItemSetData($set=""){
    #print_r($_POST);
    $sql = "DELETE FROM SetItemRegister WHERE code={$_POST['code']}";
    $this->GetResult($sql);
    $sql = "DELETE FROM SetItemValue WHERE item_id={$_POST['code']}";
    $this->GetResult($sql);
    #exit;
  }

  function ExcelDownload($data="",$OrderTable=''){
    if(empty($data)){
      return false;
    }
    //テンプレートファイルを指定
    $filePath = __DIR__."/../templates/OrderTemplate2.xlsx";
    //テンプレートファイルを読み込み
    $reader = new Reader();
    //オブジェクトに読み込む
    $spreadsheet = $reader->load($filePath);
    
      
    //住所
    $data = [$this->MakeOrderDataValue($OrderTable,$data)];
    #print_r($data);
    $fileName = time().".xlsx";
    foreach($data as $k => $v){
      #print_r($v);
      #exit;
      $clonedWorksheet = clone $spreadsheet->getSheetByName('temp'); //テンプレートシートをコピー
      $clonedWorksheet->setTitle($v["title"]); //受注番号をシート名にする
      $spreadsheet->addSheet($clonedWorksheet); //シートをブックに挿入
      
      #print_r($v);
      #exit;
      #echo $sql;
      $r = $this->GetResult($sql);
      if(!empty($r->num_rows)){
        $r = $this->DecodeData($r);
        $v["adress"] = $r["pref"].$r["add1"].$r["add2"];
        $v["zip"] = $r["zip"];
        $v["tel"] = $v["tel1"].$v["tel2"].$v["tel3"];
        #$v["adressName"] = $v["destination"];
      }
      
      #echo $v["status"];
      #exit;
      #print_r($v);
      #exit;
      //シートに値を入れていく
      $sheet = $spreadsheet->setActiveSheetIndexByName($v["title"]); //シート名定義
      #echo $v["regist"];
#      $sheet->setCellValue('C2', $v["code"]); //発注No
#      $sheet->setCellValue('E2', $v["regist"]); //発注日
#      $sheet->setCellValue('G2', $v["status"]); //ステータス
      $sheet->setCellValue('F5', $v["OrderDate"]." ".$this->OrderTime[$v["OrderTime"]]); //希望配送日
#      $sheet->setCellValue('E3', $v["OrderImplementation"]); //デモ実施日
      #$sheet->setCellValue('G3', $v["SlipNumber"]); //伝票番号
#      $sheet->setCellValueExplicit('G3',$v["SlipNumber"],\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);//伝票番号

      
#      $sheet->setCellValue('C4', $v["title"]); //注文ID
#      $sheet->setCellValue('E4', $v["demo"]); //発注名
      $sheet->setCellValue('C4', $v["Company"]); //企業名
      
      $sheet->setCellValue('F5', $v["OrderDate"]); //納品日
      $sheet->setCellValue('G5', $v["OrderImplementationCollect"]); //回収日
#      $sheet->setCellValue('G5', $v["user"]); //担当者名
      
#      $sheet->setCellValue('C6', $v["zip"]); //郵便番号
      $add = $v["adress"]." ".$v["adressName"];
      $sheet->setCellValue('C4', $v["adressName"]); //送付先
      $sheet->setCellValue('C5', $v["zip"]." ".$v["adress"]); //送付先
      $sheet->getStyle("C5")->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
      
      
      $sheet->setCellValue('D5', $v["tel"]); //納品先電話番号
      $sheet->setCellValue('B138', htmlspecialchars_decode($v["OrderOther"])); //納品先電話番号
      
#      $sheet->setCellValue('C7', $v["tel"]); //電話
#      $sheet->setCellValue('E7', $v["OrderDates"]); //実施期間
#      $sheet->setCellValue('G7', $v["OrderPerson"]); //日数
      
      /*
      $range = $sheet->rangeToArray("A8:G9"); //指定の範囲を取得
      $sheet -> fromArray($range,NULL,"A10"); //指定の位置に貼り付けるs
      
      $v_range = $sheet->rangeToArray("A8:G9");
      $h_range = array_column($v_range,0);
      $sheet -> fromArray($h_range,NULL,"A8");
      $style_c = $sheet -> getStyle("A8:G9");
      $sheet -> duplicateStyle($style_c,"A10:G11"); //他の列にも適用*/
      #$this->copyRange($sheet,'A8:G9', 'A10');
      if(!empty($v["sets"])){
        #print_r($v["sets"]);
        foreach($v["sets"] as $ks => $vs){
          #print_r($vs);
          if(is_array($vs[0]["items"])){
            foreach($vs[0]["items"] as $key => $val){
              $sql = "SELECT * from ItemRegister as i,ItemValue as v WHERE i.code=v.item_id AND i.code=$key order by i.code DESC";
              #echo $sql."\n";
              $r = $this->GetResult($sql);
              if(!empty($r->num_rows)){
                #$r = $this->DecodeData($r);
                $arr = [];
                #print_r($r);
                foreach($r as $key1 => $val1){
                  #print_r($val1);
                  foreach($val1 as $key2 => $val2){
                    #echo $key2;
                    $arr[$key2] = $val2;
                  }
                  $arr[$val1['item_title']] = $val1['item_value'];
                }
                #print_r($arr);
                #echo $vs["order_____{$arr['code']}"];
                $arr["number"] = $vs[0]["number"]*$vs[0]["order_____{$arr['code']}"];
                #print_r($arr);
                $v["items"][][] = $arr;
              }
            }
            #echo $sql;
          }
        }
        
      }
      
      #print_r($v);
      #exit;
      
      $this->SerItemCells($sheet,0,$v["items"]);



      /*
      //シートに値を入れていく
      $sheet->setCellValue('C2', $v["OrderDate"]); //納品日
      $sheet->setCellValue('E2', $v["OrderImplementation"]); //開催日
      $sheet->setCellValue('G2', $v["Company"]."/".$v["user"]); //担当者名
      $sheet->setCellValue('C3', $v["zip"]); //納品先郵便番号
      $sheet->setCellValue('D3', $v["adress"]); //納品先住所
      $sheet->setCellValue("F3", $v["adressName"]); //納品先名
      $sheet->setCellValue('C4', $v["adressTel"]); //納品先電話番号
      $sheet->setCellValue('E4', $v["OrderDates"]); //実施機関
      $sheet->setCellValue("G4", $v["OrderPerson"]); //日数*/
    }
    
    #exit;
    // ダウンロード
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$fileName.'"');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: cache, must-revalidate');
    header('Pragma: public');
    
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    /*
    // スプレッドシートを作成
    $spreadsheet = new Spreadsheet();
    
    // ファイルのプロパティを設定
    $spreadsheet->getProperties()
                ->setTitle("タイトル");
    
    // シート作成
    $spreadsheet->getActiveSheet('sheet1')->UnFreezePane();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle("シートタイトル");
    
    // 値を設定
    $sheet->setCellValue('A1', 'Hello');
    $sheet->setCellValue('B1', 'PhpSpreadsheet');
    $sheet->setCellValue('C1', 'World');
    
    // テキストの中央寄せ
    $sheet->getStyle('A1:B1')->applyFromArray(['alignment'=>['horizontal'=>Alignment::HORIZONTAL_CENTER]]);
    
    // 枠線を設定
    $sheet->getStyle('B1')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN);
    
    // 列の横幅を設定
    $sheet->getColumnDimension('B')->setWidth(8);
    
    // セルを連結
    $sheet->mergeCells('C1:D1');
    
    // テキストの縦寄せ
    $sheet->getStyle('C1:D1')->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
    
    // テキストの折り返しを設定
    $sheet->getStyle('C1')->getAlignment()->setWrapText(true);
    
    // 配列の形で値を設定
    $dataList = [
        ['Happy Bingo!'],
        ['B', 'I', 'N', 'G', 'O'],
        [26, 15, 18, 17, 13],
        ['6', '11', 2, 5, '14'],
        [1, 8, NULL, 4, 19],
        [21, 27, 3, 20, 24],
        [16, 22, 23, 25, 12],
    ];
    $sheet->fromArray($dataList, NULL, 'C6', true);
    
    // バッファをクリア
    ob_end_clean();
    
    $fileName = "sample.xlsx";
    
    // ダウンロード
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$fileName.'"');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: cache, must-revalidate');
    header('Pragma: public');
    
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');*/
  
  }
  
  function SerItemCells($sheet="",$num,$items=[]){
    if(empty($sheet)){return false;}
    if(empty($items)){return false;}
    
    
    $alp = range('A', 'Z');
    $start = $alp[0];
    $StartRow = 7;
    $novelties = 92;
    $EndRow = $StartRow+(round(count($items)/2))-1;
    #print_r($items);
    #echo count($items);
    #echo $EndRow;
    #exit;
    
    $unit = $this->SetUnitType();
    
    //行の高さを設定
#    $sheet->getRowDimension($StartRow)->setRowHeight(24);
#    $sheet->getRowDimension($EndRow)->setRowHeight(24);
    //左のセルを結合
#    $sheet->mergeCells("$start$StartRow:$start$EndRow");
    //中央揃えにする
#    $sheet->getStyle("$start$StartRow")->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
#    $sheet->getStyle("$start$StartRow")->getAlignment()->setVertical( Alignment::VERTICAL_CENTER ); // 中央揃え
    //左のセルの背景色
 #   $sheet->getStyle("$start$StartRow")->getFill()->setFillType( Fill::FILL_SOLID )->getStartColor()->setRGB( 'fde0d0' );
    //罫線
#    $sheet->getStyle("$start$StartRow:$start$EndRow")->getBorders()->getOutline()->setBorderStyle( Border::BORDER_MEDIUM ); // 下：太線
#   $sheet->setCellValue("$start$StartRow", "資材"); //注文ID
    
    $count=0;
    #print_r($items);
    #exit;
    
    
    foreach($items as $k => $v){
      $count++;
      if($v[0]["category"] == 401){
        $novelties++;
        #print_r($v);
        $startColl = $alp[$num].$novelties;
        #$StartRow = (empty($count%2)) ? $StartRow+1 : $StartRow;
  #      $sheet->getStyle($startColl)->getFill()->setFillType( Fill::FILL_SOLID )->getStartColor()->setRGB( 'd3d3d3' );
        $sheet->getStyle($startColl)->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
        $sheet->getStyle($startColl)->getAlignment()->setVertical( Alignment::VERTICAL_CENTER ); // 中央揃え
        $sheet->setCellValue($startColl, " "); //注文ID
        
        $Cell = $alp[$num+1].($novelties);
        $sheet->getStyle($Cell)->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
        $sheet->getStyle($Cell)->getAlignment()->setVertical( Alignment::VERTICAL_CENTER ); // 中央揃え
        $sheet->setCellValue($Cell, $v[0]["ItemNum"]); //管理№
        
        $Cell = $alp[$num+2].($novelties);
#        $sheet->getStyle($Cell)->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
        $sheet->getStyle($Cell)->getAlignment()->setVertical( Alignment::VERTICAL_CENTER ); // 中央揃え
        $sheet->setCellValue($Cell, htmlspecialchars_decode($v[0]["name"])); //注文ID
        
        $Cell = $alp[$num+5].($novelties);
        $sheet->getStyle($Cell)->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
        $sheet->getStyle($Cell)->getAlignment()->setVertical( Alignment::VERTICAL_CENTER ); // 中央揃え
        $sheet->setCellValue($Cell, $v[0]["number"].$unit[$v[0]["unit"]]["name"]); //注文ID
        #$sheet->getStyle("$startColl:$Cell")->getBorders()->getOutline()->setBorderStyle( Border::BORDER_THIN ); // 下：太線
      }else{
        $StartRow++;
        $startColl = $alp[$num].$StartRow;
        #$StartRow = (empty($count%2)) ? $StartRow+1 : $StartRow;
  #      $sheet->getStyle($startColl)->getFill()->setFillType( Fill::FILL_SOLID )->getStartColor()->setRGB( 'd3d3d3' );
        $sheet->getStyle($startColl)->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
        $sheet->getStyle($startColl)->getAlignment()->setVertical( Alignment::VERTICAL_CENTER ); // 中央揃え
        $sheet->setCellValue($startColl, " "); //注文ID
        
        $Cell = $alp[$num+1].($StartRow);
#       $sheet->getStyle($Cell)->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
        $sheet->getStyle($Cell)->getAlignment()->setVertical( Alignment::VERTICAL_CENTER ); // 中央揃え
        $sheet->setCellValue($Cell, $v[0]["ItemNum"]); //管理№
        
        $Cell = $alp[$num+2].($StartRow);
#        $sheet->getStyle($Cell)->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
        $sheet->getStyle($Cell)->getAlignment()->setVertical( Alignment::VERTICAL_CENTER ); // 中央揃え
        $sheet->setCellValue($Cell, $v[0]["name"]); //注文ID
        
        $Cell = $alp[$num+5].($StartRow);
        $sheet->getStyle($Cell)->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
        $sheet->getStyle($Cell)->getAlignment()->setVertical( Alignment::VERTICAL_CENTER ); // 中央揃え
        $sheet->setCellValue($Cell, $v[0]["number"].$unit[$v[0]["unit"]]["name"]); //注文ID
#        $sheet->getStyle("$startColl:$Cell")->getBorders()->getOutline()->setBorderStyle( Border::BORDER_THIN ); // 下：太線
      }
      
      #echo $startColl."\n";
    }
    
    #exit;

    
    
    
  }
  
  
  function copyRange( Worksheet $sheet, $srcRange, $dstCell) {

    // Validate source range. Examples: A2:A3, A2:AB2, A27:B100
    if( !preg_match('/^([A-Z]+)(\d+):([A-Z]+)(\d+)$/', $srcRange, $srcRangeMatch) ) {
        // Wrong source range
        return;
    }
    // Validate destination cell. Examples: A2, AB3, A27
    if( !preg_match('/^([A-Z]+)(\d+)$/', $dstCell, $destCellMatch) ) {
        // Wrong destination cell
        return;
    }

    $srcColumnStart = $srcRangeMatch[1];
    $srcRowStart = $srcRangeMatch[2];
    $srcColumnEnd = $srcRangeMatch[3];
    $srcRowEnd = $srcRangeMatch[4];

    $destColumnStart = $destCellMatch[1];
    $destRowStart = $destCellMatch[2];

    // For looping purposes we need to convert the indexes instead
    // Note: We need to subtract 1 since column are 0-based and not 1-based like this method acts.

    $srcColumnStart = Cell::columnIndexFromString($srcColumnStart) - 1;
    $srcColumnEnd = Cell::columnIndexFromString($srcColumnEnd) - 1;
    $destColumnStart = Cell::columnIndexFromString($destColumnStart) - 1;

    $rowCount = 0;
    for ($row = $srcRowStart; $row <= $srcRowEnd; $row++) {
        $colCount = 0;
        for ($col = $srcColumnStart; $col <= $srcColumnEnd; $col++) {
            $cell = $sheet->getCellByColumnAndRow($col, $row);
            $style = $sheet->getStyleByColumnAndRow($col, $row);
            $dstCell = Cell::stringFromColumnIndex($destColumnStart + $colCount) . (string)($destRowStart + $rowCount);
            $sheet->setCellValue($dstCell, $cell->getValue());
            $sheet->duplicateStyle($style, $dstCell);

            // Set width of column, but only once per row
            if ($rowCount === 0) {
                $w = $sheet->getColumnDimensionByColumn($col)->getWidth();
                $sheet->getColumnDimensionByColumn ($destColumnStart + $colCount)->setAutoSize(false);
                $sheet->getColumnDimensionByColumn ($destColumnStart + $colCount)->setWidth($w);
            }

            $colCount++;
        }

        $h = $sheet->getRowDimension($row)->getRowHeight();
        $sheet->getRowDimension($destRowStart + $rowCount)->setRowHeight($h);

        $rowCount++;
    }

    foreach ($sheet->getMergeCells() as $mergeCell) {
        $mc = explode(":", $mergeCell);
        $mergeColSrcStart = Cell::columnIndexFromString(preg_replace("/[0-9]*/", "", $mc[0])) - 1;
        $mergeColSrcEnd = Cell::columnIndexFromString(preg_replace("/[0-9]*/", "", $mc[1])) - 1;
        $mergeRowSrcStart = ((int)preg_replace("/[A-Z]*/", "", $mc[0]));
        $mergeRowSrcEnd = ((int)preg_replace("/[A-Z]*/", "", $mc[1]));

        $relativeColStart = $mergeColSrcStart - $srcColumnStart;
        $relativeColEnd = $mergeColSrcEnd - $srcColumnStart;
        $relativeRowStart = $mergeRowSrcStart - $srcRowStart;
        $relativeRowEnd = $mergeRowSrcEnd - $srcRowStart;

        if (0 <= $mergeRowSrcStart && $mergeRowSrcStart >= $srcRowStart && $mergeRowSrcEnd <= $srcRowEnd) {
            $targetColStart = Cell::stringFromColumnIndex($destColumnStart + $relativeColStart);
            $targetColEnd = Cell::stringFromColumnIndex($destColumnStart + $relativeColEnd);
            $targetRowStart = $destRowStart + $relativeRowStart;
            $targetRowEnd = $destRowStart + $relativeRowEnd;

            $merge = (string)$targetColStart . (string)($targetRowStart) . ":" . (string)$targetColEnd . (string)($targetRowEnd);
            //Merge target cells
            $sheet->mergeCells($merge);
        }
    }
  }

  
  
  //メール送信関数
  function MialSender($from="",$sendto="",$title="",$contnents=""){
    if(empty($sendto)){return false;}
    if(empty($contnents)){return false;}
    
    //エラーメッセージ用日本語言語ファイルを読み込む場合（25行目の指定も必要）
    require __DIR__.'/../vendor/phpmailer/phpmailer/language/phpmailer.lang-ja.php';
    
    //言語、内部エンコーディングを指定
    mb_language("japanese");
    mb_internal_encoding("UTF-8");
     
    // インスタンスを生成（引数に true を指定して例外 Exception を有効に）
    $mail = new PHPMailer(true);
     
    //日本語用設定
    $mail->CharSet = "utf8";
    $mail->Encoding = "8bit";
     
    //エラーメッセージ用言語ファイルを使用する場合に指定
    $mail->setLanguage('ja', __DIR__.'/../vendor/phpmailer/phpmailer/language/');


    try {
      //サーバの設定
    #  $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // デバグの出力を有効に（テスト環境での検証用）
      $mail->isSMTP();   // SMTP を使用
      $mail->Host       = _MAIL_SMTP_;  // SMTP サーバーを指定
      $mail->SMTPAuth   = true;   // SMTP authentication を有効に
      $mail->Username   = _MAIL_USR_;  // SMTP ユーザ名
      $mail->Password   = _MAIL_PWD_;  // SMTP パスワード
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // 暗号化を有効に
      $mail->Port       = 465;  // TCP ポートを指定
     
      //受信者設定 
      //※名前などに日本語を使う場合は文字エンコーディングを変換
      //差出人アドレス, 差出人名
      $mail->setFrom($from, mb_encode_mimeheader(_SITE_TITLE_));  
      //受信者アドレス, 受信者名（受信者名はオプション）
      $mail->addAddress($sendto); 
      //追加の受信者（受信者名は省略可能なのでここでは省略）
    #  $mail->addAddress('someone@gmail.com'); 
      //返信用アドレス（差出人以外に別途指定する場合）
      #$mail->addReplyTo('info@zakkly.com', mb_encode_mimeheader("お問い合わせ")); 
      //Cc 受信者の指定
    #  $mail->addCC('foo@example.com'); 
      
      //コンテンツ設定
      $mail->isHTML(true);   // HTML形式を指定
      //メール表題（文字エンコーディングを変換）
      $mail->Subject = mb_encode_mimeheader($title); 
      //HTML形式の本文（文字エンコーディングを変換）
      $mail->Body  = $contnents;  
      //テキスト形式の本文（文字エンコーディングを変換）
      #$mail->AltBody = $contnents; 
     
      $mail->send();  //送信
    } catch (Exception $e) {
      //エラー（例外：Exception）が発生した場合
      echo "メール送信に失敗しました {$mail->ErrorInfo}";
    }

  }
  
  
  //ランダム関数
  public static function random($length = 16)
  {
      $string = '';

      while (($len = strlen($string)) < $length) {
          $size = $length - $len;

          $bytes = random_bytes($size);

          $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
      }

      return $string;
  }

  
  //ステータスごとに処理をする
  function StatusChange(){
    if(empty($_POST["status"])){return false;}
    if(empty($_POST["code"])){return false;}
    require __DIR__."/config/Order/Management.php";
    #print_r($form);
    
    switch($_POST["status"]){
      //新規受注→受注確定
      case "1":
        $_POST["mode"] = "modal";
        //オーダー情報取得
        $data = $this->SerachItems($form,$SerachTable,$SerachdetailTabel,[],1);
        $_POST["d"] = $this->MakeOrderDataValue($OrderTable,$data);
        
        //減算処理
        //まずは単品商品
        if(!empty($_POST["d"]["items"])){
          foreach($_POST["d"]["items"] as $k => $v){
            $stock = $v[0]["stock"] - $v[0]["number"];
            if(!empty($v[0]["minimum"]) && $stock <$v[0]["minimum"]){
              #return  "「{$v[0]['code']}:{$v[0]['name']}」が最低最低在庫数を下回ります!\n";
            }else if($stock < 0){
              #return  "「{$v[0]['code']}:{$v[0]['name']}」が0を下回ります!\n";
            }else{
              $sql = "UPDATE ItemValue SET item_value={$stock} WHERE item_title='stock' AND item_id={$v[0]['code']}";
              $this->GetResult($sql);
            }
          }
        }
        
        //つぎはセット商品から各商品の在庫数を原産
        if(!empty($_POST["d"]["sets"])){
          foreach($_POST["d"]["sets"] as $k => $v){
            foreach($v as $key => $val){
              foreach($val["items"] as $keys => $vals){
                $sql = "SELECT * from ItemValue WHERE item_id={$vals}";
                $r = $this->GetResult($sql);
                if(!empty($r->num_rows)){
                  $res = $this->DecodeData($r);
                  $r = [];
                  foreach($res as $k => $v){
                    $r[$v["item_title"]] = $v["item_value"];
                  }
                  $res = $this->GetResult("SELECT name from ItemRegister WHERE code={$vals}");
                  $res = $this->DecodeData($res);
                  $r["name"] = $res[0]["name"];
                  #print_r($r);
                  $stock = $r["stock"] - $v[0]["number"];
                  if(!empty($r["minimum"]) && $stock <$r["minimum"]){
                    #return  "「{$val}:{$r['name']}」が最低最低在庫数を下回ります!\n";
                  }else if($stock < 0){
                    #return  "「{$val}:{$r['name']}」が0を下回ります!\n";
                  }else{
                    $sql = "UPDATE ItemValue SET item_value={$stock} WHERE item_title='stock' AND item_id={$val}";
                    $this->GetResult($sql);
                  }
                }
              }
            }
          }
        }
        
        break;
      
      //受注確定→発送完了
      case "2":
        //発送番号を取得
        $sql = "SELECT item_value FROM OrderValue WHERE item_title='SlipNumber' AND item_id={$_POST['code']}";
        #echo $sql;
        $r = $this->GetResult($sql);
        if(!empty($r->num_rows)){
          $r = $this->DecodeData($r);
          #print_r($r);
          if(empty($r)){
            return "発注番号未登録のためステータス変更出来ません";
          }
        }else{
          return "発注番号未登録のためステータス変更出来ません";
        }
#        if($v["SlipNumber"])
        break;
      
      //発送完了→到着確認
      case "3":
        break;
      
      //到着確認→資材回収
      case "4":
        break;
      
      //キャンセル
      case "5":
        break;
    }
  }

}