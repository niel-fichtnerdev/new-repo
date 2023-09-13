

<?php
if (!defined('BASE')) define('BASE', dirname(__FILE__) ."/../");
//require_once BASE.'/classes/view.class.php';
require_once 'appserv/classes/view.class.php';
//Configurations




$record_per_page = 10; //adjsut here
$page = '';
$output = '';



// fix - create functions that we can pass $start_from , $page , $record_per_page 


$view = new view($record_per_page);
$query = "SELECT * FROM sm_company WHERE factive_flag='1'";

$result = $view->select($query);

function maskString($input) {
    $length = strlen($input);

    if ($length <= 5) {
        return $input;
    }

    $firstThreeChars = substr($input, 0, 3);
    $lastTwoChars = substr($input, -2);

    return $firstThreeChars . '*****' . $lastTwoChars;
}

foreach($result as $row){


    
    
    $inputString = $row["fcompanykey"];
    $maskedString = maskString($inputString);

    $expirycheck = new controller();

    if ($expirycheck->hasExpired($row["fexpiry"])){
        
        $expiry = $row["fexpiry"].' <span style="color: red"><b>Expired</b> </span>';
    }
    else{
        $expiry = $row["fexpiry"];
    }

    if($row["fverified"] === '1'){
        $vmessage = '(Verified) <i class="fa fa-check-circle" aria-hidden="true"></i>';
    }
    else{
        $vmessage = '';
    }


  $output .= '

    <div class="content">
    <form id="companyform" enctype="multipart/form-data">
        <input type="text" name="modifycompany" value="1" hidden>
        <input type="text" name="fcompanyid" value="'.$row["fcompanyid"].'" hidden>
        <div class="clogo-container">
            <div class="img-contr">
                <img src="img/'.$row["fcompanyimg"].'" alt="clogo-temp">
            </div>
            <input type="file" class="file-input" name="clogo">
        </div>
        <div class="input-handler">
            <label>Company Name: </label>
            <input type="text" class="standard-input" value="'.$row["fname"].'"
                name="cname" disabled>
        </div>
        <div class="input-handler">
            <label>Company ID: &nbsp;'.$row["fcompanyid"].'
            </label>
        </div>

        <div class="input-handler">
            <label>Company License: </label>
            <input type="text" class="standard-input" value="'.$row["fcompanylicense"].'"
                name="clicense" disabled>
        </div>
        <div class="input-handler">
            <label>Company Key: &nbsp;'.$maskedString.$vmessage.'</label>
        </div>
        <div class="input-handler">
            <label>License valid until: &nbsp; '.$expiry.'</label>
            
        </div>
        <div class="input-handler">
            <label>Company Email: </label>
            <input type="email" class="standard-input" value="'.$row["fcompanyemail"].'"
                name="cemail">
        </div>
        <div class="input-handler">
            <label>Company Tel: </label>
            <input type="text" class="standard-input" value="'.$row["ftelno"].'"
                name="ctel">
        </div>
        <div class="input-handler">
            <label>Fax: </label>
            <input type="text" class="standard-input" value="'.$row["ffax"].'"
                name="cfax">
        </div>
        <div class="input-handler">
            <label>Company Location: </label>
            <input type="text" class="standard-input" value="'.$row["faddress"].'" name="clocation">
        </div>
        <div class="input-handler">
            <label>President: </label>
            <input type="text" class="standard-input" value="'.$row["fowner"].'" name="cowner">
        </div>
        <div class="input-handler">
            <label>Year Established: </label>
            <input type="text" class="standard-input" value="'.$row["fyest"].'" name="cest">
        </div>
        <div class="input-handler">
            <label>Memo: </label>
            <textarea name="cmemo" name="cmemo">'.$row["fmemo"].'</textarea>
        </div>





        <!-- Save Button Here -->

        <div class="input-handler">
            <button type="submit" name="csave"><b>Save</b></button>
        </div>

    </form>
    </div>
  


  ';
  
}

echo $output;

//$test = new view;
//$test->testdata(100);
//var_dump($test);


//pagination link


    
    
//var_dump($total_pages);

