<?php
session_start();
session_regenerate_id(true);
/*
カートの中身を表示する
*/
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>カートを見る</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
  <div class="container">
    <h1>カートの内容</h1>

    <?php

    if (isset($_SESSION['member_login']) == false) {
      print '<p>ようこそゲスト様</p>';
      print '<p><a href="member_login.php" class="btn btn-outline-primary">会員ログイン画面へ</a></p>';
    } else {
      print 'ようこそ';
      print $_SESSION['member_name'];
      print '様';
      print '<a href="member_logout.php" class="btn btn-outline-danger">ログアウト</a><br>';
    }

    if (isset($_SESSION['cart']) == true) {
      $cart = $_SESSION['cart'];
      $kazu = $_SESSION['kazu'];
      $max = count($cart);
    } else {
      $max = 0;
    }

    if ($max == 0) { ?>

    <p>カートに商品が入っていません</p>
    <a href="shop_list.php">商品一覧へ戻る</a>

    <?php
      exit();
    } ?>

    <?php
    require('db.php');
    $dbh->query('SET NAMES utf8');

    foreach ($cart as $key => $val)    //カートに入れたデータをforeachで順番に処理する
    {
      $sql = 'SELECT code,name,price,image FROM mst_product WHERE code=?';
      $stmt = $dbh->prepare($sql);
      $data[0] = $val;                  //カートに入れたデータを順番に配列に入れる
      $stmt->execute($data);

      $rec = $stmt->fetch(PDO::FETCH_ASSOC);

      $pro_name[] = $rec['name'];
      $pro_price[] = $rec['price'];
      if ($rec['image']) {
        $pro_image[] = '';
      } else {
        $pro_image[] = '<img src="../product/gazou/' . $rec['image'] . '">';
      }
    }
    $dbh = null;

    ?>

    <div class="cart-detail">
      <!--
      数量を渡すフォームを作成、hiddenで受け渡し
    -->
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <td>商品</td>
            <td>商品画像</td>
            <td>価格</td>
            <td>数量</td>
            <td>小計</td>
            <td>削除</td>
          </tr>
        </thead>
        <form method="post" action="kazu_change.php">
          <?php for ($i = 0; $i < $max; $i++) { ?>
          <tr>
            <td><?php print $pro_name[$i]; ?></td>
            <td><?php print $pro_gazou[$i]; ?></td>
            <td><?php print $pro_price[$i] . '円'; ?></td>
            <td><input type="text" name="kazu<?php print $i; ?>" value="<?php print $kazu[$i]; ?>"></td>
            <td><span>合計金額：<?php print $pro_price[$i] * $kazu[$i]; ?>円</span></td>
            <td><input type="checkbox" name="sakujo<?php print $i; ?>"></td>
          </tr>
          <?php } ?>
      </table>

    </div>
    <input type="hidden" name="max" value="<?php print $max; ?>">
    <p>
      <input type="submit" value="数量変更" class="btn btn-outline-info">
      <a href="./shop_list.php" class="btn btn-secondary">戻る</a></p>
    </form>
    <a href="shop_form.php" class="btn btn-primary">ご購入手続きへ進む</a>
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