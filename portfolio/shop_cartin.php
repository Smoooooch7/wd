<?php

 $siteTitle = '商品追加';
 require('head.php');
 require('header.php');

 ?>

<body>

<?php

  try
  {

  $pro_code=$_GET['procode'];

  if(isset($_SESSION['cart'])==true)
  {
     $cart=$_SESSION['cart'];
     $kazu=$_SESSION['kazu'];
     if(in_array($pro_code,$cart)==true)
     {
       print 'その商品はすでにカートに入っています。<br><br>';
       print '<a href="index.php" class="index">商品一覧へ戻る</a>';
       exit();
     }
  }
  $cart[]=$pro_code;
  $kazu[]=1;
  $_SESSION['cart']=$cart;
  $_SESSION['kazu']=$kazu;

  foreach($cart as $key => $val)
  {
    print $val;
    print '<br>';
  }

  }

  catch(Exception $e){

    print'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
  }

?>

カートに追加しました。<br>
<br>
<a href="index.php" class="index">商品一覧へ戻る</a>

</body>
</html>
