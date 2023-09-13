<?php

//Here is the middle-ware for getting data from our backend to frontend

if (!defined('BASE')) define('BASE', dirname(__FILE__) ."/../");
//require_once BASE.'/classes/view.class.php';


/*
if(isset($_GET['page'])){
    //require_once 'getData.php';
}


if(isset($_GET['page']) && isset($_GET['sproduct'])){
    //require 'getInventory.php';
}
*/

/*
###### N O T E S #####

sys_mode -> system mode whether in development mode , test mode, staging or prod (Activate mode via GET URL).

Company Table

sm_company -> company list with all company data
sm_terminals -> list of terminals and details setup 

sys_notif -> all system notification




FOR POS SIDE TABLES

pos_sale -> transactions details including recno, reciept and etc.
pos_sale_product -> transaction products (Product ID only)
pos_sale_payment -> total, change, cash mode of payment and etc.
pos_sale_current -> list of products in the current transaction / selected.

Income Summary Module

z-counter -> increment every EOD.
terminal -> terminal number transaction.
Date -> date of transactions
Total Transactions -> total count of transction everyday.
total sales -> total Net gross everyday
tax -> total tax deduction
presenet nrgt -> current nrgt including the current day sales
previous nrgt -> Yesterday nrgt




*/




//Handle Dynamic Select
if(isset($_POST['request'])){
    require_once 'appserv/classes/view.class.php';
    $perpage = 10;
    $option = new view($perpage);
    $option->gproductcategory();

}

if(isset($_POST['request2'])){
    require_once 'appserv/classes/view.class.php';
    $perpage = 10;
    $option = new view($perpage);
    $option->gproductcategory();

}

if(isset($_POST['fzcounter'])){
    require_once 'appserv/classes/view.class.php';
    
    require_once './appserv/classes/controller.class.php';

    $fzcounter = $_POST['fzcounter'];


    //$getdate = new controller();
    $gettrx = new controller();

    $gettrx->gettransaction($fzcounter);


}

if(isset($_POST['trxdate'])){
    require_once 'appserv/classes/view.class.php';
    
    require_once './appserv/classes/controller.class.php';

    $fzcounter = $_POST['trxdate'];


    //$getdate = new controller();
    $gettrx = new controller();
    $gettrx->gettrxdate($fzcounter);

}

if(isset($_POST['trxsummary'])){

    require_once './appserv/classes/controller.class.php';

    $fzcounter = $_POST['trxsummary'];


    //$gettrxsummary = new controller();
    //$gettrxsummary->gettrxsummary($fzcounter);


}

if(isset($_POST['currenttrx'])){
    require_once './appserv/classes/controller.class.php';
    //Working!
    $fzcounter = $_POST['currenttrx'];

    //$getdate = new controller();
    $gettrx = new controller();

    $gettrx->gettransaction($fzcounter);
}



//Handle Dynamic Select
if(isset($_POST['request3'])){
    require_once 'appserv/classes/view.class.php';
    $perpage = 10;
    $option = new view($perpage);
    $option->gproductcategory2();

}

//Handle Dynamic Select
if(isset($_POST['request4'])){
    require_once 'appserv/classes/view.class.php';
    $perpage = 10;
    $option = new view($perpage);
    $option->gproductcategory2();

}

//Filter Sales summary here

if(isset($_GET['ffilterby']) && isset($_GET['fterminal'])){

    require_once 'appserv/classes/controller.class.php';
    require_once 'appserv/classes/view.class.php';

    //working
    $output = '';
    $per_page = 10; //adjsut here
    $filterby = $_GET['ffilterby'];
    $fterminal = $_GET['fterminal'];
    $module = 'pos_reading';

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }   
    else{
        $page = 1;
    }

    if($filterby == 'any' && $fterminal == '0001'){
        $URL = "income_summary.php";
        echo "<script type='text/javascript'>document. location. href='{$URL}';</script>"; echo '<META HTTP-EQUIV="refresh" content="0;URL=';
    }
    

    $table = 'pos_reading as a JOIN sm_company as b ON a.fcompanyid = b.fcompanyid';
    $column = 'a.fgross, a.fsale_date , b.factive_flag, a.ftax, a.fgross2, a.fpgross, a.fzcounter, a.ftermid, a.ftotal_transaction, a.fcompanyid';
    $params = "b.factive_flag='1' AND a.fsale_date>='$filterby'";
    $query = new controller();
    $query->search($table, $column, $params, $per_page, $page, $module);
}


//sale summary transatcion

if(isset($_GET['ftrxdate'])){

    $output = '';
    $module = 'pos_reading';

    require_once 'appserv/classes/controller.class.php';

    $ftrx = $_GET['ftrxdate'];

    $search = str_replace("-", "", $ftrx);

    if(strlen($search) > 100){
        $URL = "income_summary";
        echo "<script type='text/javascript'>document. location. href='{$URL}';</script>"; echo '<META HTTP-EQUIV="refresh" content="0;URL=';
    }


    if(empty($search)){
        $URL = "income_summary";
        echo "<script type='text/javascript'>document. location. href='{$URL}';</script>"; echo '<META HTTP-EQUIV="refresh" content="0;URL=';
    }

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }

    
    $per_page = 10; //adjsut here

    $table = 'pos_reading as a JOIN sm_company as b ON a.fcompanyid = b.fcompanyid';
    $column = 'a.fgross, a.fsale_date , b.factive_flag, a.ftax, a.fgross2, a.fpgross, a.fzcounter, a.ftermid, a.ftotal_transaction, a.fcompanyid';
    $params = "b.factive_flag='1' AND a.fsale_date>='$search'";
    $query = new controller();
    $query->search($table, $column, $params, $per_page, $page, $module);


}



