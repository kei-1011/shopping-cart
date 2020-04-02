<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>商品情報の修正</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
  <div class="container">

    <?php
require_once('../session.php');

$pro_code = $_GET['procode'];

    require('db.php');
    $dbh->query('SET NAMES utf8');

    $sql = 'SELECT name,price,image FROM mst_product WHERE code=?';
    //商品コードで絞り込み

    $stmt = $dbh->prepare($sql);
    $data[] = $pro_code;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name = $rec['name'];
    $pro_price = $rec['price'];
    $pro_image_name_old = $rec['image'];

    $dbh = null;

    if ($pro_image_name_old == '') {
      $disp_image = '';
    } else {
      $disp_image = '<img src="./gazou/' . $pro_image_name_old . '">';
    }



    ?>

    <h1>商品情報修正</h1>

    <p>商品コード<span class="pro-code"><?php print $pro_code; ?></span></p>
    <form action="pro_edit_check.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <input type="hidden" name="code" value="<?php print $pro_code; ?>">
        <input type="hidden" name="image_name_old" value="<?php print $pro_image_name_old; ?>">
        <label>商品名</label>
        <input type="text" name="name" value="<?php print $pro_name; ?>" class="form-control">
        <br>
        <label>価格</label>
        <input type="text" name="price" class="form-control" value="<?php print $pro_price; ?>">
        <br>
        <?php print $disp_image; ?>
        <br>
        <input type="file" name="image">
        <br>
        <input type="button" value="戻る" onclick="history.back()" class="btn btn-secondary">
        <input type="submit" value="OK" class="btn btn-primary">
      </div>
    </form>
  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>

</body>

</html>
