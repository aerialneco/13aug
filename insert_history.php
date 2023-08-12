<?php
ini_set('display_errors', 1);

// POST data 取得
$client_id = $_POST['client_id'];
$datatime = $_POST['datatime'];
$emotion = $_POST['emotion'];
$scale = $_POST['scale'];
$color = $_POST['color'];
$theme = $_POST['theme'];
$description = $_POST['description'];


// DB接続します
//*** function化する！  *****************
try {
    $db_name = 'practice'; //データベース名
    $db_id   = 'root'; //アカウント名
    $db_pw   = ''; //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}


// データが取れているか確認
// var_dump($status);
// exitが入るとそこで処理を止める
// exit();


// 以下data登録 SQL作成
$stmt = $pdo->prepare("INSERT INTO history_table(
  id, client_id, datatime, emotion, scale, color, theme, description
) VALUES (
  NULL, :client_id, sysdata(), :emotion, :scale, :color, :theme, :description
)");

// （２）バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':client_id', $client_id, PDO::PARAM_INT);
$stmt->bindValue(':emotion', $emotion, PDO::PARAM_STR);
$stmt->bindValue(':scale', $scale, PDO::PARAM_INT);
$stmt->bindValue(':color', $color, PDO::PARAM_STR);
$stmt->bindValue(':theme', $theme, PDO::PARAM_STR);
$stmt->bindValue(':description', $description, PDO::PARAM_STR);

// （３）実行
$status = $stmt->execute();


// //（４）データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{

  //５．（登録が成功した後の処理）history.phpへのリダイレクト
  header('Location: history.php');
}

