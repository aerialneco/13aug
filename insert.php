<?php

ini_set('display_errors', 1);

// POST data 取得  **youtubeのファイル関連の取得
$organization = $_POST['organization'];
$name = $_POST['name'];
$kana = $_POST['kana'];
$certification = $_POST['certification'];
$email = $_POST['email'];
$password = $_POST['password'];
$tel = $_POST['tel'];
$website = $_POST['website'];
$address = $_POST['address'];
$details = $_POST['details'];

$file = $_FILES['img'];
$filename = basename($file['name']);
$temp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = 'images/';
$save_filename = date('YmdHis') . $filename;
$err_msgs = array();
$save_path = $upload_dir.$save_filename;



// DB接続
try {
    //ID:'root', Password: xamppは 空白 ''
    $pdo = new PDO('mysql:dbname=practice;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }

// 以下data登録 SQL作成
$stmt = $pdo->prepare("INSERT INTO counselor_table(
  id, organization, name, kana, certification, email, password, tel, website, address, details, date_time, file_name, file_path
) VALUES (
  NULL, :organization, :name, :kana, :certification, :email, :password, :tel, :website, :address, :details, sysdate(), :filename, :save_path
)");

// （２）バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':organization', $organization, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':kana', $kana, PDO::PARAM_STR);
$stmt->bindValue(':certification', $certification, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
$stmt->bindValue(':website', $website, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':details', $details, PDO::PARAM_STR);
$stmt->bindValue(':filename', $filename, PDO::PARAM_STR);
$stmt->bindValue(':save_path', $save_path, PDO::PARAM_STR);

// （３）実行
$status = $stmt->execute();

//（４）データ登録処理後
if ($status === false) {
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:' . $error[2]);
} else {
  // 画像のアップロード処理
  if ($file_err === UPLOAD_ERR_OK) {
      // 一時ファイルから保存先に移動
      move_uploaded_file($temp_path, $save_path);
  } else {
      // エラー処理
      exit('ファイルのアップロードに失敗しました。');
  }

  //５．（登録が成功した後の処理）registration.phpへのリダイレクト
  header('Location: registration.php');
}

?>