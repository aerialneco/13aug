<?php

/**
 * [ここでやりたいこと]
 * 1. クエリパラメータの確認 = GETで取得している内容を確認する
 * 2. select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * 3. SQL部分にwhereを追加
 * 4. データ取得の箇所を修正。
 */

 require_once('funcs.php');

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
    $result['file'] = array(
    'file_path' => $result['file_path']
);
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
<title>登録カウンセラー一覧</title>
</head>

<body>
<!-- header starts -->
<?php include 'header.php'; ?>
<!-- header ends -->

<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto flex flex-col">
    <div class="lg:w-4/6 mx-auto">
      <div class="flex flex-col sm:flex-row mt-10">
        <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8">
          <div class="w-20 h-20 rounded-full inline-flex items-center justify-center bg-gray-200 text-gray-400">
            <img src="<?= $result['file']['file_path'] ?>" alt="">
          </div>
          <div class="flex flex-col items-center text-center justify-center">
            <h2 class="font-medium title-font mt-4 text-gray-900 text-lg"><?= $result['organization'] ?></h2>
            <div class="w-12 h-1 bg-purple-500 rounded mt-2 mb-4"></div>
            <p class="text-base"><?= $result['name'] ?></p>
            <p class="text-base"><?= $result['certification'] ?></p><br>
            <p class="text-base"><?= $result['email'] ?></p>
            <p class="text-base"><?= $result['tel'] ?></p>
            <p class="text-base"><?= $result['website'] ?></p><br>
            <p class="text-base"><?= $result['address'] ?></p>
          </div>
        </div>
        <div class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-gray-200 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
          <p class="leading-relaxed text-lg mb-6">サービス内容・カウンセラーのご紹介</p>
          <p class="leading-relaxed text-lg mb-4"><?= $result['details'] ?></p>
          <!-- <a class="text-indigo-500 inline-flex items-center">Learn More
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
              <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
          </a> -->
        </div>
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


