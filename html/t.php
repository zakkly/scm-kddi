<?php
// Import the necessary classes
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;

#use Mail;
#use Activation;


// Include the composer autoload file
require __DIR__.'/../vendor/autoload.php';
// Setup a new Eloquent Capsule instance
$capsule = new Capsule;
$capsule->addConnection([
  'driver'    => 'mysql',
  'host'      => '127.0.0.1',
  'database'  => 'scm-kddi',      // データベース名を変更していたら合わせて変更
  'username'  => 'root',          // xxxxを、データベースのユーザー名に変更
  'password'  => 'root',        // xxxxxxを、データベースのパスワードに変更
  'charset'   => 'utf8',
  'collation' => 'utf8_unicode_ci',
]);
$capsule->bootEloquent();

// ユーザー情報
$credentials = [
  'email' => 'admin@admin.com',
  'password' => 'W7t3ZxHd'
]; 
$credentials = [
  'email' => 'master@master.com',
  'password' => 'kQ5G8yzm'
]; 

$role = Sentinel::getRoleRepository()  
   ->createModel()  
   ->create([  
     'name' => 'マスター',  
     'slug' => 'master'  
]);
#exit;



$user = Sentinel::findByCredentials($credentials);
if (is_null($user)) {
  echo "登録します\n";
  $user = Sentinel::registerAndActivate($credentials); 
  $user = json_decode(json_encode($user));
  print_r($user);
  
  $user = Sentinel::findById($user->id);
  $role = Sentinel::findRoleByName('マスター');  
  $role->users()->attach($user);  // 割り当てる 
  #$role->users()->detach($user);  // 割り当てを解除する  

  // 存在しない場合は、新規登録
  /*
  $users = Sentinel::register($credentials);
  #print_r($users);
  $Activation = Sentinel::getActivationRepository(); 
  $act = $Activation->create($users);
  $acti = json_decode(json_encode($act));
  print_r($acti->user_id);
  #print_r($act->original);
  
  $Activation->complete($users,$acti->user_id);*/
  
}
else {
  // 存在する場合は削除
  $user->delete();
  echo "user deleted".PHP_EOL;
}

#Sentinel::authenticate($credentials);

#echo Sentinel::authenticate($credentials);

#$user = Sentinel::findByCredentials(['email' => base64_decode($credentials["email"])]);



/*
// 登録済みかを確認
$user = Sentinel::getUserRepository()->findByCredentials($credentials);
if (is_null($user)) {
  // 存在しない場合は、新規登録
  $user = Sentinel::register($credentials);
  print_r($user);
}else {
  // 存在する場合は削除
  $user->delete();
  echo "user deleted".PHP_EOL;
}
*/