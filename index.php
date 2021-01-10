<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

    Spot Price : <input type="number"  step="0.01" name="spotprice"> <br>
  Strike Price : <input type="number"  step="0.01" name="strikeprice"> <br>

  Time in Days : <input type="number"   name="time"> <br>

Vola: <input type="number"  step="0.01" name="v"> <br>
RF <input type="number"  step="0.01" name="rf"> <br>
N <input type="number"  step="any" name="n"> <br>

  <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $strikeprice = $_POST['strikeprice'];
  $spotprice = $_POST['spotprice'];
  $time = $_POST['time'];
  $v = $_POST['v'];
  $rf = $_POST['rf'];
    $n = $_POST['n'];
  if (empty($strikeprice) or empty($spotprice) or empty($time) or empty($v) or empty($rf)
or empty($n)
  )
  {
    echo "Data is missing";
  } else {
    echo "Spot Price (S)".$spotprice."<br>";
    echo "Risk Free Rate (R)".($rf/100)."<br>";

    echo "Strike Price".$strikeprice."<br>";
    echo "Time ".$time."<br>";
    echo "volatility".$v."<br>";

    $u=exp(($v/100)*sqrt($time/365));
    $d=1/$u;
    echo "The Up and Down Factors are <br>";
    echo " Magnitude of Up Jump (U) = ".$u."<br>";
    echo "Magnitude of Down Jump (D) = ".$d."<br>";
    echo "Risk Neutral of up and down are  <br>";

    $pie_u=(exp(($rf/100)*($time/365))-$d)/($u-$d);
    $pie_d=1-$pie_u;
    echo "Probility of Up Jump (p) = ".$pie_u."<br>";
    echo "probility of Down Jump  (1-p) =".$pie_d."<br>";
    $rnp=((1+($rf/100))-$d)/($u-$d);
    echo "Risk Neutral Prob ".$rnp;
echo"<BR>q".$q=(exp(-1*($rf/100)*($time/365))-$d)/($u-$d);
/* towards black s */
echo "Delta T ".$delta_t=($time/365)/$n;
echo $delta_t*365;
echo "<br>";
echo "discount";
echo $discount=100/(pow(1+($rf/100),$delta_t));
echo "<br>";
echo "u ";
echo $overall_u=exp(($v/100)*sqrt($delta_t));
echo "<br>";
echo "d ".$overall_d=1/$overall_u;
echo "<br>";
echo "a".$a=exp(($rf/100)*$delta_t);
echo "<br>";
$p=($a-$overall_d)/($overall_u-$overall_d);
echo " Prob of up jump is (p)".$p."<br>";
echo "prob of down jump is (q) ".$q=1/$p;
echo "<br><br>Level 0<br>";
echo $stock[0][0]=$strikeprice;
 for ($i=1; $i <$n+1 ; $i++) {
$stock[$i][0]=$stock[$i-1][0]*$u;
 for ($j=1; $j <$i+1 ; $j++) {

   $stock[$i][$j]=$stock[$i-1][$j-1]*$d;

  }
  }

  for ($i=1; $i <$n+1 ; $i++) {
  echo "<br><br>Level".$i;
 echo "<br>".$stock[$i][0];
  for ($j=1; $j <$i+1 ; $j++) {
echo  "<br>".$stock[$i][$j];

   }
   }


}

  }
?>
</table>
</body>
</html>