if(isset($_GET['filterby'])){

    //working
    $output = '';
    $per_page = 10; //adjsut here
    $filterby = $_GET['filterby'];
    $module = 'mst_account';

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }   
    else{
        $page = 1;
    }

    if($filterby == 'any'){
        $URL = "manage_users.php";
        echo "<script type='text/javascript'>document. location. href='{$URL}';</script>"; echo '<META HTTP-EQUIV="refresh" content="0;URL=';
    }

    $table = 'mst_account';
    $column = '*';
    $params = "faccesslvl='$filterby'";

    $query = new controller();
    $query->search($table, $column, $params, $per_page, $page, $module);
}


if(isset($_GET['sfilterby']) &&isset($_GET['szcategory']) ){
        //working
        $output = '';
        $per_page = 10; //adjsut here
        $filterby = $_GET['sfilterby'];
        $category = $_GET['szcategory'];
        $module = 'mst_product';
    
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }   
        else{
            $page = 1;
        }
    
        if($filterby == 'any' && $category == 'any'){
            $URL = "inventory";
            echo "<script type='text/javascript'>document. location. href='{$URL}';</script>"; echo '<META HTTP-EQUIV="refresh" content="0;URL=';
        }
    
        $table = 'mst_product AS p 
        JOIN 
            mst_product_category AS c 
            ON p.fcategory_id = c.fcategoryid 
        JOIN 
            sm_company AS comp 
            ON p.fcompanyid = comp.fcompanyid 
            AND c.fcompanyid = comp.fcompanyid';
        $column = '    p.fproductid, p.fname, p.fdescription, p.fexpiry_alert, 
        p.fprev_cost, p.fstnd_cost, p.ftax_type, p.fuom, 
        p.fcategory_id, p.ftag, p.fmemo, p.factive_flag, 
        p.fsale_flag, p.fcreated_by, p.fstatus, p.fstock, 
        p.fupdated_by, p.fupdated_date, 
        c.fcategory_img, comp.fcompanyid';

        if($category == 'any'){
            $params = "p.fstatus='$filterby' and comp.factive_flag = '1'";
        }
        elseif($filterby == 'any'){
            $params = "p.fcategory_id='$category' and comp.factive_flag = '1'";
        }
        else{
            $params = "p.fstatus='$filterby' and fcategory_id='$category' and comp.factive_flag = '1' ";
        }
        
    
        $query = new controller();
        $query->search($table, $column, $params, $per_page, $page, $module);
}



//search account

if(isset($_GET['search'])){

    $output = '';
    $module = 'mst_account';

    require_once 'appserv/classes/controller.class.php';
    require_once 'appserv/classes/view.class.php';

    $search = $_GET['search'];

    if(strlen($search) > 15){
        $URL = "manage_users.php";
        echo "<script type='text/javascript'>document. location. href='{$URL}';</script>"; echo '<META HTTP-EQUIV="refresh" content="0;URL=';
    }

    if(!preg_match("/^[a-zA-Z]+$/",$search)){
        $URL = "manage_users.php";
        echo "<script type='text/javascript'>document. location. href='{$URL}';</script>"; echo '<META HTTP-EQUIV="refresh" content="0;URL=';
    }

    if(empty($search)){
        $URL = "manage_users.php";
        echo "<script type='text/javascript'>document. location. href='{$URL}';</script>"; echo '<META HTTP-EQUIV="refresh" content="0;URL=';
    }

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }

    
    $per_page = 10; //adjsut here

    $table = 'mst_account';
    $column = '*';

    $params = "flname LIKE '%$search%' OR femail LIKE '%$search%' OR ffname LIKE '%$search%' OR faccountid LIKE '%$search%' OR fuserid LIKE '%$search%'";
    
    $query = new controller();
    $query->search($table, $column, $params, $per_page, $page, $module);

}


//search product

if(isset($_GET['sproduct']) && isset($_GET['page'])){
    
    $output = '';
    $module = 'mst_product';

    require_once 'appserv/classes/controller.class.php';
    require_once 'appserv/classes/view.class.php';

    $search = $_GET['sproduct'];

    if(strlen($search) > 15){
        $URL = "inventory";
        echo "<script type='text/javascript'>document. location. href='{$URL}';</script>"; echo '<META HTTP-EQUIV="refresh" content="0;URL=';
    }

    if(!preg_match("/^[a-zA-Z0-9]+$/",$search)){
        $URL = "inventory";
        echo "<script type='text/javascript'>document. location. href='{$URL}';</script>"; echo '<META HTTP-EQUIV="refresh" content="0;URL=';
    }

    if(empty($search)){
        $URL = "inventory";
        echo "<script type='text/javascript'>document. location. href='{$URL}';</script>"; echo '<META HTTP-EQUIV="refresh" content="0;URL=';
    }

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }

    
    $per_page = 10; //adjsut here

    $table = 'mst_product AS p 
    JOIN 
        mst_product_category AS c 
        ON p.fcategory_id = c.fcategoryid 
    JOIN 
        sm_company AS comp  
        ON p.fcompanyid = comp.fcompanyid 
        AND c.fcompanyid = comp.fcompanyid';
    
        $column = 'p.fproductid, p.fname, p.fdescription, p.fexpiry_alert, 
    p.fprev_cost, p.fstnd_cost, p.ftax_type, p.fuom, 
    p.fcategory_id, p.ftag, p.fmemo, p.factive_flag, 
    p.fsale_flag, p.fcreated_by, p.fstatus, p.fstock, 
    p.fupdated_by, p.fupdated_date, 
    c.fcategory_img, comp.fcompanyid';

    $params = "p.fproductid LIKE '%$search%' OR p.fname LIKE '%$search%' AND comp.factive_flag='1' ";
    
    $query = new controller();
    $query->search($table, $column, $params, $per_page, $page, $module);

}

