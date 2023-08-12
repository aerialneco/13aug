<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>カウンセラーログイン</title>
</head>

<body>

<!-- header starts -->
<?php include 'header.php'; ?>
<!-- header ends -->

<!-- tailwind starts-->
<section class="text-gray-600 body-font relative">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
    </div>

    <div class="flex flex-col text-center w-full mb-20">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">カウンセラー Login</h1>
      <!-- <p class="lg:w-2/3 mx-auto leading-relaxed text-base">登録カウンセラーの一覧です。</p> -->
    </div>

    <form name="form2" action="login_act_counselor.php" method="post">   
    <div class="lg:w-1/2 md:w-2/3 mx-auto">
      <div class="flex flex-wrap -m-2">
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
            <input type="text" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="password" class="leading-7 text-sm text-gray-600">パスワード</label>
            <input type="password" id="password" name="password" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        </form>

        <div class="p-2 w-full">
          <button type="submit" class="flex mx-auto text-white bg-purple-500 border-0 py-2 px-8 focus:outline-none hover:bg-purple-600 rounded text-lg mt-5">Login</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- tailwind ends -->

<!-- footer starts -->
<?php include 'footer.php'; ?>
<!-- footer ends -->

</body>

</html>
