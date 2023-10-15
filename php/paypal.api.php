###########	blade

	{{-- <?php echo $subTotal+ $vat+$shipping_cost; ?> --}}


<?php
  $total=$subtotal+$vat+$shipping_cost;
  Session::put('total', $total);
  echo $total;	
?>

#########paypal file
$gtotal= Session::get('total');

then we can use [[[[[[[ $gtotal ]]]]]]]]

