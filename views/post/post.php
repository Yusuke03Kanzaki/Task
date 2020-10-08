<?php

//データベースに接続
$link = mysqli_connect('127.0.0.1', 'root', 'root', 'Task');
// print_r($link);
// var_dump($link);
if (!$link) {
    die('データベースに接続できません：' . mysqli_error($link). PHP_EOL) ;
}

//データベースを選択する
mysqli_select_db($link, 'Task');

//エラーを格納する$errorsを初期化
$errors = [];
// var_dump($_SERVER['REQUEST_METHOD']);
//POSTなら保存処理実行。ページにアクセスする際はGETメソッドなのでfalse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  //ページにアクセスされた際のメソッドを調べる
//   // 名前が正しく入力されているかチェック
  // var_dump($_SERVER['REQUEST_METHOD']); 
  // echo 11111;
  $name = null;
  // var_dump($_POST['name']);
  // var_dump(!isset($_POST['name']));
  if (!isset($_POST['name']) || !strlen($_POST['name'])) {  //!issetは'name'にNULLが入っていればtrueを返す。!strlenは'name'がnullであればtrueを返す  どちらか片方で良いのでは
      $errors['name'] = '名前を入力してください';
  } elseif (strlen($_POST['name']) > 40) {
      $errors['name'] = '名前は４０文字以内で入力してください';
  } else {
      $name = $_POST['name'];
  }

  //記事が正しく入力されているかチェック
  $comment = null;
  if (!isset($_POST['comment']) || !strlen($_POST['comment'])) {
      $errors['comment'] = '記事を入力してください';
  } elseif (strlen($_POST['comment']) > 10000) {
      $errors['comment'] = '記事は１００００文字以内で入力してください';
  } else {
      $comment = $_POST['comment'];
  }

  //エラーがなければ保存
  if (count($errors) === 0) {
    // echo 'aaaaa';
    //保存するためのSQL文を作成
    echo $sql = "INSERT INTO post (name, comment, created_at) VALUES ('"
    . mysqli_real_escape_string($link, $name) . "','"
    . mysqli_real_escape_string($link, $comment) . "','"
    . date('Y-m-d H:i:s') . "')";

    //保存する
    mysqli_query($link, $sql);
    echo mysqli_error ($link);

    mysqli_close($link);

    header('Location: http://'. $_SERVER['HTTP_HOST']. $_SERVER['REQUEST_URI']);
  }
}
?>
  <!-- Page Header -->
  <header class="masthead" style="background-image: url('../img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Let's post!</h1>
            <span class="subheading">Would you like to submit an article?</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <p>Let's create your own article! Please fill out the form below.</p>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
       <form action="post.php" method="post" name="sentMessage" id="contactForm" novalidate> <!-- ここからform部分 -->
          <div class="control-group"> <!--クラスの役割がわからない-->
            <div class="form-group floating-label-form-group controls">
              <label>Article Title</label>
              <input type="text" class="form-control" placeholder="Article Title" id="name" required data-validation-required-message="Please enter your name.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <!-- <div class="control-group">  メアドは必要ない
            <div class="form-group floating-label-form-group controls">
              <label>Email Address</label>
              <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
              <p class="help-block text-danger"></p>
            </div>
          </div> -->
          <!-- <div class="control-group">  電話番号もいらない
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>Phone Number</label>
              <input type="tel" class="form-control" placeholder="Phone Number" id="phone" required data-validation-required-message="Please enter your phone number.">
              <p class="help-block text-danger"></p>
            </div>
          </div> -->
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Message</label>
              <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <button type="submit" class="btn btn-primary" id="sendMessageButton">SEND</button> 
        </form>
        <form>
      </div>
    </div>
  </div>