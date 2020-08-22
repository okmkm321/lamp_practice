<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'history.php';

session_start();
header("X-FRAME-OPTIONS: DENY");

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$order_id = get_post('order_id');
$purchase_date = get_post('purchase_date');
$total_price = get_post('total_price');

$histories = get_history_detail($db, $order_id);

include_once VIEW_PATH . 'history_detail_view.php';