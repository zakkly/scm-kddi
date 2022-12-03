<?php
//保存先ディレクトリ
$upload_dir = dirname(__FILE__)."/";
if(empty($_FILES["file"]['name'])){
  return false;
}

//ファイルネーム
$name = $_FILES["file"]['name'];
//tmp_name
$tmp_file = $_FILES["file"]['tmp_name'];
$filesCount = count($_FILES);
for($i = 0; $i < $filesCount; $i++) {
  $name = explode(".",$name);
  $name = uniqid().".".$name[1];
  move_uploaded_file($_FILES["file"]['tmp_name'], $upload_dir.$name);
  list($width, $hight) = getimagesize($upload_dir.$name); // 元の画像名を指定してサイズを取得
  $baseImage = imagecreatefromjpeg($upload_dir.$name); // 元の画像から新しい画像を作る準備
  $image = imagecreatetruecolor(500, 500); // サイズを指定して新しい画像のキャンバスを作成
  
  // 画像のコピーと伸縮
  imagecopyresampled($image, $baseImage, 0, 0, 0, 0, 500, 500, $width, $hight);
  
  // コピーした画像を出力する
  imagejpeg($image , $upload_dir.$name);
  
  #echo $upload_dir.$name;
  $upload_image[] = $name;
}
$response_data=array('images'=>$upload_image);
header("Content-Type: application/json; charset=utf-8");
echo json_encode($response_data);   
