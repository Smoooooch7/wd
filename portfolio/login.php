<?php

require('function.php');

debug('ログインページ');
debugLogStart();


if(!empty($_POST)){
  debug('POST送信あり');

  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $pass_save = (!empty($_POST['pass_save'])) ? true : false;

  validEmail($email,'email');
  validMax($email,'email');

  validHalf($pass,'pass');
  validMax($pass,'pass');
  validMin($pass,'pass');

  validRequired($email,'email');
  validRequired($pass,'pass');

  if(empty($err_msg)){
    debug('バリデーションOK');

    try {
      $dbh = dbConnect();
      $sql = 'SELECT password,id FROM users WHERE email = :email AND delete_flg =0';
      $data = array(':email' => $email);
      $stmt = queryPost($dbh,$sql,$data);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      debug('クエリ結果の中身：'.print_r($result,true));

      //PW照合
      if(!empty($result) && password_verify($pass,array_shift($result))){
        debug('パスワード一致');

        $sesLimit = 60*60;
        $_SESSION['login_date']=time();

        if($pass_save){
          debug('ログイン保持にチェックあり');
          $_SESSION['login_limit'] = $sesLimit * 24 * 30;
        }else{
          debug('ログイン保持にチェックなし');
          $_SESSION['login_limit'] = $sesLimit;
        }
        $_SESSION['user_id'] = $result['id'];
        debug('セッション変数の中身：'.print_r($_SESSION,true));
        debug('商品一覧へ遷移');
        header("Location:index.php");
      }else{
        debug('パスワード不一致');
        $err_msg['common'] = MSG09;
      }
    } catch (Exception $e) {
      error_log('エラー発生：'.$e->getMessage());
      $err_msg['common'] = MSG07;
    }
  }
}

debug('画面表示処理終了');
?>

<?php
$siteTitle = 'ログイン';
require('head.php');
?>

<body class="">
<?php
require('header.php');
?>

<div class="err-msg">
  <form action="" method="post" class="form">
    <?php
     if(!empty($err_msg['common'])) echo $err_msg['common'];
    ?>
    </div>
    <h2>ログイン</h2>
    <p>メールアドレス<br>
    <div class="err-msg"><?php if(!empty($err_msg['email'])) echo $err_msg['email']; ?><br>
    </div>
    <input type="text" name="email" value="<?php if(!empty($_POST['email'])) echo $_POST['email']; ?>"></p>
    <p>パスワード<br>
    <div class="err-msg"><?php if(!empty($err_msg['pass'])) echo $err_msg['pass']; ?><br>
    </div>
    <input type="password" name="pass" value="<?php if(!empty($_POST['pass'])) echo $_POST['pass']; ?>"></p>

    <input type="checkbox" name="pass_save">次回ログインを省略する
    <div class="btn-container">
     <input type="button" onclick="history.back()" value="戻る">
     <input type="submit" class="btn btn-mid" value="ログイン">
    </div>
   </form>


<?php
require('footer.php');
 ?>
