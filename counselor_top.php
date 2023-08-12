<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>カウンセラー登録</title>
</head>
<body>

<!-- header starts -->
<?php include 'header.php'; ?>
<!-- header ends -->

<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-wrap -mx-4 -mb-10 text-center">
      <div class="sm:w-1/2 mb-10 px-4">
        <!-- <div class="rounded-lg h-64 overflow-hidden">
          <img alt="content" class="object-cover object-center h-full w-full" src="https://dummyimage.com/1201x501">
        </div> -->
        <h2 class="title-font text-2xl font-medium text-gray-900 mt-6 mb-3">カウンセラー新規登録</h2>
        <p class="leading-relaxed text-base">こちらからカウンセラーの新規登録を行うことができます。</p>
        <button class="flex mx-auto mt-6 text-white bg-purple-500 border-0 py-2 px-5 focus:outline-none hover:bg-purple-600 rounded"><a href="./registration.php">新規登録</a></button>
      </div>
      <div class="sm:w-1/2 mb-10 px-4">
        <!-- <div class="rounded-lg h-64 overflow-hidden">
          <img alt="content" class="object-cover object-center h-full w-full" src="https://dummyimage.com/1202x502">
        </div> -->
        <h2 class="title-font text-2xl font-medium text-gray-900 mt-6 mb-3">カウンセラー登録情報編集</h2>
        <p class="leading-relaxed text-base">こちらから登録情報の変更や更新を行うことができます。</p>
        <button class="flex mx-auto mt-6 text-white bg-purple-500 border-0 py-2 px-5 focus:outline-none hover:bg-purple-600 rounded"><a href="./login_counselor.php">Login</a></button>
      </div>
    </div>
  </div>
</section>

<!-- footer starts -->
<?php include 'footer.php'; ?>
<!-- footer ends -->


    
</body>
</html>