if(isset($_POST['addproduct'])){

    require_once 'appserv/classes/controller.class.php';
    require_once 'appserv/classes/view.class.php';

    date_default_timezone_set('Asia/Manila');
    //POST RECIEVED
    $productid = $_POST['fproductid'];
    $productname = $_POST['fproductname'];
    $productdesc = $_POST['fproductdesc'];
    $productprice = $_POST['fproductprice']; //stnd_cost
    $productexp = $_POST['fproductexpiry']; //expiry alert
    $productuom = $_POST['fproductuom'];
    $productwnty = $_POST['fproductwarranty'];
    $productcat = $_POST['fproductcategory'];
    $producttag = $_POST['fproducttag'];

    //POST ADDONS
    $fcompanyid = new controller();
    $fcompanyid = $fcompanyid->getcompanyid();
    $factive_flag = 'Y';
    $fsale_flag = 'Y';
    $fmemo = 'Not set';
    $fprev_cost = '0';
    $ftax_type = 'A';
    $fstock = '0';
    $fstatus = 'new';

    //Creator / Update Details
    $fcreated_by = 'Admin';
    $fcreated_date = date('Ymd');
    $fupdated_by = 'Admin';
    $fupdated_date = date('Ymd h:m:s');

    //parameter information
    $table = 'mst_product';
    $params = 'fproductid=?';


    $validate = new controller();
    
    //Validate Existence
    $validate_exist = $validate->ifexist($table, $params, $productid);
    
    if($validate_exist == true){

        echo 'Product ID is already taken';
    }
    else{

        $validated = new controller;
        $validated->preproduct($fcompanyid, $productid, $productname, $productdesc, $factive_flag, $fsale_flag, $fmemo, $producttag, $productprice, $fprev_cost, $ftax_type, $productuom, $fstock, $fstatus, $productexp, $productcat, $productwnty, $fcreated_by, $fcreated_date, $fupdated_by, $fupdated_date);

        echo 'Product Added Successfully!';

    }
    

    
 
}



if(isset($_POST['modifyaccount'])){

    require_once 'appserv/classes/controller.class.php';
    require_once 'appserv/classes/view.class.php';

    date_default_timezone_set('Asia/Manila');

    $faccountid = $_POST['faccountid'];
    $ffname = $_POST['ffname'];
    $flname = $_POST['flname'];
    $fmname = $_POST['fmname'];
    $fcivil_status = $_POST['fcivil_status'];
    $faddress = $_POST['faddress'];
    $femail = $_POST['femail'];
    $fphone = $_POST['fphone'];
    $password = $_POST['fnewpassword'];
    $fsex = $_POST['fsex'];
    $status = $_POST['fstatus'];
    $fusername = $_POST['fusername'];
    $fbirthdate = $_POST['fbirthdate'];
    $fbirth_place = $_POST['fbirth_place'];
    $fmemo = $_POST['fmemo'];
    $faccesslvl = $_POST['faccesslvl'];
    $fofficeid = $_POST['fofficeid'];


    $fcompanyid = new controller();
    $fcompanyid = $fcompanyid->getcompanyid();
    $factive_flag = '1';
    $flogon_flag = date('Ymd h:i:s A');
    $fpassword_update = date('Ymd h:i:s A');
    $flast_logon = '2';
    $fsecurity_question = 'Not set';
    $fsecurity_answer = '0';
    $fcreated_by = 'Admin';
    $fcreated_date = date('Ymd h:i:s A');
    $fupdated_by = 'Admin';
    $fupdated_date = date('Ymd h:i:s A');
    $fname = $ffname." ".$flname;
    $foldpassword = $_POST['foldpassword'];
    
    $table = "mst_account";
    $params = "faccountid=?";
    $params2 = $_POST['faccountid'];




    $validate = new controller();
    
    //Validate Existence
    $validate_exist = $validate->ifexist($table, $params, $faccountid);
    
    if($validate_exist == true){

        if(empty($password)){
            $validated = new controller;
            $validated->execupdate($fcompanyid, $faccountid, $factive_flag, $fname, $ffname, $flname, $fmname, $faddress, $fphone, $fofficeid, $faccesslvl, $fmemo, $flogon_flag, $fusername, $foldpassword, $fpassword_update, $flast_logon, $fsecurity_question, $fsecurity_answer, $femail, $fbirthdate, $fsex, $fcivil_status, $fupdated_by, $fupdated_date, $fbirth_place, $params2);

            echo 'Updated Successfuly';

        }
        else{
            $validated = new controller;
            $validated->execupdate($fcompanyid, $faccountid, $factive_flag, $fname, $ffname, $flname, $fmname, $faddress, $fphone, $fofficeid, $faccesslvl, $fmemo, $flogon_flag, $fusername, $password, $fpassword_update, $flast_logon, $fsecurity_question, $fsecurity_answer, $femail, $fbirthdate, $fsex, $fcivil_status, $fupdated_by, $fupdated_date, $fbirth_place, $params2);
            
            echo 'Updated Successfuly';

        }
    }
    else{

        echo 'something went wrong!';

    }
    

}


