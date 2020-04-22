<?php
/*
名前入力有無
メールアドレスチェック
郵便番号数字チェック
住所の入力有無
電話番号の数字チェック

上記一つでもエラーがあれば戻るボタンを表示
上記全てがOKだったら戻るボタンとOKボタンを表示
OKがクリックされたら、shop_form_done.phpへ移動

*/

require_once('../common/common.php');

$post = e($_POST);

$name = $post['name'];
$mail = $post['mail'];
$postcode = $post['postcode'];
$address = $post['address'];
$tel = $post['tel'];



$error = array();

if (empty($name)) {
  $error["name"] = '名前が入力されていません。';
}

if (preg_match('/^[\w\-\.]+\@[\w\-\.]+\.([a-z]+)$/', $mail) == 0) {
  $error['mail'] = 'メールアドレスを正確に入力してください。';
}

if (preg_match('/^[0-9]+$/', $postcode) == 0) {
  $error['postcode'] = '郵便番号は半角数字で入力してください。';
}

if (empty($address)) {
  $error['address'] = '住所が入力されていません。';
}

if (preg_match('/^\d{2,5}-?\d{2,5}-?\d{4,5}$/', $tel) == 0) {
  $error['tel'] = '電話番号を正確に入力してください。';
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>お客様情報入力</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
</head>

<body>
  <div class="container">
    <h1 class="mb-5">お客様情報入力</h1>
    <ul class="errors">
      <?php foreach ($error as $value) : ?>
      <li class="error"><?php echo $value; ?></li>
      <?php endforeach; ?>
    </ul>
    <form action="shop_form_done.php" method="post">
      <div class="form-group row">
        <label for="name" class='col-sm-2'>お名前</label>
        <span class="col-sm-10"><?php echo $name; ?></span>
      </div>
      <div class="form-group row">
        <label for="mail" class='col-sm-2'>メールアドレス</label>
        <span class="col-sm-10"><?php echo $mail; ?></span>
      </div>
      <div class="form-group row">
        <label for="postcode" class='col-sm-2'>郵便番号</label>
        <span class="col-sm-10"><?php echo $postcode; ?></span>
      </div>
      <div class="form-group row">
        <label for="address" class='col-sm-2'>住所</label>
        <span class="col-sm-10"><?php echo $address; ?></span>
      </div>
      <div class="form-group row">
        <label for="tel" class=' col-sm-2'>電話番号</label>
        <span class="col-sm-10"><?php echo $tel; ?></span>
      </div>
      <input type="button" onclick="history.back()" value=' 戻る' class="btn btn-link">
      <input type="hidden" name="name" value="<?php echo $name; ?>">
      <input type="hidden" name="mail" value="<?php echo $mail; ?>">
      <input type="hidden" name="postcode" value="<?php echo $postcode; ?>">
      <input type="hidden" name="address" value="<?php echo $address; ?>">
      <input type="hidden" name="tel" value="<?php echo $tel; ?>">
      <?php if (empty($error)) { ?>
      <input type="submit" class="btn btn-primary" value="OK">
      <?php } ?>
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
