<?php
ini_set('display_errors', 1);

// session開始
session_start();

//関数群の読み込み
require_once('funcs.php');
loginCheck();

// $id = $_GET['id'];
$id = isset($_GET['id']) ? $_GET['id'] : '';

$client_email = isset($_SESSION['client_email']) ? $_SESSION['client_email'] : '';

// echo $client_email;

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
$stmt = $pdo->prepare('SELECT * FROM client_table WHERE client_email = :client_email;');
$stmt->bindValue(':client_email', $client_email, PDO::PARAM_STR);//PARAM_INTなので注意
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
//     $result['file'] = array(
//     'file_path' => $result['file_path']
// );

}

// データが取れているか確認
// var_dump($result);


?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdn.tailwindcss.com"></script>
<title>登録ユーザーページ</title>
</head>

<body>
<!-- header starts -->
<?php include 'header.php'; ?>
<!-- header ends -->

<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col">
      <!-- <div class="h-1 bg-gray-200 rounded overflow-hidden"> -->
        <!-- <div class="w-24 h-full bg-indigo-500"></div> -->
      <!-- </div> -->
      <div class="flex flex-wrap sm:flex-row flex-col py-6 mb-12">
        <h1 class="sm:w-2/5 text-gray-900 font-medium title-font text-2xl mb-2 sm:mb-0"><?= $result['nickname'] ?>さんのページ</h1>
        <p class="sm:w-3/5 leading-relaxed text-base sm:pl-10 pl-0"><?= $result['nickname'] ?>さんのページです。</p>
      </div>
      <div class="flex flex-wrap sm:flex-row flex-col py-6 mb-12">
        <p><a href="./logout_client.php" class="text-indigo-500">ログアウト</a></p>
      </div>
    </div>
    <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">
      <div class="p-4 md:w-1/3 sm:mb-0 mb-6">
        <div class="rounded-lg h-64 overflow-hidden">
          <img alt="content" class="object-cover object-center h-full w-full" src="./images/flower1.jpg">
        </div>
        <h2 class="text-xl font-medium title-font text-gray-900 mt-5">日々の記録</h2>
        <p class="text-base leading-relaxed mt-2">どんなことがあったか、どんなことに心が動いたかを記録して視覚化してみましょう。</p>
        <a class="text-indigo-500 inline-flex items-center mt-3" href="history.php">記録する
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
            <path d="M5 12h14M12 5l7 7-7 7"></path>
          </svg>
        </a>
      </div>
      <div class="p-4 md:w-1/3 sm:mb-0 mb-6">
        <div class="rounded-lg h-64 overflow-hidden">
          <img alt="content" class="object-cover object-center h-full w-full" src="./images/flower2.jpg">
        </div>
        <h2 class="text-xl font-medium title-font text-gray-900 mt-5">メニュー２</h2>
        <p class="text-base leading-relaxed mt-2">これは、サンプルテキストです。</p>
        <a class="text-indigo-500 inline-flex items-center mt-3">Learn More
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
            <path d="M5 12h14M12 5l7 7-7 7"></path>
          </svg>
        </a>
      </div>
      <div class="p-4 md:w-1/3 sm:mb-0 mb-6">
        <div class="rounded-lg h-64 overflow-hidden">
          <img alt="content" class="object-cover object-center h-full w-full" src="./images/flower3.jpg">
        </div>
        <h2 class="text-xl font-medium title-font text-gray-900 mt-5">メニュー３</h2>
        <p class="text-base leading-relaxed mt-2">これは、サンプルテキストです。</p>
        <a class="text-indigo-500 inline-flex items-center mt-3">Learn More
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
            <path d="M5 12h14M12 5l7 7-7 7"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- footer starts -->
<footer class="text-gray-600 body-font">
  <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
    <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
      <span class="ml-3 text-xl">Grow</span>
    </a>
    <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">© 2023 Grow </p>
    <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4"><a href="./login_admin.php">Admin</a></p>
    <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4"><a href="./counselor_top.php">カウンセラーTOP</a></p>
  </div>
</footer>
<!-- footer ends -->



</body>

</html>


