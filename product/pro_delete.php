<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>商品の削除</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <style>
  .staff-code span,
  .staff-name span {
    margin-left: 30px;
  }
  </style>
</head>

<body>
  <div class="container">

    <?php
require_once('../session.php');

    $pro_code = $_GET['procode'];

    require('db.php');
    $dbh->query('SET NAMES utf8');

    $sql = 'SELECT name,image FROM mst_product WHERE code=?';
    //スタッフコードで絞り込み

    $stmt = $dbh->prepare($sql);
    $data[] = $pro_code;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name = $rec['name'];
    $pro_image_name = $rec['image'];

    $dbh = null;


    if ($pro_image_name == '') {
      $disp_image = '';
    } else {
      $disp_image = '<img src="./gazou/' . $pro_image_name . '">';
    }
    ?>

    <h1>商品削除</h1>

    <p class="staff-code">商品コード<span><?php print $pro_code; ?></span></p>
    <p class="staff-name">スタッフ名<span><?php print $pro_name; ?></span></p>

    <div class="delete-check">
      <?php print $disp_image; ?>
      <br>
      <p>このスタッフを削除してもよろしいですか？</p>
    </div>

    <form action="pro_delete_done.php" method="post">
      <div class="form-group">
        <input type="hidden" name="code" value="<?php print $pro_code; ?>">
        <input type="hidden" name="image_name" value="<?php print $pro_image_name; ?>">
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
