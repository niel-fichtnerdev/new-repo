

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
if(isset($_GET['ftrxdate'])){
  $page = 9999999999;
}
if(isset($_GET['ffilterby']) && isset($_GET['fterminal'])){
  $page = 9999999999;
}

if(isset($_GET["page"]) && !is_numeric($_GET["page"])){
  $page = 1;
}


// fix - create functions that we can pass $start_from , $page , $record_per_page 

$start_from = ($page - 1) * $record_per_page;
$view = new view($record_per_page);
$query = "SELECT a.fgross, a.fsale_date , b.factive_flag, a.ftax, a.fgross2, a.fpgross, a.fzcounter, a.ftermid, a.ftotal_transaction, a.fcompanyid FROM pos_reading as a JOIN sm_company as b ON a.fcompanyid = b.fcompanyid WHERE b.factive_flag='1' AND a.fzcounter!='0' ORDER BY a.fupdated_date DESC LIMIT $start_from, $record_per_page";

$result = $view->select($query);

foreach($result as $row){
  $number1 = $row["fgross"];
  $number2 = $row["ftax"];
  $number3 = $row["fgross2"];
  $number4 = $row["fpgross"];
  $formattedNumber1 = number_format($number1, 2);
  $formattedNumber2 = number_format($number2, 2);
  $formattedNumber3 = number_format($number3, 3);
  $formattedNumber4 = number_format($number4, 2);
  
  $output .= '

    <tr>
      <td>
      <span class="custom-checkbox"><input type="checkbox" class="userCheckbox" data-summary-id="'.$row["fzcounter"].'"></span>
      </td>

      <td>'.$row["fzcounter"].'</td>
      <td>'.$row["ftermid"].'</td>
      <td>'.$row["fsale_date"].'</td>
      <td>'.$row["ftotal_transaction"].'</td>
      <td>'.$formattedNumber1.'</td>
      <td>'.$formattedNumber2.'</td>
      <td>'.$formattedNumber3.'</td>
      <td>'.$formattedNumber4.'</td>

      <td>
      <button onclick="viewincome(\''.$row["fzcounter"].'\')" class="open_income"><i class="fa fa-eye" aria-hidden="true"></i> view </button>
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

