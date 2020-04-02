<?php
session_start();

session_regenerate_id(true);


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>商品一覧</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
  <div class="container">

    <?php

    if (isset($_SESSION['member_login']) == false) {
      print '<p>ようこそゲスト様';
      print '<a href="member_login.php">会員ログイン画面へ</a></p>';
    } else {
      print 'ようこそ';
      print $_SESSION['member_name'];
      print '様';
      print '<a href="member_logout.php">ログアウト</a><br>';
    }

    require('./db.php');
    $dbh->query('SET NAMES utf8');

    $sql = 'SELECT * FROM mst_product WHERE 1';
    //mst_staffテーブルの全てのフィールドから、全部（１）のデータを抽出

    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    print '<p>商品一覧</p>'; ?>

    <?php
    while (true) {
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($rec == false) {
        break;
      }
    ?>

      <p>
        <a href="shop_product.php?procode=<?php echo $rec['code'];?>">
          <?php print $rec['name'] . '---'; ?>
          <?php print $rec['price'] . '円'; ?>
        </a>
      </p>
    <?php }
    ?>
    <p><a href="shop_cartlook.php" class="btn btn-primary">カートを見る</a></p>
  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>

</body>

</html>
