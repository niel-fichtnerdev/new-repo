<?php

if (!defined('BASE')) define('BASE', dirname(__FILE__) ."/../");

class Dbh{
    private $host = "sql109.infinityfree.com";
    private $user = "if0_34899882";
    private $pwd = "mDPT7uGvO6ZVd";
    private $dbName = "if0_34899882_demo_syspos";

    protected function connect(){
        // Add the colon (:) and equal sign (=) in the DSN string
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}


//require_once BASE.'/classes/model.class.php';
require_once 'model.class.php';

//important to extend to model since modal has a connection to the database
class controller extends model{

    /*
    public function paginationlink($table, $per_page, $current_page){
        $link = '';
        
        //fix - Convert this into function where we can pass the $record_per_page in the parameter
        $total_query = "SELECT * FROM $table ORDER BY fcreated_date DESC"; //query
        $total_result = $this->queryselect($total_query); //example return 100
        $total_count = count($total_result); //return total rows
        
        $start_from = ($current_page - 1) * $record_per_page; 

        $total_pages = ceil($total_count/$per_page); //result divided by per page (from passed paramaeter)
        

        $rel_query = "SELECT * FROM $table ORDER BY fcreated_date DESC LIMIT $start_from, $per_page";
        $res = $this->queryselect($rel_query);


        if($total_pages > 10){
            $excess = $total_pages - $per_page; // if 30 pages value will be 20

            $nextlink ="<a href='getData.php?remaining=$excess' class='pagination_link' style='cursor: pointer; padding: 2px'; id='".$excess."'>">>"</a>";

            for($i = 1; $i<=$new_page; $i++){
                $link .="<a href='getData.php?page=$i' class='pagination_link' style='cursor: pointer; padding: 2px'; id='".$i."'>".$i."</a>";    
            }

            $pagination_link = $link . $nextlink;

            return $pagination_link; //should return 1 2 3 4 5 6 7 8 9 10 >>
        
        }
        else{
            
            for($i = 1; $i<=$total_pages; $i++){
                $link .="<a href='getData.php?page=$i' class='pagination_link' style='cursor: pointer; padding: 2px'; id='".$i."'>".$i."</a>";    
            }
            return $link;
        }
    }

    */

    //chat GPT
    public function pagirowcount($totalrows, $per_page, $current_page){
   
        $rowcount = ceil($totalrows / $per_page);

    }

    public function getcategory($query){

        $res = $this->queryselect($query);
        return $res;

    }

    public function getuom($query){

        $res = $this->queryselect($query);
        return $res;

    }



