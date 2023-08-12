<?php

ini_set('display_errors', 1);


// funcs.phpを読み込み
require_once('funcs.php');


//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=practice;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM counselor_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
  // execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:" . $error[2]);
} else {
  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $view .= '<div class="p-2 lg:w-1/3 md:w-1/2 w-full"><div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">';
    $view .= '<img alt="counselor" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="'. $result['file_path'] .'">';
    $view .= '<div class="flex-grow"><h2 class="text-gray-900 title-font font-medium">';
    $view .= h($result['organization'] );
    $view .= '</h2>';
    $view .= '<p class="text-gray-500">';
    $view .= h($result['name'], ENT_QUOTES) . '<br>' . h($result['certification']). '<br>' . 'Email:' . h($result['email']). '<br>' . h($result['website']);
    $view .= '</p>';

    $view .= '<a href="detail.php?id=' . $result['id'] . '">';
    $view .= '<button class="inline-flex text-white bg-purple-500 border-0 py-1 px-4 my-2 focus:outline-none hover:bg-purple-600 rounded text-sm">詳細</button>';
    $view .= '</a>';

    $view .= '</div></div></div>';
  }
}

?>


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

<!-- main content starts -->
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">登録カウンセラー一覧</h1>
      <!-- <p class="lg:w-2/3 mx-auto leading-relaxed text-base">登録カウンセラーの一覧です。</p> -->
    </div>
    <div class="flex flex-wrap -m-2"><?= $view ?></div>
  </div>
</section>
<!-- main content ends -->

<!-- footer starts -->
<?php include 'footer.php'; ?>
<!-- footer ends -->


</body>
</html>