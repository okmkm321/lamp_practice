<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'history.php';

session_start();
header("X-FRAME-OPTIONS: DENY");

$token = get_csrf_token();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

//$histories = get_history_order($db, $user['user_id']);

if(is_admin($user)){ 
    $histories = get_all_history($db);
} else {
    $histories = get_history_order($db, $user['user_id']);
}


include_once VIEW_PATH . 'history_view.php';