if(isset($_POST['user_id'])){
    require_once 'appserv/classes/controller.class.php';
    
    $value = $_POST['user_id'];
    $dataArray = explode(",", $value);

    $dataArrayQuoted = array_map(function ($item) {
        return '"' . $item . '"';
    }, $dataArray);

    $formattedData = implode(",", $dataArrayQuoted);

    $params = 'faccountid IN ('.$formattedData.')';
    $table = 'mst_account';
    $delete = new controller();
    $delete->deletemultiple($table, $params);

    echo 'Deleted successfully'; 
}

if(isset($_POST['product_id'])){
    require_once 'appserv/classes/controller.class.php';

    $value = $_POST['product_id'];
    $dataArray = explode(",", $value);

    $dataArrayQuoted = array_map(function ($item) {
        return '"' . $item . '"';
    }, $dataArray);

    $formattedData = implode(",", $dataArrayQuoted);

    $params = 'fproductid IN ('.$formattedData.')';
    
    $table = 'mst_product';
    $delete = new controller();
    $delete->deletemultiple($table, $params);

    echo 'Product Deleted successfully'; 

}

if(isset($_POST['modifyproduct'])){
    
    require_once 'appserv/classes/controller.class.php';
    date_default_timezone_set('Asia/Manila');
    
    $productid = $_POST['fproductid'];
    $productname = $_POST['fproductname'];
    $productdesc = $_POST['fproductdesc'];
    $productexpiry = $_POST['fproductexpiry'];
    $productcost = $_POST['fproductprice'];
    $producttax = $_POST['fproducttaxtype'];
    $productuom = $_POST['fproductuom'];
    $productcat = $_POST['fproductcategory'];
    $producttag = $_POST['fproducttag'];
    $productmemo = $_POST['fproductmemo'];
    $productactive = $_POST['fproductactive'];
    $productsale = $_POST['fsaleproduct'];
    $productstock = $_POST['faddstock'];
    $fupdated_by = "admin";
    $updated_date = date("Ymd H:m:s");
    
    $table = "mst_product";
    $params = "fproductid=?";


    $getstats = new controller;
    $getstats->getprevcost($productid, $productcost); 

    $validate = new controller();
    
    //Validate Existence
    $validate_exist = $validate->ifexist($table, $params, $productid);

    
    if($validate_exist == true){

        $validated = new controller;
        $validated->updatecategory($productname, $productdesc, $productexpiry, $productcost, $producttax, $productuom, $productcat, $producttag, $productmemo, $productactive,$productsale, $fupdated_by, $updated_date, $productid);



        if(!empty($productstock) || $productstock > 0){

            $getstats = new controller;
            $getstats->getstatus($productid);




            //handle the stock status here!

            $incrementstock = new controller;
            $incrementstock->updatestock($productstock, $productid);

            echo 'Updated Successfuly';

        }
        elseif($productstock == 0){
            $getstats = new controller;
            $getstats->getstatus($productid);

            echo 'Updated Successfuly';
        }
        else{
            echo 'Updated Successfuly';
        }

        
    }
    else{
        echo 'Error! '.$productid.' Cannot be Found in the database';
    }


}

