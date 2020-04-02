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
    <form action="shop_form_check.php" method="post">
      <div class="form-group row">
        <label for="name" class='col-sm-2'>お名前</label>
        <input type="text" name="name" id="name" class="form-control col-sm-10">
      </div>
      <div class="form-group row">
        <label for="mail" class='col-sm-2'>メールアドレス</label>
        <input type="email" name="mail" id="mail" class="form-control col-sm-10">
      </div>
      <div class="form-group row">
        <label for="postcode" class='col-sm-2'>郵便番号</label>
        <input type="text" name="postcode" id="postcode" class="form-control col-sm-10">
      </div>
      <div class="form-group row">
        <label for="address" class='col-sm-2'>住所</label>
        <input type="text" name="address" id="address" class="form-control col-sm-10">
      </div>
      <div class="form-group row">
        <label for="tel" class='col-sm-2'>電話番号</label>
        <input type="tel" name="tel" id="tel" class="form-control col-sm-10">
      </div>
      <input type="button" onclick="history.back()" value='戻る' class="btn btn-link">
      <input type="submit" class="btn btn-primary" value="OK">
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