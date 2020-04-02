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
  <div class="container">
    <?php
require_once('../session.php');

$pro_name = $_POST['name'];
    $pro_price = $_POST['price'];
    $pro_image = $_FILES['image'];


    $pro_name = htmlspecialchars($pro_name);
    $pro_price = htmlspecialchars($pro_price);

    if ($pro_name == '') {
      print '商品名が入力されていません';
    } else {
      print '商品名';
      print $pro_name;
      print '<br>';
    }


    /*
→　preg_match('正規表現', チェックする変数
/^[0-9]+$/　→　半角数字¥

*/
    if (preg_match('/^[0-9]+$/', $pro_price) == 0) {
      print '価格を正しく入力してください';
      print '<br>';
    } else {
      print '商品価格';
      print $pro_price;
      print '円<br>';
    }

    if ($pro_image['size'] > 0) {
      if ($pro_image['size'] > 1000000) {
        print '画像が大きすぎます';
      } else {
        move_uploaded_file($pro_image['tmp_name'], './gazou/' . $pro_image['name']);
        print '<img src="./gazou/' . $pro_image['name'] . '">';
        print '<br>';
      }
    }

    if ($pro_name == '' || preg_match('/^[0-9]+$/', $pro_price) == false || $pro_image['size'] > 1000000) {
      print '<form>';
      print '<input type="button" class="btn btn-secondary" onclick="history.back()" value="戻る">';
      print '</form>';
    } else {


      print '上記の商品を追加します。';
      print '<form method="post" action="pro_add_done.php">';
      print '<input type="hidden" name="name" value="' . $pro_name . '">';
      print '<input type="hidden" name="price" value="' . $pro_price . '">';
      print '<input type="hidden" name="image" value="' . $pro_image['name'] . '">';
      print '<br>';
      print '<input type="button" class="btn btn-secondary" onclick="history.back()" value="戻る">';
      print '<input type="submit" class="btn btn-primary" value="OK">';
      print '</form>';
    }

    ?>


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