if(isset($_POST['addcategorry'])){
    
    require_once 'appserv/classes/controller.class.php';

    $categoryid = $_POST['fcategoryid'];
    $categoryname = $_POST['fcategoryname'];
    $categorydesc = $_POST['fcategorydesc'];
    $categorytag = $_POST['fcategorytag'];
    $categoryimage = $_FILES['categoryimage']; //undefiend Array Key

    $fcompanyid = new controller();
    $fcompanyid = $fcompanyid->getcompanyid();
    $fcreated_by = "admin";
    $created_date = date("Ymd");
    $fupdated_by = "admin";
    $updated_date = date("Ymd H:m:s");
    
    $table = "mst_product_category";
    $params = "fcategoryid=?";


    $validate = new controller();
    
    //Validate Existence
    $validate_exist = $validate->ifexist($table, $params, $categoryid);

    
    if($validate_exist == true){

        echo 'Already Taken';

    }
    else{

        //declare the image properties
        $fileName = $_FILES['categoryimage']['name'];
        $fileTmpName = $_FILES['categoryimage']['tmp_name'];
        $fileSize = $_FILES['categoryimage']['size'];
        $fileType = $_FILES['categoryimage']['type'];
        $fileError = $_FILES['categoryimage']['error'];
                       
        //Validate the image properties
        $fileExt = explode('.' ,$fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg' ,'jpeg', 'png');
        
            if(!empty($categoryimage)){
                if (in_array($fileActualExt ,$allowed)){
                    if($fileError === 0){
                        if($fileSize < 2000000){
                            
                            $fileNameNew = uniqid(true).".".$fileActualExt;
                            $fileDir = 'img/' .$fileNameNew;
                            move_uploaded_file($fileTmpName, $fileDir);

                                
                            //Insert here
                            $validated = new controller;
                            $validated->precategory($fcompanyid, $categoryid, $categoryname, $categorydesc, $categorytag, $fileNameNew, $fcreated_by, $created_date, $fupdated_by, $updated_date);
                        
                                echo 'New Category Added Successfuly';
        
                                //handler here
                                
                            }
                            else{
                                echo 'File is too Big';
                                exit();
                            }
                        }
                        else{
                            echo 'Image has Error';
                            exit();
                        }
                        }
                        else{
                        echo 'Not an image';
                        exit();
                    }
                }
                else{
        
                    echo 'No image were attachd!';
                }   
        

    }




}

//export selected data to pdf

if(isset($_POST['pdfproduct_id'])){
    require_once 'appserv/classes/controller.class.php';
    require_once 'fpdf/fpdf.php';

    
    $value = $_POST['pdfproduct_id'];
    $dataArray = explode(",", $value);

    $dataArrayQuoted = array_map(function ($item) {
        return '"' . $item . '"';
    }, $dataArray);

    $formattedData = implode(",", $dataArrayQuoted);

    $params = 'fproductid IN ('.$formattedData.')';

    $table = 'mst_product';
    $productpdf = new controller();
    $productpdf->productpdf($table, $params);
   

    

    class PDF extends FPDF {
        function Header() {
            // Logo
            $getimg = new controller();
            $imagePath = $getimg->showimg(); // Get the image file path
            
            // Calculate the logo dimensions to maintain aspect ratio
            list($logoWidth, $logoHeight) = getimagesize($imagePath);
            $maxLogoWidth = 25; // Maximum width for the logo
            
            if ($logoWidth > $maxLogoWidth) {
                $logoHeight = ($maxLogoWidth / $logoWidth) * $logoHeight;
                $logoWidth = $maxLogoWidth;
            }
        
            $this->Image($imagePath, 10, 6, $logoWidth, $logoHeight);
            // Additional Text
            $this->SetFont('Arial', '', 9);
        
            // Calculate the height of the logo with additional text
            $logoTextHeight = max(5, $logoHeight);

        
            // Move to the right of the logo to start the additional text
            $this->SetX($logoWidth + 15);

            $getcname = new controller();
            $companyname = $getcname->getcname(); // Get the COmpany name
            
            $this->Cell(0, $logoTextHeight, '', 0, 1, 'L');
            $this->SetFont('Arial', 'B', 9); // Set font to bold
            $this->Cell(0, 5, $companyname, 0, 1, 'L');
            $this->SetFont('Arial', '', 9); // Reset font
            $this->Cell(0, 5, date('M-d-Y'), 0, 1, 'L');
            $this->Cell(0, 4, 'Ref#' . ' ' . mt_rand(0000000, 9999999), 0, 1, 'L');
        
            // Title
            $this->SetFont('Arial', 'B', 11);
            $this->Ln(10); // Add a line break after the additional text
            $this->Cell(0, 10, 'Product List', 0, 1, 'C');
        }
        
    
        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        }
    
        function CreateTable($header, $data) {
            // Page width
            $pageWidth = $this->GetPageWidth() - 20; // Subtracting margins
            
            // Calculate equal column widths
            $columnCount = count($header);
            $equalWidth = $pageWidth / $columnCount;
        
            // Set font size for header
            $this->SetFont('Arial', 'B', 8);
            
            $this->SetFillColor(255, 255, 0); // Yellow color
            // Header
            foreach ($header as $col) {
                $this->Cell($equalWidth, 10, $col['label'], 1, 0, 'C');
            }
            $this->Ln();
        
            // Set font style for data (regular font)
            $this->SetFont('Arial', '', 7); // Set to regular font
            
        
            // Data rows
            foreach ($data as $row) {
                foreach ($row as $colData) {
                    $this->Cell($equalWidth, 10, $colData, 1, 0, 'C');
                }
                $this->Ln();
            }
        }
        
    }
    
    $pdf = new PDF();
    $pdf->AddPage();
    $header = array(
        array('label' => 'Product ID'),
        array('label' => 'Product Name'),
        array('label' => 'Price'),
        array('label' => 'Category'),
        array('label' => 'Stock'),
        array('label' => 'Status'),
        array('label' => 'Updated Date')
    );
    
    
    $data = $productpdf->productpdf($table, $params);
    $pdf->CreateTable($header, $data);
    
    $pdf->Output();

    // Output PDF content
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename='my_file.pdf'");
    ob_clean(); // Clear output buffer
    $pdf->Output(); // Output PDF content directly

}



//export selected sales to pdf

