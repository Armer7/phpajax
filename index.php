<?php
session_start();

require_once 'db/db.php';

$cats = $connect->query('SELECT * FROM cats')
    ->fetchAll(PDO::FETCH_ASSOC);
$color = $connect->query('SELECT * FROM color')
    ->fetchAll(PDO::FETCH_ASSOC);
$weights = $connect->query('SELECT * FROM weights')
    ->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang = "ru">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport"
          content = "width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel = "stylesheet" href = "/css/style.css">
    <title>ajax</title>
</head>
<body>
<div class="container">
    <div class="select mt-4">
        <select name = "cats" id = "cats">
            <option value = "all">Все категории</option>
          <? foreach ($cats as $item) {?>
          <option value = "<?=$item['cat_id']?>" <? if ($_SESSION['cats'] == $item['cat_id']) {echo 'selected';} ?>><?=$item['cat']?></option>
          <? }?>
        </select>
        <select name = "color" id = "color">
            <option value = "all">Все цвета</option>
            <? foreach ($color as $item) {?>
              <option value = "<?=$item['color_id']?>" <? if ($_SESSION['color'] == $item['color_id']) {echo 'selected';} ?>><?=$item['color']?></option>
            <? }?>
        </select>
        <select name = "weights" id = "weights">
            <option value = "all">Любой вес</option>
            <? foreach ($weights as $item) {?>
              <option value = "<?=$item['weight_id']?>" <? if ($_SESSION['weights'] == $item['weight_id']) {echo 'selected';} ?>><?=$item['weight']?></option>
            <? }?>
        </select>
    </div>
    <div class="row mt-5 cards-block">

    </div>
</div>
<script src="js/ajax.js"></script>
</body>
</html>
