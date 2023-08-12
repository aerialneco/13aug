<?php
ini_set('display_errors', 1);

// session開始
session_start();
//関数群の読み込み
require_once('funcs.php');
loginCheck();

// $id = $_GET['id'];
$client_id = isset($_POST['client_id']) ? $_POST['client_id'] : '';
$datatime = isset($_POST['datatime']) ? $_POST['datatime'] : '';
$emotion = isset($_POST['emotion']) ? $_POST['emotion'] : '';
$scale = isset($_POST['scale']) ? $_POST['scale'] : '';
$color = isset($_POST['color']) ? $_POST['color'] : '';
$theme = isset($_POST['theme']) ? $_POST['theme'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';


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


// POST data 取得
$client_id = $_POST['client_id'];
$datatime = $_POST['datatime'];
$emotion = $_POST['emotion'];
$scale = $_POST['scale'];
$color = $_POST['color'];
$theme = $_POST['theme'];
$description = $_POST['description'];

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



?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/responsiveness.css">
    <link rel="stylesheet" href="./css/d3.css">
    <title>Document</title>
</head>

<body>
<header class="header">
  <div class="nav-wrapper">
    <p class="logo">
        <a href="./index.php" class="">
        <img src="./images/logo.jpg" alt="logo" width="70">
        <span class="logoーtext">Grow</span>
        </a>
    </p>
  <nav class="navigation">
    <ul class="nav-list">
    <li><a class="nav-link" href="./login_client.php">ユーザーログイン</a></li>
    <li><a class="nav-link" href="./select.php">カウンセラー一覧</a></li>
    </ul>
  </nav>
  </div>
</header>

<div class="container">
<!-- Left content starts -->
<div class="left-content">
    <h1 class="i_title">
    <?= $result['nickname'] ?>、
      <?php
      require_once 'message.php';
      $message = new Message();
      echo $message->getCustomMessage();
      ?>
    </h1>
<!-- <form action="write.php" method="post"> -->
<form action="insert_history.php" method="post" enctype="multipart/form-data">
    <section>
        <!-- <p>日付を選んでください。</p> -->
    <input type="date" name="date" id="date-input">
    </section>

    <!-- 感情ここから -->
    <section class="emotionOption1">
    <input type="radio" name="emotionOption" value="喜び" class="emotion" id="joy"><label class="emotionLabel" for="joy">楽しい</label>
    <input type="radio" name="emotionOption" value="安心" class="emotion" id="relief"><label class="emotionLabel" for="relief">安心</label>
    <input type="radio" name="emotionOption" value="緊張" class="emotion" id="tention"><label class="emotionLabel" for="tention">緊張</label>
    <input type="radio" name="emotionOption" value="怒り" class="emotion" id="annoyed"><label class="emotionLabel" for="annoyed">苛立つ</label>
    <input type="radio" name="emotionOption" value="悲しみ" class="emotion" id="sorrow"><label class="emotionLabel" for="sorrow">悲しい</label>
    <input type="radio" name="emotionOption" value="悲しみ" class="emotion" id="exhausted"><label class="emotionLabel" for="exhausted">疲れた</label>
    </section>
    <section class="emotionOption2">
    <input type="radio" name="emotionOption" value="幸福" class="emotion" id="happy"><label class="emotionLabel" for="happy">幸せ</label>
    <input type="radio" name="emotionOption" value="恐れ" class="emotion" id="anxiety"><label class="emotionLabel" for="anxiety">不安</label>  
    <input type="radio" name="emotionOption" value="驚き" class="emotion" id="surprise"><label class="emotionLabel" for="surprise">驚いた</label>
    <input type="radio" name="emotionOption" value="恐れ" class="emotion" id="anger"><label class="emotionLabel" for="anger">激怒</label>
    <input type="radio" name="emotionOption" value="嫌悪" class="emotion" id="disappoint"><label class="emotionLabel" for="disappoint">失望</label>
    <input type="radio" name="emotionOption" value="嫌悪" class="emotion" id="disgust"><label class="emotionLabel" for="disgust">辟易</label>
    </section>
    <!-- 感情ここまで -->

    <!-- スケールここから -->
    <section>
    <label><input type="range" min="10" max="90" step="10" id="scale" name="emotionScale"oninput="updateCircleRadius(this.value)">その度合いは？</label>
    <p id="msg"></p>
    </section>
    <!-- スケールここまで -->

    <!-- カラー ここから-->
    <section> 
    <input type="color" name="color" list="color-list" value="#A3DEB5" oninput="changeColor(this.value)"> 何色な感じ？
    <datalist id="color-list">
    <option value="#0000CD">
    <option value="#40E0D0">
    <option value="#32CD32">
    <option value="#008000">
    <option value="#6A5ACD">
    <option value="#9370DB">
    <option value="#FFEFD5">
    <option value="#DDA0DD">
    <option value="#FFFFE0">
    <option value="#FF00FF">
    <option value="#FF4500">
    <option value="#FF0000">
    <option value="#000000">
    <option value="#A52A2A">
    <option value="#C0C0C0">
    <option value="#FFD700">
    </datalist>
    </section>
    <!-- カラー ここまで-->

    <!-- テーマここから -->
    <section class="themeOption1">
    <input type="radio" name="themeOption" value="仕事" class="theme" id="work"><label class="themeLabel" for="work">仕事</label>
    <input type="radio" name="themeOption" value="家族" class="theme" id="family"><label class="themeLabel" for="family">家族</label>
    <input type="radio" name="themeOption" value="趣味・娯楽" class="theme" id="hobby"><label class="themeLabel" for="hobby">趣味・娯楽</label>
    <input type="radio" name="themeOption" value="お金" class="theme" id="money"><label class="themeLabel" for="money">お金</label>
    <input type="radio" name="themeOption" value="人間関係" class="theme" id="relationsip"><label class="themeLabel" for="relationsip">人間関係</label>
    <input type="radio" name="themeOption" value="自分自身" class="theme" id="myself"><label class="themeLabel" for="myself">自分自身</label>
    </section>
    <!-- <section class="themeOption2">
    <input type="checkbox" name="themeOption" value="幸福" class="emotion" id="happy"><label class="emotionLabel" for="happy">幸せ</label>
    <input type="checkbox" name="themeOption" value="恐れ" class="emotion" id="anxiety"><label class="emotionLabel" for="anxiety">不安</label>  
    <input type="checkbox" name="themeOption" value="驚き" class="emotion" id="surprise"><label class="emotionLabel" for="surprise">驚いた</label>
    <input type="checkbox" name="themeOption" value="恐れ" class="emotion" id="anger"><label class="emotionLabel" for="anger">激怒</label>
    <input type="checkbox" name="themeOption" value="嫌悪" class="emotion" id="disappoint"><label class="emotionLabel" for="disappoint">失望</label>
    <input type="checkbox" name="themeOption" value="嫌悪" class="emotion" id="disgust"><label class="emotionLabel" for="disgust">辟易</label>
    </section> -->
    <!-- テーマここまで -->

    <!-- 詳細ここから -->
    <section>
    <p>出来事等</p>    
    <textarea name="situation" id="" cols="70" rows="5"></textarea>
    </section>
    <!-- 詳細ここまで -->

    <!-- 画像切り替え -->
    <section class="registration">
    <a href="./registration_client.php" class="i_button">登録</a>
    <!-- <a href="./registration_client.php"><input type="submit" value="ユーザー登録" class="i_button"></a> -->
    <!-- <p class="registration_text">ご登録いただくと様々なメニューをご利用いただけます。</p> -->
    </section>
</form>
</div>
<!-- Left content ends -->

<!-- Right content starts -->
<div class="canvas">
    <svg width="500" height="500">
    <circle></circle>
    </svg>    
</div>
<!-- Right content ends -->

</div>

<!-- footer starts -->
<footer class="">
  <div class="footer">
    <a class="">
      <span class="logo-text">Grow</span>
    </a>
    <ul class="nav-list">
        <li class="nav-link"> | © 2023 Grow </li>
        <li class="nav-link"><a href="./login_admin.php">| Admin</a></li>
        <li class="nav-link"><a href="./login_counselor.php">| カウンセラーTOP</a></li>
    </ul>
  </div>
</footer>
<!-- footer ends -->


<script src="https://d3js.org/d3.v7.min.js"></script>
<script src="./js/d3.js"></script>
<script src="./js/base.js"></script>

</body>
</html>