    public function paginationlink2($table, $per_page, $current_page, $params, $url) {

    
        if(empty($params)){
            $params = "";
            $total_query = "SELECT COUNT(*) as total_count FROM $table"; // Get the total count of rows
            $total_result = $this->queryselect($total_query);
            $total_count = $total_result[0]['total_count']; // Extract the total count from the result
        
            $total_pages = ceil($total_count / $per_page); //divide the total count
        
            if ($total_pages > 1) {
                $prev_page = $current_page - 1;
                $next_page = $current_page + 1;
        
                $pagination_link = '';
    
                if ($current_page > 1) {
                    $pagination_link .= "<li><a href='$url.php?page=1' class='pagination_link' style='cursor: pointer; padding: 2px;'><<</a></li>";
                    $pagination_link .= "<li><a href='$url.php?page=$prev_page' class='pagination_link' style='cursor: pointer; padding: 2px;'>&lt;</a></li>";
                }


        
                // Calculate the range of pages to show in the pagination
                $start_page = max(1, $current_page - 5);
                $end_page = min($total_pages, $current_page + 5);

        
                for ($i = $start_page; $i <= $end_page; $i++) {

                    if ($i == $current_page) {
                        $pagination_link .= "<li><span class='pagination_link current'>$i</span></li>";
                    } else {
                        $pagination_link .= "<li><button type='submit' name='page' value='$i'>$i</button></li>";
                    }
                }

                

                if ($current_page < $total_pages) {
                    $pagination_link .= "<li><a href='$url.php?page=$next_page' class='pagination_link' style='cursor: pointer; padding: 2px;'>&gt;</a></li>";
                    $pagination_link .= "<li><a href='$url.php?page=$total_pages' class='pagination_link' style='cursor: pointer; padding: 2px;'>>></a></li>";
                }
    
                if($current_page > $total_count){
                    $pagination_link = "<li><a href='$url.php?page=1' class='pagination_link' style='cursor: pointer; padding: 2px;'><<</a></li>";
                    return $pagination_link;
                }
        
                return $pagination_link;
            }
        

            

        }
        else{
            $total_query = "SELECT COUNT(*) as total_count FROM $table WHERE $params"; // Get the total count of rows
            $total_result = $this->queryselect($total_query);
            $total_count = $total_result[0]['total_count']; // Extract the total count from the result

            $total_pages = ceil($total_count / $per_page); //divide the total count
        
            if ($total_pages > 1) {
                $prev_page = $current_page - 1;
                $next_page = $current_page + 1;
        
                $pagination_link = '';
    
                if ($current_page > 1) {
                    $pagination_link .= "<li><a href='$url.php?page=1' class='pagination_link' style='cursor: pointer; padding: 2px;'><<</a></li>";
                    $pagination_link .= "<li><a href='$url.php?page=$prev_page' class='pagination_link' style='cursor: pointer; padding: 2px;'>&lt;</a></li>";
                }
        
                // Calculate the range of pages to show in the pagination
                $start_page = max(1, $current_page - 5);
                $end_page = min($total_pages, $current_page + 5);
        
                for ($i = $start_page; $i <= $end_page; $i++) {
                    if ($i == $current_page) {
                        $pagination_link .= "<li><span class='pagination_link current'>$i</span></li>";
                    } else {
                        $pagination_link .= "<li><button type='submit' name='page' value='$i'>$i</button></li>";
                    }
                }
    
                if ($current_page < $total_pages) {
                    $pagination_link .= "<li><a href='$url.php?page=$next_page' class='pagination_link' style='cursor: pointer; padding: 2px;'>&gt;</a></li>";
                    $pagination_link .= "<li><a href='$url.php?page=$total_pages' class='pagination_link' style='cursor: pointer; padding: 2px;'>>></a></li>";
                }
    
                if($current_page > $total_count){
                    $pagination_link = "<li><a href='$url.php?page=1' class='pagination_link' style='cursor: pointer; padding: 2px;'><<</a></li>";
                    return $pagination_link;
                }
        
                return $pagination_link;


                
            }
        

            
            
        }

        

    }

    public function displayresult($table, $per_page, $current_page, $params) {

        if(!is_numeric($current_page)){
            $current_page = 1;
        }

        if(empty($params)){
            $params = "";

            $total_query = "SELECT COUNT(*) as total_count FROM $table"; // Get the total count of rows
            $total_result = $this->queryselect($total_query);
            $total_count = $total_result[0]['total_count']; // Extract the total count from the result
        
            // Calculate the number of results currently being displayed
            $start_result = ($current_page - 1) * $per_page + 1;
            $end_result = min($start_result + $per_page - 1, $total_count);
    
            if($start_result > $total_count){
                $result_information = "No result";
                return $result_information;
            }
        
            $result_information = "Showing $start_result - $end_result of $total_count.";
            
            return $result_information;

        }
        else{
            
            $total_query = "SELECT COUNT(*) as total_count FROM $table WHERE $params";
            $total_result = $this->queryselect($total_query);
            $total_count = $total_result[0]['total_count'];
            
            



            $start_result = ($current_page - 1) * $per_page + 1;
            $end_result = min($start_result + $per_page - 1, $total_count);

            if($start_result > $total_count){
                $result_information = "No result";
                return $result_information;
            }
        
            $result_information = "Showing $start_result - $end_result of $total_count.";
            
            return $result_information;

        }
        


    }

