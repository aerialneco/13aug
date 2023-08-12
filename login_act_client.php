<?php

ini_set('display_errors', 1);

//最初にSESSIONを開始！！ココ大事！！
session_start();


//POST値を受け取る
$client_email = $_POST["client_email"];
$password = $_POST["password"];

// var_dump($client_email, $password);
// exit();

//1.  DB接続します
require_once('funcs.php');
$pdo = db_conn();

//2. データ登録SQL作成
// client_tableに、IDとWPがあるか確認する。
$stmt = $pdo->prepare('SELECT * FROM client_table WHERE client_email = :client_email AND password = :password');
$stmt->bindValue(':client_email', $client_email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status === false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();

//if(password_verify($lpw, $val['lpw'])){ //* PasswordがHash化の場合はこっちのIFを使う
// if( $val['id'] != ''){
if (isset($val['id'])) {    
    //Login成功時 該当レコードがあればSESSIONに値を代入
    $_SESSION['chk_ssid'] = session_id();
    $_SESSION['client_email'] = $val['client_email'];
    // var_dump($val);
    header('Location: detail_client.php');
}else{
    //Login失敗時(Logout経由)
    header('Location: login_client.php');
}

exit();
