<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>ユーザー登録</title>
</head>
<body>
<!-- header starts -->
<?php include 'header.php'; ?>
<!-- header ends -->

<!-- form starts -->
<form action="insert_client.php" method="post" enctype="multipart/form-data">
<section class="text-gray-600 body-font relative">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">ユーザー登録</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">必要事項を入力し、送信してください。</p>
    </div>
    <div class="lg:w-1/2 md:w-2/3 mx-auto">
      <div class="flex flex-wrap -m-2">
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="nickname" class="leading-7 text-sm text-gray-600">ニックネーム</label>
            <input type="text" id="nickname" name="nickname" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <!-- <div class="p-2 w-1/2">
          <div class="relative">
            <label for="userid" class="leading-7 text-sm text-gray-600">ユーザーID（ログイン用）</label>
            <input type="text" id="userid" name="userid" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div> -->
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="client_email" class="leading-7 text-sm text-gray-600">Email</label>
            <input type="email" id="client_email" name="client_email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="password" class="leading-7 text-sm text-gray-600">パスワード</label>
            <input type="password" id="password" name="password" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="birthday" class="leading-7 text-sm text-gray-600">生年月日</label>
            <input type="date" id="birthday" name="birthday" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <!-- <div class="p-2 w-1/2">
          <div class="relative">
            <label for="favorite_color" class="leading-7 text-sm text-gray-600">好きな色</label>
            <input type="text" id="favorite_color" name="favorite_color" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="disliked_color" class="leading-7 text-sm text-gray-600">苦手な色</label>
            <input type="text" id="disliked_color" name="disliked_color" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div> -->
        <div class="p-2 w-full">
          <input type="submit" value="送信" class="flex my-4 mx-auto text-white bg-purple-500 border-0 py-2 px-8 focus:outline-none hover:bg-purple-600 rounded text-lg"></input>
        </div>
      </div>
    </div>
  </div>
</section>
</form>
<!-- form ends -->

<!-- footer starts -->
<?php include 'footer.php'; ?>
<!-- footer ends -->

</body>
</html>