if(isset($_POST['pdfsalesid'])){
    require_once 'appserv/classes/controller.class.php';
    require_once 'fpdf/fpdf.php';
    
    
    
    $value = $_POST['pdfsalesid'];
    $dataArray = explode(",", $value);


    $dataArrayQuoted = array_map(function ($item) {
        return '"' . $item . '"';
    }, $dataArray);

    $formattedData = implode(",", $dataArrayQuoted);
    $params = 'fzcounter IN ('.$formattedData.')';

    $table = 'pos_reading';
    $exportsalespdf = new controller();
    $exportsalespdf->salespdf($table, $params);
   

    

    class PDF extends FPDF {
        function Header() {
            // Logo
            $getimg = new controller();
            $imagePath = $getimg->showimg(); // Get the image file path
            
            // Calculate the logo dimensions to maintain aspect ratio
            list($logoWidth, $logoHeight) = getimagesize($imagePath);
            $maxLogoWidth = 25; // Maximum width for the logo
            
            if ($logoWidth > $maxLogoWidth) {
                $logoHeight = ($maxLogoWidth / $logoWidth) * $logoHeight;
                $logoWidth = $maxLogoWidth;
            }
        
            $this->Image($imagePath, 10, 6, $logoWidth, $logoHeight);
            // Additional Text
            $this->SetFont('Arial', '', 9);
        
            // Calculate the height of the logo with additional text
            $logoTextHeight = max(5, $logoHeight);

        
            // Move to the right of the logo to start the additional text
            $this->SetX($logoWidth + 15);

            $getcname = new controller();
            $companyname = $getcname->getcname(); // Get the COmpany name
            
            $this->Cell(0, $logoTextHeight, '', 0, 1, 'L');
            $this->SetFont('Arial', 'B', 9); // Set font to bold
            $this->Cell(0, 5, $companyname, 0, 1, 'L');
            $this->SetFont('Arial', '', 9); // Reset font
            $this->Cell(0, 5, date('M-d-Y'), 0, 1, 'L');
            $this->Cell(0, 4, 'Ref#' . ' ' . mt_rand(0000000, 9999999), 0, 1, 'L');
        
            // Title
            $this->SetFont('Arial', 'B', 11);
            $this->Ln(10); // Add a line break after the additional text
            $this->Cell(0, 10, 'Sales Report', 0, 1, 'C');
        }
        
        
    
        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        }
    
        function CreateTable($header, $data) {
            // Page width
            $pageWidth = $this->GetPageWidth() - 20; // Subtracting margins
            
            // Calculate equal column widths
            $columnCount = count($header);
            $equalWidth = $pageWidth / $columnCount;
        
            // Set font size for header
            $this->SetFont('Arial', 'B', 8);
            
            $this->SetFillColor(255, 255, 0); // Yellow color
            // Header
            foreach ($header as $col) {
                $this->Cell($equalWidth, 10, $col['label'], 1, 0, 'C');
            }
            $this->Ln();
        
            // Set font style for data (regular font)
            $this->SetFont('Arial', '', 7); // Set to regular font
            
        
            // Data rows
            foreach ($data as $row) {
                foreach ($row as $colData) {
                    $this->Cell($equalWidth, 10, $colData, 1, 0, 'C');
                }
                $this->Ln();
            }
        }
        
    }
    
    $pdf = new PDF();
    $pdf->AddPage();
    
    $header = array(
        array('label' => 'z-counter'),
        array('label' => 'TM#'),
        array('label' => 'Date'),
        array('label' => 'Total Trx'),
        array('label' => 'Total Sales'),
        array('label' => 'Taxable sales'),
        array('label' => 'Present NRGT'),
        array('label' => 'Previous NRGT')
    );
    

    $data = $exportsalespdf->salespdf($table, $params);
    
    $pdf->CreateTable($header, $data);
    $pdf->Output();

    // Output PDF content
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename='my_file.pdf'");
    
    ob_clean(); // Clear output buffer
    $pdf->Output(); // Output PDF content directly

}









if(isset($_POST['adduser'])){

    require_once 'appserv/classes/controller.class.php';
    require_once 'appserv/classes/view.class.php';

    date_default_timezone_set('Asia/Manila');

    $faccountid = $_POST['faccountid'];
    $ffname = $_POST['ffname'];
    $flname = $_POST['flname'];
    $fmname = $_POST['fmname'];
    $fsex = $_POST['fsex'];
    $fcivil_status = $_POST['fcivil_status'];
    $faddress = $_POST['faddress'];
    $femail = $_POST['femail'];
    $fphone = $_POST['fphone'];
    $fusername = $_POST['fusername'];
    $ftemppassword = $_POST['ftemppassword'];
    $fbirthdate = $_POST['fbirthdate'];
    $fbirth_place = $_POST['fbirth_place'];
    $fmemo = $_POST['fmemo'];
    $faccesslvl = $_POST['faccesslvl'];
    $fofficeid = $_POST['fofficeid'];

    $table = "mst_account";
    $params = "faccountid=?";

    $validate = new controller();
    
    //Validate Existence
    $validate_exist = $validate->ifexist($table, $params, $faccountid);
    if($validate_exist == true){
        // if ID is already exist
        echo 'ID is already exist';
    }
    else{

        $hashed_password = password_hash($ftemppassword, PASSWORD_BCRYPT);
        
        // if ID not exist
        $fcompanyid = new controller();
        $fcompanyid = $fcompanyid->getcompanyid();
        $factive_flag = '1';
        $flogon_flag = '1';
        $fpassword_update = date('Ymd h:i:s');
        $flast_logon = date('Ymd h:i:s A');
        $fsecurity_question = 'Not set';
        $fsecurity_answer = '0';
        $fcreated_by = 'Admin';
        $fcreated_date = date('Ymd h:i:s');
        $fupdated_by = 'Admin';
        $fupdated_date = date('Ymd h:i:s');
        $fname = $ffname." ".$flname;

        $validated = new controller;
        $validate->preuser($fcompanyid, $faccountid, $factive_flag, $fname, $flname, $ffname, $fmname, $faddress, $fphone, $fofficeid, $faccesslvl, $fmemo, $flogon_flag, $fusername, $hashed_password, $fpassword_update, $flast_logon, $fsecurity_question, $fsecurity_answer, $femail, $fbirthdate, $fsex, $fcivil_status, $fcreated_by, $fcreated_date, $fupdated_by, $fupdated_date, $fbirth_place);

        echo "Added Successfully!";
        /*

        if(!preg_match("/^[a-zA-Z0-9]+$/",$faccountid) || !preg_match("/^[a-zA-Z0-9]+$/",$ffname) || !preg_match("/^[a-zA-Z0-9]+$/",$ffname) || !preg_match("/^[a-zA-Z0-9]+$/",$flname) || !preg_match("/^[a-zA-Z0-9]+$/",$fmname) || !preg_match("/^[a-zA-Z0-9]+$/",$fphone) || !preg_match("/^[a-zA-Z0-9]+$/",$fusername) || !preg_match("/^[a-zA-Z0-9]+$/",$ftemppassword)){
            
            echo "Please avoid using special characters in the form";
        
        }
        elseif(!preg_match("/^[a-zA-Z0-9]+$/",$fbirth_place) || !preg_match("/^[a-zA-Z0-9]+$/",$fmemo)){
            echo "Please avoid using special characters in the form2";
        }
        else{


        }
        */

    }
    
}

