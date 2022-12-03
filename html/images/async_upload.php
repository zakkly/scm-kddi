<?php
//保存先ディレクトリ
$upload_dir = dirname(__FILE__)."/";
if(empty($_FILES["file"]['name'])){
  return false;
}

//必ず正方形に成形します。
$baseLength = 500;

//ファイルネーム
$name = explode(".",$_FILES["file"]['name']);
$length = count($name)-1;
$suffix = $name[$length];
$name = $name[0].".".$suffix;


//tmp_name
$tmp_file = $_FILES["file"]['tmp_name'];
$filesCount = count($_FILES);
for($i = 0; $i < $filesCount; $i++) {
  $name = explode(".",$name);
  $name = uniqid().".".$name[1];
  move_uploaded_file($_FILES["file"]['tmp_name'], $upload_dir.$name);
  list($width, $hight) = getimagesize($upload_dir.$name); // 元の画像名を指定してサイズを取得
  $baseImage = imagecreatefromjpeg($upload_dir.$name); // 元の画像から新しい画像を作る準備
  $image = imagecreatetruecolor($baseLength, $baseLength); // サイズを指定して新しい画像のキャンバスを作成
  #$image = imagecolorallocate($image,255,255,255);
  
	/** 変換用画像の背景色を設定 */
	$img_color = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
	/** 変換用画像に背景色を塗る */
	imagefill($image, 0, 0, $img_color);

  //数値初期化
  $new_width = $new_height = $baseLength;
  $dst_x = $dst_y = 0;
  
  //画像の縦横比から新画像のサイズを設定
  if($width>$hight){
    $new_height = ($hight/$width)*$baseLength;
    $dst_y = ($baseLength - $new_height)/2;
  }elseif($width<$hight ){
    $new_width = ($width/$hight)*$baseLength;
    $dst_x = ($baseLength - $new_width)/2;
  }
  
  // 画像のコピーと伸縮
  imagecopyresampled($image, $baseImage, $dst_x, $dst_y, 0, 0, $new_width, $new_height, $width, $hight);
  
  // コピーした画像を出力する
  imagejpeg($image , $upload_dir.$name);
  
  #echo $upload_dir.$name;
  $upload_image[] = $name;
}
$response_data=array('images'=>$upload_image);
header("Content-Type: application/json; charset=utf-8");
echo json_encode($response_data);   
