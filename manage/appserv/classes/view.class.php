<?php

if (!defined('BASE')) define('BASE', dirname(__FILE__) ."/../");
require_once 'controller.class.php';
//require_once BASE.'/classes/controller.class.php';




//This class will show the data to the front-end

class view extends controller{

    public $per_page;

    public function __construct($perpage){
        $this->per_page = $perpage;
    }

    public function showUsers(){
        //Function to fetch all data from mst_account table
        $users = $this->getUser();
        
        foreach($users as $row){
            ?><tr>
                
                <td><span class="custom-checkbox"><input type="checkbox" class="userCheckbox" data-user-id="<?=$row['faccountid'];?>"></span>
                </td>
                <td><?=$row['faccountid'];?></td>
                <td><?=$row['ffname'];?> <?=$row['flname'];?></td>
                <td><?=$row['fuserid'];?></td>
                <td><?=$row['faccesslvl'];?></td>
                <td><?=$row['femail'];?></td>
                <td><?=$row['faddress'];?></td>
                <td><?=$row['fphone'];?></td>
                <td><?=$row['fcreated_by'];?></td>
                <td><?=$row['fupdated_date'];?></td>
                <td>
                    <button onclick="editModal('<?=$row['faccountid'];?>', '<?=$row['ffname'];?>', '<?=$row['flname'];?>', '<?=$row['faddress'];?>', '<?=$row['femail'];?>', '<?=$row['fphone'];?>', '<?=$row['fuserid'];?>', '<?=$row['fpassword'];?>', '<?=$row['fpassword_update'];?>', '<?=$row['fbirthdate'];?>')" 
                    
                    class="open_usersz"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button>
                </td>
               </tr> 
            <?php
        }


        return $users; 
    }
    
    public function getproductimage($categoryid){
        $exec = $this->getprodimg($categoryid);

        return $exec;
    }



    public function paginationfetch($limit){
        //Function to fetch limited data from mst_account table
        $fetchedusers = $this->paginationctrl($limit);
        if(count($fetchedusers) > 0){
            
            foreach($fetchedusers as $row){
                ?><tr>
                    <td><span class="custom-checkbox"><input type="checkbox" class="userCheckbox" data-user-id="<?=$row['faccountid'];?>"></span>
                    </td>
                    <td><?=$row['faccountid'];?></td>
                    <td><?=$row['ffname'];?> <?=$row['flname'];?></td>
                    <td><?=$row['fuserid'];?></td>
                    <td><?=$row['faccesslvl'];?></td>
                    <td><?=$row['femail'];?></td>
                    <td><?=$row['faddress'];?></td>
                    <td><?=$row['fphone'];?></td>
                    <td><?=$row['fcreated_by'];?></td>
                    <td><?=$row['fupdated_date'];?></td>
                    <td>
                        <button onclick="editModal('<?=$row['faccountid'];?>', '<?=$row['ffname'];?>', '<?=$row['flname'];?>', '<?=$row['faddress'];?>', '<?=$row['femail'];?>', '<?=$row['fphone'];?>', '<?=$row['fuserid'];?>', '<?=$row['fpassword'];?>', '<?=$row['fpassword_update'];?>', '<?=$row['fbirthdate'];?>')" 
                        
                        class="open_usersz"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button>
                    </td>
                   </tr> 
                <?php
            }
        }
        else{
            echo '<tr><td colspan="11">No records found...</td></tr>'; 
        }
 
        return $fetchedusers;
    }
    public function select($query){
        $result = $this->queryselect($query);
        return $result;

    }

    public function gproductcategory(){
        $query = "SELECT a.fcategoryid, a.fcategory_name, b.factive_flag FROM mst_product_category as a JOIN sm_company AS b ON a.fcompanyid = b.fcompanyid WHERE b.factive_flag='1'";
        $res = $this->getcategory($query);
        echo "<option value='uncategorized'>Uncategorized</option>";
        
        foreach($res as $row){
            echo "<option value='".$row['fcategoryid']."'>".$row['fcategory_name']."</option>";
        }
        
        return $row;
        
    }

    public function gproductuom(){
        $query = "SELECT * FROM mst_product_category";
        $res = $this->getuom($query);
        
        foreach($res as $row){
            echo "<option value='".$row['fcategoryid']."'>".$row['fcategory_name']."</option>";
        }
        
        return $row;
        
    }


