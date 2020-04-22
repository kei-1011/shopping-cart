<?php
session_start();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>注文完了</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
</head>
<body>
<?php
try {

require_once('../common/common.php');

$post = e($_POST);

$namae = $post['name'];
$mail = $post['mail'];
$postcode = $post['postcode'];
$address = $post['address'];
$tel = $post['tel'];

/*
１、画面に注文を受け付けた旨の表示をする
２、お客様にお礼のメールを自動送信する
３、店側には注文メールを自動送信する
４、データベースに注文データを保存する
*/

$content  = ''; //初期化
$content .= $name."様\n\nこのたびはご注文ありがとうございました。\n";
$content .= "\n";
$content .= "ご注文商品\n";
$content .= "-----------------------\n";

//商品情報の取得
$cart = $_SESSION['cart'];
$kazu = $_SESSION['kazu'];
$max  = count($cart);

//DB情報
$dsn = 'mysql:dbname=shop;host=localhost';
$user = 'root';
$password = 'root';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');


for($i =0;$i<$max;$i++) {
  $sql = 'SELECT name,price FROM mst_product WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[0]  = $cart[$i];
  $stmt->execute($data);

  $rec  = $stmt->fetch(PDO::FETCH_ASSOC);

  $name = $rec['name'];
  $price  = $rec['price'];
  $kakaku[] = $price;
  $suryo  = $kazu[$i];
  $shokei = $price * $suryo;

  $content .= $name. ' ';
  $content .= $price.'円 x';
  $content .= $suryo.'個 =';
  $content .= $shokei."円 \n";
}

//注文データを追加
$sql    = 'INSERT INTO dat_sales(code_member,name,email,postcode,address,tel) VALUES (?,?,?,?,?,?)';
$stmt   = $dbh->prepare($sql);
$data   = array();
$data[] = 0;  //会員コード
$data[] = $namae;
$data[] = $mail;
$data[] = $postcode;
$data[] = $address;
$data[] = $tel;
$stmt->execute($data);


//直近に発番された番号を取得する
$sql  = 'SELECT LAST_INSERT_ID()';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec  = $stmt->fetch(PDO::FETCH_ASSOC);
$lastcode = $rec['LAST_INSERT_ID()'];


//商品明細を追加する
for($i=0;$i<$max;$i++) {

  $sql    = 'INSERT INTO dat_sales_product(code_sales,code_product,price,quantity) VALUES (?,?,?,?)';
  $stmt   = $dbh->prepare($sql);
  $data   = array();
  $data[] = $lastcode;
  $data[] = $cart[$i];
  $data[] = $kakaku[$i];
  $data[] = $kazu[$i];
  $stmt->execute($data);
}


$dbh  = null;

$content .= "-----------------------\n";
$content .= "▶︎送料は無料です。\n";
$content .= "\n";
$content .= "入金確認が取れ次第発送させていただきます。\n";
$content .= "\n";
$content .= "□□□□□□□□□□□□□□□□□□□□□□□\n";
$content .= "安心野菜のロクマル農園\n";
$content .= "\n";
$content .= "大阪府枚方市楠葉野田2-13-10\n";
$content .= "電話　090-1960-4392\n";
$content .= "メール　k_kojima0407@yahoo.co.jp\n";
$content .= "□□□□□□□□□□□□□□□□□□□□□□□\n";

/*
\nを<br>に変換する　nl2br
print nl2br($content);
*/


//メールを送信する（お客様向け）
$title = 'ご注文ありがとうございます。';
$header = 'From:k.aries0407@gmail.com';
$content = html_entity_decode($content,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail($mail,$title,$content,$header);
//$emailが送信先　$headerが送信もと

//メール送信（お店向け）
$title = 'お客様から注文がありました。';
$header = "From:".$email;
$content = html_entity_decode($content,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail('k.aries0407@gmail.com',$title,$content,$header);



} catch (Exception $e){
  print 'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}

?>
  <div class="container">
    <div class="row">
      <p><?php echo $namae;?>様</p>
      <p>ご注文ありがとうございました。</p>
      <p><?php echo $mail;?>のメールアドレスにご注文確認メールを送付いたしましたので、ご確認ください。</p>
    </div>
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
