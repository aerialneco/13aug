<?php

ini_set('display_errors', 1);

$organization = $_POST['organization'];
$name = $_POST['name'];
$kana = $_POST['kana'];
$certification = $_POST['certification'];
$email = $_POST['email'];
$password = $_POST['password'];
$tel = $_POST['tel'];
$website = $_POST['website'];
$address = $_POST['address'];
$file = $_FILES['photo'];
$file_name = basename($file['name']);
$temp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = 'images/';
$save_filename = date('YmdHis') . $file_name;
$err_msgs = array();
$save_path = $upload_dir . $save_filename;
$details = $_POST['details'];
$id = $_POST['id'];

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

// データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM counselor_table WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result === false) {
    exit('データがありません。');
}

// 既存のデータを変数に格納
$existing_file_name = $result['file_name'];
$existing_file_path = $result['file_path'];

// ファイルのアップロード処理
if ($file_err === 0) {
    // アップロード成功時の処理
    if (move_uploaded_file($temp_path, $save_path)) {
        // アップロードしたファイルの保存に成功した場合の処理
        $file_name = $file['name'];
        $file_path = $save_path;
    } else {
        $err_msgs[] = 'ファイルの保存に失敗しました。';
    }
} elseif ($file_err === 4) {
    // ファイルが選択されていない場合は、保存されている写真を残す
    $file_name = $existing_file_name;
    $file_path = $existing_file_path;
} else {
    // アップロードエラーが発生した場合の処理
    $err_msgs[] = 'ファイルのアップロードに失敗しました。';
}

// データ更新のSQL作成
$stmt = $pdo->prepare('UPDATE counselor_table 
                        SET organization = :organization,
                            name = :name,
                            kana = :kana,
                            certification = :certification,
                            email = :email,
                            password = :password,
                            tel = :tel,
                            website = :website,
                            address = :address,
                            details = :details,
                            date_time = sysdate(),
                            file_name = :file_name,
                            file_path = :file_path
                        WHERE id = :id;');
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
$stmt->bindValue(':file_name', $file_name, PDO::PARAM_STR);
$stmt->bindValue(':file_path', $file_path, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
}

header('Location: edit.php?id=' . $id);
exit();

?>