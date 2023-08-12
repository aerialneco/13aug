<?php

ini_set('display_errors', 1);

// session開始
session_start();

//関数群の読み込み
require_once('funcs.php');
loginCheck();


$id = isset($_GET['id']) ? $_GET['id'] : '';

/**
 * [ここでやりたいこと]
 * 1. クエリパラメータの確認 = GETで取得している内容を確認する
 * 2. select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * 3. SQL部分にwhereを追加
 * 4. データ取得の箇所を修正。
 */

//  require_once('funcs.php');

$id = $_GET['id'];

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
$stmt->bindValue(':id', $id, PDO::PARAM_INT);//PARAM_INTなので注意
$status = $stmt->execute(); //実行

// データが取れているか確認
// var_dump($status);
// exitが入るとそこで処理を止める
// exit();

// データ表示
$result = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();

    // 画像の情報を配列に追加
    // $result['file'] = array(
    // 'file_path' => $result['file_path']
    // );

    // 画像の情報を配列に追加する部分を修正 ＊＊＊＊＊GPTさん
  $result['file'] = array(
  'file_name' => $result['file_name'],
  'file_path' => $result['file_path']
);

}

// データが取れているか確認
// var_dump($result);


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>カウンセラー登録情報 - 編集/削除</title>
</head>
<body>
<!-- header starts -->
<?php include 'header.php'; ?>
<!-- header ends -->

<!-- form starts -->
<form action="update.php" method="POST" enctype="multipart/form-data">
<section class="text-gray-600 body-font relative">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">カウンセラー登録情報 - 変更/削除</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">必要事項を入力し、送信してください。</p>
    </div>
    <div class="lg:w-1/2 md:w-2/3 mx-auto">
      <div class="flex flex-wrap -m-2">
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="organization" class="leading-7 text-sm text-gray-600">カウンセリングルーム名</label>
            <input type="text" id="organization" name="organization" value="<?= $result['organization'] ?>" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="website" class="leading-7 text-sm text-gray-600">Website</label>
            <input type="text" id="website" name="website" value="<?= $result['website'] ?>" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="name" class="leading-7 text-sm text-gray-600">カウンセラー氏名</label>
            <input type="text" id="name" name="name" value="<?= $result['name'] ?>" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="kana" class="leading-7 text-sm text-gray-600">カウンセラー氏名（カナ）</label>
            <input type="text" id="kana" name="kana" value="<?= $result['kana'] ?>" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="tel" class="leading-7 text-sm text-gray-600">Tel</label>
            <input type="text" id="tel" name="tel" value="<?= $result['tel'] ?>" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
            <input type="email" id="email" name="email" value="<?= $result['email'] ?>" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="password" class="leading-7 text-sm text-gray-600">パスワード</label>
            <input type="password" id="password" name="password" value="<?= $result['password'] ?>" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <!-- <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
            <input type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> -->
          </div>
        </div>
        <div class="p-2 w-full">
          <div class="relative">
            <label for="address" class="leading-7 text-sm text-gray-600">住所</label>
            <input type="text" id="address" name="address" value="<?= $result['address'] ?>" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-10 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></input>
          </div>
        </div>
        <div class="p-2 w-full">
          <div class="relative">
            <label for="certification" class="leading-7 text-sm text-gray-600">資格</label>
            <input type="text" id="certification" name="certification" value="<?= $result['certification'] ?>" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-10 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></input>
          </div>
        </div>
        <div class="p-2 w-full">
          <div class="relative">
            <label for="details" class="leading-7 text-sm text-gray-600">概要</label>
            <textarea id="details" name="details" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"><?= $result['details'] ?></textarea>
          </div>
        </div>
        <div class="p-2 w-full">
          <div class="relative">
            <label for="photo" class="leading-7 text-sm text-gray-600"></label>
            <span><img src="<?= $result['file']['file_path'] ?>" alt=""></span>
          </div>
        </div>
        <div class="p-2 w-full">
          <div class="relative">
            <label for="photo" class="leading-7 text-sm text-gray-600">写真を変更する</label>
            <input type="file" id="photo" name="photo" accept="image/*" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>


        <div class="p-2 w-1/2">
          <input type="hidden" name="id" value="<?= $result['id'] ?>">
          <input type="submit" value="更新" class="flex mx-auto text-white bg-purple-500 border-0 py-2 px-8 focus:outline-none hover:bg-purple-600 rounded text-lg">
        </div>
      </div>
    </div>
  </div>
</section>
</form>
<!-- form ends -->

<!-- footer starts -->
<footer class="text-gray-600 body-font">
  <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
    <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
      <span class="ml-3 text-xl">Grow</span>
    </a>
    <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">© 2023 Grow </p>
    <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4"><a href="./logout.php">ログアウト</a></p>
  </div>
</footer>
<!-- footer ends -->

</body>
</html>