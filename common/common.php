<?php

/*
$beforeで$_POSTを受け取る
エスケープ処理したデータを返す
*/
function e($before)
{
  foreach($before as $key => $value)
  {
    $after[$key] = htmlspecialchars($value);
  }
  return $after;
}
?>
