<?php

  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Home';
  require_once('header.php');
  require_once('appvars.php');
  require_once('connectvars.php');
 
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

require_once('navmenu');

	$cart = $_SESSION['cart'];
	$n=0;
	
		while ($cart[$n][0]!=NULL){
	 $n++;
	}

	if ($n) {

	echo '<br /><br /><br /><br /><br /><br />';
 
		$output[] = '<form action="cart.php?action=update" method="post" id="cart">';
		$output[] = '<table class="carttable">';
		  
	for ($p=0; $p<$n; $p++){	 
	  if($cart[$p][0]=='Kris-9' || $cart[$p][0]=='4-the-$' || $cart[$p][0]=='Slider-74'  || $cart[$p][0]=='Paradise-73' ){
		$output[] = '<tr>';
		$output[] = '<th rowspan="2"><a href="cart.php?action=delete&id='.$p.'" class="r">Remove</a></th>';
		$output[] = '<th rowspan="2"><b>'.$cart[$p][0] .'</b></th>';
		$output[] = '<td>Finish: '.$cart[$p][2].'</td>';
		$output[] = '<td>Length: '. $cart[$p][1] .'"</td>';
 		$output[] = '<td>Grip: '. $cart[$p][3] .'</td>';
	    $output[] = '<th rowspan="2">$289.99</th>';	
		$output[] = '<th rowspan="2"><input type="text" name="qty'.$p.'" value="'.$cart[$p][6].'" size="3" maxlength="3" /></th>';
		$output[] = '<th rowspan="2">$'.(289.99 * $cart[$p][6]).'</th></tr>';
		$output[] = '<tr><td>'. $cart[$p][4] .' handed</td>';
		$output[] = '<td>Head Cover:'. $cart[$p][5] .'</td>';	
		$total += 289.99 * $cart[$p][6];
		$output[] = '</tr><tr><td>&nbsp;</td></tr>';
	
	}else{
	  $output[] = '<tr>';
		$output[] = '<th rowspan="2"><a href="cart.php?action=delete&id='.$p.'" class="r">Remove</a></th>';
		$output[] = '<th rowspan="2"><b>'.$cart[$p][0] .'</b></th>';
		$output[] = '<th rowspan="2">$7.00</th>';	
		$output[] = '<th rowspan="2"><input type="text" name="qty'.$p.'" value="'.$cart[$p][6].'" size="3" maxlength="3" /></th>';
		$output[] = '<th rowspan="2">$'.(7.00 * $cart[$p][6]).'</th></tr>';
		$total += 7.00 * $cart[$p][6];
		$output[] = '</tr><tr><td>&nbsp;</td></tr>';
	
	}
		
	} 
		$output[] = '</table>';
	$output[] = '<p style="position:relative; right:-500px;"><b>Grand total: $'.$total.'</b></p>';
	   $output[] = '<div><button type="submit">Update cart</button></div>';
	  $output[] = '</form>';
	   $output[] = '<a href="putters.php" style="position:relative; right:-300px; top:-50px""><b>Continue Shopping</b></a>';
	
 //  $output[] = '<form action="waitlist.php" method="post" id="waitlist">';
//	$output[] = '<input type="submit"  id="waitlist" style="position:relative; right:-700px; top:-110px;" value="Add To Wait List"/>';
 // $output[] = '</form>';	
	} else {
	    $output[] ='<br /><br /><br /><br /><br /><br /><br /><br />';
		$output[] = '<p>You shopping cart is empty.</p>';
		$output[] ='<br /><br /><br /><br /><br /><br /><br /><br />';
	echo join('',$output);
	require_once('footer.php');
	exit;
} 

echo join('',$output);




 

echo '<br />';
?>

<form style="position:relative; right:-700px; top:-90px;" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="business" value="travis.g@paradigmputters.com">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<?php 

for ($m=0; $m<$n; $m++){

echo '<input type="hidden" name="item_name_' .($m+1) .'"';
echo ' value="'. $cart[$m][0] . '">';
echo '<input type="hidden" name="amount_' . ($m+1) . '" value="' . 7.00 . '">';
echo '<input type="hidden" name="quantity_' . ($m+1) . '" value="' . $cart[$m][6] . '">';
}

?>

<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="shopping_url" value="http://www.beerpuck.com/pucks.php">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_SM.gif" border="0" name="submit" disable="disable" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>



<?php
echo '<br /><br /><br /><br /><br /><br />';



require_once('footer.php');
?>

