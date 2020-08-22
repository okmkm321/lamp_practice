<?php 
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_history_order($db, $user_id) {
    $sql = "
        SELECT
            histories.order_id,
            histories.purchase_date,
            histories.user_id,
            SUM(histories_detail.price * histories_detail.quantity) as total_price
        FROM
            histories
        JOIN
            histories_detail
        ON
            histories_detail.order_id = histories.order_id
        WHERE
            histories.user_id = ?
        GROUP BY
            histories_detail.order_id
        DESC
    ";
    $params[0] = $user_id;
    return fetch_all_query($db, $sql, $params);
}

function get_history_detail($db, $order_id) {
    $sql = "
        SELECT
            items.name,
            histories_detail.price,
            histories_detail.quantity,
            histories_detail.price * histories_detail.quantity as total_price
        FROM
            items
        JOIN   
            histories_detail
        ON
            items.item_id = histories_detail.item_id
        WHERE
            histories_detail.order_id = ?
    ";
    $params[0] = $order_id;
    return fetch_all_query($db, $sql, $params);
}

function get_all_history($db) {
    $sql = "
    SELECT
        histories.order_id,
        histories.purchase_date,
        histories.user_id,
        SUM(histories_detail.price * histories_detail.quantity) as total_price
    FROM
        histories
    JOIN
        histories_detail
    ON
        histories_detail.order_id = histories.order_id
    GROUP BY
        histories_detail.order_id
    DESC
    ";
    return fetch_all_query($db, $sql);
}

?>