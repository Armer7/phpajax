<?php

    session_start();
    require_once '../db/db.php';
    foreach ($_GET as $key=>$value) {
        $currentKey = $key;
        $currentValue = $value;
    }

    $_SESSION[$currentKey] = htmlspecialchars($currentValue);


$query = "SELECT `products`.`id`, `cats`.`cat`, `products`.`title`, `color`.`color`, `weights`.`weight`
FROM `cats`
         LEFT JOIN `products` ON `products`.`cat` = `cats`.`cat_id`
         LEFT JOIN `color` ON `products`.`color` = `color`.`color_id`
         LEFT JOIN `weights` ON `products`.`weight` = `weights`.`weight_id`
         WHERE";

foreach ($_SESSION as $key=>$value) {
    if ($value != 'all') {
        switch ($key) {
            case 'cats': {
                $query .= " products.cat = '$value' AND";
                break;
            }
            case 'color': {
                $query .= " products.color = '$value' AND";
                break;
            }
            case 'weights': {
                $query .= " products.weight = '$value' AND";
                break;
            }
        }
    }
}
$query = trim($query, ' WHERE');
$query = trim($query, ' AND');
$query .= " ORDER BY `products`.`title`;";
$products = $connect-> query($query)
    ->fetchAll(PDO::FETCH_ASSOC);
if (!$products) {
  echo '{"item": "false"}';
} else {
  echo '{"item":"true", "product":';
  echo json_encode($products);
  echo '}';
}
