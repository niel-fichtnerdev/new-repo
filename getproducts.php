<?php
require_once 'pos/appserv/fmodel.php';
$output = '';

if(isset($_GET['category'])){
  $category = $_GET['category'];

  if(!is_numeric($category)){
    header("location: ?category=0");
    exit();
  }

  $fetch = new model();
  $query = "SELECT p.fproductid, p.fname, p.fdescription, p.fexpiry_alert, 
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
  c.fcategoryid='$category' AND comp.factive_flag = '1'";
  $result = $fetch->queryselect($query);



}
elseif(isset($_GET['search'])){
  $search = $_GET['search'];


  if($search === ''){
    $fetch = new model();
    $query = "SELECT p.fproductid, p.fname, p.fdescription, p.fexpiry_alert, 
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
    comp.factive_flag = '1'";
    $result = $fetch->queryselect($query);
  }
  elseif(preg_match('/[!@#$%^&*()\-_=+{}[\]:;"\'<>,.?~\\/]/', $search)){
    exit("Please do not use special characters");
  }
  else{

    $fetch = new model();
    $query = "SELECT p.fproductid, p.fname, p.fdescription, p.fexpiry_alert, 
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
    p.fname LIKE '%$search%' AND comp.factive_flag = '1'";
    $result = $fetch->queryselect($query);
  }
 
}
else{

  $fetch = new model();
  $query = "SELECT p.fproductid, p.fname, p.fdescription, p.fexpiry_alert, 
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
  comp.factive_flag = '1'";
  $result = $fetch->queryselect($query);
}


foreach($result as $row){

  $number1 = $row["fstnd_cost"];
  $number2 = $row["fprev_cost"];
  $formattedNumber1 = number_format($number1, 2);
  $formattedNumber2 = number_format($number2, 2);


  if(empty($row["fcategory_img"])){
    
    $image = 'photo-placeholder.png';

  }
  else{
    $image = $row["fcategory_img"];
  }

  $output .= '

      <div href="#" class="gallery-img" data-product="'.$row["fproductid"].'">
      <div class="uom">
          <p>'.$row["fstatus"].'</p>
      </div>
      <img src=../manage/img/'.$image.'>

      <div class="price-section">
          <div class="pname">
              <p>'.$row["fname"].'</p>
          </div>

          <div class="pcost">
          <p>'.$formattedNumber1.'</p>
          </div>
      </div>
      </div>
  ';
  
}

echo $output;







?>