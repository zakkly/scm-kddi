<?php
// HPMailer のクラスをグローバル名前空間（global namespace）にインポート
// スクリプトの先頭で宣言する必要があります
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
// Composer のオートローダーの読み込み（ファイルの位置によりパスを適宜変更）
require '../vendor/autoload.php';
//エラーメッセージ用日本語言語ファイルを読み込む場合（25行目の指定も必要）
require '../vendor/phpmailer/phpmailer/language/phpmailer.lang-ja.php';
 
//言語、内部エンコーディングを指定
mb_language("japanese");
mb_internal_encoding("UTF-8");
 
// インスタンスを生成（引数に true を指定して例外 Exception を有効に）
$mail = new PHPMailer(true);
 
//日本語用設定
$mail->CharSet = "iso-2022-jp";
$mail->Encoding = "7bit";
 
//エラーメッセージ用言語ファイルを使用する場合に指定
$mail->setLanguage('ja', '../vendor/phpmailer/phpmailer/language/');

define("_MAIL_POP_","pop3.lolipop.jp"); //popサーバ
define("_MAIL_SMTP_","smtp.lolipop.jp"); //smtpサーバ
define("_MAIL_USR_","202006@d-connect.jp"); //メールユーザ
define("_MAIL_PWD_","LBhFR8hEjzQYx-Z"); //メールユーザ
define("_MAIL_PORT_",465); //メールユーザ
 
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
  $mail->setFrom('doi@zakkly.com', mb_encode_mimeheader('差出人名'));  
  //受信者アドレス, 受信者名（受信者名はオプション）
  $mail->addAddress('yshrdoi@gmail.com', mb_encode_mimeheader("受信者名")); 
  //追加の受信者（受信者名は省略可能なのでここでは省略）
#  $mail->addAddress('someone@gmail.com'); 
  //返信用アドレス（差出人以外に別途指定する場合）
  $mail->addReplyTo('info@zakkly.com', mb_encode_mimeheader("お問い合わせ")); 
  //Cc 受信者の指定
#  $mail->addCC('foo@example.com'); 
  
  //コンテンツ設定
  $mail->isHTML(true);   // HTML形式を指定
  //メール表題（文字エンコーディングを変換）
  $mail->Subject = mb_encode_mimeheader('日本語メールタイトル'); 
  //HTML形式の本文（文字エンコーディングを変換）
  $mail->Body  = mb_convert_encoding('メッセージ <b>BOLD</b>',"JIS","UTF-8");  
  //テキスト形式の本文（文字エンコーディングを変換）
  $mail->AltBody = mb_convert_encoding('テキストメッセージ',"JIS","UTF-8"); 
 
  $mail->send();  //送信
  echo 'Message has been sent';
} catch (Exception $e) {
  //エラー（例外：Exception）が発生した場合
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