if(isset($_POST['modifycompany'])){
    

    require_once './appserv/classes/controller.class.php';
    //declare the image properties
    $fileName = $_FILES['clogo']['name'];
    $fileTmpName = $_FILES['clogo']['tmp_name'];
    $fileSize = $_FILES['clogo']['size'];
    $fileType = $_FILES['clogo']['type'];
    $fileError = $_FILES['clogo']['error'];

    $cemail = $_POST['cemail'];
    $ctel = $_POST['ctel'];
    $cfax = $_POST['cfax'];
    $clocation = $_POST['clocation'];
    $cowner = $_POST['cowner'];
    $cest = $_POST['cest'];
    $cmemo = $_POST['cmemo'];
    $fcompanyid = new controller();
    $fcompanyid = $fcompanyid->getcompanyid();
    $updated_by = 'admin';
    $updated_date = date('Ymd H:i:s');

    if(empty($fileName)){
        $execute = new controller();
        $execute->execupdatecompany($cemail, $ctel, $cfax, $clocation, $cowner, $cest, $cmemo, $fileName, $updated_by, $updated_date, $fcompanyid);

        echo 'Updated Succesfully!';
    
    }
    else{
        
        //Validate the image properties
        $fileExt = explode('.' ,$fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg' ,'jpeg', 'png');
        
            if(!empty($fileName)){
                if (in_array($fileActualExt ,$allowed)){
                    if($fileError === 0){
                        if($fileSize < 2000000){
                            
                            $fileNameNew = uniqid(true).".".$fileActualExt;
                            $fileDir = 'img/' .$fileNameNew;
                            move_uploaded_file($fileTmpName, $fileDir);

                            $getcompanyimage = new controller();
                            $getcompanyimage->deletecimg();
                            
                            //Insert here
                            $execute = new controller();
                            $execute->execupdatecompany($cemail, $ctel, $cfax, $clocation, $cowner, $cest, $cmemo, $fileNameNew, $updated_by, $updated_date, $fcompanyid);
                    
                            echo 'Updated Succesfully!';
        
                                //handler here
                                
                            }
                            else{
                                echo 'File is too Big';
                                exit();
                            }
                        }
                        else{
                            echo 'Image has Error';
                            exit();
                        }
                        }
                        else{
                        echo 'Not an image';
                        exit();
                    }
                }
                else{
        
                    echo 'No image were attachd!';
                }   
        
    }

}

if(isset($_POST['expirycheck'])){
    require_once './appserv/classes/controller.class.php';
    $getexpiry = new controller();
    $getexpiry->getlicenseexpiry();
}
if(isset($_POST['getcompanyname'])){
    require_once './appserv/classes/controller.class.php';
    $getcompname = new controller();
    $getcompname->getcompanyname();
  
}

if(isset($_POST['expiredemo'])){
    require_once './appserv/classes/controller.class.php';
    
    $removesession = new controller();
    $removesession->clearsessions();

    $inactivate = new controller();
    $inactivate->setinactive();

    echo 'Demo is now expired!';    
  
}

if (isset($_POST['currentmonth'])) {
    require_once './appserv/classes/controller.class.php';

    $currentmonthdata = new controller();
    $exec = $currentmonthdata->getcurrentmonthsales($currentmonthdata->getcompanyid());

    $currentnrgt = new controller();
    $exec2 = $currentnrgt->getpresentnrgt($currentnrgt->getcompanyid());

    $averangesales = new controller();
    $exec3 = $averangesales->getavegrosspermonth($averangesales->getcompanyid());



    $data1 = $exec[0]['total_sales'];
    $data2 = $exec2[0]['presentnrgt'];
    $data3 = $exec3[0]['average_gross'];

    $response = [
        'data1' => $data1,
        'data2' => $data2,
        'data3' => $data3
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}

if(isset($_POST['getversion'])){
    require_once './appserv/classes/controller.class.php';
    $getversion = new controller();
    $version = $getversion->version();

    $data1 = $version[0]['fversion'];
    $data2 = $version[0]['fversion_alias'];
    $data3 = $version[0]['fversion_note'];

    $response = [
        'data1' => $data1,
        'data2' => $data2,
        'data3' => $data3
    ];

    header('Content-Type: application/json');
    echo json_encode($response);


}
if(isset($_POST['demoversion'])){
    require_once './appserv/classes/controller.class.php';
    $getversion = new controller();
    $version = $getversion->version();

    $f1 = $version[0]['fversion'];
    $f2 = $version[0]['fversion_alias'];

    echo $f2.' '.$f1;
}


if(isset($_POST['getversion2'])){
    require_once './appserv/classes/controller.class.php';
    $getversion = new controller();
    $version = $getversion->version();

    $data1 = $version[0]['fversion'];
    $data2 = $version[0]['fversion_alias'];
    $data3 = $version[0]['fversion_note'];

    $response = [
        'data1' => $data1,
        'data2' => $data2,
        'data3' => $data3
    ];

    header('Content-Type: application/json');
    echo json_encode($response);

}

if(isset($_POST['name'])){

    session_start();

    require_once './appserv/classes/controller.class.php';
    //declare the image properties
    $fileName = $_FILES['icon']['name'];
    $fileTmpName = $_FILES['icon']['tmp_name'];
    $fileSize = $_FILES['icon']['size'];
    $fileType = $_FILES['icon']['type'];
    $fileError = $_FILES['icon']['error'];
    
    $cname = $_POST['name'];
    $clicense = $_POST['license'];
    $address = $_POST['address'];
    $ctelno = $_POST['telno'];
    $cemail = $_POST['email'];
    $ctype = $_POST['type'];
    $cowner = $_POST['owner'];

    $factive_flag = '1';
    $fmemo = 'not set';

    $fexpiry = date('Ymd') + 1;
    $fax = 'not set';
    $yest = 'not set';
    $fverified = '1';

    $fcreated_by = 'admin';
    $created_date = date('Ymd');
    $updated_by = 'admin';
    $updated_date = date('Ymd');

    $generateid = new controller();
    $companyid = $generateid->generateCompanyID($cname);
    
    $generatekey = new controller();
    $companykey = $generatekey->generateCompanykey($cname);

    $validatelicense = new controller();
    $licensecheck = $validatelicense->getcompanylicense($clicense);

    if(strlen($cname) > 15){
        echo 'exceed';
        exit();
    }
    elseif($licensecheck === '0'){
        echo 'Invalid License';
    }  
    else{

        //Validate the image properties
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');

        if (!empty($fileName)) {
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 2000000) {

                        $fileNameNew = uniqid(true) . "." . $fileActualExt;
                        $fileDir = 'img/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDir);

                        //Insert here
                        $execute = new controller();
                        $execute->createcompany($companyid, $cname, $factive_flag, $address, $clicense, $companykey, $ctelno, $fmemo, $fexpiry, $cemail, $fax, $cowner, $yest, $fverified, $fileNameNew, $fcreated_by, $created_date, $updated_by, $updated_date);

                        echo 'success';


                        //handler here

                    } else {
                        echo 'big';
                        exit();
                    }
                } else {
                    echo 'imgerror';
                    exit();
                }
            } else {
                echo 'Notimage';
                exit();
            }
        } else {

            echo 'Noimg';
        }

    }

}

