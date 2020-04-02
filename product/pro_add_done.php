<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>商品追加</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

  <?php
require_once('../session.php');
/*tryは<?
*/
  try {

    $pro_name = $_POST['name'];
    $pro_price = $_POST['price'];
    $pro_image_name = $_POST['image'];

    $pro_name = htmlspecialchars($pro_name);
    $pro_price = htmlspecialchars($pro_price);

    /*データベースに接続する
    */
    require('db.php');
    $dbh->query('SET NAMES utf8');

    $sql = 'INSERT INTO mst_product(name,price,image) VALUES (?,?,?)';
    $stmt = $dbh->prepare($sql);
    $data[] = $pro_name;
    $data[] = $pro_price;
    $data[] = $pro_image_name;
    $stmt->execute($data);

    $dbh = null;

    print $pro_name;
    print 'を追加しました<br>';
    print '  <a href="pro_list.php" class="btn btn-secondary">戻る</a>';
  } catch (Exception $e) {

    print 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
  }

  ?>

  <a href="staff_list.php"></a>

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
