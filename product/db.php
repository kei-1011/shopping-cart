<?php
try {
  $dbh = new PDO('mysql:dbname=shop;host=localhost;charset=utf8', 'root', 'root');
} catch (PDOException $e) {
  print('DB接続エラー:' . $e->getMessage());
}