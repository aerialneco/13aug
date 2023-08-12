<?php

ini_set('display_errors', 1);

// POST data 取得
$nickname = $_POST['nickname'];
$password = $_POST['password'];
$birthday = $_POST['birthday'];
$client_email = $_POST['client_email'];


// DB接続
try {
    //ID:'root', Password: xamppは 空白 ''
    $pdo = new PDO('mysql:dbname=practice;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }

// 以下data登録 SQL作成
$stmt = $pdo->prepare("INSERT INTO client_table(
  id, nickname, password, birthday, client_email, datetime
) VALUES (
  NULL, :nickname, :password, :birthday, :client_email, sysdate()
)");

// （２）バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);
$stmt->bindValue(':client_email', $client_email, PDO::PARAM_STR);

// （３）実行
$status = $stmt->execute();

// //（４）データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{

  //５．（登録が成功した後の処理）registration.phpへのリダイレクト
  header('Location: registration_client.php');
}

