<?php
require_once 'pos/appserv/fmodel.php';
$output = '';


$fetch = new model();
$query = "SELECT a.fcategory_name, a.fcategoryid, b.factive_flag FROM mst_product_category as a JOIN sm_company as b ON a.fcompanyid=b.fcompanyid WHERE b.factive_flag='1'";
$result = $fetch->queryselect($query);



foreach($result as $row){

  $output .= '
    <div class="category-label" data-category="'.$row["fcategoryid"].'">
        <p>'.$row["fcategory_name"].'</p>
    </div>

  ';
  
}

echo $output;





?>