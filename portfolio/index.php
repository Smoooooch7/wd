<?php

require('function.php');
debug('商品一覧ページ');
debugLogStart();

?>

<?php
$siteTitle = '商品一覧';
require('head.php');
require('header.php');
?>

<body>

  <div class="bg-image">
  <?php

  try{

  $dsn='mysql:dbname=wdmarket;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql ='SELECT id,name,price,pic1 FROM product WHERE 1';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $dbh = null;

  print '<br>';
  print '<h2><b>商品一覧</b></h2><br><br>';

  while(true)
  {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec==false)
  {
    break;
  }
  print '<div class=list>';
  print '<b><a href="shop_product.php?procode='.$rec['id'].'">';
  print $rec['name'].'---';
  print $rec['price'].'円';
  print '</a></b>';
  print '<br>';
  print '<br>';
  print '</div>';
}

 }catch(Exception $e){
   print'ただいま障害により大変ご迷惑をおかけしております。';
   exit();
}
   print '<br>';
   print '<a href="shop_cartlook.php" class="cartin">カートを見る</a><br><br><br>';

  ?>

    </div>

<?php
require('footer.php');
 ?>
