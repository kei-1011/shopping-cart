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
  <title>商品詳細画面</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
  <div class="container">
    <h1>カートに追加</h1>

    <?php

    if (isset($_SESSION['member_login']) == false) {
      print '<p>ようこそゲスト様<br>';
      print '<a href="member_login.php">会員ログイン画面へ</a></p>';
    } else {
      print 'ようこそ';
      print $_SESSION['member_name'];
      print '様';
      print '<a href="member_logout.php">ログアウト</a><br>';
    }
    $pro_code = $_GET['procode'];
    // require('db.php');

    /*
    商品を追加した時に上書きされないようにする
    */
    if(isset($_SESSION['cart']) == true)
    {
      $cart = $_SESSION['cart'];      //現在のカートの内容を$cartにコピー
      $kazu = $_SESSION['kazu'];      //商品の購入数
      if(in_array($pro_code,$cart) == true) {
        print 'その商品はすでにカートに入っています<br>';
        print '<a href="shop_list.php">商品一覧に戻る</a>';
        exit();
      }
    }
    $cart[]=$pro_code;              //カートに商品を追加
    $kazu[]= 1;              //カートに商品を追加
    $_SESSION['cart'] = $cart;      //$_SESSIONにカートを保管
    $_SESSION['kazu'] = $kazu;      //

    ?>

    <p>カートに追加しました</p>
    <p><a href="shop_list.php">商品一覧に戻る</a></p>

  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>

</body>

</html>
