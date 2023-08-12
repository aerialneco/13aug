<?php

$id = $_GET['id'];

try {
    $db_name = 'practice'; //データベース名
    $db_id   = 'root'; //アカウント名
    $db_pw   = ''; //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

// データ登録SQL作成
//UPDATE テーブル名 SET カラム1 = １に保存したいもの、 カラム２ = ２に保存したいもの.....WHERE 条件id = 送られてきたid
$stmt = $pdo->prepare('DELETE FROM counselor_table WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute(); //実行

if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    header('Location: admin.php');
    // 以降の処理がないので、exitはなくてもよい
    exit();
}

