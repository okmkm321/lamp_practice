<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();
header("X-FRAME-OPTIONS: DENY");

$token = get_csrf_token();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$number_of_items = get_all_item($db);
$number_of_pages = get_number_of_pages($db);
$page = get_get('page');

if($page === '') {
  $page = 1;
}

$user = get_login_user($db);

$items = get_open_items($db, $page);

include_once VIEW_PATH . 'index_view.php';