if(isset($_POST['companydetailsx'])){
    require_once './appserv/classes/controller.class.php';

    $getcompanydata = new controller();
    $cdata = $getcompanydata->getcompanydetails();




    $data1 = $cdata[0]['fcompanyid'];
    $data2 = $cdata[0]['fcompanykey'];
    $data3 = $cdata[0]['fname'];

    $response = [
        'data1' => $data1,
        'data2' => $data2,
        'data3' => $data3
    ];

    header('Content-Type: application/json');
    echo json_encode($response);


}

if(isset($_POST['ipAddress'])){
    require_once './appserv/classes/controller.class.php';
    $ipaddress = $_POST['ipAddress'];

    $logip = new controller();
    $logip->logvisitor($ipaddress);

}

if(isset($_POST['startsession'])){
    
    session_start();

    require_once './appserv/classes/controller.class.php';

    $getcompanydata = new controller();
    $cdata = $getcompanydata->getcompanydetails();

    $compid = $cdata[0]['fcompanyid'];
    $compkey = $cdata[0]['fcompanykey'];

    
    $_SESSION['companyid'] = $compid;
    $_SESSION['companykey'] = $compkey;
}

if(isset($_POST['logout'])){
   
    require_once './appserv/classes/controller.class.php';

    $removesession = new controller();
    $removesession->clearsessions();

    echo '1';
}

if(isset($_POST['activecompany'])){
    require_once './appserv/classes/controller.class.php';
    $checkactive = new controller();
    $check = $checkactive->getactivecomp();

    if($check = '1'){

    }
    else{
        
    }
}

if(isset($_POST['complogin'])){
    
    require_once './appserv/classes/controller.class.php';

    $compid = $_POST['coid'];
    $compkey = $_POST['cokey'];
    
    $validatecreds = new controller();
    $check = $validatecreds->processcreds($compid, $compkey);


    if($check == '1'){

        session_start();

        $getcompanydata = new controller();
        $cdata = $getcompanydata->getcompanydetails();
    
        $compid = $cdata[0]['fcompanyid'];
        $compkey = $cdata[0]['fcompanykey'];
    
        
        $_SESSION['companyid'] = $compid;
        $_SESSION['companykey'] = $compkey;

        echo '1';

    }
    else{
        echo '0';
    }    


}






