    public function search($table, $column ,$params, $per_page, $page, $module){

        if($module === 'mst_account'){
            $start_from = ($page - 1) * $per_page;

            $output = '';
            $query = "SELECT $column FROM $table WHERE $params ORDER BY fupdated_date LIMIT $start_from, $per_page"; // query
            $res = $this->queryselect($query);
    


            if(count($res) > 0){
                foreach($res as $row){
                    $hashedPassword = $row['fpassword'];
                    $truncatedPassword = substr($hashedPassword, 0, 20);

                    $output .= '
                  
                    
                      <tr>
                        <td><span class="custom-checkbox"><input type="checkbox" class="userCheckbox" data-user-id="'.$row["faccountid"].'"></span>
                        </td>
                        <td>'.$row["faccountid"].'</td>
                        <td>'.$row["ffname"].'</td>
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
                
                return $res;
            }
            else{
                $output .= "<td>No result Found</td>
                ";
                echo $output;
                
                return $res;
            }
        }
        
        
        elseif($module === 'mst_product'){
            $start_from = ($page - 1) * $per_page;

            $output = '';
            $query = "SELECT $column FROM $table WHERE $params ORDER BY fupdated_date LIMIT $start_from, $per_page"; // query
            $res = $this->queryselect($query);

            $img_path = "img/";
    
            if(count($res) > 0){
                foreach($res as $row){
                    $number1 = $row["fstnd_cost"];
                    $number2 = $row["fprev_cost"];
                    $formattedNumber1 = number_format($number1, 2);
                    $formattedNumber2 = number_format($number2, 2);
                    $output .= '
                  
                    
                    <tr>
                    <td><span class="custom-checkbox"><input type="checkbox" class="userCheckbox" data-product-id="'.$row["fproductid"].'"></span>
                    </td>
                    <td> <img height="50px" width="50px" src='.$img_path.$row["fcategory_img"].'> </td>
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
                
                return $res;
            }
            
            else{
                $output .= "<td>No result Found</td>
                ";
                echo $output;
                
                return $res;
            }
        }

        elseif($module === 'pos_reading'){
            $start_from = ($page - 1) * $per_page;
            $output = '';
            $query = "SELECT $column FROM $table WHERE $params ORDER BY a.fupdated_date LIMIT $start_from, $per_page"; // query
            $res = $this->queryselect($query);


    
            if(count($res) > 0){
                foreach($res as $row){
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
                    <button onclick="viewincome(\''.$row["fzcounter"].'\')" class="open_income"><i class="fa fa-eye" aria-hidden="true"></i> view</button>
                </td>
                  </tr>

                    ';
                    
                  }
                
                  echo $output;
                
                return $res;
            }
            
            else{
                $output .= "<td>No result Found</td>
                ";
                echo $output;
                
                return $res;
            }
        }
        

    }
    
    public function preuser($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19, $f20, $f21, $f22, $f23, $f24, $f25, $f26, $f27, $f28){
        
        $exec = $this->execuser($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19, $f20, $f21, $f22, $f23, $f24, $f25, $f26, $f27, $f28);

        return $exec;
        
    }
    
    public function execupdate($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19, $f20, $f21, $f22, $f23, $f26, $f27, $f28, $params){

        $execupdate = $this->update($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19, $f20, $f21, $f22, $f23, $f26, $f27, $f28, $params);

        return $execupdate;

    }

    public function preproduct($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19, $f20, $f21){
        $exec = $this->execproduct($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19, $f20, $f21);

        return $exec;
    }
    
    public function precategory($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10){
        $exec = $this->execategory($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10);

        return $exec;
    }

    public function updatecategory($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f13, $f14, $f15){
        $exec = $this->execupdateproduct($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f13, $f14, $f15);

        return $exec;
    }

    public function updatestock($f1, $params){
        $exec = $this->execaddstock($f1, $params);

        return $exec;
    }

    public function getstockcount($params){
        $sql =  "SELECT fstock FROM mst_product WHERE fproductid ='$params'";
        $exec = $this->queryselect($sql);
        
        $count = $exec[0]['fstock'];
        return $count;
    }

    public function getprevcost($params, $productcost){
        $sql =  "SELECT fstnd_cost FROM mst_product WHERE fproductid ='$params'";
        $exec = $this->queryselect($sql);
        
        $prevcost = $exec[0]['fstnd_cost'];

        if($prevcost == $productcost){
            return false;
        }
        else{
            $updateprevcost = "UPDATE mst_product SET fprev_cost='$prevcost' WHERE fproductid ='$params'";
            $execupdate = $this->queryselect($updateprevcost);

            return $execupdate;
        }
    
    }

    public function getstatus($params){
        $sql = "SELECT fstatus FROM mst_product WHERE fproductid='$params'";
        
        $exec = $this->queryselect($sql);
        $getcount = $this->getstockcount($params);
    
        // Check if data was retrieved successfully
        if ($exec && count($exec) > 0) {
            $status = $exec[0]['fstatus'];
            
            if($status == "new"){
                
                if($getcount < 20){
                    $updatestatus = "UPDATE mst_product SET fstatus='low' WHERE fproductid=?";
                    $execute = $this->updatesingle($updatestatus, $params);
                }
                elseif($getcount == 0){
                    $updatestatus = "UPDATE mst_product SET fstatus='outstock' WHERE fproductid=?";
                    $execute = $this->updatesingle($updatestatus, $params);
                }
                else{
                    $updatestatus = "UPDATE mst_product SET fstatus='instock' WHERE fproductid=?";
                    $execute = $this->updatesingle($updatestatus, $params);
                }
            }
            elseif($status == "low"){
                
                if($getcount > 20){
                    $updatestatus = "UPDATE mst_product SET fstatus='instock' WHERE fproductid=?";
                    $execute = $this->updatesingle($updatestatus, $params);
                }
                elseif($getcount == 0){
                    $updatestatus = "UPDATE mst_product SET fstatus='outstock' WHERE fproductid=?";
                    $execute = $this->updatesingle($updatestatus, $params);
                }
                else{
                    $updatestatus = "UPDATE mst_product SET fstatus='low' WHERE fproductid=?";
                    $execute = $this->updatesingle($updatestatus, $params);
                }
            }
            elseif($status == "instock"){
                
                if($getcount < 20){
                    $updatestatus = "UPDATE mst_product SET fstatus='low' WHERE fproductid=?";
                    $execute = $this->updatesingle($updatestatus, $params);
                }
                elseif($getcount == 0){
                    $updatestatus = "UPDATE mst_product SET fstatus='outstock' WHERE fproductid=?";
                    $execute = $this->updatesingle($updatestatus, $params);
                }
                else{
                    $updatestatus = "UPDATE mst_product SET fstatus='instock' WHERE fproductid=?";
                    $execute = $this->updatesingle($updatestatus, $params);
                }
            }

            elseif($status == "outstock"){
                
                if($getcount > 20){
                    $updatestatus = "UPDATE mst_product SET fstatus='instock' WHERE fproductid=?";
                    $execute = $this->updatesingle($updatestatus, $params);
                }
                elseif($getcount == 0){

                    $updatestatus = "UPDATE mst_product SET fstatus='outstock' WHERE fproductid=?";
                    $execute = $this->updatesingle($updatestatus, $params);
                }
                else{
                    $updatestatus = "UPDATE mst_product SET fstatus='low' WHERE fproductid=?";
                    $execute = $this->updatesingle($updatestatus, $params);
                }
            }
        } else {
            return null; // Return null or some other indication of no data
        }
    }
    

    public function getprodimg($categoryid){
        $exec = $this->getproductimg($categoryid);

        return $exec;
    }

    public function ifexist($table, $params, $value){
        
        $res = $this->totalrow($table, $params, $value);

        if($res == true){
            //already exist
            return true;
        }
        else{
            return false;
            //not exist
        }

    }

    public function multidelete($table, $params){
        $res = $this->deletemultiple($table, $params);

        if($res == 'true'){
            //Deleted successfuly
            return 'true';
        }
        else{
            //Error Delete
            return 'false';
            
        }
    }

    //function for generating pdf from selected products    

    public function productpdf($table, $params){
        //$output = '';
        $query = "SELECT fproductid, fname, fstnd_cost, fcategory_id, fstock, fstatus, fupdated_date FROM $table WHERE $params";
        $res = $this->queryselect($query);

        /*
        foreach($res as $row){
            $output .= '
          
            
              <tr>
                <td><span class="custom-checkbox"><input type="checkbox" class="userCheckbox" data-product-id="'.$row["fproductid"].'"></span>
                </td>
                <td>IMG</td>
                <td>'.$row["fproductid"].'</td>
                <td>'.$row["fname"].'</td>
                <td>'.$row["fstnd_cost"].'</td>
                <td>'.$row["fcategory_id"].'</td>
                <td>'.$row["fstock"].'</td>
                <td>'.$row["fstatus"].'</td>
                <td>'.$row["fupdated_date"].'</td>
        
              </tr>
            ';
            
          }
          
        
        return $output;
        */
        return $res;
    }


    public function salespdf($table, $params){
        //$output = '';
        $query = "SELECT fzcounter, ftermid, fsale_date, ftotal_transaction, fgross, ftax, fgross2,fpgross FROM $table WHERE $params";
        $res = $this->queryselect($query);

        /*
        foreach($res as $row){
            $output .= '
          
            
              <tr>
                <td><span class="custom-checkbox"><input type="checkbox" class="userCheckbox" data-product-id="'.$row["fproductid"].'"></span>
                </td>
                <td>IMG</td>
                <td>'.$row["fproductid"].'</td>
                <td>'.$row["fname"].'</td>
                <td>'.$row["fstnd_cost"].'</td>
                <td>'.$row["fcategory_id"].'</td>
                <td>'.$row["fstock"].'</td>
                <td>'.$row["fstatus"].'</td>
                <td>'.$row["fupdated_date"].'</td>
        
              </tr>
            ';
            
          }
          
        
        return $output;
        */
        return $res;
    }




/*$formattedNumber = number_format($number, 2); ADD THIS CODE TO MAKE FORMAT THE NUMBER if 99.00000 to 99.00 */

/*

// Assuming $row['your_column_name'] contains the fetched number
$number = $row['your_column_name'];
$formattedNumber = number_format($number, 2);
echo $formattedNumber; // Output: 99.00


*/
    public function gettransaction($zcounter){
        $sql = "SELECT * FROM pos_sale WHERE fzcounter='$zcounter'";
        $res = $this->queryselect($sql);
        $output = "";
        $output .= '
        
        <tr>
        <th>Fzcounter</th>
        <th>Date</th>
        <th>Terminal</th>
        <th>Reciept#</th>
        <th>Trx#</th>
        <th>Trx by</th>
        <th>Trx time</th>
        <th>Product Qty</th>
        <th>Gross</th>
        </tr>
        
        ';
        
        if(count($res) > 0){
            foreach($res as $row){
                $number1 = $row["ftotal_qty"];
                $number2 = $row["fgross"];
                $formattedNumber1 = number_format($number1, 0);
                $formattedNumber2 = number_format($number2, 2);
                $output .= '

              
                <tr>
                <td>'.$row["fzcounter"].'</td>
                <td>'.$row["fsale_date"].'</td>
                <td>'.$row["ftermid"].'</td>
                <td>'.$row["fdocument_no"].'</td>
                <td>'.$row["ftrx_no"].'</td>
                <td>'.$row["fcashierid"].'</td>
                <td>'.$row["fsale_time"].'</td>
                <td>'.$formattedNumber1.'</td>
            
                <td>'.$formattedNumber2.'</td>

              </tr>
                
                ';
                
              }
              
              echo $output;
              $this->gettrxsummary($zcounter);
            return $res;
            
            
            
        }

        
        
        else{
            $output .= "<td>No result Found</td>
            ";
            echo $output;
            
            return $res;
        }


    }


    public function gettrxdate($zcounter){

        $sql = "SELECT DISTINCT fsale_date FROM pos_sale WHERE fzcounter='$zcounter'";
        $res = $this->queryselect($sql);

        foreach ($res as $row) {
            $saleDate = DateTime::createFromFormat('Ymd', $row['fsale_date']);
            if ($saleDate !== false) {
                $formattedDate = $saleDate->format('M d, Y');
                echo 'Sales Summary - '.$formattedDate . PHP_EOL;
            } else {
                echo "Invalid date format: " . $row['fsale_date'] . PHP_EOL;
            }
        }


    }

    public function gettrxsummary($zcounter){
        $sql = "SELECT SUM(fgross) AS gross, COUNT(*) AS total FROM pos_sale WHERE fzcounter='$zcounter'";
        $res = $this->queryselect($sql);

        $gross = $res[0]['gross'];
        $totaltrx = $res[0]['total'];

        echo '<b>Total Gross = </b>'.+ $gross.'<br>';
        echo '<b> Total Transactions = </b>'.+ $totaltrx;

    }

    public function getcompanyid(){
        $sql = "SELECT * FROM sm_company WHERE factive_flag='1'";
        $res = $this->queryselect($sql);

        $companyid = $res[0]['fcompanyid'];
        return $companyid;

    }

    public function getcompanyimg($fcompanyid){
        $sql = "SELECT fcompanyimg FROM sm_company WHERE fcompanyid='$fcompanyid'";
        $res = $this->queryselect($sql);
        
        $companyimg = $res[0]['fcompanyimg'];

        return $companyimg;

    }

    public function deletecimg(){
        $path = 'img/';
        unlink($path.$this->getcompanyimg($this->getcompanyid()));
        
        return true;
    }

    public function showimg(){
        $path = 'img/';
        $respath = $path.$this->getcompanyimg($this->getcompanyid());
        
        return $respath;
    }

    public function getcname(){
        $sql = "SELECT * FROM sm_company WHERE factive_flag='1'";
        $res = $this->queryselect($sql);

        $companyname = $res[0]['fname'];

        return $companyname;
    }

    public function getcompanyname(){
        $sql = "SELECT * FROM sm_company WHERE factive_flag='1'";
        $res = $this->queryselect($sql);

        $companyname = $res[0]['fname'];
        echo $companyname;
        
        return $companyname;

    }

    // Function to check if the expiry date has passed
    public function hasExpired($expiryDate) {
        $currentDate = date("Ymd"); // Get the current date in the format "YYYY-MM-DD"
        
        return ($currentDate > $expiryDate);
    }
    public function getlicenseexpiry(){
        
        $fcompanyid = $this->getcompanyid();
        $sql = "SELECT fexpiry FROM sm_company WHERE fcompanyid='$fcompanyid'";
        $res = $this->queryselect($sql);

        $expiry = $res[0]['fexpiry'];
        echo $expiry;
        return $expiry;
    }

    public function getexpiryactive(){

        $sql = "SELECT * FROM sm_company";
    }

    public function generatePrefix($inputString) {
        $inputString = strtoupper($inputString); // Convert to uppercase
        $prefix = substr($inputString, 0, 3); // Get the first three characters
        return $prefix;
    }

    public function truncatetable() {

        $tables = array('mst_product', 'mst_account');
    
        foreach ($tables as $table) {
            $sql = "TRUNCATE TABLE $table"; // or "DELETE FROM $table" to empty the table
            $res = $this->queryselect($sql);

            return $res;
        }
    }

    public function execupdatecompany($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $params){
        $exec = $this->updatecompany($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $params);
        
        return $exec;

    }

    public function getmonthlysummary(){
        $exec = $this->getmonthlygross($this->getcompanyid());
        
        return $exec;
        
    }

    public function gettop5products(){
        $exec = $this->gettopproducts($this->getcompanyid());
        
        return $exec;
        
    }

    public function getcurrentmonthgross(){
        $exec = $this->getcurrentmonthsales($this->getcompanyid());
         
        //$number2 = $exec[0]['total_sales'];
        //$formattedNumber1 = number_format($number2 , 2);

        return $exec;
        
    }

    public function version(){
        return $this->getversion();
    }

    public function createcompany($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19){

        $this->disablecompany();

        return $this->insertcompany($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19);
    }

    function generateCompanyID($companyName) {
        $words = explode(' ', $companyName);
        $firstWord = strtoupper(substr($words[0], 0, 1));
        $middleWord = strtoupper(substr($words[count($words) / 2], 0, 1));
        $lastWord = strtoupper(substr(end($words), 0, 1));
        
        $randomNumbers = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
        
        $companyID = $firstWord . $middleWord . $lastWord .'-'. $randomNumbers;
        
        return $companyID;
    }

    function generateCompanykey($companyName) {
        $words = explode(' ', $companyName);
        $firstWord = strtoupper(substr($words[0], 0, 1));
        $middleWord = strtoupper(substr($words[count($words) / 2], 0, 1));
        $lastWord = strtoupper(substr(end($words), 0, 1));
        
        $randomNumbers = str_pad(rand(0, 999999999), 7, '0', STR_PAD_LEFT);
        
        $companykey = $firstWord . '-'. $randomNumbers;
        
        return $companykey;
    }

    public function setinactive(){
        $sql = "UPDATE sm_company SET factive_flag='0' WHERE factive_flag='1'";
        $res = $this->queryselect($sql);

        return $res;
    }

    function clearsessions() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION = array();
        
        session_destroy();

        return 0;
    }

    public function getcompanydetails(){
        $sql = "
        SELECT * FROM sm_company WHERE factive_flag='1'
        ";
        $res = $this->queryselect($sql);
        
        return $res;
    }

    public function getcompanylicense($params){
        $sql = "
        SELECT * FROM sm_license WHERE flicense='$params'
        ";
        $res = $this->queryselect($sql);

        if(count($res) > 0){
            return '1';
        }
        else{
            return '0';
        }

    }


    function logvisitor($ipaddress) {
        $updateby = 'system';
        $updatedate = date('YMD H:i:s');

        $query = "
        SELECT * FROM sm_ip_logs WHERE fip_address='$ipaddress';
        ";
        $res = $this->queryselect($query);

        if(count($res) > 0){
            $sql = "
            UPDATE sm_ip_logs SET fvisit_count=fvisit_count+1 fupdated_date='$updatedate' WHERE fip_address='$ipaddress'
            ";
            $this->queryselect($sql);

            return 0;

        }
        else{
            $sql = "
            INSERT INTO sm_ip_logs (fip_address, fvisit_count, fupdated_by, fupdated_date) VALUES ('$ipaddress', '1', '$updateby', '$updatedate');
            ";
            $this->queryselect($sql);

            return 0;
        }
    
    }

    function companylogin($username, $password) {
        // Replace with your actual authentication logic
        if ($username === "example" && $password === "password") {
            
            
            // Authentication successful
            $_SESSION['loggedin'] = true; // Set a session variable to indicate the user is logged in
            $_SESSION['username'] = $username; // Store user-specific data in the session
            return true;
        } else {
            return false;
        }
    }

    public function getactivecomp(){
        
        $activecompany = $this->getcompanyid();
        
        if(!empty($activecompany)){
            //if there is
            echo '1';
            return 0;
        }
        else{
            echo '0';
            return 0;
        }
    }

    public function processcreds($compid, $compkey){
        $rowCount = $this->validatecreds($compid, $compkey);

        if ($rowCount > 0) {
            return '1';
        } else {
            return '0';
        }
    }


    

}

