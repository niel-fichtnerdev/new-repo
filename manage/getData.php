

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
if(isset($_GET['search'])){
  $page = 9999999999;
}
if(isset($_GET['filterby'])){
  $page = 9999999999;
}

if(isset($_GET["page"]) && !is_numeric($_GET["page"])){
  $page = 1;
}


// fix - create functions that we can pass $start_from , $page , $record_per_page 

$start_from = ($page - 1) * $record_per_page;
$view = new view($record_per_page);
$query = "SELECT * FROM mst_account ORDER BY faccountid DESC LIMIT $start_from, $record_per_page";

$result = $view->select($query);

foreach($result as $row){
  $hashedPassword = $row['fpassword'];
  $truncatedPassword = substr($hashedPassword, 0, 20);
  $output .= '

  
    <tr>
      <td><span class="custom-checkbox"><input type="checkbox" class="userCheckbox" data-user-id="'.$row["faccountid"].'"></span>
      </td>
      <td>'.$row["faccountid"].'</td>
      <td>'.$row["ffname"].'&nbsp;' .$row["flname"].'</td>
      <td>'.$row["fuserid"].'</td>
      <td>'.$row["faccesslvl"].'</td>
      <td>'.$row["femail"].'</td>
      <td>'.$row["faddress"].'</td>
      <td>'.$row["fphone"].'</td>
      <td>'.$row["fcreated_by"].'</td>
      <td>'.$row["fupdated_date"].'</td>



      <td>
      <button onclick="editModal(\''.$row["faccountid"].'\',  \''.$row["ffname"].'\', \''.$row["flname"].'\',  \''.$row["fmname"].'\',  \''.$row["fsex"].'\', \''.$row["fcivil_status"].'\',  \''.$row["faddress"].'\', \''.$row["femail"].'\', \''.$row["fphone"].'\', \''.$row["fuserid"].'\', \''.$truncatedPassword.'\', \'' . $row["fbirthdate"] . '\', \''.$row["fbirth_place"].'\', \''.$row["fmemo"].'\', \''.$row["fsecurity_question"].'\', \''.$row["fsecurity_answer"].'\', \''.$row["factive_flag"].'\', \''.$row["faccesslvl"].'\', \''.$row["fofficeid"].'\', \''.$row["fcreated_by"].'\', \''.$row["fcreated_date"].'\', \''.$row["factive_flag"].'\', \''.$row["flast_logon"].'\')" class="open_usersz"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button>
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