    public function gproductcategory2(){
        $query = "SELECT a.fcategoryid, a.fcategory_name, b.factive_flag FROM mst_product_category as a JOIN sm_company AS b ON a.fcompanyid = b.fcompanyid WHERE b.factive_flag='1' ";
        $res = $this->getcategory($query);
        echo "<option value='any'>Any</option>";
        echo "<option value='uncategorized'>Uncategorized</option>";
        foreach($res as $row){
            echo "<option value='".$row['fcategoryid']."'>".$row['fcategory_name']."</option>";
        }
        
        return $row;
        
    }
    
    
    public function createpagi_link($table, $url){

        if(isset($_GET['search'])){
            //Search Account
            $search = $_GET['search'];

            $per_page = $this->per_page;
            $current_page = '';
            $params = "flname LIKE '%$search%' OR femail LIKE '%$search%' OR ffname LIKE '%$search%' OR faccountid LIKE '%$search%' OR fuserid LIKE '%$search%'";

            if(isset($_GET['page'])){
                $current_page = $_GET['page'];
            }
            else{
                $current_page = '1';
            }
    
            if(!is_numeric($current_page)){
                $current_page = '1';
            }
    
            //$table = "mst_account";
            $dump = $this->paginationlink2($table, $per_page, $current_page, $params, $url);
            echo $dump;
            return $dump;



        }
        //Search Product
        if(isset($_GET['sproduct'])){

            $search = $_GET['sproduct'];

            $per_page = $this->per_page;
            $current_page = '';
            $params = "p.fproductid LIKE '%$search%' OR p.fname LIKE '%$search%' and comp.factive_flag='1'";

            if(isset($_GET['page'])){
                $current_page = $_GET['page'];
            }
            else{
                $current_page = '1';
            }
    
            if(!is_numeric($current_page)){
                $current_page = '1';
            }
    
            //$table = "mst_account";
            $dump = $this->paginationlink2($table, $per_page, $current_page, $params, $url);
            echo $dump;
            return $dump;

        }
        //Search Account via Filter
        elseif(isset($_GET['filterby'])){
            $filterby = $_GET['filterby'];
            $per_page = $this->per_page;
            $current_page = '';
            $params = "faccesslvl='$filterby'";

            if(isset($_GET['page'])){
                $current_page = $_GET['page'];
            }
            else{
                $current_page = '1';
            }
    
            if(!is_numeric($current_page)){
                $current_page = '1';
            }
    
            //$table = "mst_account";
            $dump = $this->paginationlink2($table, $per_page, $current_page, $params,$url);
            echo $dump;
            return $dump;
        }

        //Search sales via transaction date
        elseif(isset($_GET['ftrxdate'])){
            $filterby = $_GET['ftrxdate'];
            $per_page = $this->per_page;
            $current_page = '';
            $params = "a.fsale_date>='$filterby' AND b.factive_flag='1'";
            if(isset($_GET['page'])){
                $current_page = $_GET['page'];
            }
            else{
                $current_page = '1';
            }
    
            if(!is_numeric($current_page)){
                $current_page = '1';
            }
    
            //$table = "mst_account";
            $dump = $this->paginationlink2($table, $per_page, $current_page, $params,$url);
            echo $dump;
            return $dump;
        }

        //Search Product via Filter 
        elseif(isset($_GET['sfilterby']) && isset($_GET['szcategory'])){
            $filterby = $_GET['sfilterby'];
            $category = $_GET['szcategory'];

            $per_page = $this->per_page;
            $current_page = '';

            
            if($category == 'any'){
                $params = "p.fstatus='$filterby' AND comp.factive_flag='1'";
            }
            elseif($filterby == 'any'){
                $params = "p.fcategory_id='$category' AND comp.factive_flag='1'";
            }
            else{
                $params = "p.fstatus='$filterby' and p.fcategory_id='$category' AND comp.factive_flag='1'";
            }


            if(isset($_GET['page'])){
                $current_page = $_GET['page'];
            }
            else{
                $current_page = '1';
            }
    
            if(!is_numeric($current_page)){
                $current_page = '1';
            }
    
            //$table = "mst_account";
            $dump = $this->paginationlink2($table, $per_page, $current_page, $params,$url);
            echo $dump;
            return $dump;
        }
        

        //if search is empty!
        else{
            $per_page = $this->per_page;
            $current_page = '';
            $params = "";
    
            if(isset($_GET['page'])){
                $current_page = $_GET['page'];
            }
            else{
                $current_page = '1';
            }
    
            if(!is_numeric($current_page)){
                $current_page = '1';
            }
    
            //$table = "mst_account";
            $dump = $this->paginationlink2($table, $per_page, $current_page, $params,$url);
            echo $dump;
            return $dump;
        }

        
    }

    
    public function displayinfo($table){

        if(isset($_GET['search'])){
            $per_page = $this->per_page;
            $current_page = '';
            $search = $_GET['search'];
            
            $params = "flname LIKE '%$search%' OR femail LIKE '%$search%' OR ffname LIKE '%$search%' OR faccountid LIKE '%$search%' OR fuserid LIKE '%$search%'";
    
            if(isset($_GET['page'])){
                $current_page = $_GET['page'];
            }
            else{
                $current_page = '1';
            }
    
            //$table = "mst_account";
            $show = $this->displayresult($table, $per_page, $current_page ,$params);
            echo $show;
            return $show;
        }

        elseif(isset($_GET['sproduct'])){
            $per_page = $this->per_page;
            $current_page = '';
            $search = $_GET['sproduct'];
            
            $params = "p.fproductid LIKE '%$search%' OR p.fname LIKE '%$search%' and comp.factive_flag='1' ";
    
            if(isset($_GET['page'])){
                $current_page = $_GET['page'];
            }
            else{
                $current_page = '1';
            }
    
            //$table = "mst_account";
            $show = $this->displayresult($table, $per_page, $current_page ,$params);
            echo $show;
            return $show;
        }

        elseif(isset($_GET['ftrxdate'])){
            $per_page = $this->per_page;
            $current_page = '';
            $table = "pos_reading as a JOIN sm_company as b ON a.fcompanyid = b.fcompanyid";

            $ftrx = $_GET['ftrxdate'];

            $search = str_replace("-", "", $ftrx);
            
            $params = "b.factive_flag='1' AND a.fsale_date>='$search'";
    
            if(isset($_GET['page'])){
                $current_page = $_GET['page'];
            }
            else{
                $current_page = '1';
            }
    
            //$table = "mst_account";
            $show = $this->displayresult($table, $per_page, $current_page ,$params);
            echo $show;
            return $show;
        }
        
        elseif(isset($_GET['sfilterby']) && isset($_GET['szcategory'])){
            $per_page = $this->per_page;
            $current_page = '';
            $filterby = $_GET['sfilterby'];
            $category = $_GET['szcategory'];

            if($category == 'any'){
                $params = "p.fstatus='$filterby' and comp.factive_flag = '1' ";
            }
            elseif($filterby == 'any'){
                $params = "p.fcategory_id='$category' and comp.factive_flag = '1' ";
            }
            else{
                $params = "p.fstatus='$filterby' and p.fcategory_id='$category' and comp.factive_flag='1' ";
            }
            
    
            if(isset($_GET['page'])){
                $current_page = $_GET['page'];
            }
            else{
                $current_page = '1';
            }
    
            //$table = "mst_account";
            $show = $this->displayresult($table, $per_page, $current_page ,$params);
            echo $show;
            return $show;
        }
        

        elseif(isset($_GET['filterby'])){
            $per_page = $this->per_page;
            $current_page = '';
            $filterby = $_GET['filterby'];
            
            $params = "faccesslvl='$filterby'";
    
            if(isset($_GET['page'])){
                $current_page = $_GET['page'];
            }
            else{
                $current_page = '1';
            }
    
            //$table = "mst_account";
            $show = $this->displayresult($table, $per_page, $current_page ,$params);
            echo $show;
            return $show;
        }


        
        else{
            $per_page = $this->per_page;
            $current_page = '';
            $params = "";
    
            if(isset($_GET['page'])){
                $current_page = $_GET['page'];
            }
            else{
                $current_page = '1';
            }
    
            //$table = "mst_account";
            $show = $this->displayresult($table, $per_page, $current_page, $params);
            echo $show;
            return $show;
        }



    }
}

