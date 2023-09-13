

<?php
if (!defined('BASE')) define('BASE', dirname(__FILE__) ."/../");
//require_once BASE.'/classes/view.class.php';
require_once 'appserv/classes/view.class.php';
//Configurations




$record_per_page = 10; //adjsut here
$page = '';
$output = '';
$link = '';


if(isset($_GET["page"])){

  $page = $_GET['page'];

}
else{
  $page = 1;
}
if(isset($_GET['sproduct'])){
  $page = 9999999999;
}
if(isset($_GET['sfilterby']) && isset($_GET['szcategory'])){
  $page = 9999999999;
}

if(isset($_GET["page"]) && !is_numeric($_GET["page"])){
  $page = 1;
}


// fix - create functions that we can pass $start_from , $page , $record_per_page 

$start_from = ($page - 1) * $record_per_page;
$view = new view($record_per_page);
$query = "SELECT 
p.fproductid, p.fname, p.fdescription, p.fexpiry_alert, 
p.fprev_cost, p.fstnd_cost, p.ftax_type, p.fuom, 
p.fcategory_id, p.ftag, p.fmemo, p.factive_flag, 
p.fsale_flag, p.fcreated_by, p.fstatus, p.fstock, 
p.fupdated_by, p.fupdated_date, 
c.fcategory_img, comp.fcompanyid
FROM 
mst_product AS p 
JOIN 
mst_product_category AS c 
ON p.fcategory_id = c.fcategoryid 
JOIN 
sm_company AS comp 
ON p.fcompanyid = comp.fcompanyid 
AND c.fcompanyid = comp.fcompanyid	
WHERE 
comp.factive_flag = '1'
ORDER BY fupdated_date DESC LIMIT $start_from, $record_per_page";

$result = $view->select($query);

$img_path = "img/";


foreach($result as $row){

  $number1 = $row["fstnd_cost"];
  $number2 = $row["fprev_cost"];
  $formattedNumber1 = number_format($number1, 2);
  $formattedNumber2 = number_format($number2, 2);


  if(empty($row["fcategory_img"])){
    
    $image = $img_path.'photo-placeholder.png';

  }
  else{
    $image = $img_path.$row["fcategory_img"];
  }

  $output .= '

    <tr>
      <td><span class="custom-checkbox"><input type="checkbox" class="userCheckbox" data-product-id="'.$row["fproductid"].'"></span>
      </td>
      <td> <img height="50px" width="50px" src='.$image.'> </td>
      <td>'.$row["fproductid"].'</td>
      <td>'.$row["fname"].'</td>
      <td>'.$formattedNumber1.'</td>
      <td>'.$row["fcategory_id"].'</td>
      <td>'.$row["fstock"].'</td>
      <td>'.$row["fstatus"].'</td>
      <td>'.$row["fupdated_date"].'</td>



      <td>
      <button onclick="editproduct(\''.$row["fproductid"].'\', \''.$row["fname"].'\' , \''.$row["fdescription"].'\' , \''.$row["fexpiry_alert"].'\' , \''.$formattedNumber2.'\' , \''.$formattedNumber1.'\' , \''.$row["ftax_type"].'\' , \''.$row["fuom"].'\' , \''.$row["fcategory_id"].'\' , \''.$row["ftag"].'\' , \''.$row["fmemo"].'\' , \''.$row["factive_flag"].'\' , \''.$row["fsale_flag"].'\' , \''.$row["fcreated_by"].'\' , \''.$row["fstatus"].'\' , \''.$row["fstock"].'\' , \''.$row["fupdated_by"].'\' , \''.$row["fupdated_date"].'\')" class="open_product"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button>
  </td>
    </tr>
  ';
  
}

echo $output;

//$test = new view;
//$test->testdata(100);
//var_dump($test);


//pagination link


    
    
//var_dump($total_pages);

