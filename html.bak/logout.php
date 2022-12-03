<?php
use Manage\manage;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;

require __DIR__."/../vendor/autoload.php";

$mng = new manage;
$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../templates_c';
$_SESSION = array();
if (isset($_COOKIE["PHPSESSID"])) {
  setcookie("PHPSESSID", '', time() - 1800, '/');
}

session_destroy();

header("Location:"._BASE_URL_);

