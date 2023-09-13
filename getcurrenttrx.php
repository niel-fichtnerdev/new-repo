<?php
require_once 'pos/appserv/fmodel.php';
$output = '';


$fetch = new model();
$query = "SELECT a.fname, b.fqty, a.fstnd_cost, b.fproductid FROM mst_product as a JOIN pos_sale_current as b ON b.fproductid=a.fproductid";
$result = $fetch->queryselect($query);


foreach($result as $row){

    
  $number1 = $row["fstnd_cost"];
  $formattedNumber1 = number_format($number1, 2);

  $output .= '

  <tr>
    <td class="product-list" data-fproducts="'.$row["fproductid"].'"><a href=""><i class="fa fa-times" aria-hidden="true"></i></a></td>
    <td>'.$row["fname"].'</td>
    <td><input type="number" class="quantity-input" name="quantity" data-productid="'.$row["fproductid"].'" value="'.$row["fqty"].'"></td>
    <td>'.$formattedNumber1.'</td>
  </tr>


  ';
  
}

echo $output;





?>