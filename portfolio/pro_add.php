<?php
  require('function.php');
 ?>

<?php

$siteTitle = '商品追加ページ';
require('head.php');

 ?>

  <body>
    <?php
      require('header.php');
     ?>

    <h2>商品追加</h2>
    <br>
    <form method="post" action="pro_add_check.php" enctype="multipart/form-data">
      商品名を追加してください。<br>
       <input type="text" name="name"><br>
      価格を入力してください。<br>
      ※半角英数字<br>
       <input type="text" name="price"><br>
      <br>
      画像を選んでください。<br>
       <input type="file" name="image"><br>
      <br>
       <input type="submit" value="OK" class="btn">
    </form>

    <?php
      require('footer.php');
     ?>
